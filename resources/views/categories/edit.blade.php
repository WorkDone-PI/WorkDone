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
<form action="{{ route('category.update', $category->id) }}" method="post">
    @csrf
    @method('PUT')
    <h1> Editar Categorias </h1>

    <label for="Titulo">Nome</label>
    <input type="text" name="Titulo" id="Titulo" value="{{ $category->Titulo }}"> <br />

    <div class="mb-3">
        <label for="Descricao" class="form-label">Descrição</label>
        <input type="text" class="form-control" name="Descricao" id="Descricao" value="{{ $category->Descricao }}">
        @error('Descricao') {{ $message }} @enderror
    </div>

    <label for="parent_id">Categoria pai</label>
    <select name="parent_id" id="parent_id">
        <option value=""></option>
        @foreach ($categories as $parentCategory)
            <option value="{{ $parentCategory->id }}" {{ $category->parent_id == $parentCategory->id ? 'selected' : ''}}>
                {{ $parentCategory->Titulo }}
            </option>
        @endforeach
    </select> <br />

    <input type="submit" value="Salvar">
</form>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

</html>