<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/WK.png') }}" type="Favicon_Image_Location">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="dropdown-item" id="logout"><i class='bx bx-log-out'></i></button> 
                </form>
                <div class="dropdown-menu">
                    
                        @if (Auth::id() == $user->id)
                            <a href="{{ route('edit') }}" class="dropdown-item">Editar Perfil</a>
                                                  
                        @endif
                    
                </div>
            </div>
        </div>
    </nav>

    <div class="profile-container">
        <div class="profile-header">
            @if ($usuario_autenticado)
            <div class="profile-background"
                style="background-image: url('{{ asset('storage/' . $user->background_image) }}');">
            </div>
            @else
            <div class="profile-background"
                style="background-image: url('{{ asset('storage/' . $other_user->background_image) }}');">
            </div>
            @endif
            @if ($usuario_autenticado)
                @if($user->profile_image)
                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Foto de Perfil">
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
                    <img src="{{ asset('storage/' . $other_user->profile_image) }}" alt="Default Profile Image">
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
                <h3>{{ $seguidoresCount }}</h3>
                <p>Seguidores</p>
            </div>
            <div class="stat">
                <h3>{{ $seguindoCount }}</h3>
                <p>Seguindo</p>
            </div>
        </div>

        <div class="follow-button">
            @if(Auth::user()->id != $other_user->id)
                @if(Auth::user()->following()->where('followed_id', $other_user->id)->exists())
                    <!-- Já segue, então exibe o botão para deixar de seguir -->
                    <div class="stat">
                        <form action="{{ route('unfollowUser', $other_user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Deixar de Seguir</button>
                        </form>
                    </div>
                @else
                    <!-- Não segue ainda, então exibe o botão para seguir -->
                    <div class="stat">
                        <form action="{{ route('followUser', $other_user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Seguir</button>
                        </form>
                    </div>
                @endif
                <div class="stat">
                    <button id="viewFollowingBtn" class="btn btn-secondary">Ver Seguindo</button>
                </div>
            @endif
        </div>

        <!-- Modal: Lista de pessoas que o usuário está seguindo -->
        <div id="followingModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h3>Pessoas que você está seguindo</h3>
                <ul id="followingList"> </ul>
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
                            <small>Adicionado em {{ $projeto->created_at->setTimezone('America/Sao_Paulo')->diffForHumans() }}</small>
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
        @if ($usuario_autenticado)
            <div class="projects-section">
                <h2 class="projects-title">Projetos Favoritos</h2>
                <div class="projects-container">
                    @foreach($favorites as $favorito)
                        <div class="project-card">
                            <img src="{{ asset('storage/' . $favorito->project_image ?? 'https://via.placeholder.com/480x320') }}" alt="Imagem do Projeto">
                            <h4>{{ $favorito->Titulo }}</h4>
                            <p>{{ $favorito->Descricao }}</p>
                            <small>Favoritado em {{ $favorito->created_at->diffForHumans() }}</small>
                            <p><strong>Preço:</strong> R$ {{ number_format($favorito->Valor, 2, ',', '.') }}</p>
                            <a href="{{ route('project.show', $favorito->id) }}" class="btn btn-primary">Ver Projeto</a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const followingButton = document.getElementById('viewFollowingBtn');
        const modal = document.getElementById('followingModal');
        const closeModal = document.querySelector('.close');
        const followingList = document.getElementById('followingList');

        // Passando os seguidores como um array para o JavaScript (agora os usuários que o outro está seguindo)
        const followingArray = @json($seguindo);

        // Abrir o modal quando clicar no botão "Seguindo"
        followingButton.addEventListener('click', function () {
            modal.style.display = "block";

            // Limpar a lista antes de adicionar os novos itens
            followingList.innerHTML = '';

            // Preencher a lista de pessoas que o outro usuário está seguindo
            followingArray.forEach(function(following) {
                const listItem = document.createElement('li');
                listItem.textContent = following.name;

                // Caso o usuário tenha uma imagem de perfil, exiba ela também
                const img = document.createElement('img');
                img.src = following.profile_image ? "{{ asset('storage/') }}" + '/' + following.profile_image : "{{ asset('img/avatar.png') }}";
                img.alt = "Imagem de Perfil";
                img.style.width = "40px";
                img.style.height = "40px";
                img.style.borderRadius = "50%";
                listItem.prepend(img); // Adiciona a imagem antes do nome

                followingList.appendChild(listItem);
            });
        });

        // Fechar o modal quando clicar no "X"
        closeModal.addEventListener('click', function () {
            modal.style.display = "none";
        });

        // Fechar o modal se o usuário clicar fora da área do modal
        window.addEventListener('click', function (event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });
    });
    </script>
</body>

</html>
