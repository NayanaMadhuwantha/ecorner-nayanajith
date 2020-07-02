<?php

include("../db.php");

session_start(); 

  if (!isset($_SESSION['username'])) 
  {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../a_signin.php');
  }

//get current id 
$id = $_GET['id'];

// select all fields from tlb_user equal id
$sql = 'SELECT * FROM tbl_user WHERE U_id=:id';

//statement= connection of SQL select constraint
$statement = $connection->prepare($sql);

//execute statement
$statement->execute([':id' => $id ]);

//declaring variable for fetch all fields for database
$person = $statement->fetch(PDO::FETCH_OBJ);

//isset functions for textbox
if (  isset ($_POST['firstname'])       && 
      isset ($_POST['lastname'])        && 
      isset ($_POST['username'])        && 
      isset($_POST['email'])            && 
      isset ($_POST['password'])        && 
      isset ($_POST['gender'])          && 
      isset ($_POST['country'])         &&  
      isset ($_POST['mobilenumber'])    &&
      isset ($_POST['cardnumber'])      && 
      isset ($_POST['carddate'])        &&
      isset ($_POST['cardCVC'])         &&
      isset ($_POST['image'])

    ) {
  
  //declaring variable
  $firstname       = $_POST['firstname'];
  $lastname        = $_POST['lastname'];
  $username        = $_POST['username'];
  $email           = $_POST['email'];
  $password        = $_POST['password'];
  $gender          = $_POST['gender'];
  $country         = $_POST['country'];
  $mobilenumber    = $_POST['mobilenumber'];
  $cardnumber      = $_POST['cardnumber'];
  $carddate        = $_POST['carddate'];
  $cardCVC         = $_POST['cardCVC'];
  $Image           = $_POST['image'];

//declaring update constraint
  $sql = 'UPDATE tbl_user SET 
                                U_firstname       =:firstname, 
                                U_lastname        =:lastname, 
                                U_username        =:username, 
                                U_email           =:email, 
                                U_password        =:password, 
                                U_gender          =:gender,  
                                U_country         =:country, 
                                U_mobilenumber    =:mobilenumber,
                                U_cardtnumber     =:cardnumber,
                                U_carddate        =:carddate,
                                U_cardCVC         =:cardCVC,
                                U_image           =:image 

                                WHERE U_id=:id';
  
  $statement = $connection->prepare($sql);
//statement execution
  if ($statement->execute([
                              ':firstname'    => $firstname,
                              ':lastname'     => $lastname,
                              ':username'     => $username, 
                              ':email'        => $email,
                              ':password'     => $password,
                              ':gender'       => $gender, 
                              ':country'      => $country,  
                              ':mobilenumber' => $mobilenumber,
                              ':cardnumber'   => $cardnumber,
                              ':carddate'     => $carddate,
                              ':cardCVC'      => $cardCVC,
                              ':image'        => $image, 
                              ':id' => $id
                            ])
      ) 
  {
    header("Location: a_detail.php");
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
            <a class="nav-link active" href="a_detail.php">
              Account Management
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="../product/p_detail.php">
              Product Management
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../user/u_detail.php">
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
          <h2>Update Accounts's Detail</h2>
        </div>
      
        <div class="card-body">
          <form method="post" class="needs-validation" novalidate>
            
            <div class="form-row">
              <div class="col-md-6 col-lg-6" style="padding: 1%;">
                <label for="validationCustomFirstname">Firstname</label>
                <div class="input-group">
                  <input value="<?= $person->U_firstname; ?>" type="text" class="form-control" id="validationCustomFirstname" name="firstname" placeholder="Firstname" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please insert a Firstname.
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-lg-6" style="padding: 1%;">
                <label for="validationCustomLastname">Lastname</label>
                <div class="input-group">
                  <input value="<?= $person->U_lastname; ?>" type="text" class="form-control" id="validationCustomLastname" name="lastname" placeholder="Lastname" aria-describedby="inputGroupPrepend" required>
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
                  <input value="<?= $person->U_username; ?>" type="text" class="form-control" id="validationCustomUsername" name="username" placeholder="Username" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please insert a Username.
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-lg-6" style="padding: 1%;">
                <label for="validationCustomEmail">Email</label>
                <div class="input-group">
                  <input value="<?= $person->U_email; ?>" type="text" class="form-control" id="validationCustomEmail" name="email" placeholder="Email" aria-describedby="inputGroupPrepend" required>
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
                  <input value="<?= $person->U_password; ?>" type="text" class="form-control" id="validationCustomPassword" name="password" placeholder="Password" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please insert a Password.
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-lg-6" style="padding: 1%;">
                <label for="validationCustomGender">Gender</label>
                <div class="input-group">
                  <input value="<?= $person->U_gender; ?>" type="text" class="form-control" id="validationCustomGender" name="gender" placeholder="Gender" aria-describedby="inputGroupPrepend" required>
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
                  <input value="<?= $person->U_country; ?>" type="text" class="form-control" id="validationCustomCountry" name="country" placeholder="Country" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please insert a Country.
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-lg-6" style="padding: 1%;">
                <label for="validationCustomMobile">Mobilenumber</label>
                <div class="input-group">
                  <input value="<?= $person->U_mobilenumber; ?>" type="text" class="form-control" id="validationCustomMobile" name="mobilenumber" placeholder="Mobile" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please insert a Mobile.
                  </div>
                </div>
              </div>              
            </div>

            <div class="form-row">
              <div class="col-md-6 col-lg-6" style="padding: 1%;">
                <label for="cardnumber">Card Number</label>
                <input value="<?= $person->U_cardtnumber; ?>" type="text" name="cardnumber" id="cardnumber" class="form-control" placeholder="Card Number">
                <span></span>
              </div>
              <div class="col-md-6 col-lg-6" style="padding: 1%;">
                <label for="carddate">Card Date</label>
                <input value="<?= $person->U_carddate; ?>" type="text" name="carddate" id="carddate" class="form-control" placeholder="Card Date">
                <span></span>
              </div>              
            </div>
            <div class="form-row">
              <div class="col-md-6 col-lg-6" style="padding: 1%;">
                <label for="cardCVC">Card CVC</label>
                <input value="<?= $person->U_cardCVC; ?>" type="text" name="cardCVC" id="cardCVC" class="form-control" placeholder="Card CVC" >
                <span></span>
              </div>
              <div class="col-md-6 col-lg-6" style="padding: 1%;">
                <label for="validationCustomImage">Image</label>
                <div class="input-group">
                  <input value="<?= $person->U_image; ?>" type="text" class="form-control" id="validationCustomImage" name="image" placeholder="Image" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please insert a Image.
                  </div>
                </div>
              </div>              
            </div>
            <div class="form-row">
              <div class="col-md-6 col-lg-6" style="padding: 1%;">
                <button type="submit" class="btn btn-primary">Update</button>
                    <?php if(!empty($message)): ?>
                    <div class="alert alert-success">
                      <?= $message; ?>
                    </div>
                  <?php endif; ?>
                <p>Account Details <a href="a_detail.php">Go</a></p>
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
