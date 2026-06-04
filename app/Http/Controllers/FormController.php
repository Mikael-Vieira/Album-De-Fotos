<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Album;

class FormController extends Controller
{
    public function index(){
        return view('form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

        Album::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect('/')->with('sucesso', 'Álbum cadastrado com sucesso!');
    }
}
