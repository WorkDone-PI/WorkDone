@extends("layouts\app")

@section("content")


<div class="container">
    <div class="align-self-center">
        <h3 class="text-center mb-4">{{ $category->name }}</h3>
        <p>{{ $category->description }}</p>
    </div>
</div>

@endsection