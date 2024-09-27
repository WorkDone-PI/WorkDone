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
            <a href="{{ route('registerProject') }}" class="btn btn-primary">Voltar</a>
            <a href="{{ route('registerProject') }}" class="btn btn-primary">Sair</a>
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
            <!--<a href="{{ route('prjs') }}" class="btn btn-primary">Ver meus projetos</a>   -->
            <p>About Me: Sou um desenvolvedor de software freelancer com mais de 5 anos de experiência em projetos web,
                mobile e desktop. Tenho conhecimentos em diversas linguagens e frameworks, como Python, Django, React,
                Flutter, C#, .NET, entre outros. Sou apaixonado por tecnologia e sempre busco aprender novas ferramentas
                e metodologias para entregar soluções de qualidade aos meus clientes.</p>
            <h2>My Projects</h2>
            <div class="projects">
                <div class="project">
                    <h3>Plataforma de Jogos</h3>
                    <p>Temos um jogo na steam, onde o usuário terá um saldo em coins. O projeto visa ter uma plataforma
                        de negociação entre os players para poderem comprar e vender essas coins com dinheiro real.
                        Gostaria que fosse em um gráfico de candles, hospedado em nosso site wordpress, porém com as
                        consultas de... Ver mais detalhes</p>
                </div>
                <div class="project">
                    <h3>Jogo: A lenda de Leo</h3>
                    <p>Um jogo de aventura em 2D que conta a história de um herói que precisa explorar um mundo mágico,
                        enfrentar inimigos e resolver enigmas. Desenvolvi o jogo usando Unity e C#, e utilizei recursos
                        gráficos e sonoros de sites gratuitos.</p>
                </div>
                <div class="project">
                    <h3>ChatBot: Bia</h3>
                    <p>Um chatbot inteligente que pode conversar com os usuários sobre diversos assuntos, como notícias,
                        esportes, entretenimento, etc. Desenvolvi o chatbot usando Python e TensorFlow, e utilizei
                        modelos de processamento de linguagem natural pré-treinados.</p>
                </div>
                <div class="project">
                    <h3>App Vita</h3>
                    <p>Um aplicativo de saúde que permite aos usuários monitorar seus sinais vitais, como pressão
                        arterial, frequência cardíaca, oxigênio no sangue, etc. Desenvolvi o aplicativo usando Kotlin e
                        Android Studio, e utilizei sensores e APIs de saúde do Google.</p>
                </div>
            </div>
        </div>
    </div>
@endsection 