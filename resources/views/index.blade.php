<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/logoWK.png' ) }}" type="Favicon_Image_Location">  
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>WorkDone | Bem-vindo</title>
</head>
<body>
    <nav class="navbar">
        <div class="logo"><a href="{{ route('index') }}">WorkDone</a></div>
        <ul class="menu">
            <li><a href="#about">Sobre Nós</a></li>
            <li><a href="#skills">Seu projeto</a></li>
            <li><a href="#services">Invista</a></li>
            <li><a href="#contact">Contato</a></li>
        </ul>
        <div class="media-icons">
            <li><a href="{{ route('register') }}">Cadastrar</a></li>
            <li><a href="{{ route('login') }}">Entrar</a></li>
        </div>
    </nav>

    <section class="home" id="home">
        <div class="home-content">
            <div class="text">
                <div class="text-one">Olá,</div>
                <div class="text-two">Bem-vindo(a) ao</div>
                <div class="text-three">WorkDone</div>
                <div class="text-four">Finka Tech</div>
            </div>
        </div>
        <div class="logo-container">
            <img src="img/WKbg.png" alt="Logo">
        </div>
    </section>

    <section class="about" id="about">
        <div class="content">
            <div class="title"><span>Sobre Nós</span></div>
            <div class="about-details">
                <div class="right">
                    <img src="img/logo finka.png" alt="">
                </div>
                <div class="left">
                    <div class="topic">Finka Tech</div>
                    <p>
                        Somos apaixonados por transformar ideias em realidade digital. 
                        Especializados em criar websites e aplicativos personalizados e sistemas exclusivos que impulsionam seu sucesso online. 
                        Estamos animados para compartilhar nossa jornada tecnológica com vocês. 
                        Fiquem ligados para conhecer nossos projetos incríveis!
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="skills" id="skills">
        <div class="content">
            <div class="title"><span>Seu projeto</span></div>
            <div class="skill-details">
                <div class="left">
                    <div class="topic">Publique seus projetos:</div>
                    <p>Através da nossa plataforma você pode publicar seus projetos e encontrar compradores. Acha que seu projeto não tem importância? Aqui você pode encontrar o real valor das suas ideias!</p>
                    <div class="experience">
                        <div class="num">4</div>
                        <div class="exp">Passos <br> para lucar com os seus projetos</div>
                    </div>
                </div>
                <div class="boxes">
                    <div class="box">
                        <div class="topic">Desenvolva</div>
                        <div class="num">1º</div>
                    </div>
                    <div class="box">
                        <div class="topic">Publique</div>
                        <div class="num">2º</div>
                    </div>
                    <div class="box">
                        <div class="topic">Negocie</div>
                        <div class="num">3º</div>
                    </div>
                    <div class="box">
                        <div class="topic">Ganhe dinheiro</div>
                        <div class="num">4º</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="services" id="services">
        <div class="content">
            <div class="text">
                <div class="title"><span>Invista</span></div>
                <p>Procurando projetos com grandes pontenciais? Encontre aqui seu novo investimento.</p>
            </div>
            <div class="boxes">
                <div class="box">
                    <div class="icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="topic">Desenvolvimento Web</div>
                    <p>Potencialize seu negócio com soluções web desenvolvidas para performance, escalabilidade e segurança</p>
                </div>
                <div class="box">
                    <div class="icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="topic">Servidores/Automação</div>
                    <p>Simplifique processos com automação inteligente e servidores robustos para uma operação eficiente.</p>
                </div>
                <div class="box">
                    <div class="icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="topic">Design e Multimedia</div>
                    <p>Explore projetos de design e multimídia que dão vida à sua marca, com criatividade e impacto visual.</p>
                </div>
                <div class="box">
                    <div class="icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="topic">Marketing</div>
                    <p>Descubra estratégias vencedoras de marketing que impulsionam resultados e maximizam seu retorno sobre investimento.</p>
                </div>
                <div class="box">
                    <div class="icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="topic">UI/UX</div>
                    <p>Encontre designs UI/UX que cativam os usuários, criando experiências intuitivas e envolventes.</p>
                </div>
                <div class="box">
                    <div class="icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="topic">Apps</div>
                    <p>Invista em aplicativos inovadores que transformam ideias em soluções digitais eficientes e funcionais</p>
                </div>
            </div>
        </div>
    </section>

    <section class="contact" id="contact">
        <div class="content">
            <div class="title"><span>Contate-nos</span></div>
            <div class="text">
                <div class="topic">Tem algum projeto?</div>
                <p>Entre em contato com a gente para melhorarmos ainda mais a sua experiência!</p>
                <div class="button">
                    <button>Vamos conversar!</button>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="text">
            <span>Desenvolvido por <a href="">Finka Tech</a> | &#169; 2024</span>
        </div>
    </footer>
</body>
</html>