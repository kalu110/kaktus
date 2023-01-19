<?php
require('admin/konekcija.php');
if($_SESSION['user'])
{
$data = array();
$orders = array();
$q = "SELECT * FROM destination";
$r = @mysqli_query($dbc, $q); 
$q2 = "SELECT * FROM orders";
$r2 = @mysqli_query($dbc, $q2); //Izvrsavanje upita
// Brojanje prikazanih redova:
$num2 = mysqli_num_rows($r2);
$num = mysqli_num_rows($r);
if ($num2 > 0) { 
    while ($row = mysqli_fetch_array($r2, MYSQLI_ASSOC)) {
        $orders[]=$row;
    }
    mysqli_free_result ($r2); // Oslobadjanje resursa zauzetih od strane upita.
  } 
if ($num > 0) { // Ako je rezultat upita broj redova  veci od nula
  // Štampaj Broj destinacija:
 
   /* echo "<div class='container'>";
    echo "<div class='row'>";
*/
  // Prolazak kroz redove zapisa rezultata upita:
  while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
      $data[]=$row;
    /*    echo '<div class="card" style="width: 16rem;">
        
         <div id="'.$row['id'].'" class="card-body">
          <h5 class="card-title">'.$row['country'].'<br>'.$row['city'].' - '.$row['price'].'€</h5>
          <p class="card-text">'.$row['description'].'</p>
          <p>'.$row['date'].'</p>
          <button name="btnobrisi" onclick="obrisi('.$row['id'].')">Obrisi</button>
          </div>
      </div>';*/
  }
  mysqli_free_result ($r); // Oslobadjanje resursa zauzetih od strane upita.
} 
}
elseif($_SESSION['user']=='acmilan')
{
  header("Location:lazna.html");
}
else{
  header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <title>Document</title>
</head>
<body>
    <style>
        #nazus{
            display:none;
        }
        #prikazus{
           visibility:visible;
        }
        #nazad{
            padding:10px 15px 10px 15px;
            background-color: black;
            color:white;
            border-radius:6px;
            width:100%;
            margin-left:100px;

        }
        #nazad :hover{
            text-decoration-line:none;   
            text-decoration:none; 
        }
        #rezus{
            visibility:hidden;
            margin-bottom:50px;
            height:40px;
        }
    </style>
            <?php
             echo "<img id='imgus' style='width:30px; height:30px; margin:20px;' src='images/destination.png'><span id='br'> $num <a id='nazb' class='btn btn-dark' href='userputovanja.php' style='visibility:hidden;'>Nazad</a></span>  <hr>\n";
             ?>
            <input type="text" id="myInput" onkeyup="searchdestination(this.value)" class="fa fa-search" placeholder="Search for names..">
            <div class="container">
            <div class="row homeca">
           

            
</div>
<button id="rezus" class="btn-block btn-primary" onclick="ajaxrezervisi(orders,idus)">Rezervisi</button>
</div>

    

    <script>
        let idus;
  spisakzaposlenih=[];
  let destination = <?php echo json_encode($data) ?>;
  orders=[];
  let nizorders = <?php echo json_encode($orders) ?>;
  let html = document.querySelector('.homeca');
  for(let i of destination)
  {
    spisakzaposlenih.push(i);
  }
  for(let i of nizorders)
  {
    orders.push(i);
  }
  for(let i of orders)
  {
    if(<?php echo $_SESSION['iduser']?>==i['iduser'])
    {
        idus = i['iduser'];
    }
  }
  
  
  for(let i of spisakzaposlenih)
  {
    html.innerHTML+=`
    
    <div class="card" style="width: 24%; padding:10px;">
  <img style="width:100%; height:150px; " src="uploads/${i['pocetna']}" class="card-img-top" alt="...">
  <div class="card-body">
  <form action="admin/snimi.php" method="POST">
    <h6 class="card-title text">${i['country']} - ${i['days']}</h6>
    <h5 class="card-title">${i['city']} - ${i['price']}€</h5>
    <div class="row">
    <div class="col-md-12">
    <p>${i['description']}</p>
    </div>
    </div>
      </form>
      <input type="hidden" name="id" value="${i['id']}">
      <button type="submit" name="btn2" id="btn2" class="btn btn-primary" onclick="asss(${i['id']})">Prikazi</button>
      </div>
  </div>
    `
  }

 
</script>
<script src="js/funckije.js"></script>
</body>
</html>