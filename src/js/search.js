var btnSearch = document.getElementById('btnSearch');
var txtTermSearch = document.getElementById('txtTermSearch');
var spaceResult = document.getElementById('spaceResult');
var urlRoot = "/animaling3/public";

btnSearch.addEventListener(
	"click",
	function clickSearch(){
		;
	}
);

function CriaRequest(){
	try{
		request = new XMLHttpRequest();
	}catch(IEAtual){
		try{
			request = new ActiveObject("MSxml2.HMLHTTP");
		}catch(falha){
			try{
				request = new ActiveObject("Microsoft.XMLHTTP")
			}catch(falha){
				request=false;
		}
	}

	if(!request)
		alert("Seu navegador nao suporta ajax");
	else
		return request;
}


function showData(term){
	
	var url = urlRoot+"/getsearch";	//url que enviara as informações
	var xmlreq = criaRequest();	// Request a ser usado no processo de requisicao da pagina

	xmlreq.open("GET", url, true);	// Iniciando uma requisicao

	// Atribui uma funcao para ser executada sempre que houver uma mudanca de estado
	xmlreq.onreadystatechange = 
	function(){
		
		// Veririfca se foi concluido com sucesso a conexao fechada (reayState = 4)
		if(xmlreq.readyState == 4){

			// Verifica se o arquivo foi encontrado com sucesso
			if(xmlreq.status == 200)
				alert("OI");
			else
				btnSearch.value = "ERROR";
		}
	};

	xmlreq.send(null);

}

