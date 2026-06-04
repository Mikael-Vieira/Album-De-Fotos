<?php

namespace App\Http\Controllers;
use App\Models\Album;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    public function select(){

        $albums = Album::all();

        return view('index', compact('albums'));
    }
}
