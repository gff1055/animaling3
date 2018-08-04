
var btnSeguir = document.getElementById("btnSeguir");
var hdnSessaoUsuario = document.getElementById("hdnSessaoUsuario").value;
var hdnPerfil = document.getElementById("hdnPerfil").value;
var tagBody = document.getElementsByTagName("body")[0];

btnSeguir.addEventListener(
	"click",
	function btnSeguirClick(){
		labelButton("click", hdnSessaoUsuario, hdnPerfil);
	}
);

tagBody.addEventListener("onload", function btnSeguirLoad(){
	labelButton(hdnSessaoUsuario, hdnPerfil);
});


function CriaRequest(){
	try{
		request = new XMLHttpRequest();
	}catch(IEAtual){
		try{
			request = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(IEAntigo){
			try{
				request = new ActiveXObject("Microsoft2.XMLHTTP");
			}catch(falha){
				request = false;
			}
		}
	}

	if(!request)
		alert("Seu navegador nao suporta Ajax");
	else
		return request;
}

/**************************
Funcao para enviar os dados
**************************/

/*Metodo que muda o valor do button ao seguir ou deixar de seguir alguem*/
function labelButton(sessaoUsuario, perfilUsuario){

	// Declaracao de variaveis
	var nome = document.getElementById("btnSeguir");	// recebendo referencia do botao seguir
	var xmlreq = CriaRequest();	// Request a ser usado no processo de requisicao dos usuarios
	var url = "/animaling3/public/"+perfilUsuario+"/gersegs?&user="+sessaoUsuario+"&prof="+perfilUsuario;	// url que enviara as informações

	xmlreq.open("GET", url , true);	// Iniciando uma requisicao

	// Atribui uma funcao para ser executada sempre que houver uma mudance de ado
	xmlreq.onreadystatechange =
	function(){

		// Verifica se foi concluido com sucesso e a cnexao fechada(readyState = 4)
		if(xmlreq.readyState == 4){

			// Verifica se o arquivo foi encontrado com sucesso
			if(xmlreq.status == 200){
				nome.value = xmlreq.responseText; 	// o botão recebe o novo status do relacionamento dos usuarios
			}else{
				nome.value = "ERROR:"
			}
		}
	};

	xmlreq.send(null);

}