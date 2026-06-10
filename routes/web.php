<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\editAlbumController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PhotoController; // Adicionamos a importação do novo controller aqui
use Illuminate\Support\Facades\Route;

// Rotas dos Álbuns
Route::get('/form', [FormController::class, 'index'])->name('formulario');
Route::get('/', [CardsController::class, 'select'])->name('card.index');
Route::post('/albums', [FormController::class, 'store']);
Route::get('/albums', [CardsController::class, 'select']);
Route::get('/albums/{id}', [AlbumController::class, 'show'])->name('albums.show');

// Rotas das Fotos
Route::get('/photos', [PhotoController::class, 'index'])->name('photos.index');
Route::get('/catalogar', [PhotoController::class, 'uploadPage'])->name('photos.catalogar');
Route::post('/catalogar/salvar', [PhotoController::class, 'storePhoto'])->name('photos.store');
Route::post('/fotos/vincular', [PhotoController::class, 'linkAlbum'])->name('photos.link-album');


//deletar foto do álbum
Route::delete('/albums/{album}/photos/{photo}', [AlbumController::class, 'detachPhoto'])->name('albums.photos.detach');

//deletar foto do sistema
Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');

//mostrar foto em tamanho real
Route::get('/photos/{photo}', [PhotoController::class, 'show'])->name('photos.show');

//editar álbum
Route::get('/album/{album}/editar', [editAlbumController::class, 'viewEdit'])->name('album.edit');

//atulizar album com as edições
Route::put('/album/{album}', [editAlbumController::class, 'update'])->name('album.update');