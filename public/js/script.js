document.getElementById('publicar').addEventListener('click', function() {
    // Exibe o pop-up
    document.getElementById('popup').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';

    // Fecha o pop-up após 3 segundos (3000 milissegundos)
    setTimeout(function() {
      document.getElementById('popup').style.display = 'none';
      document.getElementById('overlay').style.display = 'none';
    }, 3000);
  });