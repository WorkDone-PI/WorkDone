<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/chatbot.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Chatbot</title>
</head>
<body>
    <div class="main-div">
        <div class="menuToggle">
            <i class='bx bx-help-circle'></i>
        </div>
        <div class="container">
            <div class="top-part">
                <div class="agent-details">
                    <img src="{{ asset('img/profile.png') }}" alt="">
                    <div class="agent-text">
                        <h3>WorkdoneBot</h3>
                        <p>Agente <span>(Online)</span></p>
                    </div>
                </div>
                <i class='bx bx-x'></i>
            </div>
            <div id="chat" class="chart-section">
                <div class="left-part">
                    <div class="agent-chart">
                        <img src="{{ asset('img/profile.png') }}" alt="">
                        <p>Olá, Qual a sua dúvida hoje? Perguntas Frequentes? Problemas com projeto? Problemas com perfil? Problemas com vendedor?</p>
                    </div>
                </div>
                <div class="right-part">
                    <!--<p></p>
                    <span></span>-->
                </div>
            </div>
            <div class="bottom-section">
                <i class='bx bxs-camera'></i>
                <input type="text" id="message" placeholder="Digite sua mensagem..." />
                <button onclick="sendMessage()">Enviar
                    <i class='bx bxs-send'></i>
                </button>
            </div>
        </div>
    </div>
    <script>
        const menuToggle = document.querySelector('.menuToggle');
        menuToggle.onclick = function() {
            menuToggle.classList.toggle('active')
        }

        async function sendMessage() {
            const message = document.getElementById('message').value;
            const response = await fetch('/chatbot', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message })
            });
            const data = await response.json();

            // Adiciona a mensagem do usuário à direita
            document.getElementById('chat').innerHTML += `
                <div class="right-part">
                    <p>${message}</p>
                </div>
            `;

            // Adiciona a resposta do bot à esquerda
            document.getElementById('chat').innerHTML += `
                <div class="left-part">
                    <div class="agent-chart">
                        <img src="{{ asset('img/profile.png') }}" alt="">
                        <p>${data.response}</p>
                    </div>
                </div>
            `;

            // Limpa o campo de entrada de mensagem
            document.getElementById('message').value = '';

            const chatSection = document.getElementById('chat');
            chatSection.scrollTop = chatSection.scrollHeight;

        }
    </script>
</body>
</html>
