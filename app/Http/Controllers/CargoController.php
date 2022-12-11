<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;

class CargoController extends Controller
{
    public function index()
    {
        $cargos = Cargo::all();
        
        return view('cargo.index', compact('cargos'));
    }

    public function create()
    {

        return view('cargo.create');
    }

    public function store(Request $request)
    {

        $cargo = new Cargo;

        $cargo->cargo = $request->cargo;
        $cargo->save();

        return redirect('cargo')->with('sucesso', 'Cargo Salvo com sucesso!');
    }
}
