<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Picture Book</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <aside class="sidebar">
        <h3>📸 Picture Book</h3>

        <a href="{{ route('card.index') }}">🏠 Início</a>
        <a href="{{ route('formulario') }}">📚 Criar Álbum</a>
        <a href="/photos">🖼️ Minhas Fotos</a>
    </aside>

    <main class="content">
        @yield('content')
    </main>

</body>
</html>
