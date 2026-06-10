<?php

namespace App\Http\Controllers;
use App\Models\Album;
use Illuminate\Http\Request;

class editAlbumController extends Controller
{
    //funcao para levar ate a pagina para editar album com id do album
    public function viewEdit(Album $album)
    {
        return view('albums.editAlbum', compact('album'));
    }


    //funcao para excluir o álbum e desvincular as fotos
    public function destroy(Album $album)
    {
        $album->photos()->detach();
        $album->delete();

        return redirect()->back()->with('sucesso', 'Álbum deletado com sucesso!');
    }

    //funcao para atualizar o nome, descricao e foto do album
    public function update(Request $request, Album $album)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $album->name = $request->name;
        $album->description = $request->description;

        if ($request->hasFile('cover_photo')) {
            $path = $request->file('cover_photo')->store('album_covers', 'public');
            $album->cover_photo = $path;
        }

        $album->save();

        return redirect()->route('card.index')->with('sucesso', 'Álbum atualizado com sucesso!');    
    }
}