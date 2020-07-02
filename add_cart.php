<?php   

 session_start();  

 ?>  

<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>eCorner | Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="bootstrap/js/bootstrap.min.js"></script>

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
      <span class="navbar-brand mb-0 h1"><b>eCorner DVD Store</b></span>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="navbar-toggler">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto navbar-right">
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="nav-item">
            <a class="nav-link" href="admin/a_signin.php">
              Admin
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link " href="index.php">
              Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="add_cart.php">
              Add Cart
              <span class="badge badge-primary">
                <?php if(isset($_SESSION[""])) { echo count($_SESSION["shopping_cart"]); } else { echo '0';}?>    
              </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="log/login.php">
              Sign in
              <span class="glyphicon glyphicon-log-in"></span>
            </a>
          </li>
        </ul>
      </div>
  </nav>


  <div class="container-fluid">
    <div class="container">  
                <h3 align="center">Payments</h3><br />  
                
        <ul class="nav nav-tabs">   
                     <li class="nav-item"><a class="nav-link active" href="#">Cart</a></li>   
                </ul> 
        <br>
        <!--add to cart table-->
                <div class="tab-content" id="nav-tabContent"> 
           
                  <div class="table-responsive">
                    <div class="table-responsive" id="order_table">  
                               <table class="table table-bordered" >  
                                    <tr>  
                                         <th width="40%">Product Name</th>  
                                         <th width="10%">Quantity</th>  
                                         <th width="20%">Price</th>  
                                         <th width="15%">Total</th>  
                                         <th width="5%">Action</th>  
                                    </tr>  
                                   
                                    <tr>  
                                         
                                    </tr>  
                                   
                                    <tr>  
                                         
                                         
                                    </tr>  
                                    <tr>  
                                         
                                    </tr>  
                                   
                               </table>  
                    </div>  
                  </div> 
                </div>
    </div>
  </div>





</body>  
</html>  
 