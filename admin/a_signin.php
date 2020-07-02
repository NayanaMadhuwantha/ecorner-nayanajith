<?php

  include("db.php");

  session_start(); // Starting Session
  $_SESSION['success'] = ""; 

  // Variable To Store Error Message
      $error = ''; 

  if (isset($_POST['submit'])) {


      // Define $username and $password
      $username =  $_POST['username'];
      $password =  $_POST['password'];
      
      

      //Validation for login
      if (empty($_POST['username']) AND empty($_POST['password'])) {
          $error = "Please enter the Username and Password";
      }
      elseif (($_POST['username']) AND empty($_POST['password'])) {
          $error = "Please enter the Password";
      }
      elseif (empty($_POST['username']) AND ($_POST['password'])) {
          $error = "Please enter the Username";
      }
      else
      {
        // SQL query to fetch information of registerd users and finds user match.
        $query = "SELECT A_username, A_password from tbl_admin where A_username=? AND A_password=? LIMIT 1";

        // To protect MySQL injection for Security purpose
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->bind_result($username, $password);
        $stmt->store_result();

        if($stmt->fetch()) //fetching the contents of the row
                {
                  $_SESSION['username'] = $username; // Initializing Session
                  header("location: account/a_detail.php"); // Redirecting To Profile Page
                }
        else {
               $error = "Username is invalid";
             }
        mysqli_close($conn); // Closing Connection
      }

  }

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
    
    padding: 3%;
    border-radius: 5px;
  }

  .navbar{
     box-shadow: 0 5px 5px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }

  </style>
  

<body>

<!-- Navbar section-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><b>Coffee Shop Store</b></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto navbar-right">
        </ul>
    <ul class="navbar-nav navbar-right">
      <li class="nav-item active"><a class="nav-link" href="../admin/a_signin.php">Admin</a></li>
      <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
    </ul>
  </div>
</nav>

  <div class="container-fluid">
    <div class="container">
      <div class="col-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h2>Adminstration Sign in</h2>
          </div>
          <div class="card-body"> 
            <form method="post" action="a_signin.php" class="needs-validation" novalidate>
              
              <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                <label for="validationCustomUsername">Username</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="validationCustomUsername" name="username" placeholder="Username" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please insert a Username.
                  </div>
                </div>
              </div>

              <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                <label for="validationCustomPassword">Password</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="validationCustomPassword" name="password" placeholder="Password" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please insert a Password.
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

              <div class="form-group col-md-12 col-lg-12">
                <span style="color: red;"><?php echo $error; ?></span><br>
                <button type="submit"  class="btn btn-primary" name="submit">Sign in</button>
              </div>

            </form>
          </div>
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