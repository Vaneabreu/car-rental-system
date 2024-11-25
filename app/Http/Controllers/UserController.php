<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Producto;
use PDF;

class UserController extends Controller
{
    /**
     * Return Users data to users view
     *
     * @return void
     */
    public function index()
    {
        $users = Producto::all();

        return view('users.index', compact('users'));
    }

    /**
     * Export content to PDF with View
     *
     * @return void
     */
    public function downloadPdf()
    {
        $users = Producto::all();

       view()->share('users.pdf',$users);

        $pdf = PDF::loadView('users.pdf', ['users' => $users]);

        return $pdf->download('users.pdf');
    }


}
