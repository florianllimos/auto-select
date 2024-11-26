<?php

require_once("composants/header.php");

require_once("composants/background-fixed.php");

require_once("composants/database.php");

$sql = "SELECT * FROM voitures";
$requete = $db->query($sql);
$voitures = $requete->fetchAll();

?>

<div class='page'>
  <h2 class='big-title'>Vente de voitures</h2>
  <form id="filterForm" class="form">
    <div class="bloc-form">
      <label for="priceRange">Prix maximum :</label>
      <span id="spanPrice">0</span>
    </div>
    <div class="bloc-form">
      <input type="range" id="priceRange" name="priceRange" min="0" max="500000" step="1000" value="0">
    </div>
    <div class="bloc-form">
      <label for="mileageRange">Kilométrage maximum :</label>
      <span id="spanKm">0</span>
    </div>
    <div class="bloc-form">
      <input type="range" id="mileageRange" name="mileageRange" min="0" max="200000" step="10000" value="0">
    </div>
    <div class="bloc-form">
      <label for="yearRange">Année maximum :</label>
      <span id="spanYear">0</span>
    </div>
    <div class="bloc-form">
      <input type="range" id="yearRange" name="yearRange" min="1990" max="2023" step="1" value="0">
    </div>
  </form>
  <div id="carList"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
      
    $(document).ready(function() {

      $('#priceRange, #mileageRange, #yearRange').on('input', function() {
        
        var price = $('#priceRange').val();
        var mileage = $('#mileageRange').val();
        var year = $('#yearRange').val();
        
        document.getElementById('spanPrice').innerHTML = price ;
        document.getElementById('spanKm').innerHTML = mileage ;
        document.getElementById('spanYear').innerHTML = year ;
        
    $.ajax({

      url: 'fetch_cars.php',
      method: 'POST',
      data: { price: price, mileage: mileage, year: year },
      success: function(response) {

        $('#carList').html(response);
      }
    });
  });
});


</script>

<?php

require_once("composants/footer.php");

?>

