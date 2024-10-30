@extends("layouts\app")

@section("content")


<div class="container">
    <div class="align-self-center">
    @if ($categories)
            <h3 class="text-center mb-4">{{ $categories->Titulo }}</h3>
            <p>{{ $categories->Descricao }}</p>
        @else
            <h3 class="text-center mb-4">Não há nenhuma Categoria cadastrada</h3>
        @endif
    </div>
</div>

@endsection