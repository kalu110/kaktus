





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <title>Document</title>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>
<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-8">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-10 col-xl-6 ">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                <form class="mx-1 mx-md-4" name="myFormSign" action="admin/usersend.php" method="POST">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 mb-4 mr-2 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0 ml-auto mr-auto">
                      <input required type="text" name="name" id="name" class="form-control" />
                      <label id="error1" class="form-label" for="form3Example1c">Your Name</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 mb-4 mr-2 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0  ml-auto mr-auto">
                      <input required type="email" name="email" id="form3Example33c" class="form-control" />
                      <label id="error2" class="form-label" for="form3Example3c">Your Email</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-phone fa-lg me-3 mb-4 mr-2 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0  ml-auto mr-auto">
                      <input type="number" name="phone" id="form3Example3c" class="form-control" />
                      <label id="error3" class="form-label" for="form3Example3c">Your Phone</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 mb-4 mr-2 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0  ml-auto mr-auto">
                      <input required type="password" name="pass" id="form3Example4c" class="form-control" />
                      <label id="error4" class="form-label" for="form3Example4c">Password</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 mb-4 mr-2 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0  ml-auto mr-auto">
                      <input required type="password" name="reppass" id="form3Example4cd" class="form-control" />
                      <label id="error5" class="form-label" for="form3Example4cd">Repeat your password</label>
                    </div>
                  </div>
                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                  <input type="submit" name="btnsign"  value="Register" class="btn btn-primary btn-lg">
                  </div>

                </form>

              </div>
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="js/funckije.js"></script>
</body>
</html>