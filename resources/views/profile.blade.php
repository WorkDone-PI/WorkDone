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
                @if ($usuario_autenticado)
                    <a href="{{ route('edit') }}" class="btn btn-primary">Editar Perfil</a>
                @endif
                <div class="profile-photo">
                    <a id="profile-photo">
                        @if($user->profile_image)
                            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Foto de Perfil">
                        @else
                            <img src="{{ asset('img/avatar.png') }}" alt="Default Profile Image">
                        @endif
                    </a>
                </div>
                <div class="dropdown-menu">
                    @if (Auth::id() == $user->id)
                        <a href="{{ route('edit') }}" class="dropdown-item">Editar Perfil</a>
                        <a href="{{ route('logout') }}" class="dropdown-item" id="logout">Logout</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-background"
                style="background-image: url('{{ asset('storage/' . $user->background_image) }}');">
            </div>
            @if ($usuario_autenticado)
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
            @else
                @if($user->profile_image)
                    <img src="{{ asset('storage/' . $other_user->profile_image) }}" alt="">
                @else
                    <img src="{{ asset('img/avatar.png') }}" alt="Default Profile Image">
                @endif
                <div class="profile-info">
                <h2>{{ $other_user->name }}</h2>
                <h4>{{ $other_user->email }}</h4>
                <p>{{ $other_user->Descricao }}</p>
            </div>
            @endif
        </div>

        <div class="stats">
            <div class="stat">
                <h3>{{ $projetos ? count($projetos) : 0 }}</h3>
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
                    @if($projeto->removed == 0)
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

                            @if ($usuario_autenticado)
                                <a href="{{ route('editProject', $projeto->id) }}" class="btn btn-primary">Editar Projeto</a>
                                <a href="{{ route('deleteProject', $projeto->id) }}" class="btn btn-secundary">Remover Projeto</a>
                            @else
                                <a href="{{ route('project.show', $projeto->id) }}" class="btn btn-primary">Ver Projeto</a>
                            @endif
                        </div>
                    @endif
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
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const profilePhoto = document.querySelector('.profile-photo');
            const dropdownMenu = document.querySelector('.dropdown-menu');

            if (profilePhoto && dropdownMenu) {
                profilePhoto.addEventListener('click', function (event) {
                    // Impede a propagação do clique
                    event.stopPropagation();
                    dropdownMenu.classList.toggle('show');
                });

                // Fecha o dropdown se clicar em qualquer lugar fora dele
                document.addEventListener('click', function (event) {
                    if (!profilePhoto.contains(event.target) && !dropdownMenu.contains(event.target)) {
                        dropdownMenu.classList.remove('show');
                    }
                });
            }
        });

    </script>
</body>

</html>