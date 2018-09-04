var btnSearch = document.getElementById('btnSearch');
var txtTermSearch = document.getElementById('txtTermSearch');
var spaceResult = document.getElementById('spaceResult');

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
	var url = "/animaling3/public/getsearch";	//url que enviara as informações
	xmlReq = criaRequest();
	xmlreq.open("GET", url, true);
	xmlReq

}

