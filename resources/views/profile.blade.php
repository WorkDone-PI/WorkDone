<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/WK.png') }}" type="Favicon_Image_Location">
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <title>WorkDone | {{ $user->name }}</title>
</head>

<body>
    <nav>
        <div class="navbar">
            <div class="logo"><a href="{{ route('home') }}">WorkDone</a></div>
            <div class="create">
                <a href="{{ route('edit') }}" class="btn btn-primary">Editar Perfil</a>
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

    <div class="profile-container">
        <!-- Primeira sessão: Imagem de fundo e informações do perfil -->
        <div class="profile-header">
            <div class="profile-background"
                style="background-image: url('{{ asset('storage/' . $user->background_image) }}');">
            </div>
            @if($user->profile_image)
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="">
            @else
                <img src="{{ asset('img/avatar.png') }}" alt="Default Profile Image">
            @endif
            <div class="profile-info">
                <h2>{{ $user->name }}</h2>
                <h4>{{ $user->email }}</h4>
                <p>{{ $user->Descricao }}</p>
            </div>
        </div>

        <!-- Segunda sessão: Estatísticas -->
        <div class="stats">
            <div class="stat">
                <h3>{{ count($projetos) }}</h3>
                <p>Projetos</p>
            </div>
            <div class="stat">
                <h3>200</h3>
                <p>Seguidores</p>
            </div>
            <div class="stat">
                <h3>150</h3>
                <p>Seguindo</p>
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

                        <small>Adicionado em
                            {{ $projeto->created_at->setTimezone('America/Sao_Paulo')->diffForHumans() }}</small>

                        <p><strong>Preço:</strong> R$ {{ number_format($projeto->Valor, 2, ',', '.') }}</p>

                        <strong>Categorias:</strong>
                        <ul>
                            @foreach($projeto->categories as $category)
                                <li>{{ $category->Titulo }}</li>
                            @endforeach
                        </ul>

                        <a href="{{ route('editProject', $projeto->id) }}" class="btn btn-primary">Editar Projeto</a>
                        <a href="{{ route('editProject', $projeto->id) }}" class="btn btn-primary">Remover Projeto</a>

                    </div>
                @endforeach
            </div>
        </div>

        <!--<div class="profile-actions">
                    <a href="{{ route('edit') }}" class="btn btn-primary">Editar Perfil</a>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                    <a href="{{ route('chatbot.show') }}" class="btn btn-primary">Suporte</a>
                </div>-->
    </div>
</body>

</html>