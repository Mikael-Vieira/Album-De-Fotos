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
            'description' => 'nullable',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        Album::create([
            'name' => $request->name,
            'description' => $request->description,
            'cover_photo' => $request->file('cover_photo') ? $request->file('cover_photo')->store('albums', 'public') : null,
        ]);

        return redirect('index')->with('sucesso', 'Álbum cadastrado com sucesso!');
    }
}
