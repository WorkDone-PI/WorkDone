<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/WK.png" type="Favicon_Image_Location">  
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/postagem.css') }}">
    <title>WorkDone</title>
</head>
<body>
    <header>
        <nav class="navigation">
            <a href="{{ route('home') }}"><img class="logo" src="img/logoWK.png" alt=""></a>
            <ul class="nav-menu">
                <li class="nav-item"><a href="{{ route('home') }}">Home</a></li>
            </ul>
        </nav>
    </header>
    <div class="formulario">
        <form action="">
            <h2>Publique seu projeto</h2>
            <br>
            <div class="options">
                <input type="checkbox" id="webdesign" name="webdesign">
                <span class="checkmark"></span>
                <label for="webdesign">Web Design</label><br>
                <br>
                <input type="checkbox" id="webdesign" name="webdesign">
                <span class="checkmark"></span>
                <label for="webdesign">TI e Programação</label><br>
                <br>
                <input type="checkbox" id="webdesign" name="webdesign">
                <span class="checkmark"></span>
                <label for="webdesign">Design e Multimedia</label><br>
                <br>
                <input type="checkbox" id="webdesign" name="webdesign">
                <span class="checkmark"></span>
                <label for="webdesign">Marketing e vendas</label><br>
                <br>
                <input type="checkbox" id="webdesign" name="webdesign">
                <span class="checkmark"></span>
                <label for="webdesign">Suporte Admnistrativo</label><br>
                <div class="search">
                    <a href="" target="_blank" hidden></a>
                    <input type="text" placeholder="Titulo do projeto...">
                    <div class="icon"><i class='bx bx-search'></i></div>
                </div>
                <br>
                <textarea placeholder="Descrição do projeto..." name="" id="" cols="30" rows="10"></textarea><br><br>
                <div class="card-line"></div>   
                <a id="publicar" href="{{ route('home') }}">Publicar</a>  
                <div class="publi">
                    <label for=""> Na plataforma WorkDone, os programadores tem a chance de trabalhar 
                        em projetos variados e desafiadores. </label>
                    <img src="img/homeimg.jpg" alt="">
                </div>
            </div>
            
            <a id="proximo" href="{{ route('registerProject2') }}">Próximo</a>
            <div class="card-line"></div>       
            <div class="publi">
                <label for=""> Na plataforma WorkDone, os programadores têm a chance de trabalhar 
                    em projetos variados e desafiadores. </label>
                <img src="img/homeimg.jpg" alt="">
            </div>
        </form>
    </div>
</body>
</html>
