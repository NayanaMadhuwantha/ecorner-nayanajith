<?php   
 session_start(); 

 if (!isset($_SESSION['username'])) 
  {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../log/login.php');
  }
  
 $connect = mysqli_connect("localhost", "root", "", "ecorner");  

 ?> 
 
<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>eCorner | Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
    background-color: #fff;
    padding: 3%;
    border-radius: 5px;
  }

  .navbar{
     box-shadow: 0 5px 5px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }

  .product{
    text-align: center;
    padding: 1%;
  }

  .hover{
    background-color: #f2f2f2;
  }

  #image:hover{
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
          <li class="nav-item ">
            <a class="nav-link active" href="index.php">
              Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="add_cart.php">
              Add Cart  
              <span class="badge badge-primary">
                <?php if(isset($_SESSION[""])) { echo count($_SESSION["shopping_cart"]); } else { echo '0';}?>    
              </span>
            </a>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <strong><?php echo ucfirst( $_SESSION['username']); ?></strong>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="../log/logout.php">
              Sign out</a>
              </div>
          </li>
        </ul>
      </div>
  </nav>

  <div class="container-fluid">
    <div class="container">
      <div class="row">
        
        <div class="col-md-12 col-lg-12">
          <h1 align="center">Payment Methods</h1>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
          <form method="post" >

            <div class="row" style="padding: 3%;">
              <div class="col-md-12" style="background-color: rgb(217, 26, 70); border-radius: 15px; color: white; text-align: center;">
                <label for="cardname"><h3>Online Card Payment</h3></label>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label for="cardname">Card Name</label>
                <input type="text" name="cardname" id="cardname" class="form-control"  placeholder="Card Name" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label for="cardnumber">Card Number</label>
                <input type="text" name="cardnumber" id="cardnumber" class="form-control" placeholder="0000-0000-0000-0000" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label for="cardnumber">Expiration Date</label>
                <input type="text" name="cardnumber" id="cardnumber" class="form-control" placeholder="MM/YY" required>
              </div>
                              
              <div class="col-md-12">
                <label for="cardnumber">CVV Number</label>
                <input type="text" name="cardnumber" id="cardnumber" class="form-control" placeholder="CVV" required>
              </div>
            </div>               
            <div class="row">
              <div class="col-md-12">
                <input type="checkbox"  id="brand1" value="">
                <label for="brand1"><span></span>I agree to the Terms and Conditions and provided Privacy Policy. </label>
              </div>
            </div>  
            <div class="row">
              <div class="col-md-12">
                <div class="input-group">
                <a href="set_inventory.php" id="buy_btn" class="btn btn-primary" role="button">Buy</a>
                </div>
              </div>
            </div>

          </form>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
          <form method="post" >

            <div class="row" style="padding: 3%;">
              <div class="col-md-12" style="background-color: rgb(217, 26, 70); border-radius: 15px; color: white; text-align: center;">
                <label for="cardname"><h3 >PayPal Payment</h3></label>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label for="cardname">Email</label>
                <input type="text" name="cardname" id="cardname" class="form-control"  placeholder="name@gmail.com" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label for="cardnumber">Password</label>
                <input type="password" name="cardnumber" id="cardnumber" class="form-control" placeholder="********" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <input type="checkbox"  id="brand1" value="">
                <label for="brand1"><span></span>Remember me?</label>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="input-group">
                  <a href="#" class="btn btn-primary" role="button">Sign in</a>
                </div>
              </div>
            </div>

          </form>          
        </div>
      </div>
    </div>
  </div>
</body>  
</html>  