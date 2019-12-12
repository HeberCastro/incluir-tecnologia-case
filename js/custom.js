//Processa as entradas da busca
function controllerSearch(){
	var region = document.getElementById("inputRegion");
	var country = document.getElementById("inputCountry");
	var url = "./";
	if(region.value!=0){
		url+="?region=" + region.value;
	}
	else{
		url+="?country=" + country.value;	
	}
	window.location.href = url;
}
 
 //Habilita o auto complete depois de 3 letras digitadas no campo country
function autoCompleteCountry(){

	var country = document.getElementById("inputCountry");

	if(country.value.length>=3){
		var list = document.getElementById("countriesDataListaOff");
		if(list.innerHTML){
			document.getElementById("countriesDataLista").innerHTML = list.innerHTML;
			list.innerHTML = null;
		}
	}
}

//Faz request via AJAX 
function makeRequest(url) {
	var ourRequest = new XMLHttpRequest();
	ourRequest.open("GET", url, true);
	ourRequest.onreadystatechange = function() {
		if (this.readyState == 4) {
		  	var result = this.responseText;
		  	var json = JSON.parse(result);
		  	setGlobalValue(json);
		}
	};
	ourRequest.send();
}

function setGlobalValue(json){
	countriesGlobal = json;
	console.log(countriesGlobal);
}

//Resta o input de região para nulo
function resetRegion(){
	document.getElementById("inputRegion").value = 0;
}


//Resta o input de country para nulo
function resetCountry(){
	document.getElementById("inputCountry").value = null;
}

//Configurando para quando apertar "Enter" estando selecionado o campo de entrada para paises, ative o evento de click() no botão pesquisar(#searchBtn).
window.onload = function(){
	var input = document.getElementById("inputCountry");
	input.addEventListener("keyup", function(event){
		if (event.keyCode === 13) {
		   document.getElementById("searchBtn").click();
	  	}
	});
}