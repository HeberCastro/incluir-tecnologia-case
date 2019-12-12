    

    <div  class="col-sm-12 col-md-4">
      <a href="./?country=<?php echo  $country->alpha3Code; ?>">
      	<img style="max-height: 45vh;" id="countryFlag" src="<?php echo $country->flag; ?>" class="img-fluid img-responsive" alt="Bandeira de <?php echo $country->name; ?>">
      </a>
      <p class="text-center">
        <?php echo "Nome: <b>" . $country->translations->br . "</b>";?> 
      </p>
      	
  	</div>

