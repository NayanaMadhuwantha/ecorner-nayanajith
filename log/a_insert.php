<?php

  include("db.php");

  session_start(); 


  $message = '';

  if (isset ($_POST['firstname'])  && isset ($_POST['lastname'])  && isset ($_POST['username'])  && isset($_POST['email']) && isset ($_POST['password']) && isset ($_POST['gender'])  &&  isset ($_POST['country'])  && isset ($_POST['mobilenumber'])  && isset ($_POST['image']) )   
  
  {
 
  
  $Firstname = $_POST['firstname'];
  $Lastname = $_POST['lastname'];
  $Username = $_POST['username'];
  $Email = $_POST['email'];
  $Password = $_POST['password'];
  $Gender = $_POST['gender'];
  $Country = $_POST['country'];
  $Mobilenumber = $_POST['mobilenumber'];
  $Image = $_POST['image'];
 
 
  $sql = 'INSERT INTO tbl_user ( U_firstname,  U_lastname, U_username, U_email, U_password, U_gender, U_country, U_mobilenumber, U_image) 
  VALUES( :firstname, :lastname, :username, :email, :password, :gender, :country, :mobilenumber, :image)';

  $statement = $connection->prepare($sql);
  if ($statement->execute([':firstname' => $Firstname,':lastname' => $Lastname,':username' => $Username, ':email' => $Email,':password' => $Password, ':gender' => $Gender, ':country' => $Country, ':mobilenumber' => $Mobilenumber, ':image' => $Image ]  )) 
  {
    $message = 'Successfully Registered';
  }

}




 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>eCorner | Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <script src="../bootstrap/js/bootstrap.min.js"></script>

</head>
  <style>
  
  .container-fluid{
    padding-top: 3%;
    padding-bottom: 3%;
    background-color: #f2f2f2;  
  } 

  .container{
    background-color: #fff;
    padding: 3%;
    border-radius: 5px;
  }

  .navbar{
     box-shadow: 0 5px 5px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }

  </style>

<body>

<!-- Navbar section-->
  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light ">
      <span class="navbar-brand mb-0 h1"><b>eCorner</b></span>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="navbar-toggler">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto navbar-right">
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="nav-item">
            <a class="nav-link" href="../admin/a_signin.php">
              Admin
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="../index.php">
              Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../add_cart.php">
              Add Cart  
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="log/login.php">
              Sign in
              <span class="glyphicon glyphicon-log-in"></span>
            </a>
          </li>
        </ul>
      </div>
  </nav>

  <div class="container-fluid">
    <div class="container">
      <div class="card mt-5">
        <div class="card-header">
          <h2>Product Registration</h2>
        </div>
        <div class="card-body">
          <?php if(!empty($message)): ?>
            <div class="alert alert-success">
              <?= $message; ?>
            </div>
          <?php endif; ?>
          <form method="post" class="needs-validation" novalidate>
        
            <div class="form-row">
              <div class="col-md-6 col-lg-6" style="padding: 1%;">
                <label for="validationCustomFirstname">Firstname</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="validationCustomFirstname" name="firstname" placeholder="Firstname" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please insert a Firstname.
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-6" style="padding: 1%;">
                <label for="validationCustomLastname">Lastname</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="validationCustomLastname" name="lastname" placeholder="Lastname" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please insert a Lastname.
                  </div>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-6 col-lg-6" style="padding: 1%;">
                <label for="validationCustomUsername">Username</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="validationCustomUsername" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{5,20}$" name="username" placeholder="Username" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please insert a Username.
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-lg-6" style="padding: 1%;">
                <label for="validationCustomEmail">Email</label>
                <div class="input-group">
                  <input type="email" class="form-control" id="validationCustomEmail" name="email" placeholder="Email" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please insert a Email.
                  </div>
                </div>
              </div>
            </div>  

            <div class="form-row">
              <div class="col-md-6 col-lg-6" style="padding: 1%;">
                <label for="validationCustomPassword">Password</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="validationCustomPassword" name="password" placeholder="Password" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please insert a Password.
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-6" style="padding: 1%;">
                <label for="validationCustomGender">Gender</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="validationCustomGender" name="gender" placeholder="Gender" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please insert a Gender.
                  </div>
                </div>
              </div>
            </div>    
            
            <div class="form-row">
              <div class="col-md-6 col-lg-6" style="padding: 1%;">
                <label for="validationCustomCountry">Country</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="validationCustomCountry" name="country" placeholder="Country" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please insert a Country.
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-6" style="padding: 1%;">
                <label for="validationCustomMobile">Mobile</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="validationCustomMobile" name="mobilenumber" placeholder="Mobile" pattern="[0-9]{10}" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please insert a Mobile.
                  </div>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-6 col-lg-6" style="padding: 1%;">
                <label for="validationCustomImage">Image</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="validationCustomImage" name="image" placeholder="Image" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please insert a Image.
                  </div>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-12 col-lg-12">
                <button type="submit" class="btn btn-success">Sign Up</button>
              </div>
              <div class="form-group col-md-12 col-lg-12">
                <p>Already a member? <a href="login.php">Sign In</a></p>
              </div>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </div>

   <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';
        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');
          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
      </script>

 
  </body>
</html>
