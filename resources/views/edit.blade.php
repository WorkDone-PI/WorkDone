<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/editarperfil.css') }}">
    <title>WorkDone | Editar Perfil</title>
</head>

<body>
    @extends('layouts.app')
    <nav>
        <div class="navbar">
            <div class="logo"><a href="{{ route('home') }}">WorkDone</a></div>
            <div class="search-bar">
                <i class='bx bx-search-alt'></i>
                <input type="search" name="" id="" placeholder="Pesquise por projetos, pessoas e filtros...">
            </div>
            <div class="create">
                <div class="profile-photo">
                    <a href="{{ route('profile') }}">
                        @if($user->profile_image)
                            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Foto de Perfil">
                        @else
                            <img src="{{ asset('img/avatar.png') }}" alt="Default Profile Image">
                        @endif
                    </a>
                </div>
            </div>
        </div>
        <div>
            <a href="{{ route('profile') }}" class="bn3">Voltar</a>
        </div>
    </nav>
    @section('content')
    <div class="formPostagem">
        <header>Editar Perfil</header>
        @section('content')
        <form action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form">
                <div class="details">
                    <span class="title">Atualize suas informações</span>
                    <div class="fields">
                        <div class="input-field">
                            <label for="name">Nome</label>
                            <input type="text" name="name" id="name" placeholder="Digite seu nome"
                                value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div class="input-field">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="Digite seu email"
                                value="{{ old('email', $user->email) }}" required>
                        </div>
                        <div class="input-field">
                            <label for="arroba">Arroba (Nome de Usuário)</label>
                            <input type="text" name="arroba" id="arroba" placeholder="Digite seu @"
                                value="{{ old('arroba', $user->Arroba) }}" required>

                            <div class="container_image">
                                <!--<div class="input-field">-->
                                <label for="profile_image">Imagem do Perfil</label>
                                <div class="imagem_lado">
                                    <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('img/avatar.png') }}"
                                        alt="Foto de Perfil Atual" class="profile-preview">
                                    <input type="file" name="profile_image" id="profile_image" accept="image/*">
                                </div>
                                <!--</div>-->
                            </div>
                        </div>
                        <div class="cima_baixo">
                            <div class="input-field">
                                <label for="descricao">Descrição</label>
                                <textarea name="descricao" id="descricao" rows="4"
                                    placeholder="Adicione uma breve descrição">{{ old('descricao', $user->Descricao) }}</textarea>
                            </div>
                            <div class="buttons_submit">
                                <button type="submit" value="Atualizar">Atualizar Perfil</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
@endsection