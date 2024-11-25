<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{

    public function buscarClientes(Request $request)
    {
        $q = $request->input('q'); // Obtener el término de búsqueda desde la solicitud

        // Buscar clientes que coincidan con el término de búsqueda
        $clientes = Cliente::where('nombre_completo', 'like', '%'.$q.'%')->get();

        // Retornar los clientes encontrados en formato JSON
        return response()->json($clientes);
    }

    public function create(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $clientes = Cliente::where('nombre', 'LIKE', "%$search%")
                ->orWhere('apellido', 'LIKE', "%$search%")
                ->orWhere('telefono', 'LIKE', "%$search%")
                ->orWhere('direccion', 'LIKE', "%$search%")
                ->orWhere('genero', 'LIKE', "%$search%")
                ->orWhere('cedula', 'LIKE', "%$search%")
                ->get();
        } else {
            $clientes = Cliente::all();
        }
        return view('clientes', compact('clientes'));
    }

    public function show($id)
    {
        $clientes = Cliente::all();
        $cliente = Cliente::findOrFail($id);
        return view('clientesview', compact('cliente', 'clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string|max:12',
            'direccion' => 'nullable|string|max:255',
            'cedula' => 'required|numeric|digits:11',
            'genero' => 'nullable|string'
        ]);

        $cliente = new Cliente();

        $cliente->nombre = $request->input('nombre');
        $cliente->apellido = $request->input('apellido');

        $telefono = $request->input('telefono');
        $telefonoFormateado = substr($telefono, 0, 3) . '-' . substr($telefono, 3, 3) . '-' . substr($telefono, 6);
        $cliente->telefono = $telefonoFormateado;

        $cedula = $request->input('cedula');
        $cedulaFormateada = substr($cedula, 0, 3) . '-' . substr($cedula, 3, 7) . '-' . substr($cedula, 10, 1);
        $cliente->cedula = $cedulaFormateada;

        $cliente->direccion = $request->input('direccion');
        $cliente->genero = $request->input('genero');

        $cliente->nombre_completo = $cliente->nombre . ' ' . $cliente->apellido;

        $cliente->save();

        return redirect()->route('ver.clientes')->with('success', 'El cliente se ha registrado correctamente.');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $clientes = Cliente::where('status', 'Activo')->get();

        if ($search) {

            $clientesAll = Cliente::where('nombre', 'LIKE', "%$search%")
                ->orWhere('apellido', 'LIKE', "%$search%")
                ->orWhere('telefono', 'LIKE', "%$search%")
                ->orWhere('direccion', 'LIKE', "%$search%")
                ->orWhere('genero', 'LIKE', "%$search%")
                ->orWhere('cedula', 'LIKE', "%$search%")
                ->paginate(5);
            $clienteExiste = $clientesAll->isNotEmpty();
        } else {

            $clientesAll = Cliente::where('status', 'Activo')->paginate(5);
            $clienteExiste = true; // No se especificó búsqueda, el cliente existe.
        }

        return view('ver_clientes', compact('clientes', 'clienteExiste', 'search', 'clientesAll'));
    }

    public function edit($id)
    {
        $clientes = Cliente::all();
        $cliente = Cliente::findOrFail($id);
        return view('clientes_edit', compact('cliente', 'clientes'));
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $cliente->update($request->all());

        return redirect()->route('ver.clientes')->with('success', 'Cliente actualizado exitosamente');
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->update(['status' => 'eliminado']);

        return redirect()->route('ver.clientes')->with('success', 'Cliente eliminado exitosamente');
    }
}
