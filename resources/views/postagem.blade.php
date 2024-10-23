<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/WK.png" type="Favicon_Image_Location">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/postagem.css') }}">
    <title>WorkDone | Publicar </title>
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
                        
                    </a>
                </div>
            </div>
        </div>
    </nav>
    @php
        $step = $step ?? 1;
    @endphp
    <div class="formPostagem">
        <header>Publique seu projeto</header>

        <form action="{{ route('form.submit') }}" method="post">
            @csrf

            @if ($step == 1)
                <div class="form first">
                    <div class="details">
                        <span class="title">Adicione as informações do seu projeto</span>
                        <div class="fields">
                            <div class="input-field">
                                <label for="Titulo">Título do projeto</label>
                                <input type="text" name="Titulo" placeholder="Qual o nome do seu projeto?" required>
                            </div>
                            <div class="input-field">
                                <label for="Valor">Precifique seu projeto</label>
                                <input type="text" name="Valor" placeholder="Valor..." required>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit">Próxima Etapa <box-icon type='solid' name='right-arrow'></box-icon></button>
                @elseif ($step == 2)
                <div class="form second">
                    <div class="details">
                        <span class="title">Descreva seu projeto</span>
                        <div class="fields">
                            <div class="input-field">
                                <label for="Descricao">Faça uma descrição dele</label>
                                <textarea name="Descricao" id="desc" placeholder="Descrição..." required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit">Finalizar<box-icon name='paper-plane' type='solid' color='#ffffff' ></box-icon></button>
            @endif
        </form>
    </div>

</body>

</html>