<?php   
 session_start(); 
//database connection 
 include("log/db.php");

$sql = 'SELECT * FROM tbl_products';
$statement = $connection->prepare($sql);
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);

if (isset($_GET["txt_search"]))
  {
  
	$sql = "SELECT * FROM tbl_products WHERE P_name like '".$_GET["txt_search"]."%'";

  }


$result = mysqli_query($conn, $sql);

 ?>  

<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>eCorner | Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="bootstrap/js/bootstrap.min.js"></script>

 <link rel="stylesheet" href="bootstrap/style.css">
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

 

	#image:hover{
    background-color: #f2f2f2;
    /*box-shadow: 0 5px 5px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);*/
    border-radius: 5px;
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
            <a class="nav-link" href="admin/a_signin.php">
              Admin
            </a>
          </li>
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
          <li class="nav-item">
            <a class="nav-link" href="log/login.php">
              Sign in
              <span class="glyphicon glyphicon-log-in"></span>
            </a>
          </li>
        </ul>
      </div>
  </nav>

<!--Carousel section-->
  <div class="container-fluid" style="padding-top: 0%; background-color: #fff;">
    <div class="container" style="padding: 0%;">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="images/banner/banner1.jpg" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="images/banner/banner6.jpg" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="images/banner/banner5.jpg" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
  </div>
  

<!-- Coffee Product cards -->
  <div class="container-fluid">
  
      <div class="container">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
          <div class="row" style="padding: 2%;">
              <div class="col-md-12 col-lg-12" style="text-align: center; color: #a3254a;">
                <label><h3><b>Coffee</b></h3></label>
              </div>
              <div class="col-md-12 col-lg-12" >  
                          <div class="row">
                               <?php  
                               $query = "SELECT * FROM tbl_products WHERE P_category='Coffee' ORDER BY P_id DESC LIMIT 4";  
                               $result = mysqli_query($conn, $query);  
                               while($row = mysqli_fetch_array($result))  
                               {  
                               ?>  
                               <div id="cards" class="col-md-3" style="margin-top:12px;">  
                                    <div  id="image"  style="padding:12px; height:100%;" align="center">  
                                         <img  src="<?php echo $row["P_image"]; ?>" class="img-fluid rounded img-responsive" /><br />  
                                         <h5><?php echo $row["P_name"]; ?></h5> 
                                         
                                         <h5 class="text-danger">Rs. <?php echo $row["P_price"]; ?></h5>  
                                         <input type="hidden" name="quantity" id="quantity<?php echo $row["P_id"]; ?>" class="form-control" value="1" />  
                                         <input type="hidden" name="hidden_name" id="name<?php echo $row["P_id"]; ?>" value="<?php echo $row["P_name"]; ?>" />
                                         <input type="hidden" name="hidden_name" id="name<?php echo $row["P_id"]; ?>" value="<?php echo $row["P_category"]; ?>" />    
                                         <input type="hidden" name="hidden_price" id="price<?php echo $row["P_id"]; ?>" value="<?php echo $row["P_price"]; ?>" /> 
                                         <a href="log/login.php" class="btn btn-danger" name="add_to_cart" value="Sign in to purchase" style="margin-top:10px; width:100%; " role="button">Sign in to buy</a> 
                                    </div>  
                               </div>  
                               <?php  
                               }  
                               ?>        
                          </div> 
              </div>
              <!--<div class="col-md-12 col-lg-12" style="text-align: center; padding-top: 2%;">
                <a href="#" class="btn btn-light">View All</a>
              </div>-->
            </div>            
          </div>
        </div>
        
  </div>

<!-- Main Dish Product cards -->
  <div class="container-fluid">
  
      <div class="container">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
          <div class="row" style="padding: 2%;">
              <div class="col-md-12 col-lg-12" style="text-align: center; color: #a3254a; ">
                <label><h3><b>Main Dish</b></h3></label>
              </div>
              <div class="col-md-12 col-lg-12" >  
                          <div class="row">
                               <?php  
                               $query = "SELECT * FROM tbl_products WHERE P_category='Main Dish' ORDER BY P_id DESC LIMIT 4";  
                               $result = mysqli_query($conn, $query);  
                               while($row = mysqli_fetch_array($result))  
                               {  
                               ?>  
                               <div id="cards" class="col-md-3" style="margin-top:12px;">  
                                    <div  id="image"  style="padding:12px; height:100%;" align="center">  
                                         <img  src="<?php echo $row["P_image"]; ?>" class="img-fluid rounded img-responsive" /><br />  
                                         <h5><?php echo $row["P_name"]; ?></h5> 
                                         
                                         <h5 class="text-danger">Rs. <?php echo $row["P_price"]; ?></h5>  
                                         <input type="hidden" name="quantity" id="quantity<?php echo $row["P_id"]; ?>" class="form-control" value="1" />  
                                         <input type="hidden" name="hidden_name" id="name<?php echo $row["P_id"]; ?>" value="<?php echo $row["P_name"]; ?>" />
                                         <input type="hidden" name="hidden_name" id="name<?php echo $row["P_id"]; ?>" value="<?php echo $row["P_category"]; ?>" />    
                                         <input type="hidden" name="hidden_price" id="price<?php echo $row["P_id"]; ?>" value="<?php echo $row["P_price"]; ?>" /> 
                                         <a href="log/login.php" class="btn btn-danger" name="add_to_cart" value="Sign in to purchase" style="margin-top:10px; width:100%; " role="button">Sign in to buy</a> 
                                    </div>  
                               </div>  
                               <?php  
                               }  
                               ?>        
                          </div> 
              </div>
              <!--<div class="col-md-12 col-lg-12" style="text-align: center; padding-top: 2%;">
                <a href="#" class="btn btn-light">View All</a>
              </div>-->
            </div>            
          </div>
        </div>
        
  </div>
  


