@extends('layouts.app') {{-- Extendendo o layout principal --}}

<header>
    <nav class="navigation">
        <a href="#"><img class="logo" src="{{ asset('img/logoWK.png') }}" alt=""></a>
        <ul class="nav-menu">
            <li class="nav-item"><a href="{{ route('home') }}">Home</a></li>
        </ul>
    </nav>
</header>

@section('content')
<div class="container">
    <div class="card">
        <h1>Editar Perfil de {{ $user->name }}</h1>

        <main class="main-content">
            <form action="{{ route('update') }}" method="POST" enctype="multipart/form-data" class="login-form">
                @csrf
                @method('PUT')

                <div class="input-group">
                    <label for="name">Nome:</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}">
                </div>

                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}">
                </div>

                <div class="input-group">
                    <label for="arroba">@:</label>
                    <input type="text" id="arroba" name="arroba" value="{{ old('arroba', $user->arroba) }}">
                </div>

                <div class="input-group">
                    <label for="descricao">Descrição:</label>
                    <input type="text" id="descricao" name="descricao" value="{{ old('descricao', $user->descricao) }}">
                </div>

                <div class="input-group">
                    <label for="profile_image">Imagem de Perfil:</label>
                    <input type="file" name="profile_image" accept="image/*">
                </div>

                <div class="button-group">
                    <input type="submit" class="submit-btn" value="Atualizar">
                </div>
            </form>
        </main>
    </div>
</div>
@endsection