<!doctype html>
<html lang="pt-BR">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
    <!--Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Anton|Gupter|Josefin+Sans&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <script src="js/custom.js"></script>
    <title>Case Incluir Tecnologia</title>
  </head>
  <body>
      <div  class="container-fluid">
        <div id="menu" class="row d-flex">
          <div class="col-sm-12">
            <a class="btn" href="."><img src="img/logo.png" class="img-fluid img-responsive" alt="Logo Incluir Tecnologia"></a>
          </div>
        </div>
      </div>
      <div id="mainContentDiv">
        <div id="searchBar" class="row d-flex">
          <div class="col-sm-12 col-md-3">
            <label class="labelForInput" for="inputRegion">Região</label>

            <select id="inputRegion" class="form-control" aria-describedby="searchRegion"  onchange="resetCountry()">
              <option selected value="0">Selecione...</option>
              <option value="Africa">Africa</option>       
              <option value="Americas">Americas</option>
              <option value="Asia">Asia</option>  
              <option value="Europe">Europe</option>
              <option value="Oceania">Oceania</option>
            </select>
            
          </div>
          <div class="col-sm-12 col-md-3">
            <label class="labelForInput" for="inputCountry">Pais</label>
            <input type="search" placeholder="Insira o pais..." id="inputCountry" class="form-control" aria-describedby="searchCountry" onkeyup="autoCompleteCountry()" onkeydown="resetRegion()" list="countriesDataLista">
            <datalist id="countriesDataLista"></datalist>
            <datalist id="countriesDataListaOff">
            <?php 
              if(isset($allCountries)){
                foreach($allCountries as $country){
                  echo '<option value="'.$country->alpha3Code.'">'. $country->translations->br .'</option>';
                }
              }
            ?>
            </datalist>
          </div>
          <div class="col-sm-12 col-md-6">
            <div id="divBtn2">
              <input type="button" class="btn btn-primary" id="searchBtn" value="PESQUISAR" onclick="controllerSearch()" >
            </div>
          </div>
        </div>
        
        <?php
          if(isset($_GET["error"]) || isset($error)){
            if(!isset($error))
              $error = $_GET["error"];
        ?>
            <div class="col-sm-12 offset-md-4 col-md-4 mt-3 alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Erro:</strong> <?php echo $error; ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php
            }
            if(isset($regionCountries) && !isset($regionCountries->status)){
          ?>
            <div id="regionCountries" class="row d-flex mt-5 text-center">
            <?php
              foreach($regionCountries as $country){
                include('singleCountry.php');
              }
            ?>
            </div>
          <?php
            }
          ?>
      </div>
          
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>