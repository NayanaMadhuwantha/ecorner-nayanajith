<?php
session_start();
$error = ''; // Variable To Store Error Message

// initializing variables
$firstname="";
$lastname="";
$username = "";
$email    = "";
$gender    = "";
$city    = "";
$address    = "";
$country    = "";
$telephone    = "";
$mobilenumber    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'ecorner');

// REGISTER USER
if (isset($_POST['reg_user'])) {
	
  // receive all input values from the form
  $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
  $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $confirmpassword = mysqli_real_escape_string($db, $_POST['confirmpassword']);
  $gender = mysqli_real_escape_string($db, $_POST['gender']);
  $city = mysqli_real_escape_string($db, $_POST['city']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $country = mysqli_real_escape_string($db, $_POST['country']);
  $telephone = mysqli_real_escape_string($db, $_POST['telephone']);
  $mobilenumber = mysqli_real_escape_string($db, $_POST['mobilenumber']);

  // form validation: ensure that the form is correctly filled ...
  
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($firstname)) { array_push($errors, "Username is required"); }
  if (empty($username)) { array_push($errors, "Username is required"); }
  
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }
  
  if ($password != $confirmpassword) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM tbl_user WHERE U_username='$username' OR U_email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	
	//insert data to the database
  	$query = "INSERT INTO tbl_user (U_firstname, U_lastname, U_username, U_email, U_password, U_confirmpassword, U_gender, U_city, U_address, U_country, U_telephone, U_mobilenumber) 
  			  VALUES('$firstname', '$lastname','$username', '$email', '$password','$confirmpassword', '$gender', '$city', '$address', '$country','$telephone', '$mobilenumber')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: login.php');
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
      <a class="navbar-brand" href="#"><b>eCorner</b></a>
    </div>
    <ul class="nav navbar-nav">
      
    </ul>
    <ul class="nav navbar-nav navbar-right">
     
      <li><a href="../admin/a_signin.php">Admin</a></li>
      <li><a href="../index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
      <li><a href="../add_cart.php">Add Cart  <span class="badge glyphicon glyphicon-shopping-cart"><?php if(isset($_SESSION["shopping_cart"])) { echo count($_SESSION["shopping_cart"]); } else { echo '0';}?></span></a></li>
    
    <li class="active"> <a href="login.php">Sign in <span class="glyphicon glyphicon-log-in"></span></a>
        
      </li>
    
    </ul>
  </div>
</nav>

<div class="container" style="height:100px"></div>


<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Create a person</h2>
    </div>
    <div class="card-body">
    <!-- Error notification-->
    <span style="color:red"><?php echo $error; ?></span>
    
	<form method="post" action="create.php">
	
		  <div class="form-group">
          <label for="firstname">Firstname</label>
          <input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo $firstname?>" placeholder="Firstname " required>
        </div>
		    <div class="form-group">
          <label for="lastname">Lastname</label>
          <input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo $lastname;?>" placeholder="Lastname" required>
        </div>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{5,20}$" class="form-control" value="<?php echo $username;?>" placeholder="Username" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-control" value="<?php echo $email;?>" placeholder="Email" required>
        </div>
		    <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" class="form-control"  placeholder="Password" required>
        </div>
        <div class="form-group">
          <label for="confirmpassword">Confirm Password</label>
          <input type="password" name="confirmpassword" id="confirmpassword" class="form-control"  placeholder="Confirm Password" required>
        </div>
		    <div class="form-group">
          <label for="gender">Gender</label>
          <input type="text" name="gender" id="gender" class="form-control" value="<?php echo $gender;?>" placeholder="Gender " required>
        </div>
        <div class="form-group">
          <label for="city">City</label>
          <input type="text" name="city" id="city" class="form-control" value="<?php echo $city;?>" placeholder="City" required>
        </div>
        <div class="form-group">
          <label for="address">Address</label>
          <input type="text" name="address" id="address" class="form-control" value="<?php echo $address;?>" placeholder="Address" required>
        </div>
        <div class="form-group">
          <label for="country">Country</label>
          <input type="text" name="country" id="country" class="form-control" value="<?php echo $country;?>" placeholder="Country " required>
        </div>
        <div class="form-group">
          <label for="telephone">Telephone</label>
          <input type="text" name="telephone" id="telephone" class="form-control" value="<?php echo $telephone;?>" placeholder="Telephone " required>
        </div>
        <div class="form-group">
          <label for="mobilenumber">Mobilenumber</label>
          <input type="text" name="mobilenumber" id="mobilenumber" value="<?php echo $mobilenumber;?>" class="form-control"  placeholder="Mobile " required>
        </div>
		
        <div class="form-group">
          <button type="submit" class="btn btn-info" name="reg_user">Sign up</button>
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
