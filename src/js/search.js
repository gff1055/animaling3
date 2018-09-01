var btnSearch = document.getElementById('btnSearch');
var txtTerm = document.getElementById('txtTerm');

btnSearch.addEventListener(
	"click",
	function clickSearch(){
		alert("OI");
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
	var url = "/animaling3/public/"+profileUser+"/someactionfollow?&state="+aux+"&user="+sessionUser+"&prof="+profileUser;	// url que enviara as informações
}

