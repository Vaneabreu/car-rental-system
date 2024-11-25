<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Reserva;
use App\Models\Cliente;
use App\Models\Gasto;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class ReservaController extends Controller
{
    public function calendar(Request $request)
    {
        $mesSeleccionado = $request->input('mes');

        if ($mesSeleccionado === null) {
            $reservas = Reserva::whereYear('fecha_salida', '=', date('Y'))
                ->get();
        } else {
            $reservas = Reserva::with('cliente')
                ->whereMonth('fecha_salida', $mesSeleccionado)
                ->whereYear('fecha_salida', date('Y'))
                ->get();
        }

        // Agrupa las reservas por día
        foreach ($reservas as $reserva) {
            $reserva->fecha_salida = \Carbon\Carbon::parse($reserva->fecha_salida);
        }
        $clientes = Cliente::all();
        $vehiculos = Vehiculo::all();

        return view('calendar', compact('reservas', 'mesSeleccionado', 'clientes', 'vehiculos'));
    }


    public function create(Request $request)
    {
        $mesSeleccionado = $request->input('mes');

        if ($mesSeleccionado === null) {
        $reservas = Reserva::whereYear('fecha_salida', '=', date('Y'))
                ->get();
        } else {
            $reservas = Reserva::with('cliente')
                ->whereMonth('fecha_salida', $mesSeleccionado)
                ->whereYear('fecha_salida', date('Y'))
                ->get();
        }

        foreach ($reservas as $reserva) {
            $reserva->fecha_salida = \Carbon\Carbon::parse($reserva->fecha_salida);
        }

        $gastos = Gasto::all();
        $clientes = Cliente::all();
        $vehiculos = Vehiculo::all();

        return view('vehiculos.reservar', compact('reservas', 'mesSeleccionado', 'clientes', 'vehiculos'));
    }

    public function editar($id)
    {
        $reserva = Reserva::findOrFail($id);
        $clientes = Cliente::all();

        return view('editar', compact('reserva', 'clientes'));
    }

    public function actualizar(Request $request, $id)
    {
        $request->validate([
            'fecha_salida' => 'required',
            'fecha_entrada' => 'required',
        ]);

        $reserva = Reserva::findOrFail($id);
        $vehiculo = Vehiculo::find($request->vehiculo_id);
        $reserva->vehiculo = $request->vehiculo;
        $reserva->fecha_salida = $request->fecha_salida;
        $reserva->fecha_entrada = $request->fecha_entrada;

        $reserva->vehiculo_id = $request->vehiculo_id;
        $reserva->vehiculo = $vehiculo->marca . ' ' . $vehiculo->modelo . ' ' . $vehiculo->año_vehiculo;
        $fechaSalida = Carbon::parse($request->fecha_salida);
        $fechaEntrada = Carbon::parse($request->fecha_entrada);
        $diasRenta = $fechaSalida->diffInDays($fechaEntrada);

        $reserva->dias_renta = $diasRenta;
        $reserva->precio_dia = $request->precio_dia;
        $reserva->comision = $request->comision;
        $reserva->total = $reserva->dias_renta * $reserva->precio_dia;
        $reserva->cliente_id = $request->cliente_id;
        $reserva->fecha_reserva = $fechaSalida->format('F');

        $reserva->save();

        return redirect()->route('reservas.por-mes')->with('success', 'Reserva actualizada correctamente');
    }


    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required',
            'vehiculo_id' => 'required',
            'fecha_salida' => 'required|date_format:d-m-Y',
            'fecha_entrada' => 'required|date_format:d-m-Y',
            'precio_dia' => 'required',
            'comision' => 'required',
        ]);

        $vehiculo = Vehiculo::find($request->vehiculo_id);
        $cliente = Cliente::find($request->cliente_id);

        // Parsear fechas desde el formato 'd-m-Y' al formato 'Y-m-d'
        $fechaSalida = Carbon::createFromFormat('d-m-Y', $request->fecha_salida);
        $fechaEntrada = Carbon::createFromFormat('d-m-Y', $request->fecha_entrada);

        $diasRenta = $fechaSalida->diffInDays($fechaEntrada);

        $reserva = new Reserva;

        $reserva->vehiculo_id = $request->vehiculo_id;
        $reserva->cliente_id = $request->cliente_id;
        $reserva->vehiculo = $vehiculo->marca . ' ' . $vehiculo->modelo . ' ' . $vehiculo->año_vehiculo;
        $reserva->dias_renta = $diasRenta;
        $reserva->comision = $request->comision;
        $reserva->fecha_salida = $fechaSalida->format('Y-m-d'); // Guardar en el formato correcto
        $reserva->fecha_entrada = $fechaEntrada->format('Y-m-d'); // Guardar en el formato correcto

        $mesesEnEspanol = [
            'January' => 'Enero',
            'February' => 'Febrero',
            'March' => 'Marzo',
            'April' => 'Abril',
            'May' => 'Mayo',
            'June' => 'Junio',
            'July' => 'Julio',
            'August' => 'Agosto',
            'September' => 'Septiembre',
            'October' => 'Octubre',
            'November' => 'Noviembre',
            'December' => 'Diciembre'
        ];

        // Convertir la fecha de salida a nombre de mes en español
        $reserva->fecha_reserva = $mesesEnEspanol[$fechaSalida->format('F')];
        $reserva->precio_dia = $request->precio_dia;
        $reserva->total = $reserva->dias_renta * $reserva->precio_dia;

        $reserva->save();
        $mensajeExito = 'Reserva creada exitosamente';

        session()->flash('success', $mensajeExito);
        return redirect()->route('reservas.por-mes');
    }

    public function reservasPorMes(Request $request)
    {
        $mesSeleccionado = $request->input('mes');
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');


        $query = Reserva::with('cliente')
                        ->where('status', 'Activa');

        if ($mesSeleccionado !== null) {
            $query->whereMonth('fecha_salida', $mesSeleccionado)
                ->whereYear('fecha_salida', date('Y'));
        } elseif ($fechaInicio !== null && $fechaFin !== null) {
            $query->whereBetween('fecha_salida', [$fechaInicio, $fechaFin]);
        } else {
            $query->whereYear('fecha_salida', date('Y'));
        }

        $reservasCompleto = clone $query;
        $totalFinal = 0;
        foreach ($reservasCompleto->get() as $reserva) {
            $comisionFinal = $reserva->comision * $reserva->dias_renta;
            $totalFinal += $reserva->total - $comisionFinal;
        }

        $reservas = $query->paginate(8);

        $clientes = Cliente::all();
        $vehiculos = Vehiculo::all();

        return view('vehiculos.reservas_por_mes', compact('reservas', 'mesSeleccionado', 'fechaInicio', 'fechaFin', 'clientes', 'vehiculos', 'totalFinal'));
    }

    public function generarFacturaPDF(Request $request)
    {
        $mes = $request->input('mes');

        $reservas = Reserva::whereMonth('fecha_reserva', $mes)->get();
        $reservas = Reserva::all();
        $totalFinal = $reservas->sum('total');

        $html = View::make('vehiculos.factura', compact('reservas', 'totalFinal'))->render();

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

    public function eliminar($id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->update(['status' => 'eliminada']);

        return redirect()->route('reservas.por-mes')->with('success', 'Reserva eliminada correctamente');
    }
}
