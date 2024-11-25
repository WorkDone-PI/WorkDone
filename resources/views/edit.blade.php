<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/WK.png') }}" type="Favicon_Image_Location">
    <link rel="stylesheet" href="{{ asset('css/editarperfil.css') }}">
    <title>WorkDone | Editar Perfil</title>
</head>

<body>
    @extends('layouts.app')
    <nav>
        <div class="navbar">
            <div class="logo"><a href="{{ route('home') }}">WorkDone</a></div>
            <a href="{{ route('profile') }}" class="btn btn-primary">Voltar</a>
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
                            <label for="phone">Telefone</label>
                            <input type="text"  name="phone" id="phone" placeholder="Digite seu telefone"
                                value="{{ old('phone', $user->phone) }}" required oninput="mascaraTelefone(event)">
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
                            <label for="background_image">Imagem do Fundo</label>
                            <input type="file" name="background_image" id="background_image" accept="image/*">
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
    <script>
        function mascaraTelefone(event) {
            let input = event.target;
            let telefone = input.value.replace(/\D/g, ''); // Remove tudo que não for número
            
            if (telefone.length <= 2) {
                input.value = telefone;
            } else if (telefone.length <= 5) {
                input.value = `(${telefone.slice(0, 2)}) ${telefone.slice(2)}`;
            } else if (telefone.length <= 9) {
                input.value = `(${telefone.slice(0, 2)}) ${telefone.slice(2, 7)}-${telefone.slice(7)}`;
            } else {
                input.value = `(${telefone.slice(0, 2)}) ${telefone.slice(2, 7)}-${telefone.slice(7, 11)}`;
            }
        }
    </script>
</body>

</html>
@endsection