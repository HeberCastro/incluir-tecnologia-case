<?php
//Analisa as entradas via GET e coordenada as ações do sistema
function controller(){
	$getRegion = NULL;
	$getCountry = NULL;
	$regions = ["Africa", "Americas", "Asia", "Europe", "Oceania"];

	if(isset($_GET["region"])){
		$getRegion = $_GET["region"];
	}
	if(isset($_GET["country"])){
		$getCountry = $_GET["country"];
	}

	if($getCountry){
		controllerCountry($getCountry);
	}
	else {
		controllerRegion($getRegion);
	}
}


function controllerCountry($countryName){
	$urlCountry = "https://restcountries.eu/rest/v2/alpha/" . $countryName;
	//Busca o pais no caso de a entrada do usuário tenha sido no formato que a API aceita.
	$country = makeRequest($urlCountry);
	if(isset($country->status)){
		//Caso não de certo no primeiro momento, percorre todos os países comparando as strings tentando encontrar alguma semelhança entre o digitado e o nome dos paises.
		$urlAllCountries = "https://restcountries.eu/rest/v2/";
		$allCountries = makeRequest($urlAllCountries);

		//Para fins de comparação entre a entrada do usuario e os nomes dos paises, removemos todos os caracteres especiais e deixarmos tudo em letras minusculas
		$trimCountryName = removeFormatacao($countryName);
		foreach($allCountries as $aCountry){
			$aCName = removeFormatacao($aCountry->translations->br);
			
			if(strstr($aCName, $trimCountryName)){
				//A primeira ocorrência de semelhança entre as strings já é tomada como a correta e retornamos a página para o usuário
				$country = $aCountry;
				include("view/country.php");
			}
		}
		//Se mesmo assim não encontrarmos nenhum pais que faça sentido, retornamos para a página inicial com uma mensagem de erro.
		header('Location: ./?error=Pais não encontrado. Favor tentar novamente com as opções sugeridas.');
		
	}
	else{
		//Caso ótimo onde a entrada do usuário já deu certo na chamada a API e retornamos as informações
		include("view/country.php");
	}
}

function controllerRegion($regionName){

	$urlRegion = "https://restcountries.eu/rest/v2/region/" . $regionName;

	//Faz o request de todos os paises para poder preencher o autocomplete na hora da pesquisa.
	$urlAllCountries = "https://restcountries.eu/rest/v2/";
	$allCountries = makeRequest($urlAllCountries);

	if($regionName) {

		//Request dos paises da região
		$regionCountries = makeRequest($urlRegion);
		if(isset($regionCountries->status)){
			$error = 'Região "'. $regionName . '" não encontrada. Por favor selecione uma das opções válidas.';
		}
	}
	
	include("view/index.php");

}

//Requer os dados de um pais sem nenhum tipo de tratamento da string de entrada, usada apenas em ambiente controlado pelo proprio sistema
function getCountry($acrCountry){

	$urlCountry = "https://restcountries.eu/rest/v2/alpha/" . $acrCountry;

	$country = makeRequest($urlCountry);

	return $country;
}


//Função que faz o request em php
function makeRequest($url){

    // create curl resource
    $ch = curl_init();
    // set url 
    curl_setopt($ch, CURLOPT_URL, $url); 

    //return the transfer as a string 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

    // $output contains the output string 
    $output = curl_exec($ch); 

    $obj_php = json_decode($output, false);

    //}
    
    // close curl resource to free up system resources 
    curl_close($ch);

    return $obj_php;
}

//Função que remove caracteres especiais
function removeFormatacao($countryName){
	$result = strtolower($countryName);
	return strtolower(preg_replace(["/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"],explode(" ","a A e E i I o O u U n N"), $result));
}

