<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/WK.png') }}" type="Favicon_Image_Location">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>WorkDone | Login</title>
</head>

<body>
    <nav class="navbar">
        <div class="logo"><a href="{{ route('index') }}">WorkDone</a></div>
        <ul class="menu">
        </ul>
        <div class="media-icons">
            <li><a href="{{ route('register') }}">Cadastrar</a></li>
        </div>
    </nav>

    <div class="principal">
        <div class="introduction">
            <h2 class="intro-text">Bem-vindo de volta!</h2>
            <p class="sub-text">Acesse seus projetos em qualquer lugar. Basta fazer login para continuar.</p>
            <div class="illustration">
                <img src="{{ asset('img/login_image.png') }}" alt="Login Illustration">
            </div>
        </div>

        <form action="{{ route('auth.login') }}" method="post" class="login">
            @csrf
            <h2>Login</h2>
            
            <div class="box-user">
                <input type="text" name="email" id="email" value="{{ old('email') }}" required>
                <label for="email">Email</label>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="box-user">
                <input type="password" name="password" id="password" required>
                <label for="password">Senha</label>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <a href="" class="forget">Esqueceu a senha?</a>
            </div>

            <input type="submit" class="btn" value="Entrar">
        </form>
    </div>
</body>
</html>