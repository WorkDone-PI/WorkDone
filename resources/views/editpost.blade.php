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

    <div class="formPostagem">
        <header>Publique seu projeto</header>

        <form action="{{ route('updateProject', $prj->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form first">
                <div class="details">
                    <span class="title">Edite as informações do seu projeto</span>
                    <div class="fields">
                        <div class="input-field">
                            <label for="Titulo">Título do projeto</label>
                            <input type="text" name="Titulo" value="{{ old('Titulo', $prj->Titulo) }}" placeholder="Qual o nome do seu projeto?" required>
                        </div>

                        <div class="input-field">
                            <label for="Valor">Precifique seu projeto</label>
                            <input type="text" name="Valor" value="{{ old('Valor', $prj->Valor) }}" placeholder="Valor..." required>
                        </div>

                        <div class="fields">
                            <div class="input-field">
                                <label for="Descricao">Descreva seu projeto</label>
                                <textarea name="Descricao" id="desc" placeholder="Descrição..." required>{{ old('Descricao', $prj->Descricao) }}</textarea>
                            </div>
                        </div>

                        <div class="input-field">
                            <label for="Categoria">Escolha uma categoria</label>
                            <select name="Categoria" id="Categoria">
                                <option value="">Selecione uma categoria</option>
                            </select>
                        </div>
                        
                    </div>
                </div>
            </div>
            <button type="submit">Atualizar<box-icon name='paper-plane' type='solid' color='#ffffff'></box-icon></button>
            <a href=" {{ route('profile') }} " class="btn btn-primary">Voltar</a>
        </form>

    </div>

</body>

</html>