<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/WK.png') }}" type="Favicon_Image_Location">
    <title>WorkDone | Feed</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
</head>

<body>
    <nav>
        <div class="navbar">
            <div class="logo"><a href="{{ route('home') }}">WorkDone</a></div>
            <div class="search-bar">
                <form action="{{ route('home') }}" method="GET">
                    <i class='bx bx-search-alt'></i>
                    <input type="search" name="search" id="search"
                        placeholder="Pesquise por projetos, pessoas e filtros..."
                        value="{{ request()->input('search') }}">
                </form>
            </div>
            <div class="create">
                <h5>Olá, {{ $user->name }}! </h5>
                <div class="profile-photo">
                    <a href="{{ route('profile') }}">
                        @if($user->profile_image)
                            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image">
                        @else
                            <img src="{{ asset('img/avatar.png') }}" alt="Default Profile Image">
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="left">
            <a href=" {{ route('profile') }} " class="profile">
                <div class="profile-photo">
                    @if($user->profile_image)
                        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image">
                    @else
                        <img src="{{ asset('img/avatar.png') }}" alt="Default Profile Image">
                    @endif
                </div>
                <div class="handle">
                    <h4>{{ $user->name }}</h4>
                    <p class="text-muted">
                        {{ $user->arroba }}
                    </p>
                    <p class="text-view">
                        Vizualizar Perfil
                    </p>
                </div>
            </a>


            <div class="sidebar">
                <a class="menu-item active" href=" {{ route('registerProject') }} ">
                    <span><i class='bx bx-plus-circle'></i></i></span>
                    <h3>Novo Projeto</h3>
                </a>
                <a class="menu-item active">
                    <span><i class='bx bx-filter-alt'></i></span>
                    <h3>Filtrar</h3>
                </a>
                <a href=" {{ route('chatbot.show') }} " class="menu-item active">
                    <span><i class='bx bx-question-mark'></i></span>
                    <h3>Suporte</h3>
                </a>

            </div>
        </div>


        <div class="middle">
            <div class="feeds">
                @if ($projetos->isEmpty())
                    <div class="feed empty_container">
                        <div class="head empty_project">
                            <img src="{{ asset('img/no_projects.png')}}" alt="Sem Projetos!" class="empty_image">
                            <h2>Não há projetos disponíveis no momento, mas você pode criar o seu próprio!</h2>
                        </div>
                    </div>
                @endif
                @foreach($projetos as $projeto)
                    <div class="feed">
                        <div class="head">
                            <div class="user">
                                <div class="profile-photo">
                                    @if($projeto->user && $projeto->user->profile_image)
                                        <img src="{{ asset('storage/' . $projeto->user->profile_image) }}" alt="Profile Image">
                                    @else
                                        <img src="{{ asset('img/avatar.png') }}" alt="Default Profile Image">
                                    @endif
                                </div>
                                <div class="ingo">
                                    <h3>{{ $projeto->Titulo }}</h3>
                                    <small>Adicionado em
                                        {{ $projeto->created_at->setTimezone('America/Sao_Paulo')->diffForHumans() }}
                                        |</small>
                                    <small>Desenvolvido por: {{ $projeto->user->name ?? 'Desconhecido' }}</small>
                                    <!-- Exibe o nome do usuário -->
                                </div>
                            </div>
                            <div class="descricao">
                                <p>{{ $projeto->Descricao }}</p>
                            </div>
                        </div>
                        <div class="valor">
                            <p>Preço: R$ {{ number_format($projeto->Valor, 2, ',', '.') }}</p>
                        </div>
                        <div class="categorias">
                            <strong>Categorias:</strong>
                            <ul>
                                @foreach($projeto->categories as $category)
                                    <li>{{ $category->Titulo }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="{{ route('home') }}">Ver Projeto</a>
                    </div>
                @endforeach
                <div class="pagination-container">
                    <div class="pagination">
                        <a href="{{ $projetos->previousPageUrl() }}"
                            class="pagination-btn {{ $projetos->onFirstPage() ? 'disabled' : '' }}">
                            Anterior
                        </a>
                        @foreach($projetos->getUrlRange(1, $projetos->lastPage()) as $page => $url)
                            <a href="{{ $url }}"
                                class="pagination-page {{ $projetos->currentPage() == $page ? 'active' : '' }}">
                                {{ $page }}
                            </a>
                        @endforeach
                        <a href="{{ $projetos->nextPageUrl() }}"
                            class="pagination-btn {{ !$projetos->hasMorePages() ? 'disabled' : '' }}">
                            Próximo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>