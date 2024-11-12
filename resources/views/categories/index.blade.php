<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="{{ asset('img/WK.png') }}" type="Favicon_Image_Location">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>

    <h1> Categorias </h1>
    <br />
    <a href="{{ route('category.create') }}">Cadastrar Categoria</a>
    <br />
    <table style="width: 80%">
        <thead>
            <tr>
                <td>Categoria</td>
                <td>Categoria Pai</td>
                <td coslpan="2">Ações</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category->Titulo }}</td>
                <td>{{ $category->parent ? $category->parent->Titulo : '' }}</td>
                <td><a href="{{ route('category.edit', $category->id) }}">Editar</a></td>
                <td>
                    <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Tem certeza que quer excluir esta categoria?');">
                            Excluir
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</html>
