<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <title>WorkDone | {{ $user->name }}</title>
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

        <div class="profile">
            <div class="profile-container">
                <div class="profile-header">
                    <div class="profile-photo">
                        @if($user->profile_image)
                            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Foto do Usuário">
                        @else
                            <img src="{{ asset('img/avatar.png') }}" alt="Default Profile Image">
                        @endif
                    </div>
                    <div class="profile-info">

                        <h1 class="username">{{ $user->name }}</h1>

                        <!--<p class="arroba">@{{ $user->arroba }}</p>-->

                        <p class="email">Email: {{ $user->email }}</p>

                        <p class="bio">{{ $user->descricao }}</p>
                    </div>
                </div>

                <div class="profile-details">
                    <div class="stat">
                        <h3>Projetos</h3>
                        <p>{{ count($projetos) }}</p>
                    </div>
                    <div class="stat">
                        <h3>Seguidores</h3>
                        <p>250</p>
                    </div>
                    <div class="stat">
                        <h3>Seguindo</h3>
                        <p>180</p>
                    </div>
                </div>

                <div class="profile-actions">
                    <a href="{{ route('edit') }}" class="btn btn-primary">Editar Perfil</a>
                </div>
            </div>

            <div class="projects-section">
                <h2 class="projects-title">Meus Projetos</h2>
                <div class="projects-container">
                    @foreach($projetos as $projeto)
                        <div class="project-card">

                            @if($projeto->project_image)
                                <img src="{{ asset('storage/' . $projeto->project_image) }}" alt="Imagem do Projeto">
                            @else
                                <img src="https://via.placeholder.com/480x320" alt="Imagem Padrão do Projeto">
                            @endif

                            <h4>{{ $projeto->Titulo }}</h4>

                            <p>{{ $projeto->Descricao }}</p>

                            <small>Adicionado em {{ $projeto->created_at->setTimezone('America/Sao_Paulo')->diffForHumans() }}</small>

                            <p><strong>Preço:</strong> R$ {{ number_format($projeto->Valor, 2, ',', '.') }}</p>

                            <strong>Categorias:</strong>
                            <ul>
                                @foreach($projeto->categories as $category)
                                    <li>{{ $category->Titulo }}</li>
                                @endforeach
                            </ul>

                            <a href="" class="btn btn-primary">Ver Projeto</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </body>
</html>
