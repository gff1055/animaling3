
var btnSeguir = document.getElementById("btnSeguir");
btnSeguir.addEventListener("click", function btnSeguirClick(){
	labelButton();
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


function labelButton(){

	// Declaracao de variaveis
	var nome = document.getElementById("btnSeguir").value;
	var xmlreq = CriaRequest();

	// Exibi a mensagem de progresso
	// result.innerHTML = '<img src="progresso1.gif"/>';

	// Iniciar uma requisicao
	xmlreq.open("GET", "/animaling3/public/opseguidor", true);

	// Atribui uma funcao para ser executada sempre que houver uma mudance de ado
	xmlreq.onreadystatechange = function(){

		// Verifica se foi concluido com sucesso e a cnexao fechada(readyState = 4)
		if(xmlreq.readyState == 4){

			// Verifica se o arquivo foi encontrado com sucesso
			if(xmlreq.status == 200){
				alert(xmlreq.responseText);
				nome.value = xmlreq.responseText;
			}else{
				//result.innerHTML = "Erro: "+ xmlreq.statusText;
			}
		}
	};

	xmlreq.send(null);

}