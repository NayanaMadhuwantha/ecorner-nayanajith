
<?php

//database connection 
 include("../log/db.php");
   
  session_start(); 

  if (!isset($_SESSION['username'])) 
  {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../log/login.php');
  }

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

  #image:hover{
    background-color: #f2f2f2;
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
        <div class="row">
          <div class="col-md-12 col-lg-12" style="text-align: center; color: white; background-color:  rgb(217, 26, 70); border-radius: 25px;">
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
                                <div  id="image"  style=" padding:12px; height:100%;" align="center">  
                                     <img  src="<?php echo $row["P_image"]; ?>" class="img-fluid rounded img-responsive" /><br />  
                                     <h5 ><?php echo $row["P_name"]; ?></h5> 
                                     
                                     <h5 class="text-danger">Rs. <?php echo $row["P_price"]; ?></h5>  
                                     <input type="hidden" name="quantity" id="quantity<?php echo $row["P_id"]; ?>" class="form-control" value="1" />  
                                     <input type="hidden" name="hidden_name" id="name<?php echo $row["P_id"]; ?>" value="<?php echo $row["P_name"]; ?>" />
                                     <input type="hidden" name="hidden_name" id="name<?php echo $row["P_id"]; ?>" value="<?php echo $row["P_category"]; ?>" />    
                                     <input type="hidden" name="hidden_price" id="price<?php echo $row["P_id"]; ?>" value="<?php echo $row["P_price"]; ?>" /> 
                                     <input type="button" name="add_to_cart" id="<?php echo $row["P_id"]; ?>" style="margin-top:5px;" class="btn btn-primary form-control add_to_cart" value="Add to Cart" /> 
                                </div>  
                           </div>  
                           <?php  
                           }  
                           ?>        
                      </div> 
          </div>
          <div class="col-md-12 col-lg-12" style="text-align: center; padding-top: 2%;">
            <a href="#" class="btn btn-light">View All</a>
          </div>
        </div>            
      </div>
  </div>

<!-- Main Dish Product cards -->
  <div class="container-fluid">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-12" style="text-align: center; color: white; background-color:  rgb(217, 26, 70); border-radius: 25px;">
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
                                <div  id="image"  style=" padding:12px; height:100%;" align="center">  
                                     <img  src="<?php echo $row["P_image"]; ?>" class="img-fluid rounded img-responsive" /><br />  
                                     <h5 ><?php echo $row["P_name"]; ?></h5> 
                                     
                                     <h5 class="text-danger">Rs. <?php echo $row["P_price"]; ?></h5>  
                                     <input type="hidden" name="quantity" id="quantity<?php echo $row["P_id"]; ?>" class="form-control" value="1" />  
                                     <input type="hidden" name="hidden_name" id="name<?php echo $row["P_id"]; ?>" value="<?php echo $row["P_name"]; ?>" />
                                     <input type="hidden" name="hidden_name" id="name<?php echo $row["P_id"]; ?>" value="<?php echo $row["P_category"]; ?>" />    
                                     <input type="hidden" name="hidden_price" id="price<?php echo $row["P_id"]; ?>" value="<?php echo $row["P_price"]; ?>" /> 
                                     <input type="button" name="add_to_cart" id="<?php echo $row["P_id"]; ?>" style="margin-top:5px;" class="btn btn-primary form-control add_to_cart" value="Add to Cart" /> 
                                </div>  
                           </div>  
                           <?php  
                           }  
                           ?>        
                      </div> 
          </div>
          <div class="col-md-12 col-lg-12" style="text-align: center; padding-top: 2%;">
            <a href="#" class="btn btn-light">View All</a>
          </div>
        </div>            
      </div>
  </div>

<!-- Drinks Product cards -->
  <div class="container-fluid">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-12" style="text-align: center; color: white; background-color:  rgb(217, 26, 70); border-radius: 25px;">
            <label><h3><b>Drinks</b></h3></label>
          </div>
          <div class="col-md-12 col-lg-12" >  
                      <div class="row">
                           <?php  
                           $query = "SELECT * FROM tbl_products WHERE P_category='Drinks' ORDER BY P_id DESC LIMIT 4";  
                           $result = mysqli_query($conn, $query);  
                           while($row = mysqli_fetch_array($result))  
                           {  
                           ?>  
                           <div id="cards" class="col-md-3" style="margin-top:12px;">  
                                <div  id="image"  style=" padding:12px; height:100%;" align="center">  
                                     <img  src="<?php echo $row["P_image"]; ?>" class="img-fluid rounded img-responsive" /><br />  
                                     <h5 ><?php echo $row["P_name"]; ?></h5> 
                                     
                                     <h5 class="text-danger">Rs. <?php echo $row["P_price"]; ?></h5>  
                                     <input type="hidden" name="quantity" id="quantity<?php echo $row["P_id"]; ?>" class="form-control" value="1" />  
                                     <input type="hidden" name="hidden_name" id="name<?php echo $row["P_id"]; ?>" value="<?php echo $row["P_name"]; ?>" />
                                     <input type="hidden" name="hidden_name" id="name<?php echo $row["P_id"]; ?>" value="<?php echo $row["P_category"]; ?>" />    
                                     <input type="hidden" name="hidden_price" id="price<?php echo $row["P_id"]; ?>" value="<?php echo $row["P_price"]; ?>" /> 
                                     <input type="button" name="add_to_cart" id="<?php echo $row["P_id"]; ?>" style="margin-top:5px;" class="btn btn-primary form-control add_to_cart" value="Add to Cart" /> 
                                </div>  
                           </div>  
                           <?php  
                           }  
                           ?>        
                      </div> 
          </div>
          <div class="col-md-12 col-lg-12" style="text-align: center; padding-top: 2%;">
            <a href="#" class="btn btn-light">View All</a>
          </div>
        </div>            
      </div>
  </div>

