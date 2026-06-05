<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Photo;

class AlbumController extends Controller
{
    public function uploadPage()
    {
        $albums = Album::all();
        return view('catalog', compact('albums'));
    }

    public function storePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'album_id' => 'nullable|exists:albums,id'
        ]);

        $path = $request->file('photo')->store('galeria_fotos', 'public');

        $photo = Photo::create([
            'path' => $path
        ]);

        if ($request->filled('album_id')) {
            $album = Album::findOrFail($request->album_id);
            $album->photos()->attach($photo->id);

            return redirect()->back()->with('sucesso', 'Foto adicionada e catalogada com sucesso!');
        }

        return redirect()->back()->with('sucesso', 'Foto adicionada à galeria geral!');
    }

    public function show($id)
    {
        $album = Album::with('photos')->findOrFail($id);

        return view('albums.show', compact('album'));
    }

    public function detachPhoto(Album $album, Photo $photo)
    {
        $album->photos()->detach($photo->id);

        return redirect()->back()->with('sucesso', 'Foto removida do álbum com sucesso!');
    }
}
