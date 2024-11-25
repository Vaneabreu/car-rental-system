<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gasto;
use App\Models\Vehiculo;
use App\Models\Cliente;
use App\Models\Reserva;


class GastoController extends Controller
{
    public function create()
    {
        $vehiculos = Vehiculo::all();
        $clientes = Cliente::all();
        return view('gastos.create', compact('vehiculos', 'clientes'));
    }

    public function crear()
    {
        $vehiculos = Vehiculo::all();
        $clientes = Cliente::all();
        return view('gastos.create_gastos', compact('vehiculos', 'clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required',
            'monto' => 'required',
            'vehiculo_id' => 'required',
            'fecha_gasto' => 'required|date',
        ]);


        $fechaGasto = \Carbon\Carbon::createFromFormat('d-m-Y', $request->fecha_gasto)->format('Y-m-d');

        $gasto = Gasto::create(array_merge($request->all(), ['fecha_gasto' => $fechaGasto]));

        $reserva = Reserva::where('vehiculo_id', $request->vehiculo_id)->first();

        if ($reserva) {
            $reserva->update(['gasto_id' => $gasto->id]);
        }

        return redirect()->route('gastos.index')->with('success', 'Gasto registrado exitosamente.');
    }


    public function index()
    {
        $selectedVehiculo = request('vehiculo_id');

        $gastosQuery = Gasto::where('status', 'Activo');

        if ($selectedVehiculo) {
            $gastosQuery->where('vehiculo_id', $selectedVehiculo);
        }

        $gastos = $gastosQuery->with('vehiculo')->paginate(5);
        $total = $gastos->sum('monto');

        $vehiculos = Vehiculo::all();
        $clientes = Cliente::all();

        // Verifica si la solicitud es AJAX
        if (request()->ajax()) {
            $html = view('gastos.table', compact('gastos', 'total'))->render(); // Renderiza la tabla
            return response()->json(['html' => $html]);
        }

        return view('gastos.index', compact('gastos', 'total', 'vehiculos', 'clientes', 'selectedVehiculo'));
    }

    public function edit($id)
    {
        $gasto = Gasto::findOrFail($id);
        $vehiculos = Vehiculo::all();
        $clientes = Cliente::all();

        return view('gastos.edit', compact('gasto', 'vehiculos', 'clientes'));
    }

    public function update(Request $request, $id)
    {
        /*  $request->validate([
            'descripcion' => 'required',
            'monto' => 'required|numeric',
            'vehiculo_id' => 'required|exists:vehiculos,id',
        ]); */

        $gasto = Gasto::findOrFail($id);

        $gasto->descripcion = $request->descripcion;
        $gasto->monto = $request->monto;
        $gasto->vehiculo_id = $request->vehiculo_id;
        $gasto->fecha_gasto = $request->fecha_gasto;

        $gasto->save();

        session()->flash('success', 'Gasto editado exitosamente');

        return redirect()->route('gastos.index');
    }

    public function destroy($id)
    {
        $gasto = Gasto::findOrFail($id);
        $gasto->update(['status' => 'eliminado']);

        return redirect()->route('gastos.index')->with('success', 'Gasto eliminado correctamente');
    }
}
