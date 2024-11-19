<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>{{ $projeto->Titulo }}</h1>
    <p>{{ $projeto->Descricao }}</p>
    <p>Preço: R$ {{ number_format($projeto->Valor, 2, ',', '.') }}</p>

    <h3>Categorias:</h3>
    <ul>
        @foreach($categories as $category)
            <li>{{ $category->Titulo }}</li>
        @endforeach
    </ul>

    <h4>Desenvolvido por: {{ $projeto->user->name }}</h4>

</body>

</html>