<?php


session_start(); // Starting Session
$error = ''; // Variable To Store Error Message

$username = "";

//check whether username or password inserted or not
if (isset($_POST['submit'])) 
  {
		if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid";
	}
else
	{
	// Define $username and $password
	$username =  $_POST['username'];
	$password =  $_POST['password'];


	// mysqli_connect() function opens a new connection to the MySQL server.
	$conn = mysqli_connect("localhost", "root", "", "ecorner");

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
			  $_SESSION['login_user'] = $username; // Initializing Session
			  header("location: ../in/index.php"); // Redirecting To Profile Page
			}
	else {
		   $error = "Username or Password is invalid";
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><b>eCorner DVD Store</b></a>
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
      <h2>Sign in to your Account</h2>
    </div>
    <div class="card-body">
    
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
          
        </div>
      <?php endif; ?>
      <form method="post" action="login.php">

      	<span style="color:red"><?php echo $error; ?></span>

        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" class="form-control" value="<?php echo $username;?>" placeholder="Username" required>
        </div>
		<div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" class="form-control" value="<?php echo $password;?>" placeholder="Password" required>
        </div>
        <div class="form-group text-center">
          <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
          <label for="remember"> Remember Me</label>
        </div>
		
      <div class="input-group">
			<button type="submit" class="btn btn-info" name="submit">Sign in</button>
			
		  </div>
			<p>
			Not yet a member? <a href="create.php">Sign up</a>
			</p>
      </form>
    </div>
  </div>
</div>

</body>
</html>