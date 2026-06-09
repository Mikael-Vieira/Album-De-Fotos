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

    // 3. Processa o upload de múltiplas fotos de uma só vez (Tornando o álbum opcional)
    public function storePhoto(Request $request)
    {
        // 1. Valida se o campo 'photos' veio como um array e checa os requisitos de cada imagem
        $request->validate([
            'photos'   => 'required|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Valida cada foto individual do lote
            'album_id' => 'nullable|exists:albums,id'
        ]);

        // 2. Se o usuário selecionou um álbum, buscamos ele uma única vez fora do loop para poupar o banco
        $album = $request->filled('album_id') ? Album::findOrFail($request->album_id) : null;

        // 3. Percorre a lista de imagens enviadas
        foreach ($request->file('photos') as $file) {

            // Salva o arquivo físico na pasta local (storage/app/public/galeria_fotos)
            $path = $file->store('galeria_fotos', 'public');

            // Cria uma nova linha na tabela 'photos' do seu banco de dados
            $photo = Photo::create([
                'image_path' => $path
            ]);

            // Se o álbum foi informado, faz o vínculo na tabela pivô
            if ($album) {
                $album->photos()->attach($photo->id);
            }
        }

        // 4. Retorna para a página com a mensagem de sucesso correspondente
        if ($album) {
            return redirect()->back()->with('sucesso', 'Todas as fotos foram adicionadas e catalogadas no álbum com sucesso!');
        }

        return redirect()->back()->with('sucesso', 'Todas as fotos foram adicionadas à galeria geral!');
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
