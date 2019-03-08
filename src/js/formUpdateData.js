

/* Função que faz a miniatura da foto enviada */
function previewFile(){
      /* var PREVIEW recebe o elemento IMG */
      var preview = document.querySelector('#foto'); //selects the query named img
      // var FILE recebe os arquivos inseridos no elemento INPUT FILE
      var file    = document.querySelector('input[type=file]').files[0]; //sames as here
      /* var READER recebe nova instancia de
      FileReader (classe usada na leitura assincrona de arquivos no PC do usuario)*/
      var reader  = new FileReader();

      /* Evento ONLOADEND (chamado quando a operacao de leitura de arquivos é terminada) */
      /* Manipulador do evento ONLOADEND da variavel READER recebe função*/
      reader.onloadend = function () {
          /* Propriedade SRC da variavel PREVIEW recebe o conteudo do arquivo enviado */
          preview.src = reader.result;
      }

      /* Testa se algum arquivo foi enviado */
      if (file) {
          /* Leitura do arquivo que está na variave FILE.
          Os dados serão apresentados (reader.result) em forma de URL */
          reader.readAsDataURL(file); //reads the data as a URL
      } else {
          /* Se nao houver arquivos, a prop. SRC recebe nada */
          preview.src = "";
      }
}