<!-- Drinks Product cards -->
  <div class="container-fluid">
    
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-12" style="text-align: center; color: #a3254a;">
            <label><h3><b>Drinks</b></h3></label>
          </div>
          <div class="col-md-12 col-lg-12" >  
                      <div class="row">
                           <?php  
                           $query = "SELECT * FROM tbl_products WHERE P_category='Drinks' ORDER BY P_id DESC LIMIT 9";  
                           $result = mysqli_query($conn, $query);  
                           while($row = mysqli_fetch_array($result))  
                           {  
                           ?>  
                           <div id="cards" class="col-md-3" style="margin-top:12px;">  
                                <div  id="image"  style="padding:12px; height:100%;" align="center">  
                                     <img  src="<?php echo $row["P_image"]; ?>" class="img-fluid rounded img-responsive" /><br />  
                                     <h5 class="text-info"><?php echo $row["P_name"]; ?></h5> 
                                     
                                     <h5>Rs. <?php echo $row["P_price"]; ?></h5>  
                                     <input type="hidden" name="quantity" id="quantity<?php echo $row["P_id"]; ?>" class="form-control" value="1" />  
                                     <input type="hidden" name="hidden_name" id="name<?php echo $row["P_id"]; ?>" value="<?php echo $row["P_name"]; ?>" />
                                     <input type="hidden" name="hidden_name" id="name<?php echo $row["P_id"]; ?>" value="<?php echo $row["P_category"]; ?>" />    
                                     <input type="hidden" name="hidden_price" id="price<?php echo $row["P_id"]; ?>" value="<?php echo $row["P_price"]; ?>" /> 
                                     <a href="log/login.php" class="btn btn-danger" name="add_to_cart" value="Sign in to purchase" style="margin-top:10px; width:100%; " role="button">Sign in to buy</a> 
                                </div>  
                           </div>  
                           <?php  
                           }  
                           ?>        
                      </div> 
          </div>
          <!--<div class="col-md-12 col-lg-12" style="text-align: center; padding-top: 2%;">
            <a href="#" class="btn btn-light">View All</a>
          </div>-->
        </div>            
      </div>
  </div>

<!-- Desserts Product cards -->
  <div class="container-fluid">
    
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-12" style="text-align: center; color: #a3254a;">
            <label><h3><b>Desserts</b></h3></label>
          </div>
          <div class="col-md-12 col-lg-12" >  
                      <div class="row">
                           <?php  
                           $query = "SELECT * FROM tbl_products WHERE P_category='Desserts' ORDER BY P_id DESC LIMIT 
						   9";  
                           $result = mysqli_query($conn, $query);  
                           while($row = mysqli_fetch_array($result))  
                           {  
                           ?>  
                           <div id="cards" class="col-md-3" style="margin-top:12px;">  
                                <div  id="image"  style="padding:12px; height:100%;" align="center">  
                                     <img  src="<?php echo $row["P_image"]; ?>" class="img-fluid rounded img-responsive" /><br />  
                                     <h5 class="text-info"><?php echo $row["P_name"]; ?></h5> 
                                     
                                     <h5 >Rs. <?php echo $row["P_price"]; ?></h5>  
                                     <input type="hidden" name="quantity" id="quantity<?php echo $row["P_id"]; ?>" class="form-control" value="1" />  
                                     <input type="hidden" name="hidden_name" id="name<?php echo $row["P_id"]; ?>" value="<?php echo $row["P_name"]; ?>" />
                                     <input type="hidden" name="hidden_name" id="name<?php echo $row["P_id"]; ?>" value="<?php echo $row["P_category"]; ?>" />    
                                     <input type="hidden" name="hidden_price" id="price<?php echo $row["P_id"]; ?>" value="<?php echo $row["P_price"]; ?>" /> 
                                     <a href="log/login.php" class="btn btn-danger" name="add_to_cart" value="Sign in to purchase" style="margin-top:10px; width:100%; " role="button">Sign in to buy</a> 
                                </div>  
                           </div>  
                           <?php  
                           }  
                           ?>        
                      </div> 
          </div>
          <!--<div class="col-md-12 col-lg-12" style="text-align: center; padding-top: 2%;">
            <a href="#" class="btn btn-light">View All</a>
          </div>-->
        </div>            
      </div>
  </div>
  
  






  <footer class="container-fluid">
    <div class="row">
      <div class="col-5">
       
      </div>
      <div class="col-4">
        <label style="text-align: right;"><b>Created by Irosha Dasanayaka</b></label>
      </div>
      <div class="col-5">
      </div>
    </div>
  </footer> 

</body>
 </html>  
 