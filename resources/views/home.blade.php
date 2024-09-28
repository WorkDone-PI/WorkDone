<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkDone | Feed</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
</head>
<body>
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
                        <img src="{{ asset('img/profile.png') }}" alt="Foto de Perfil">
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="left">
            <a href=" {{ route('profile') }} " class="profile">
                <div class="profile-photo">
                    <img src="{{ asset('img/profile.png') }}" alt="">
                </div>
                <div class="handle">
                    <h4>Lucas Monaco</h4>
                    <p class="text-muted">
                        @lucasMonaco
                    </p>
                    <p class="text-view">
                        Vizualizar Perfil
                    </p>
                </div>
            </a>


            <div class="sidebar">
                <a class="menu-item active">
                    <span><i class='bx bx-home-alt-2'></i></span><h3>Home</h3>
                </a>
                <a class="menu-item active">
                    <span><i class='bx bx-filter-alt'></i></span><h3>Filtrar</h3>
                </a>
                <a class="menu-item active">
                    <span><i class='bx bx-message-square-dots'></i></span><h3>Mensagens</h3>
                </a>
                
            </div>
        </div>


        <div class="middle">
        <div class="feeds">
    @foreach($projetos as $projeto)
    <div class="feed">
        <div class="head">
            <div class="user">
                <div class="profile-photo">
                    <img src="{{ asset('img/profile.png') }}" alt="">
                </div>
                <div class="ingo">
                    <h3>{{ $projeto->Titulo }}</h3>
                    <small>Adicionado em {{ $projeto->created_at->diffForHumans() }}</small>
                </div>
            </div>
            <div class="descricao">
                <p>{{ $projeto->Descricao }}</p>
            </div>
        </div>
        <div class="valor">
            <p>Preço: R$ {{ number_format($projeto->Valor, 2, ',', '.') }}</p>
        </div>
    </div>
    @endforeach
</div>
        </div>


        <!--<div class="right">
            <div class="messages">
                <div class="heading">
                    <h4>Mensagens</h4><i class='bx bxs-edit'></i>
                </div>
                <div class="search-bar">
                    <i class='bx bx-search-alt'></i>
                    <input type="search" name="" id="search-message" placeholder="Procurar mensagens...">
                </div>
                <div class="category">
                    <h6 class="active">Primary</h6>
                    <h6>General</h6>
                    <h6 class="message-requests">Request</h6>
                </div>
                <div class="message">
                    <div class="profile-photo">
                        <img src="{{ asset('img/profile.png') }}" alt="">
                    </div>
                    <div class="message-body">
                        <h5>Matheus Candido</h5>
                        <p class="text-muted">Estou interessado no seu projeto</p>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
    
</body>
</html>