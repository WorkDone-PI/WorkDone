<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/editarperfil.css') }}">
    <title>WorkDone | Editar Perfil</title>
</head>
    <body>
    @extends('layouts.app') {{-- Extendendo o layout principal --}}
        <nav>
            <div class="navbar">
                <div class="logo"><a href="{{ route('home') }}">WorkDone</a></div>
                <div class="search-bar">
                    <i class='bx bx-search-alt'></i>
                    <input type="search" name="" id="" placeholder="Pesquise por projetos, pessoas e filtros...">
                </div>
                <div class="create">
                    <a href="{{ route('registerProject') }}" class="btn btn-primary">Novo Projeto</a>
                    <div class="profile-photo">
                        <a href="{{ route('profile') }}">
                            @if($user->profile_image)
                                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Foto de Perfil">
                            @else
                                <img src="https://via.placeholder.com/150" alt="Foto de Perfil Padrão">
                            @endif
                        </a>
                    </div>
                </div>
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
                                <input type="text" name="name" id="name" placeholder="Digite seu nome" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="input-field">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" placeholder="Digite seu email" value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="input-field">
                                <label for="username">Arroba (Nome de Usuário)</label>
                                <input type="text" name="username" id="username" placeholder="Digite seu nome de usuário" value="{{ old('arroba', $user->arroba) }}" required>
                            </div>
                            <div class="input-field">
                                <label for="description">Descrição</label>
                                <textarea name="description" id="description" rows="4" placeholder="Adicione uma breve descrição" value="{{ old('descricao', $user->descricao) }}"></textarea>
                            </div>
                            <div class="input-field">
                                <label for="profile_image">Imagem do Perfil</label>
                                <input type="file" name="profile_image" id="profile_image" accept="image/*">
                                <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://via.placeholder.com/100' }}" alt="Foto de Perfil Atual" class="profile-preview">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" value="Atualizar">Atualizar Perfil</button>
            </form>
        </div>
    </body>
</html>
@endsection