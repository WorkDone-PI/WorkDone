<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <script>
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
            document.getElementById('chat').innerHTML += '<p><strong>Você:</strong> ' + message + '</p>';
            document.getElementById('chat').innerHTML += '<p><strong>Bot:</strong> ' + data.response + '</p>';
            document.getElementById('message').value = '';
        }
    </script>
</head>
<body>
    <div id="chat"></div>
    <input type="text" id="message" placeholder="Digite sua mensagem..." />
    <button onclick="sendMessage()">Enviar</button>
</body>
</html>
