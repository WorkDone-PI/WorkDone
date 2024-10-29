@extends("layouts\app")

@section("content")


<div class="container">
    <div class="align-self-center">
        <h3 class="text-center mb-4">Listar Categoria</h3>
        <ul class="list-group">
            @foreach ($categories as $category)
            <li class="list-group-item">
                <a href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a>
            </li>
            @endforeach
        </ul>
    </div>
</div>

@endsection