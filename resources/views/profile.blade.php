@extends('layouts.app') {{-- Extendendo o layout principal --}}
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/WK.png') }}" type="Favicon_Image_Location">
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <title>WorkDone</title>
</head>
@section('content')

    <nav>
        <div class="navbar">
            <div class="logo"><a href="{{ route('home') }}">WorkDone</a></div>
            <div class="create">
            <a href="{{ route('home') }}" class="btn btn-primary">Voltar</a>
            <a href="{{ route('logout') }}" class="btn btn-primary">Sair</a>
            </div>
        </div>
    </nav>
    <!--<div class="card">
        <div class="card__container">
            <h4 class="card__title"><b>Ultimo Login</b></h4>
            <p class="card__subtitle">Agora mesmo há 29 dias</p>
            <p class="card__description">Data de ingresso: Agora mesmo há 29 dias</p>
        </div>
    </div>-->

    <div class="profile">
    <img src="{{ asset('img/profile.png') }}" alt="Profile Photo">
    <div class="about">
        <h1>Perfil de {{ $user->name }}</h1> 
        <p style="margin-bottom: 30px;">Email: {{ $user->email }}</p>
        <p style="margin-bottom: 30px;">Sobre mim: {{ $user->description }}</p>
        <a href="{{ route('edit') }}" class="btn btn-primary">Editar Perfil</a>
        <p>About Me: Sou um desenvolvedor de software freelancer com mais de 5 anos de experiência em projetos web,
            mobile e desktop. Tenho conhecimentos em diversas linguagens e frameworks, como Python, Django, React,
            Flutter, C#, .NET, entre outros. Sou apaixonado por tecnologia e sempre busco aprender novas ferramentas
            e metodologias para entregar soluções de qualidade aos meus clientes.</p>

        <h2>Meus Projetos</h2>
        <div class="projects">
            @foreach($projetos as $projeto)
            <div class="project">
                <h3>{{ $projeto->Titulo }}</h3>
                <p>{{ $projeto->Descricao }}</p>
                <small>Adicionado em {{ $projeto->created_at->setTimezone('America/Sao_Paulo')->diffForHumans() }}</small>
                <p>Preço: R$ {{ number_format($projeto->Valor, 2, ',', '.') }}</p>
                <strong>Categorias:</strong>
                <ul>
                    @foreach($projeto->categories as $category)
                        <li>{{ $category->Titulo }}</li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection 