$(document).ready(function() {

    // Hint nas imagens que contem o alt
    var imageEls = document.getElementsByClassName('imagem_hint');
    for(var i=0; i < imageEls.length; i++) {
        imageEls[i].title = imageEls[i].alt;
    }

    // Click do botão limpar imagem
    $('#btn_limpar_pdf').click(function() {

        var input_pdf = document.getElementById('pdf');
        var input_nome = document.getElementById('nome_pdf');

        input_pdf.value = '';
        input_nome.value = '';

    });

});
