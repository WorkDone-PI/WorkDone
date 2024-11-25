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
                    <input type="search" name="search" id="search" value="{{ request()->input('search') }}">
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
                <a class="menu-item active" id="filterBtn">
                    <span><i class='bx bx-filter-alt'></i></span>
                    <h3>Filtrar</h3>
                </a>
                <div class="filter-dropdown" id="filterDropdown" style="display: none;">
                    <form action="{{ route('home') }}" method="GET">
                        <div class="filter-option">
                            <label for="price_order">Ordenar por Preço:</label>
                            <select name="price_order" id="price_order">
                                <option value="">Selecione</option>
                                <option value="asc" {{ request('price_order') == 'asc' ? 'selected' : '' }}>Do menor para
                                    o maior</option>
                                <option value="desc" {{ request('price_order') == 'desc' ? 'selected' : '' }}>Do maior
                                    para o menor</option>
                            </select>
                        </div>
                        <div class="filter-option">
                            <label for="date_order">Ordenar por Data:</label>
                            <select name="date_order" id="date_order">
                                <option value="">Selecione</option>
                                <option value="desc" {{ request('date_order') == 'desc' ? 'selected' : '' }}>Mais recente
                                </option>
                                <option value="asc" {{ request('date_order') == 'asc' ? 'selected' : '' }}>Mais antigo
                                </option>
                            </select>
                        </div>
                        <div class="filter-option">
                            <label for="category">Categoria:</label>
                            <select name="category" id="category">
                                <option value="">Selecione</option>
                                @foreach ($categories as $category)
                                    @if ($category->parent_id == null)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->Titulo }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="filter-option">
                            <label for="subcategory">Sub-Categoria:</label>
                            <select name="subcategory" id="subcategory" disabled>
                                <option value="">Selecione</option>
                                @foreach ($categories as $category)
                                    @if ($category->parent_id != null)
                                        <option value="{{ $category->id }}" 
                                            data-category="{{ $category->parent_id }}" 
                                            {{ request('subcategory') == $category->id ? 'selected' : '' }}>
                                            {{ $category->Titulo }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn" style="width: 100%;">Filtrar</button>
                    </form>
                    <script>
                        document.getElementById('filterBtn').addEventListener('click', function () {
                            const dropdown = document.getElementById('filterDropdown');
                            if (dropdown.style.display === 'none' || dropdown.style.display === '') {
                                dropdown.style.display = 'flex';
                                setTimeout(() => {
                                    dropdown.style.opacity = 1;
                                }, 10);
                            } else {
                                dropdown.style.opacity = 0;
                                setTimeout(() => {
                                    dropdown.style.display = 'none';
                                }, 300);
                            }
                        });
                        document.getElementById('category').addEventListener('change', function () {
                            const categoryId = this.value;
                            const subcategorySelect = document.getElementById('subcategory');
                            const options = subcategorySelect.querySelectorAll('option');

                            subcategorySelect.value = '';
                            subcategorySelect.disabled = false;

                            if (categoryId) {
                                // Filtra as subcategorias baseadas na categoria selecionada
                                options.forEach(option => {
                                    if (option.getAttribute('data-category') == categoryId || option.value == '') {
                                        option.style.display = 'block';
                                    } else {
                                        option.style.display = 'none';
                                    }
                                });
                            } else {
                                // Se nenhuma categoria for selecionada, desabilita o campo de subcategoria
                                subcategorySelect.disabled = true;
                                subcategorySelect.innerHTML = '<option value="">Selecione</option>';
                            }
                        });

                        // Se já houver categoria e subcategoria selecionadas na URL, os filtros sejam aplicados corretamente
                        document.addEventListener('DOMContentLoaded', function () {
                            const categoryId = document.getElementById('category').value;
                            if (categoryId) {
                                document.getElementById('category').dispatchEvent(new Event('change'));
                            }
                        });
                    </script>
                </div>
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
                    @if($projeto->removed == 0)
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
                                            <a href="{{ route('profile.show', $projeto->user->id) }}">
                                                <small>Desenvolvido por: {{ $projeto->user->name ?? 'Desconhecido' }}</small>
                                            </a>
                                    </div>
                                </div>
                                <div class="descricao">
                                    <p>{{ $projeto->Descricao }}</p>
                                </div>
                            </div>
                            <div class="valor">
                                <p>Preço: R$ {{ number_format($projeto->Valor, 2, ',', '.') }}</p>
                            </div>
                            <div class="ladolado">
                                <div class="categorias">
                                    <strong>Categorias:</strong>
                                    <ul>
                                        @foreach($projeto->categories as $category)
                                            <li>{{ $category->Titulo }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <a href="{{ route('project.show', $projeto->id) }}" class="cta">
                                    <span class="hover-underline-animation"> Ver Projeto </span>
                                    <svg id="arrow-horizontal" xmlns="http://www.w3.org/2000/svg" width="30" height="10"
                                        viewBox="0 0 46 16">
                                        <path id="Path_10" data-name="Path 10"
                                            d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z"
                                            transform="translate(30)"></path>
                                    </svg>
                                </a>
                                @if (!in_array($projeto->id, $favorites))
                                <form action="{{ route('project.favorite', $projeto->id) }}" method="POST" class="favoritar-form">
                                    @csrf
                                    <button type="submit" class="favoritar-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12l5 5l10-10"></path>
                                        </svg>
                                        <span>Favoritar</span>
                                    </button>
                                </form>
                                @else
                                <form action="{{ route('project.favorite', $projeto->id) }}" method="POST" class="favoritar-form">
                                    @csrf
                                    <button type="submit" class="favoritar-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12l5 5l10-10"></path>
                                        </svg>
                                        <span>Favoritado</span>
                                    </button>
                                </form>
                                @endif
                                <div class="share-buttons">
                                    <button class="btn-share" onclick="copiarLink('{{ route('project.show', $projeto->id) }}')">
                                        <i class="bx bx-link"></i> Compartilhar Link
                                    </button>
                                    <span id="link-copiado" style="display:none; color: green;">Link copiado com sucesso!</span>
                                </div>
                            </div>
                        </div>
                    @endif
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
    <script>
        function copiarLink(url) {
            // Cria um campo temporário para copiar o link
            var campo = document.createElement('input');
            document.body.appendChild(campo);
            campo.value = url;
            campo.select();
            document.execCommand('copy');
            document.body.removeChild(campo);

            // Exibe a mensagem de "Link copiado com sucesso!"
            var mensagem = document.createElement('div');
            mensagem.textContent = "Link copiado com sucesso!";
            mensagem.style.position = 'fixed';
            mensagem.style.bottom = '20px';
            mensagem.style.left = '50%';
            mensagem.style.transform = 'translateX(-50%)';
            mensagem.style.padding = '10px';
            mensagem.style.backgroundColor = '#4CAF50';
            mensagem.style.color = '#fff';
            mensagem.style.borderRadius = '5px';
            mensagem.style.fontSize = '16px';
            mensagem.style.zIndex = '9999';
            document.body.appendChild(mensagem);

            // Fecha a mensagem após 2 segundos
            setTimeout(function() {
                mensagem.style.display = 'none';
            }, 2000);  // A mensagem será ocultada após 3 segundos
                }
    </script>

</body>

</html>