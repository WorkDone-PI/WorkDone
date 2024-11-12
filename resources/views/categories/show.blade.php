<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>WorkDone | Publicar </title>
    </head>
    <div class="container">
        <div class="align-self-center">
        @if ($categories)
                <h3 class="text-center mb-4">{{ $categories->Titulo }}</h3>
                <p>{{ $categories->Descricao }}</p>
                <p>{{ $categories->parent_id }}</p>
            @endif
        </div>
    </div>
</html>