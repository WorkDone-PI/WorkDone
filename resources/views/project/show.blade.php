<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/WK.png') }}" type="Favicon_Image_Location">
    <link rel="stylesheet" href="{{ asset('css/project_page.css') }}">
    <title>WorkDone | {{ $projeto->Titulo }}</title>
</head>

<body>
    <nav>
        <div class="navbar">
            <div class="logo"><a href="{{ route('home') }}">WorkDone</a></div>
            <div class="create">
                <a href="{{ route('edit') }}" class="btn btn-primary">Voltar</a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="dropdown-item" id="logout"><i class='bx bx-log-out'></i></button>
                </form>
            </div>
        </div>
    </nav>
    <main class="project-container">
        <div class="project-image">
            <img src="{{ asset('storage/' . $projeto->project_image) }}" alt="Imagem do Projeto">
        </div>
        <div class="project-details">
            <div style="display: flex; justify-content: space-between;">
                <div>
                    <h1>{{ $projeto->Titulo }}</h1>
                    <p class="price">R$ {{ number_format($projeto->Valor, 2, ',', '.') }}</p>
                </div>
                <div class="share-save">
                    @if (!in_array($projeto->id, $favorites))
                        <form action="{{ route('project.favorite', $projeto->id) }}" method="POST" class="favoritar-form">
                            @csrf
                            <button type="submit" class="favoritar-btn">
                                <img src="{{ asset('img/save.png') }}" alt="Favoritar">
                            </button>
                        </form>
                    @else
                        <form action="{{ route('project.favorite', $projeto->id) }}" method="POST" class="favoritar-form">
                            @csrf
                            <button type="submit" class="favoritar-btn">
                                <img src="{{ asset('img/saved.png') }}" alt="Favoritado">
                            </button>
                        </form>
                    @endif
                    <div class="share-buttons">
                        <button class="btn-share" onclick="copiarLink('{{ route('project.show', $projeto->id) }}')">
                            <img src="{{ asset('img/share.png') }}" alt="Compartilhar" class="share-icon">
                        </button>
                        <span id="link-copiado" style="display:none;">Link copiado com sucesso!</span>
                    </div>
                </div>
            </div>
            <p>Descrição:</p>
            <p class="description">{{ $projeto->Descricao }}</p>

            <div class="user-info">
                <h3 style="margin-bottom: 1vh;">Desenvolvido por:</h3>
                <div class="user-profile">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <img src="{{ asset('storage/' . $projeto->user->profile_image) }}" alt="Foto de Perfil">
                        <a href="{{ route('profile.show', $projeto->user->id) }}">{{ $projeto->user->name }}</a>
                    </div>
                    <div class="actions">
                        <button class="btn btn-contact" onclick="mostrarModal()">Entrar em Contato</button>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <div id="modalContato" class="modal">
        <div class="modal-content">
            <span class="close" onclick="fecharModal()">&times;</span>
            <h2>Contato do Profissional</h2>
            <p>E-mail: <span id="emailContatos">{{ $projeto->user->email }}</span></p>
            <button class="copy-btn" onclick="copiarTexto('emailContatos')">Copiar E-mail</button>
            <p>Telefone: <span id="telefoneContatos">{{ $projeto->user->phone }}</span></p>
            <button class="copy-btn" onclick="copiarTexto('telefoneContatos')">Copiar Telefone</button>
        </div>
    </div>
    <script>
        function copiarLink(url) {
            var campo = document.createElement('input');
            document.body.appendChild(campo);
            campo.value = url;
            campo.select();
            document.execCommand('copy');
            document.body.removeChild(campo);

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

            setTimeout(function () {
                mensagem.style.display = 'none';
            }, 2000);
        }

        function mostrarModal() {
            var modal = document.getElementById("modalContato");
            modal.style.display = "block";
        }

        function fecharModal() {
            var modal = document.getElementById("modalContato");
            modal.style.display = "none";
        }

        function copiarTexto(id) {
            var texto = document.getElementById(id).textContent;
            var campo = document.createElement('input');
            document.body.appendChild(campo);
            campo.value = texto;
            campo.select();
            document.execCommand('copy');
            document.body.removeChild(campo);

            var mensagem = document.createElement('div');
            mensagem.textContent = "Copiado com sucesso!";
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

            setTimeout(function () {
                mensagem.style.display = 'none';
            }, 2000);
        }

        window.onclick = function (event) {
            var modal = document.getElementById("modalContato");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>