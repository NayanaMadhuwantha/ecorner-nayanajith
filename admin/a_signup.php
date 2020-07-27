<?php

require 'db.php';




$message = '';


if ( isset($_POST['firstname']) && isset($_POST['lastname']) && isset ($_POST['username'])  && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmpassword'])
	&& isset($_POST['gender']) && isset($_POST['city']) && isset($_POST['address']) && isset($_POST['country']) && isset($_POST['telephone']) && isset($_POST['mobilenumber'])  )  
	
{
 
  // Define $username and $password
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmpassword = $_POST['confirmpassword'];
  $gender = $_POST['gender'];
  $city = $_POST['city'];
  $address = $_POST['address'];
  $country = $_POST['country'];
  $telephone = $_POST['telephone'];
  $mobilenumber = $_POST['mobilenumber'];
  
  
 //insert data to the database
  $sql = 'INSERT INTO tbl_user ( U_firstname, U_lastname,  U_username, U_email, U_password, U_confirmpassword, U_gender, U_city, U_address, U_country, U_telephone, U_mobilenumber) 
  VALUES( :firstname, :lastname, :username, :email, :password, :confirmpassword, :gender, :city, :address, :country, :telephone, :mobilenumber)';
	//execution of insert data
  $statement = $connection->prepare($sql);
if ($statement->execute([':firstname' => $firstname, ':lastname' => $lastname, ':username' => $username, ':email' => $email, ':password' => $password, ':confirmpassword' => $confirmpassword,':gender' => $gender, ':city' => $city, ':address' => $address, ':country' => $country, ':telephone' => $telephone, ':mobilenumber' => $mobilenumber]  )) 
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">eCorner</a>
    </div>
    <ul class="nav navbar-nav">
      
    </ul>
    <ul class="nav navbar-nav navbar-right">

    <li><a href="a_signin.php">Sign in<span class="glyphicon glyphicon-log-in"></span></a></li>
    <li><a href="a_signup.php">Sign up<span class=" glyphicon glyphicon-user"></span></a></li>

  </div>
</nav>

<div class="container" style="height:100px"></div>


<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Create a person</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
		  <div class="form-group">
          <label for="firstname">Firstname</label>
          <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name eg :- John" required>
        </div>
		    <div class="form-group">
          <label for="lastname">Lastname</label>
          <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name eg :- Philip" required>
        </div>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" class="form-control" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{5,20}$" placeholder="Username eg :- Johnnyphilip999" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-control" placeholder="Email eg :- John100philip@gmail.com" required>
        </div>
		    <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Password eg :- XXXXXXXX" required>
        </div>
        <div class="form-group">
          <label for="confirmpassword">Confirm Password</label>
          <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Confirm Password eg :- XXXXXXXX" required>
        </div>
		    <div class="form-group">
          <label for="gender">Gender</label>
          <input type="text" name="gender" id="gender" class="form-control" placeholder="Gender eg :- Male/Female" required>
        </div>
        <div class="form-group">
          <label for="city">City</label>
          <input type="text" name="city" id="city" class="form-control" placeholder="City eg :- Colombo" required>
        </div>
        <div class="form-group">
          <label for="address">Address</label>
          <textarea type="text" name="address" id="address" class="form-control" placeholder="Address eg :- XXXGalle road, dehiwala. " required></textarea>
        </div>
        <div class="form-group">
          <label for="country">Country</label>
          <input type="text" name="country" id="country" class="form-control" placeholder="Country eg :- Sri Lanka" required>
        </div>
        <div class="form-group">
          <label for="telephone">Telephone</label>
          <input type="text" name="telephone" id="telephone" class="form-control" pattern="[0-9]{10}" placeholder="Telephone eg :- 032XXXXXXX" required>
        </div>
        <div class="form-group">
          <label for="mobilenumber">Mobilenumber</label>
          <input type="text" name="mobilenumber" id="mobilenumber" class="form-control" placeholder="Mobile eg :- 077XXXXXXX" required>
        </div>
		
        <div class="form-group">
          <button type="submit" class="btn btn-info">Create a person</button>
        </div>
        <p>
          Already a member? <a href="login.php">Sign in</a>
        </p>
      </form>
    </div>
  </div>
</div>

 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>
