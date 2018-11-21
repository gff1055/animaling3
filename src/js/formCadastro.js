var formCadastro = document.getElementById('formCadastro');	// Recebendo referencia do formulario de cadastro
var arrRequireField = document.getElementsByClassName('requireField');	// Recebendo referencia da classe dos campos obrigatorios
var arrCheckField = document.getElementsByClassName('requireField');	// Recebendo referencia da classe dos campos obrigatorios
var btnRegister = document.getElementById('btnRegister');


/*btn.addEventListener(
	"click",
	function(){

	}
)*/

formCadastro.addEventListener(
	"load",
	function clickSearch(){
		var disable = false;
		for(var index=0; index<arrRequireField.length; index++){
			if(arrRequireField[index].value=="")
				disable = true;			
		}
		if(disable)
			btnRegister.disable = disable
	}
);

function isItEmpty(content,index){

}

