<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/WK.png') }}" type="Favicon_Image_Location">
    <link rel="stylesheet" href="{{ asset('css/project_page.css') }}">
    <title>WorkDone | {{ $projeto->Titulo }}</title>
</head>

<body>
    <main>
        <section class="image-carousel">
            <div class="carousel">
                <button class="arrow left">&lt;</button>
                <div class="images">
                    <img src="{{ asset('storage/' . $projeto->project_image) }}" alt="Imagem 1">
                    <img src="https://via.placeholder.com/800x600?text=Imagem+2" alt="Imagem 2">
                    <img src="https://via.placeholder.com/800x600?text=Imagem+3" alt="Imagem 3">
                    <img src="https://via.placeholder.com/800x600?text=Imagem+4" alt="Imagem 4">
                    <img src="https://via.placeholder.com/800x600?text=Imagem+5" alt="Imagem 5">
                </div>
                <button class="arrow right">&gt;</button>
            </div>
        </section>

        <section class="project-info">
            <div class="flip-container">
                <div class="flip-face front">
                    <div class="user-info">
                        <img src="{{ asset('storage/' . $projeto->user->profile_image) }}" alt="Foto do criador"
                            class="user-photo">
                        <div class="user-details">
                            <h3>{{ $projeto->user->name }}</h3>
                            <h3>{{$projeto->Titulo}}</h3>
                            <p class="description">
                                {{ $projeto->Descricao }}
                            </p>
                        </div>
                    </div>

                    <div class="project-details">
                        <h3>Detalhes do Projeto</h3>
                        <p><strong>Valor:</strong>{{ number_format($projeto->Valor, 2, ',', '.') }}</p>
                        @foreach($categories as $category)
                            <p><strong>Categoria:</strong> {{ $category->Titulo }}</p>
                        @endforeach
                        <p><strong>Data de Criação:</strong> {{ $projeto->created_at->format('d/m/Y H:i:s') }}
                        </p>
                    </div>
                </div>

                <div class="flip-face back">
                    <h4>Informações Detalhadas do Criador</h4>
                    <p><strong>Email:</strong> {{ $projeto->user->email }} </p>
                    <p><strong>Nome:</strong> {{ $projeto->user->name }}</p>
                    <p><strong>Telefone:</strong> <a href="">00 99999-9999</a></p>
                </div>
            </div>

            <button class="show-user-info-btn">Ver Informações do Criador</button>
        </section>
    </main>

    <script>
        let currentIndex = 0;
        const images = document.querySelectorAll('.carousel .images img');
        const totalImages = images.length;

        document.querySelector('.arrow.left').addEventListener('click', () => {
            currentIndex = (currentIndex === 0) ? totalImages - 1 : currentIndex - 1;
            updateCarousel();
        });

        document.querySelector('.arrow.right').addEventListener('click', () => {
            currentIndex = (currentIndex === totalImages - 1) ? 0 : currentIndex + 1;
            updateCarousel();
        });

        function updateCarousel() {
            const offset = -currentIndex * 100;
            document.querySelector('.carousel .images').style.transform = `translateX(${offset}%)`;
        }

        document.querySelector('.show-user-info-btn').addEventListener('click', function () {
            const userInfo = document.querySelector('.full-user-info');
            if (userInfo.style.display === 'none' || userInfo.style.display === '') {
                userInfo.style.display = 'block';
            } else {
                userInfo.style.display = 'none';
            }
        });

        document.querySelector('.show-user-info-btn').addEventListener('click', function () {
            const flipContainer = document.querySelector('.flip-container');
            if (flipContainer.style.transform === 'rotateY(180deg)') {
                flipContainer.style.transform = 'rotateY(0deg)';
            } else {
                flipContainer.style.transform = 'rotateY(180deg)';
            }
        });

    </script>
</body>

</html>