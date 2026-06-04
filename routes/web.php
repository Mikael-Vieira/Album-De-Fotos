<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

//quando acessar a rota /... retorna a funcao do controller que retorna a view
Route::get('/form', [FormController::class, 'index'])->name('formulario');

Route::get('/photos', function () {
    return view('photos');
});

//acessa a view index com os dados atualizados de acordo com o banco
Route::get('/', [CardsController::class, 'select'])->name('card.index');

//chama as funcoes do controller
Route::post('/albums', [FormController::class, 'store']);
Route::get('/albums', [CardsController::class, 'select']);
