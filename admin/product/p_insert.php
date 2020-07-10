<?php

include("../db.php");

session_start(); 

  if (!isset($_SESSION['username'])) 
  {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../a_signin.php');
  }

$message = '';
if (isset ($_POST['name'])  && isset ($_POST['category'])  && isset ($_POST['price'])  && isset($_POST['image']) && isset ($_POST['quantity'])   )   
	
{
 
  
  $Name = $_POST['name'];
  $Category = $_POST['category'];
  $Price = $_POST['price'];
  $Image = $_POST['image'];
  $Quantity = $_POST['quantity'];
 
 
  $sql = 'INSERT INTO tbl_products ( P_name,  P_category, P_price, P_image, P_quantity) 
  VALUES( :name, :category, :price, :image, :quantity)';

  $statement = $connection->prepare($sql);
if ($statement->execute([':name' => $Name,':category' => $Category,':price' => $Price, ':image' => $Image,':quantity' => $Quantity]  )) 
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
            <a class="nav-link active" href="../product/p_detail.php">
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
          <h2>Product Registration</h2>
        </div>
        <div class="card-body">
          
          <form method="post" class="needs-validation" novalidate>
        
            <div class="form-row">
              <div class="col-md-6 col-lg-6" style="padding: 1%;">
                <label for="validationCustomname">Product Name</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="validationCustomname" name="name" placeholder="Product Name" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please insert a Product Name.
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-6" style="padding: 1%;">
                <label for="validationCustomcategory">Product Category</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="validationCustomcategory" name="category" placeholder="Product Category" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please insert a Product Category.
                  </div>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-6 col-lg-6" style="padding: 1%;">
                <label for="validationCustomprice">Product Price</label>
                <div class="input-group">
                  <input type="number" class="form-control" id="validationCustomprice" name="price" placeholder="Product Price" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please insert a Product Price.
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-6" style="padding: 1%;">
                <label for="validationCustomimage">Product Image</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="validationCustomimage" name="image" placeholder="Product Image" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please insert a Product Image.
                  </div>
                </div>
              </div>
            </div>  

            <div class="form-row">
              <div class="col-md-6 col-lg-6" style="padding: 1%;">
                <label for="validationCustomquantity">Product Quantity</label>
                <div class="input-group">
                  <input type="number" class="form-control" id="validationCustomquantity" name="quantity" placeholder="Product Quantity" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please insert a Product Quantity.
                  </div>
                </div>
              </div>
            </div>    
              
            <div class="form-row">
              <div class="col-md-12 col-lg-12" style="padding: 1%;">
                 <?php if(!empty($message)): ?>
                    <div class="alert alert-success">
                      <?= $message; ?>
                    </div>
                  <?php endif; ?>
                <button type="submit" class="btn btn-success">Create</button>
              </div>
              <div class="col-md-4 col-lg-4" style="padding: 1%;">
                <p>Product Details <a href="p_detail.php">Go</a></p>
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
