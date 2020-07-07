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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  

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
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="navbar-toggler" style="visibility: hidden;">
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
      <h3 align="center">Payments</h3><br />  
                
      <ul class="nav nav-tabs">   
        <li class="active"><a data-toggle="tab" href="#cart">Cart </a></li>    
      </ul>  
        
        <div class="tab-content">  
            <div id="cart" class="tab-pane fade in active">  
                <div class="table-responsive" id="order_table">  
                  <table class="table table-bordered table-hover">  
                    <tr>  
                         <th width="40%">Product Name</th>  
                         <th width="10%">Quantity</th>  
                         <th width="20%">Price</th>  
                         <th width="15%">Total</th>  
                         <th width="5%">Action</th>  
                    </tr>  
                    <?php  
                    if(!empty($_SESSION["shopping_cart"]))  
                    {  
                         $total = 0;  
                         foreach($_SESSION["shopping_cart"] as $keys => $values)  
                         {                                               
                    ?>  
                    <tr>  
                         <td><?php echo $values["product_name"]; ?></td>  
                         <td><input type="text" name="quantity[]" id="quantity<?php echo $values["product_id"]; ?>" value="<?php echo $values["product_quantity"]; ?>" data-product_id="<?php echo $values["product_id"]; ?>" class="form-control quantity" /></td>  
                         <td align="right">Rs. <?php echo $values["product_price"]; ?></td>  
                         <td align="right">RS. <?php echo number_format($values["product_quantity"] * $values["product_price"], 2); ?></td>  
                         <td><button name="delete" class="btn btn-danger btn-xs delete" id="<?php echo $values["product_id"]; ?>">Remove</button></td>  
                    </tr>  
                        <?php  
                                  $total = $total + ($values["product_quantity"] * $values["product_price"]);  
                             }  
                        ?>  
                    <tr>  
                         <td colspan="3" align="right">Total</td>  
                         <td align="right">Rs. <?php echo number_format($total, 2); ?></td>  
                         <td></td>  
                    </tr>  
                    <tr>  
                         <td colspan="5" align="center">  
                            <form method="post" action="payment.php">  
                              <input type="submit" name="place_order" class="btn btn-info" value="Buy" style="width:200px"/>  
                            </form>  
                          </td>  
                    </tr>  
                    <?php  
                    }  
                    ?>  
                  </table>  
                </div>  
              </div>  
            </div>  
        </div>
        
  </div> 


 <script>  
 $(document).ready(function(data){  
      $('.add_to_cart').click(function(){  
           var product_id = $(this).attr("P_id");  
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
                    //when the product added to cart     
                          $('.badge').text(data.cart_item);  
                          alert("Product has been Added into Cart");  
                     }  
                });  
           }  
           else  
         //when the product added to cart if there is no quantity  
           {  
                alert("Please Enter Number of Quantity")  
           }  
      }); 
//remove the product form cart table      
      $(document).on('click', '.delete', function(){  
           var product_id = $(this).attr("id");  
           var action = "remove";
           if(confirm("Are you sure you want to remove this product?"))  
           {  
                $.ajax({  
                     url:"action.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{product_id:product_id, action:action},  
                     success:function(data){  
                            
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
                          
                     }  
                });  
           }  
      });  
 });  
 </script>



</body>  
</html>  

