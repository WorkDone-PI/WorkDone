@extends("layouts\app")

@section("content")

<div class="container">
    <div class="align-self-center">
        <h3 class="text-center mb-4">Cadastrar Categoria</h3>
        <form action="{{ route('category.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Titulo</label>
                <input type="text" class="form-control" title="title" id="name" value="{{ old('name') }}">
                @error('name') {{ $message }} @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <input type="text" class="form-control" name="description" id="description" value="{{ old('description') }}">
                @error('description') {{ $message }} @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
        </form>
    </div>
</div>

@endsection