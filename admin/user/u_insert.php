<?php

include("../db.php");


session_start(); 

  if (!isset($_SESSION['username'])) 
  {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../a_signin.php');
  }

$message = '';
if (isset ($_POST['firstname']) && isset ($_POST['lastname']) && isset ($_POST['username'])  && isset($_POST['email']) && isset ($_POST['password'])  && isset ($_POST['confirmpassword'])  && isset ($_POST['gender']) && isset ($_POST['mobilenumber']) )   
	
{
 
  
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmpassword = $_POST['confirmpassword'];
  $gender = $_POST['gender'];  
  $mobilenumber = $_POST['mobilenumber'];
  
  
  
 
  $sql = 'INSERT INTO tbl_admin ( A_firstname,  A_lastname, A_username, A_email , A_password, A_confirmpassword, A_gender, A_mobilenumber) 
  VALUES( :firstname, :lastname , :username, :email, :password, :confirmpassword, :gender, :mobilenumber)';

  
  
  $statement = $connection->prepare($sql);
  
if ($statement->execute([':firstname' => $firstname,':lastname' => $lastname,':username' => $username, ':email' => $email,':password' => $password,':confirmpassword' => $confirmpassword, ':gender' => $gender, ':mobilenumber' => $mobilenumber]  )) 
  {
    $message = 'Successfully Registered';
  }

}




 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>eCorner | Administration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <script src="../../bootstrap/js/bootstrap.min.js"></script>
  

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
      <span class="navbar-brand mb-0 h1"><b>Coffee Shop Store</b></span>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="navbar-toggler">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto navbar-right">
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="nav-item">
            <a class="nav-link" href="a_detail.php">
              Account Management
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="../product/p_detail.php">
              Product Management
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="../user/u_detail.php">
              User Management  
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><strong><?php echo ucfirst( $_SESSION['username']); ?></strong>
              
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="../logout.php">Logout</a>
            </div>
        </li>
        </ul>
      </div>
  </nav>


  <div class="container-fluid">
    <div class="container">
      <div class="card mt-5">
        <div class="card-header">
          <h2>User Sign up</h2>
        </div>
        <div class="card-body">
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
                      <input type="text" class="form-control" id="validationCustomUsername" name="username" placeholder="Username" aria-describedby="inputGroupPrepend" required>
                      <div class="invalid-feedback">
                        Please insert a Username.
                      </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6" style="padding: 1%;">
                    <label for="validationCustomEmail">Email</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="validationCustomEmail" name="email" placeholder="Email" aria-describedby="inputGroupPrepend" required>
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
                      <input type="text" class="form-control" id="validationCustomPassword" name="password" placeholder="Password" aria-describedby="inputGroupPrepend" required>
                      <div class="invalid-feedback">
                        Please insert a Password.
                      </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6" style="padding: 1%;">
                    <label for="validationCustomconfirmpassword">Confirm Password</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="validationCustomconfirmpassword" name="confirmpassword" placeholder="Confirm Password" aria-describedby="inputGroupPrepend" required>
                      <div class="invalid-feedback">
                        Please insert a Confirm Password.
                      </div>
                    </div>
                </div>
              </div>
             
              <div class="form-row">
                <div class="col-md-6 col-lg-6" style="padding: 1%;">
                    <label for="validationCustomGender">Gender</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="validationCustomGender" name="gender" placeholder="Gender" aria-describedby="inputGroupPrepend" required>
                      <div class="invalid-feedback">
                        Please insert a Gender.
                      </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6" style="padding: 1%;">
                    <label for="validationCustomMobile">Mobile</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="validationCustomMobile" name="mobilenumber" placeholder="Mobile" aria-describedby="inputGroupPrepend" required>
                      <div class="invalid-feedback">
                        Please insert a Mobile.
                      </div>
                    </div>
                </div>
              </div>
                    
              <div class="form-row">
                <div class="col-md-12 col-lg-12">
                    <?php if(!empty($message)): ?>
                      <div class="alert alert-success">
                        <?= $message; ?>
                      </div>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary">Create a product</button>
                </div>
                <div class="col-md-12 col-lg-12">
                    <p>User Details <a href="u_detail.php">Go</a></p>
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
