<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\editAlbumController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;


// Rota tela de login
Route::get('/', [LoginController::class, 'uploadPage'])->name('login');

// Autenticação
Route::post('authenticate/login', [LoginController::class, 'authenticate'])->name('authenticate');


// ROTAS PRIVADAS (Só entra com login e senha)
Route::middleware('auth')->group(function () {

    // Tela principal pós-login
    Route::get('/index', [CardsController::class, 'select'])->name('card.index');

    // Rotas dos Álbuns
    Route::get('/form', [FormController::class, 'index'])->name('formulario');
    Route::post('/albums', [FormController::class, 'store']);
    Route::get('/albums', [CardsController::class, 'select']);
    Route::get('/albums/{id}', [AlbumController::class, 'show'])->name('albums.show');

    // Editar, atualizar e deletar álbum
    Route::get('/album/{album}/editar', [editAlbumController::class, 'viewEdit'])->name('album.edit');
    Route::put('/album/{album}', [editAlbumController::class, 'update'])->name('album.update');
    Route::delete('/album/{album}', [editAlbumController::class, 'destroy'])->name('album.destroy');

    // Rotas das Fotos
    Route::get('/photos', [PhotoController::class, 'index'])->name('photos.index');
    Route::get('/catalogar', [PhotoController::class, 'uploadPage'])->name('photos.catalogar');
    Route::post('/catalogar/salvar', [PhotoController::class, 'storePhoto'])->name('photos.store');
    Route::post('/fotos/vincular', [PhotoController::class, 'linkAlbum'])->name('photos.link-album');

    // Deletar e visualizar fotos
    Route::delete('/albums/{album}/photos/{photo}', [AlbumController::class, 'detachPhoto'])->name('albums.photos.detach');
    Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');
    Route::get('/photos/{photo}', [PhotoController::class, 'show'])->name('photos.show');

    // Rota de logout (Se você não tiver, adicione no Controller depois)
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

});
