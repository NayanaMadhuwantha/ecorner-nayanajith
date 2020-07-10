<?php
session_start();
date_default_timezone_set("Asia/Colombo");
if (!isset($_SESSION['username']))
{
    $_SESSION['msg'] = "You must log in first";
    header('location: ../log/login.php');
}
$dateNow = date("Y-m-d");
$timeNow = date("H:i:s");
$dateTime = $dateNow." ".$timeNow;
$connect = mysqli_connect("localhost", "root", "", "ecorner");
?>
<html>
<head>

    <title>eCorner | Payment receipt</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
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
</head>
<body>

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


<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3" style="margin: 0 auto;">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <address>
                        <strong>eCorner</strong>
                        <br>
                        <abbr title="Phone">P:</abbr> 071-5154926
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        <em>Date: <?=$dateNow?></em>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="text-center">
                    <h1>Receipt</h1>
                </div>
                </span>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>#</th>
                        <th class="text-center">Price/LKR</th>
                        <th class="text-center">Total/LKR</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($_SESSION["shopping_cart"])){
                        $total = 0;
                        foreach($_SESSION["shopping_cart"] as $keys => $values) {
                            $product_name = $values["product_name"];
                            $product_quantity = $values["product_quantity"];
                            $product_price =  $values["product_price"];
                            $total_price = $product_price*$product_quantity;
                            $total += $total_price;
                            echo "
                            <tr>
                                <td class='col-md-9'><em>$product_name</em></h4></td>
                                <td class='col-md-1' style='text-align: center'> $product_quantity </td>
                                <td class='col-md-1 text-center'>$product_price</td>
                                <td class='col-md-1 text-center'>$total_price</td>
                            </tr>
                            ";
                        }
                    }
                    ?>


                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td class="text-right"><h4><strong>Total: </strong></h4></td>
                        <td class="text-center text-danger"><h4><strong><?=$total?></strong></h4></td>
                    </tr>
                    </tbody>
                </table>
                <form action="set_inventory.php">
                    <button type="submit" class="btn btn-success btn-lg btn-block">
                        Pay Now   <span class="glyphicon glyphicon-chevron-right"></span>
                    </button></td>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
