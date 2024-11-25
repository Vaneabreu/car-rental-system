<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Cotizaciones;
use Dompdf\Dompdf;
use App\Models\Cliente;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

class CotizacionController extends Controller
{

    public function index(Request $request)
    {
        $query = Cotizaciones::where('status', 'Activa');

        if ($request->has('vehiculo_id') && $request->vehiculo_id != '') {
            $query->where('vehiculo_id', $request->vehiculo_id);
        }

        $cotizaciones = $query->paginate(8);
        $clientes = Cliente::all();
        $vehiculos = Vehiculo::all();

        return view('cotizacion.cotizaciones', compact('cotizaciones', 'clientes', 'vehiculos'));
    }

    public function crear()
    {
        $vehiculos = Vehiculo::all();
        $clientes = Cliente::all();

        return view('cotizacion.crear', compact('vehiculos', 'clientes'));
    }

    public function generar(Request $request)
    {
        $request->validate([
            'vehiculo_id' => 'required',
            'fecha_salida' => 'required|date_format:d-m-Y',
            'fecha_entrada' => 'required|date_format:d-m-Y',
            'precio_dia' => 'required|numeric',
        ]);

        $vehiculo = Vehiculo::find($request->vehiculo_id);

        $fechaSalida = Carbon::createFromFormat('d-m-Y', $request->fecha_salida);
        $fechaEntrada = Carbon::createFromFormat('d-m-Y', $request->fecha_entrada);

        $diasRenta = $fechaEntrada->diffInDays($fechaSalida);

        $precioDia = $request->precio_dia;

        $total = $diasRenta * $precioDia;

        $cotizacion = Cotizaciones::create([
            'vehiculo_id' => $vehiculo->id,
            'fecha_salida' => $fechaSalida->format('Y-m-d'),
            'fecha_entrada' => $fechaEntrada->format('Y-m-d'),
            'dias_renta' => $diasRenta,
            'precio_dia' => $precioDia,
            'total' => $total,
        ]);

        return redirect()->route('cotizacion.index')->with('success', 'Cotización creada correctamente.');
    }

    public function ver($id)
    {
        $cotizacion = Cotizaciones::with('vehiculo')->findOrFail($id);
        $clientes = Cliente::all();
        return view('cotizacion.ver', compact('cotizacion', 'clientes'));
    }

   /*  public function edit(Cotizaciones $cotizacion)
    {
        $vehiculos = Vehiculo::all();
        $clientes = Cliente::all();

        return view('cotizacion.editar', compact('cotizacion', 'vehiculos', 'clientes'));
    } */

    public function edit(Cotizaciones $cotizacion)
    {
        // Formatear las fechas
        $cotizacion->fecha_salida = date("d-m-Y", strtotime($cotizacion->fecha_salida));
        $cotizacion->fecha_entrada = date("d-m-Y", strtotime($cotizacion->fecha_entrada));

        $vehiculos = Vehiculo::all();
        $clientes = Cliente::all();

       /*  dd($cotizacion); */
        return view('cotizacion.editar', compact('cotizacion', 'vehiculos', 'clientes'));
    }

    public function actualizar(Request $request, $id)
    {
        //dd($request->all());
        $cotizacion = Cotizaciones::findOrFail($id);

        $validatedData = $request->validate([
            'vehiculo_id' => 'required',
            'fecha_salida' => 'required',
            'fecha_entrada' => 'required',
            'dias_renta' => 'required|integer',
            'precio_dia' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        $cotizacion->update($validatedData);

        return redirect()->route('cotizacion.ver', $cotizacion->id)->with('success', 'Cotización actualizada correctamente');
    }

    public function destroy($id)
    {
        $cotizacion = Cotizaciones::findOrFail($id);
        $cotizacion->update(['status' => 'eliminada']);

        return redirect()->route('cotizacion.index')->with('success', 'Cotizacion eliminada correctamente');
    }

    public function descargar(Cotizaciones $cotizacion)
    {
        $data = [
            'cotizacion' => $cotizacion,
            'vehiculo' => $cotizacion->vehiculo,
            'fecha_salida' => $cotizacion->fecha_salida,
            'fecha_entrada' => $cotizacion->fecha_entrada,
            'dias_renta' => $cotizacion->dias_renta,
            'precio_dia' => $cotizacion->precio_dia,
            'total' => $cotizacion->total,
        ];
        //dd($data);

        $html = View::make('cotizacion.pdf', $data)->render();

        $dompdf = new Dompdf();

        $dompdf->loadHtml($html);

        $dompdf->render();

        $filename = 'cotizacion.pdf';

        $dompdf->stream($filename);
    }
}
