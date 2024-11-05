<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/WK.png') }}" type="Favicon_Image_Location">
    <link rel="stylesheet" href="{{ asset('css/cadastrar.css') }}">
    <title>WorkDone | Cadastro</title>
</head>

<body>
    <nav class="navbar">
        <div class="logo"><a href="{{ route('index') }}">WorkDone</a></div>
        <ul class="menu">
        </ul>
        <div class="media-icons">
            <li><a href="{{ route('login') }}">Entrar</a></li>
        </div>
    </nav>
    <div class="principal">
        <div class="introduction">
            <img src="{{ asset('img/register_image.png') }}" alt="Logo WorkDone" class="img_introduction">
        </div>
        <form action="{{ route('user.register') }}" method="POST" class="login">
            @csrf
            <h2>Cadastro</h2>
            <div class="box-user">
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                <label>Nome</label>
                @error('name')
                <div class="error">{{ $message }}</div> @enderror
            </div>
            <div class="inputs-inline">
                <div class="box-user">
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                    <label>Email</label>
                    @error('email')
                    <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="box-user">
                    <label for="birthdate" class="label-static">Data de Nascimento</label>
                    <input type="date" name="birthdate" id="birthdate" required>
                </div>
            </div>
            <div class="box-user">
                <input type="password" name="password" id="password" required>
                <label>Senha</label>
                @error('password')
                <div class="error">{{ $message }}</div> @enderror
            </div>
            <div class="box-user">
                <input type="password" name="password_confirmation" id="password_confirmation" required>
                <label>Confirmar senha</label>
                @error('password_confirmation')
                <div class="error">{{ $message }}</div> @enderror
            </div>
            <input type="submit" class="btn" value="Cadastrar">
        </form>
    </div>
</body>

</html>