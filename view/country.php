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

    <title>Case Incluir Tecnologia</title>
  </head>
  <body>
      <div id="" class="container-fluid">
        <div id="menu" class="row d-flex">
          <div class="col-sm-12">
            <a class="btn" href="."><img src="img/logo.png" class="img-fluid img-responsive" alt="Logo Incluir Tecnologia"></a>
            <div id="divBtn">
              <input type="button" class="btn btn-primary align-middle" id="backwards" onclick="window.history.back();"value="VOLTAR">
            </div>
          </div>
        </div>
        <div id="mainContentDiv">
          <div id="mainContent" class="row d-flex mt-3 text-center">
            <div class="col-sm-12 offset-md-4 col-md-4">
              
              <img id="countryFlag" src="<?php echo $country->flag; ?>" class="img-fluid img-responsive" alt="Bandeira de <?php echo $country->name; ?>">
              <h3><?php echo "Nome: " . $country->translations->br . " (" . $country->nativeName . ")";?></h3>
              <p><?php echo "Capital: " . $country->capital;?></p>
              <p><?php echo "Região: " . $country->region;?></p>
              <p><?php echo "Sub-Região: " . $country->subregion;?></p>
              <p><?php echo "População: " . $country->population;?></p>
              <p>
                <?php 
                  echo "Linguas: ";
                  foreach($country->languages as $lang){
                    echo $lang->name . "; ";
                  }
                ?>
              </p>

              <?php if(count($country->borders)>0){?>
                <h5>Paises vizinhos:</h5>
              <?php } ?>
            </div>
          </div>
          <div id="borderCountries" class="row d-flex mt-3 text-center">
            <?php 
              foreach($country->borders as $countryC){
                $country = getCountry($countryC);
                include('singleCountry.php');
              }
            ?>
          </div>
        </div>
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>