<?php
require('admin/konekcija.php');
    
    $q = "SELECT * FROM users";
    $r = @mysqli_query($dbc, $q); //Izvrsavanje upita
    // Brojanje prikazanih redova:
    $num = mysqli_num_rows($r);
    
    if ($num > 0) { // Ako je rezultat upita broj redova  veci od nula
      // Prolazak kroz redove zapisa rezultata upita:
      while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
          $data[]=$row;
      }
      mysqli_free_result ($r); // Oslobadjanje resursa zauzetih od strane upita.
    } 

    if(isset($_POST['btn']))
    {
        $url = "lazna.php";
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $putanja = "loz.txt";
        $file = fopen($putanja,"r");
        $string = explode("|",fgets($file));
        
        if($user==$string[0] ?? $pass == $string[1])
        {
            $_SESSION["user"] = $user;
            ob_start(); 
            header('Location: '.$url); 
            ob_end_flush(); 
            die(); 
            echo "Ulogovani ste";
         } 
        else
        {
          foreach($data as $value) {
        
            if(strtolower($user)==strtolower($value['name']) && strtolower($pass)==strtolower($value['pass']))
            {
              $_SESSION["user"] = $value['name'];
              $_SESSION["iduser"] = $value['id'];
              header("Location: indexuser.php");
            }
          }
        }
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">    
    <title>Document</title>
</head>
<body>
    <form action="login.php" method="POST">
    <section class="vh-100" style="background-color: #508bfc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <h3 class="mb-5">Sign in</h3>
            <div class="form-outline mb-4">
              <input name="user" type="text" id="typeEmailX-2" class="form-control form-control-lg" />
              <label class="form-label" for="typeEmailX-2">Username</label>
            </div>
            <div class="form-outline mb-4">
              <input name="pass" type="password" id="typePasswordX-2" class="form-control form-control-lg" />
              <label class="form-label" for="typePasswordX-2">Password</label>
            </div>
            <button name="btn" class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
            <hr class="my-4">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</form>
    <script src="js/funckije.js"></script>
</body>
</html>