<!-- Desserts Product cards -->
  <div class="container-fluid">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-12" style="text-align: center; color: white; background-color:  rgb(217, 26, 70); border-radius: 25px;">
            <label><h3><b>Desserts</b></h3></label>
          </div>
          <div class="col-md-12 col-lg-12" >  
                      <div class="row">
                           <?php  
                           $query = "SELECT * FROM tbl_products WHERE P_category='Desserts' ORDER BY P_id DESC LIMIT 9";  
                           $result = mysqli_query($conn, $query);  
                           while($row = mysqli_fetch_array($result))  
                           {  
                           ?>  
                           <div id="cards" class="col-md-3" style="margin-top:12px;">  
                                <div  id="image"  style=" padding:12px; height:100%;" align="center">  
                                     <img  src="<?php echo $row["P_image"]; ?>" class="img-fluid rounded img-responsive" /><br />  
                                     <h5 ><?php echo $row["P_name"]; ?></h5> 
                                     
                                     <h5 class="text-danger">Rs. <?php echo $row["P_price"]; ?></h5>  
                                     <input type="hidden" name="quantity" id="quantity<?php echo $row["P_id"]; ?>" class="form-control" value="1" />  
                                     <input type="hidden" name="hidden_name" id="name<?php echo $row["P_id"]; ?>" value="<?php echo $row["P_name"]; ?>" />
                                     <input type="hidden" name="hidden_name" id="name<?php echo $row["P_id"]; ?>" value="<?php echo $row["P_category"]; ?>" />    
                                     <input type="hidden" name="hidden_price" id="price<?php echo $row["P_id"]; ?>" value="<?php echo $row["P_price"]; ?>" /> 
                                     <input type="button" name="add_to_cart" id="<?php echo $row["P_id"]; ?>" style="margin-top:5px;" class="btn btn-primary form-control add_to_cart" value="Add to Cart" /> 
                                </div>  
                           </div>  
                           <?php  
                           }  
                           ?>        
                      </div> 
          </div>
          <div class="col-md-12 col-lg-12" style="text-align: center; padding-top: 2%;">
            <a href="#" class="btn btn-light">View All</a>
          </div>
        </div>            
      </div>
  </div>

   

  
   
      </body>
 </html>  
 <script>  
 $(document).ready(function(data){  
      $('.add_to_cart').click(function(){  
           var product_id = $(this).attr("id");  
           var product_name = $('#name'+product_id).val();  
           var product_price = $('#price'+product_id).val();  
           var product_quantity = $('#quantity'+product_id).val();  
           var action = "add";  
           if(product_quantity > 0)  
           {  
                $.ajax({  
                     url:"action.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{  
                          product_id:product_id,   
                          product_name:product_name,   
                          product_price:product_price,   
                          product_quantity:product_quantity,   
                          action:action  
                     },  
                     success:function(data)  
                     {  
                          $('#order_table').html(data.order_table);  
                          $('.badge').text(data.cart_item);  
                          alert("Product has been Added into Cart");  
                     }  
                });  
           }  
           else  
           {  
                alert("Please Enter Number of Quantity")  
           }  
      });  
      $(document).on('click', '.delete', function(){  
           var product_id = $(this).attr("product_id");  
           var action = "remove";  
           if(confirm("Are you sure you want to remove this product?"))  
           {  
                $.ajax({  
                     url:"action.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{product_id:product_id, action:action},  
                     success:function(data){  
                          $('#order_table').html(data.order_table);  
                          $('.badge').text(data.cart_item);  
                     }  
                });  
           }  
           else  
           {  
                return false;  
           }  
      });  
      $(document).on('keyup', '.quantity', function(){  
           var product_id = $(this).data("product_id");  
           var quantity = $(this).val();  
           var action = "quantity_change";  
           if(quantity != '')  
           {  
                $.ajax({  
                     url :"action.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{product_id:product_id, quantity:quantity, action:action},  
                     success:function(data){  
                          $('#order_table').html(data.order_table);  
                     }  
                });  
           }  
      });  
 });  
 </script>