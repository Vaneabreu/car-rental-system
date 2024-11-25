<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Reserva;
use App\Models\Cliente;
use App\Models\Gasto;
use App\Models\Ventas;
use Illuminate\Support\Facades\View;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VehiculoController extends Controller
{
    public function crear()
    {
        $clientes = Cliente::all();
        return view('vehiculos.crear', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'año_vehiculo' => 'required|integer',
            'color' => 'required|string',
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'matricula' => 'required|string',
            'placa' => 'required|string',
            'imagen' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('imagen')->store('imagenes', 'public');

        Vehiculo::create(array_merge($request->all(), ['imagen' => $path]));

        return redirect()->route('vehiculos.crear')->with('success', 'El vehículo ha sido registrado exitosamente.');
    }


    public function ver()
    {
        $vehiculos = Vehiculo::where('status', 'Activo')->get();

        $vehiculoConMasReservas = Vehiculo::withCount('reservas')->orderByDesc('reservas_count')->first();
        $clientes = Cliente::all();
        $user = Auth::user();
        $name = $user->name;

        return view('vehiculos.ver', compact('vehiculos', 'clientes', 'vehiculoConMasReservas', 'name'));
    }

    public function editar($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $clientes = Cliente::all();

        return view('vehiculos.editar', compact('vehiculo', 'clientes'));
    }

    public function actualizar(Request $request, $id)
    {

        $request->validate([
            'año_vehiculo' => 'required',
            'color' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $vehiculo = Vehiculo::findOrFail($id);

        $vehiculo->año_vehiculo = $request->año_vehiculo;
        $vehiculo->color = $request->color;
        $vehiculo->marca = $request->marca;
        $vehiculo->modelo = $request->modelo;

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('imagenes', 'public');
            $vehiculo->imagen = $path;
        }

        $vehiculo->save();

        return redirect()->route('vehiculos.ver')->with('success', 'Vehículo actualizado correctamente');
    }

    public function eliminar($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $vehiculo->update(['status' => 'eliminado']);

        return redirect()->route('vehiculos.ver')->with('success', 'Vehículo eliminado correctamente');
    }

    public function estadoCuenta(Request $request)
    {
        $mesSeleccionado = $request->input('mes');

        $query = Reserva::with('vehiculo')->where('status', 'Activa');

        if ($mesSeleccionado) {
            $reservas = $query->whereMonth('fecha_salida', $mesSeleccionado)
                              ->whereYear('fecha_salida', '=', date('Y'))
                              ->get();
        } else {
            $reservas = $query->whereYear('fecha_salida', '=', date('Y'))
                              ->get();
        }

        $gastosActivos = Gasto::where('status', 'Activo')->get();

        $vehiculos = Vehiculo::with('gastos')->get();
        $clientes = Cliente::all();
        $gastos = Gasto::where('status', 'Activo')->get();


        $comisionFinal = 0;
        $totalGastos = 0;

        foreach ($reservas as $reserva) {
            $comisionFinal += $reserva->comision * $reserva->dias_renta;

            if ($reserva->vehiculo) {
                $totalGastos += $gastosActivos->where('vehiculo_id', $reserva->vehiculo_id)->sum('monto');
            }
        }

        $totalFinal = $comisionFinal - $totalGastos;

        return view('vehiculos.estado_cuenta', compact('reservas', 'mesSeleccionado', 'comisionFinal', 'totalFinal', 'clientes', 'gastos', 'vehiculos'));
    }


    public function generarFacturaPDF(Request $request)
    {
        $mes = $request->input('mes');
        $reservas = Reserva::whereMonth('fecha_reserva', $mes)->get();
        $vehiculos = Vehiculo::with('gastos')->get();
        $gastos = Gasto::all();


        // Calcula el total final
        $totalFinal = $reservas->sum('total');

        $view = view('vehiculos.estado_cuenta', compact('reservas', 'totalFinal', 'vehiculos', 'gastos'));

        // Renderiza la vista en HTML
        $html = $view->render();

        // Configuración de dompdf
        $options = new Options();
        $options->setIsRemoteEnabled(true);
        $options->set('defaultFont', 'Arial');

        // Instancia de dompdf
        $dompdf = new Dompdf($options);

        // Carga el contenido HTML en dompdf
        $dompdf->loadHtml($html);

        // Renderiza el contenido HTML en PDF
        $dompdf->render();

        // Genera el nombre del archivo PDF
        $filename = 'estado_cuenta.pdf';

        // Descarga el archivo PDF
        $dompdf->stream($filename, ['Attachment' => true]);
    }

    public function printEstadoCuenta()
    {
        $reservas = Reserva::all();

        return view('print', compact('reservas'));
    }

    public function estadoCuentaPDF(Request $request)
    {

        $mesSeleccionado = $request->input('mes');

        if ($mesSeleccionado === null) {
            $reservas = Reserva::whereYear('fecha_salida', '=', date('Y'))
                ->get();
        } else {
            $reservas = Reserva::whereMonth('fecha_salida', $mesSeleccionado)
                ->whereYear('fecha_salida', '=', date('Y'))
                ->get();
        }

        $vehiculos = Vehiculo::with('gastos')->get();
        $gastos = Gasto::all();
        $clientes = Cliente::all();
        $html = View::make('estado_cuenta_pdf', compact('reservas', 'mesSeleccionado', 'vehiculos', 'gastos', 'clientes'))->render();

        // Crea una instancia de Dompdf
        $dompdf = new Dompdf();

        // Carga el HTML en Dompdf
        $dompdf->loadHtml($html);

        // Renderiza el PDF
        $dompdf->render();

        // Genera el nombre del archivo PDF
        $filename = 'factura.pdf';

        // Descarga el PDF en el navegador
        $dompdf->stream($filename);
    }


    public function cars()
    {
        $vehiculos = Vehiculo::all();

        foreach ($vehiculos as $vehiculo) {
            $reserva = Reserva::where('vehiculo_id', $vehiculo->id)
                ->whereDate('fecha_salida', date('Y-m-d'))
                ->first();

            if ($reserva) {
                $vehiculo->status = "Reservado";
            } else {
                $vehiculo->status = "Disponible";
            }
        }

        return view('carros', compact('vehiculos'));
    }

    public function CrearVenta()
    {
        $clientes = Cliente::get();
        $vehiculos = Vehiculo::all();
        return view('vehiculos.venta', compact('clientes', 'vehiculos'));
    }

    public function storeVenta(Request $request)
    {
        $vehiculo = Vehiculo::find($request->vehiculo_id);
        $cliente = Cliente::find($request->cliente_id);

        $precio = $request->precio;
        $traspaso = $request->precio_traspaso;

        $total = $precio + $traspaso;

        $venta = Ventas::create([
            'vehiculo_id' =>  $vehiculo->id,
            'cliente_id'  => $cliente->id,
            'fecha_venta' => $request->fecha_venta,
            'precio' => $request->precio,
            'precio_traspaso' => $request->precio_traspaso,
            'total' => $total,

        ]);

        return redirect()->route('vehiculos.viewVentas')->with('success', 'Venta creada exitosamente');
    }

    public function viewVentas(Request $request)
    {
        $ventasVehiculos = Ventas::query();

        //verificar si el campo fecha en la solicitud tiene un valor.
        if ($request->filled('fecha')) {
            $ventasVehiculos->whereDate('fecha_venta', $request->input('fecha'));
        }
        $ventas = $ventasVehiculos->paginate(6);
        $vehiculos = Vehiculo::all();
        $clientes = Cliente::all();

        return view('vehiculos.ventasview', compact('ventas', 'vehiculos', 'clientes'));
    }

    public function editVenta($id)
    {
        $venta = Ventas::findOrFail($id);
        $vehiculos = Vehiculo::all();
        $clientes = Cliente::all();

        return view('vehiculos.ventasedit', compact('venta', 'vehiculos', 'clientes'));
    }

    public function destroyVenta($id)
    {
        $venta = Ventas::findOrFail($id);
        $venta->delete();

        return redirect()->route('vehiculos.viewVentas')->with('success', 'Venta eliminada correctamente');
    }

    public function updateVenta(Request $request, $id)
    {
        $request->validate([
            'fecha_venta' => 'required',
            'precio' => 'required|numeric',
            'vehiculo_id' => 'required|exists:vehiculos,id',
        ]);

        $venta = Ventas::findOrFail($id);

        $venta->fecha_venta = $request->fecha_venta;
        $venta->precio = $request->precio;
        $venta->precio_traspaso = $request->precio_traspaso;
        $venta->vehiculo_id = $request->vehiculo_id;
        $venta->cliente_id = $request->cliente_id;

        // Actualizar la columna total con la suma de precio y precio_traspaso
        $venta->total = $request->precio + $request->precio_traspaso;

        $venta->save();

        session()->flash('success', 'Venta editado exitosamente');

        return redirect()->route('vehiculos.viewVentas');
    }

    public function reservasPorMes(Request $request)
    {
        $mesSeleccionado = $request->input('mes');
        $fechaSeleccionada = $request->input('fecha');

        if ($mesSeleccionado === null && $fechaSeleccionada === null) {
            // Mostrar todas las reservas si no se selecciona un mes ni una fecha
            $reservas = Reserva::whereYear('fecha_salida', '=', date('Y'))->paginate(4);
        } elseif ($mesSeleccionado !== null) {
            // Filtrar por mes si se selecciona un mes
            $reservas = Reserva::with('cliente')
                ->whereMonth('fecha_salida', $mesSeleccionado)
                ->whereYear('fecha_salida', date('Y'))
                ->paginate(4);
        } elseif ($fechaSeleccionada !== null) {
            // Filtrar por fecha si se selecciona una fecha
            $reservas = Reserva::with('cliente')
                ->whereDate('fecha_salida', $fechaSeleccionada)
                ->paginate(4);
        }

        $clientes = Cliente::all();
        $vehiculos = Vehiculo::all();

        return view('vehiculos.reservas_por_mes', compact('reservas', 'mesSeleccionado', 'clientes', 'vehiculos'));
    }

    public function paginaWeb()
    {
        $vehiculos = Vehiculo::all();

        return view('pagina_web', compact('vehiculos'));
    }
}
