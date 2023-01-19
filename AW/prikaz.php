<?php
 
    $data = array();
    require('admin/konekcija.php');
      $id =$_COOKIE['id'];
      $sql = "SELECT * FROM destination WHERE id = $id";
      $r = @mysqli_query($dbc, $sql); //Izvrsavanje upita
// Brojanje prikazanih redova:
  $num = mysqli_num_rows($r);

if ($num > 0) { // Ako je rezultat upita broj redova  veci od nula

 
 

 
   /* echo "<div class='container'>";
    echo "<div class='row'>";
*/


  // Prolazak kroz redove zapisa rezultata upita:
  while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
      $data[]=$row;
      $kraj = strtotime($row['dateend']);
      $poc = strtotime($row['datestart']);
      $brdana = ($kraj - $poc)/ 86400;
      if($row['transport']=='da')
      {
        $ima=true;
      }
    echo '<a href="admindestination.php" id="nazus" class="btn btn-dark ml-4">Nazad</a>';
      echo ' <div style="padding:30px;" class="container mb-5 pri">
     
      <div class="row">
      
      <div class="col-md-12">
   <div style="margin:0px; padding:0px;" id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div style="margin:0px; padding:0px;" class="carousel-inner">
      <div style="width:100%; height:300px !important;" class="carousel-item active">
        <img style="height:300px;" class="d-block w-100" src="uploads/'.$row['pocetna'].'" alt="First slide">
      </div>';
      $photos = explode("|",$row['slideri']);
      foreach($photos as $photo){
    echo  '  <div class="carousel-item"> <img style="height:300px;" class="d-block w-100" src="uploads/'.$photo.'" alt="First slide"></div>';
      }
       echo '
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  </div>
      <div class="col-md-12 text-center">
      <h5>'.$row['country'].'</h5>
      <h4>'.$row['city'].' - '.$row['price'].'€</h4>
      <h4>'.$brdana.' - dana</h4>
      <p>'.$row['description'].'</p>
      <hr>
      <div class="row">
          <div class="col-md-6 text-left">
          <span> 
        ';
        if($row['transport']=='da')
        {
          echo '<label>Prevoz<img style="width:20px; height:20px; margin-left:7px;" src="images/'.$row['transportway'].'.png"> </label><hr>';
        }
        else
        {
          echo '<label>Prevoz<img style="width:20px; height:20px; margin-left:7px;" src="images/ne.png"> </label><hr>';
        }
        if($row['apartmans']=='da')
        {
          echo '<label>'.$row['apartmansway'].' - '.$row['nameapartamns'].' </label><hr>';
        }
        else{
          echo '<label>Smestaj <img style="width:20px; height:20px; margin-left:7px;" src="images/ne.png">  </label><hr>';
        }
      
       if($row['food']=='da')
        {
          echo '<label>Hrana - '.$row['foodway'].'</label><hr>';
        }
        else{
          echo '<label>Hrana <img style="width:20px; height:20px; margin-left:7px;" src="images/ne.png">  </label><hr>';
        }
        
        echo '<label>Datum '.date("d.m",$poc).' / '.date("d.m.Y",$kraj).' </label><hr>';

echo ' 
  </span>
          </div>
          <div class="col-md-6 text-right" >
          <span>';
       

        $dodaci = explode("|",$row['add']);
        for($i=1;$i<count($dodaci);$i++)
         {
          echo '<label>'.$dodaci[$i].'<img style="width:20px; height:20px; margin-left:7px;" src="images/da.png"></label><hr>';
         }
          echo ' 
      </span>
          </div>
          </div>
          </div>
          </div>
      ';
  }

 


  mysqli_free_result ($r); // Oslobadjanje resursa zauzetih od strane upita.


 
} else { // Ako nema zapisa za prikaz.
  echo '<p class="error">U sistemu nema podataka za prikaz</p>';
}


?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
  span img{
    width:15px;
    height:15px;
  }


.carousel-inner{
  height:300px;
  width:100%;
  background-size:cover;

}
.carousel-inner img{
}


#myInput{
  display:none;
}


</style>
<body> 
  
    <div id="prikaz">

  </div>
<script src="js/funckije.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
