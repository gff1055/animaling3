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
		request = new XMLHttpRequest
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
}