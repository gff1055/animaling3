/* Declaracao de classe */
class PhotoSubmission {
    /* construtor da classe */
    constructor() {
        /* constante INPUTS recebe uma lista dos elementos da classe '.js-photo_submit-input' */
        const inputs = document.querySelectorAll('.js-photo_submit-input');

        /* percorrendo a lista de seletores retornada */
        for (var i = 0; i < inputs.length; i++) {
            /* adicionando a espera do evento 'change' nos seletores retornados */
            /* execucao do metodo UPLOADIMAGE */
            inputs[i].addEventListener('change', this.uploadImage);
        }
    }

    /* (uploadImage) passa o evento (e)*/
    uploadImage(e) {
        /* constante (FILEINPUT) recebe a referencia (TARGET) do objeto que enviou o evento*/
        const fileInput = e.target;
        /* constante (UPLOADBTN) recebe o "pai" do objeto */
        const uploadBtn = fileInput.parentNode;
        /* constante (DELETEBTN) recebe um determinado "filho" do objeto "pai" anterior */
        const deleteBtn = uploadBtn.childNodes[13];
        /* constante (READER) é inicializada com a classe (FILEREADER), permitindo a leitura assincrona do conteudo dos arquivos */
        const reader = new FileReader();
        /*variavel (READER) recebe funcao para exibir a imagem que foi selecionada*/
        reader.onload = function(e) {
            /* variavel (UPLOADBTN) recebe o atributo (STYLE) e o seu valor */
            uploadBtn.setAttribute('style', `background-image: url('${e.target.result}');`);
            /* variavel (UPLOADBTN) é adicionada a uma nova classe */
            uploadBtn.classList.add('photo_submit--image');
            //fileInput.setAttribute('disabled', 'disabled');
        };

        /* a nova foto enviada é exibida em forma de URL */
        reader.readAsDataURL(e.target.files[0]);

        /* adicionando a espera do evento 'click' no botao de exclusao de foto (X) */
        /* execucao do metodo ANONIMO */
        deleteBtn.addEventListener('click', function(){
            /* remocao do atributo STYLE */
            uploadBtn.removeAttribute('style');
            /* remocao da classe (PHOTO_SUBMIT--IMAGE) */
            uploadBtn.classList.remove('photo_submit--image');
            /* configurando a chamada de funcao apos 200 ms */
            setTimeout(() => {
                fileInput.removeAttribute('disabled', 'disabled');
            }, 200);
        });
    }
};

/* chamanando a classe */
new PhotoSubmission;