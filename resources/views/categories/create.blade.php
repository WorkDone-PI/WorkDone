<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/logoWK.png') }}" type="Favicon_Image_Location">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>WorkDone</title>
</head>
    <body>
        <div class="container">
            <div class="align-self-center">
                <h3 class="text-center mb-4">Cadastrar Categoria</h3>
                <form action="{{ route('category.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="Titulo" class="form-label">Titulo</label>
                        <input type="text" class="form-control" title="Titulo" id="Titulo" value="{{ old('Titulo') }}">
                        @error('Titulo') {{ $message }} @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Descricao" class="form-label">Descrição</label>
                        <input type="text" class="form-control" name="Descricao" id="Descricao" value="{{ old('Descricao') }}">
                        @error('description') {{ $message }} @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                </form>
            </div>
        </div>
    </body>
</html>