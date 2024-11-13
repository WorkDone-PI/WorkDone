<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/WK.png') }}" type="Favicon_Image_Location">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/postagem.css') }}">
    <title>WorkDone | Publicar </title>
</head>

<body>
    <nav>
        <div class="navbar">
            <div class="logo"><a href="{{ route('home') }}">WorkDone</a></div>
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

        <form action="{{ route('produto') }}" method="post" enctype="multipart/form-data">
            @csrf

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
                            <input type="number" name="Valor" placeholder="Valor..." required>
                        </div>

                        <div class="fields">
                            <div class="input-field">
                                <label for="Descricao">Descreva seu projeto</label>
                                <textarea name="Descricao" id="desc" placeholder="Descrição..." required></textarea>
                            </div>
                        </div>

                        <div class="input-field">
                            <label for="Categoria">Escolha uma categoria</label>
                            <select name="Id_Categoria" id="Categoria">
                                <option value="">Selecione uma categoria</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->Titulo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-field">
                            <label for="project_image">Imagem do Perfil</label>
                            <input type="file" name="project_image" id="project_image" accept="image/*">
                        </div>

                    </div>
                </div>
            </div>
            <button type="submit">Finalizar<box-icon name='paper-plane' type='solid'
                    color='#ffffff'></box-icon></button>

        </form>
    </div>

</body>

</html>