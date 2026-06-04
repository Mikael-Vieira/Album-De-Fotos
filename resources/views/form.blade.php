@extends('layout.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/styleForm.css') }}">

<div class="album-container">

    <div class="album-form-card">

        <h1>Criar Álbum</h1>

        <form action="/albums" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nome do Álbum</label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Ex: Casamento Ana e João"
                    required
                >
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>

                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    placeholder="Descreva o álbum..."
                ></textarea>
            </div>

            <button type="submit" class="btn-save">
                Criar Álbum
            </button>

        </form>

    </div>

</div>

@endsection
