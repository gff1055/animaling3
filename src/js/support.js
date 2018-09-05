
var btnSeguir = document.getElementById("btnSeguir");	// variavel recebe referencia do botao seguir
var countFollowers = document.getElementById("countFollowers");	//	variavel recebe a quantidade de seguidores
var hdnSessaoUsuario = document.getElementById("hdnSessaoUsuario").value;	// variavel recebe o codigo do usuario da sessao
var hdnPerfil = document.getElementById("hdnPerfil").value;	// variavel recebendo o codigo do usuario do perfil
var tagBody = document.getElementsByTagName("body")[0];	// variavel recebendo a referencia da tag body
var aux = null;	// variavel auxiliar
var urlRoot = "/animaling3/public";

/* Adicionando evento quando usuario clicar no botao seguir */
btnSeguir.addEventListener(
	"click",
	function fncBtnFollowClick(){
		if(btnSeguir.value == "Seguindo"){
			continueExecution = confirm("Deseja deixar de seguir este usuario?");
			if(continueExecution == false)
				return false;				
		}
		runFollowButton(btnSeguir.value, hdnSessaoUsuario, hdnPerfil);		
	}
);

/* Adicionando evento quando usuario acessar o perfil de outro usuario */
tagBody.addEventListener(
	"onload",
	function fncBtnFollowLoad(){
		loadLabelButton(hdnSessaoUsuario, hdnPerfil);
});

/* Funcao que cria a requisicao e testa o suporte a ajax */
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
Funcao para carregar os dados
**************************/

/*Metodo que muda o valor do button (seguir/seguir de volta/seguindo) */
function loadLabelButton(sessaoUsuario, perfilUsuario){

	// Declaracao de variaveis
	var xmlreq = CriaRequest();	// Request a ser usado no processo de requisicao dos usuarios
	var url = urlRoot+"/"+perfilUsuario+"/followstate?&user="+sessaoUsuario+"&prof="+perfilUsuario;	// url para onde serão enviadas as informações


	xmlreq.open("GET", url , true);	// Iniciando uma requisicao

	// Atribui uma funcao para ser executada sempre que houver uma mudance de estado
	xmlreq.onreadystatechange =
	function(){

		// Verifica se foi concluido com sucesso e a cnexao fechada(readyState = 4)
		if(xmlreq.readyState == 4){

			// Verifica se o arquivo foi encontrado com sucesso
			if(xmlreq.status == 200){
				btnSeguir.value = aux = xmlreq.responseText; 	// o botão recebe o novo status do relacionamento dos usuarios
			}else{
				btnSeguir.value = "ERROR:"
			}
		}
	};
	xmlreq.send(null);
}


/* Metodo que insere os novos seguidores e atualiza a quantidade destes */
function runFollowButton(aux, sessionUser, profileUser){

	// Declaracao de variaveis
	var xmlreq = CriaRequest();	// Request a ser usado no processo de requisicao dos usuarios
	var url = urlRoot+"/"+profileUser+"/someactionfollow?&state="+aux+"&user="+sessionUser+"&prof="+profileUser;	// url que enviara as informações

	xmlreq.open("GET", url, true);	// Iniciando uma requisicao

	// Atribui uma funcao para ser executada sempre que houver uma mudance de estado
	xmlreq.onreadystatechange =
	function(){

		// Verifica se foi concluido com sucesso e a cnexao fechada(readyState = 4)
		if(xmlreq.readyState == 4){

			// Verifica se o arquivo foi encontrado com sucesso
			if(xmlreq.status == 200){
				dataServer = JSON.parse(xmlreq.responseText); 	// dataServer recebendo resposta da operacao do servidor
				btnSeguir.value = dataServer.indexNewState; //	elemento do botao seguir recebe o novo relacionamento
				countFollowers.innerHTML = dataServer.indexCountFollowers;	// atualizando a quantidade de seguidores
			}else{
				btnSeguir.value = "ERROR:";
			}
		}
	};

	xmlreq.send(null);

}