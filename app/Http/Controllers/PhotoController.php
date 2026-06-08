<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Photo;

class PhotoController extends Controller
{
    // 1. Abre a página de Catalogar (Tua página antiga com o formulário)
    public function uploadPage()
    {
        $albums = Album::all();
        return view('catalog', compact('albums'));
    }

    // 2. Abre a página "Minhas Fotos" (A grade com os cards que você me mandou)
    public function index()
    {
        $photos = Photo::all();
        $albums = Album::all();
        return view('photos', compact('photos', 'albums'));
    }

    // 3. Processa o upload da foto (Tornando o álbum opcional)
    public function storePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'album_id' => 'nullable|exists:albums,id'
        ]);

        $path = $request->file('photo')->store('galeria_fotos', 'public');

        $photo = Photo::create([
            'image_path' => $path
        ]);

        if ($request->filled('album_id')) {
            $album = Album::findOrFail($request->album_id);
            $album->photos()->attach($photo->id);
            return redirect()->back()->with('sucesso', 'Foto adicionada e catalogada com sucesso!');
        }

        return redirect()->back()->with('sucesso', 'Foto adicionada à galeria geral!');
    }

    // 4. Processa o botão "OK" de catalogar direto no card da foto
    public function linkAlbum(Request $request)
    {
        $request->validate([
            'photo_id' => 'required|exists:photos,id',
            'album_id' => 'required|exists:albums,id'
        ]);

        $album = Album::findOrFail($request->album_id);
        $album->photos()->syncWithoutDetaching([$request->photo_id]);

        return redirect()->back()->with('sucesso', 'Foto catalogada com sucesso!');
    }

    public function destroy(Photo $photo)
    {
        if ($photo->image_path && Storage::disk('public')->exists($photo->image_path)) {
            Storage::disk('public')->delete($photo->image_path);
        }

        $photo->albums()->detach();

        Photo::destroy($photo->id);

        return redirect()->back()->with('sucesso', 'Foto excluída permanentemente do sistema!');
    }

    public function show(Photo $photo)
    {
        // 1. Pega o caminho real do arquivo dentro do seu HD
        $caminhoAbsoluto = storage_path('app/public/' . $photo->image_path);

        // 2. Verifica se o arquivo realmente existe no HD
        if (file_exists($caminhoAbsoluto)) {
            // Retorna o arquivo cru para o navegador, sem nenhuma casca de HTML
            return response()->file($caminhoAbsoluto);
        }

        // Se não achar, dá erro 404
        abort(404);
    }
}
