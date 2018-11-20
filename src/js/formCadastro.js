var formCadastro = document.getElementById('formCadastro');	// Recebendo referencia do formulario de cadastro
var arrRequireField = document.getElementsByClassName('requireField');	// Recebendo referencia da classe dos campos obrigatorios
var arrCheckField = document.getElementsByClassName('requireField');	// Recebendo referencia da classe dos campos obrigatorios


/*btn.addEventListener(
	"click",
	function(){

	}
)*/

formCadastro.addEventListener(
	"load",
	function clickSearch(){
		arrRequireField.foreach()
	}
);

function isItOk(content,index){

}

