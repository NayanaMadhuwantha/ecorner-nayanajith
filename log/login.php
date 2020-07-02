<?php

//database connection 
 include("db.php");

// Starting Session
session_start(); 

// Variable To Store Error Message
$error = ''; 
$_SESSION['success'] = ""; 


// initializing variables
$username = "";

//check whether username or password is not inserted
if (isset($_POST['submit'])) 
  {
    if (empty($_POST['username']) && empty($_POST['password']))
      {
        $error = "Enter the username or password";
      }
      
      elseif (empty($_POST['username']) )
        {
          $error = "Enter an username";
        }
      
      else
      {
        if (empty($_POST['password']) )
        {
          $error = "Enter a password";
        }
      } 
  } 
  
//check whether username or password verification 
if (isset($_POST['submit'])) 
  {
    
    // Define $username and $password
    
    $username =  mysqli_real_escape_string($conn, $_POST['username']);
    $password =  mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($_POST['username']) AND empty($_POST['password'])) {
          $error = "Please enter the Username and Password";
      }
      elseif (($_POST['username']) AND empty($_POST['password'])) {
          $error = "Please enter the Password";
      }
      elseif (empty($_POST['username']) AND ($_POST['password'])) {
          $error = "Please enter the Username";
      }
      else{
         // SQL query to fetch information of registerd users and finds user match.
    $query = "SELECT U_username, U_password from tbl_user where U_username=? AND U_password=? LIMIT 1";

    // To protect MySQL injection for Security purpose
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->bind_result($username, $password);
    $stmt->store_result();


    if($stmt->fetch()) //fetching the contents of the row
        {
          $_SESSION['username'] = $username; // Initializing Session
          header("location: ../in/index.php"); // Redirecting To Profile Page
        }
        
        else
        {
          $error="Invalid username or password";
        }
    
    mysqli_close($conn); // Closing Connection
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
            <a class="nav-link active" href="login.php">
              Sign in
              <span class="glyphicon glyphicon-log-in"></span>
            </a>
          </li>
        </ul>
      </div>
  </nav>

<div class="container-fluid">
  <div class="container">
  <div class="card mt-5" >
    <div class="card-header">
      <h2>Sign in to your Account</h2>
    </div>
    <div class="card-body">
      <form method="post" action="login.php" class="needs-validation" novalidate>
        
        <div class="form-row">  
          <div class="col-md-12">
            <label for="validationCustomUsername">Username</label>
            <div class="input-group">
              <input type="text" class="form-control" id="validationCustomUsername" name="username" placeholder="Username" aria-describedby="inputGroupPrepend" required>
              <div class="invalid-feedback">
                Please insert a username.
              </div>
            </div>
          </div>
        </div>
        
        <div class="form-row">
          <div class="col-md-12">
            <label for="validationCustomPasssword">Password</label>
            <input type="password" class="form-control" id="validationCustomPassword" name="password" placeholder="Password" required>
            <div class="invalid-feedback">
              Please insert a password.
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="col-md-12">
            <div class="col-7">
              <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
              <label for="remember"> Remember Me</label>
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-12 col-lg-12">
            <span style="color: red; font-size: 15px;"><?php echo $error;?><br></span>
            <button type="submit"  class="btn btn-primary" name="submit">Sign in</button>
          </div>
          <div class="form-group col-md-12 col-lg-12">
          <p>Not yet a member? <a href="a_insert.php">Sign up</a></p>
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


<footer class="container-fluid" style="background-color:  #e6e6e6; padding: 2%; ">
  <div class="row">
    <div class="col-5">
     
    </div>
    <div class="col-4">
      <label style="text-align: right;"><b>Powered by Irosha Dasanayaka</b></label>
    </div>
    <div class="col-5">
    </div>
  </div>
</footer> 

</body>
</html>