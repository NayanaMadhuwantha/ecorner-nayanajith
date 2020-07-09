
<?php

include("../db.php");

session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../a_signin.php');
  }

$sql = 'SELECT * FROM tbl_products';
$statement = $connection->prepare($sql);
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);

if (isset($_GET["txt_search"])){
	
	$sql = "SELECT * FROM tbl_products WHERE P_name like '".$_GET["txt_search"]."%' OR P_category like '".$_GET["txt_search"]."%' ";
}
$result = mysqli_query($conn, $sql);



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
            <a class="nav-link" href="../account/a_detail.php">
              Account Management
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link active" href="p_detail.php">
              Product Management
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../user/u_detail.php">
              User Management  
            </a>
          </li>
            <li class="nav-item">
                <a class="nav-link" href="../account/a_report.php">
                    Generate reports
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
			<form method="GET" action="p_detail.php">
				<div class="row">
					<div  class="col-12 col-sm-12 col-md-12">
						<h2 align="center">Product Details</h2>
					</div>
					<div class="col-12 col-sm-12 col-md-5" style="padding: 2%;">
						<input  name="txt_search" required="" type="text" class="form-control " id="txt_search" placeholder="Search Product" />
					</div>
					<div class="col-9 col-sm-10 col-md-5" style="padding: 2%;">
						<div class="row">
							<div class="col-4 col-sm-2 col-md-4">
								<input type="submit" value="Search" class="btn btn-warning">
							</div>
							<div class="col-6 col-sm-9 col-md-8">
								<a href="p_detail.php" class="btn btn-info" role="button">Refresh</a>	
							</div>
						</div>
						
					</div>
					<div class="col-3 col-sm-2 col-md-2" style="padding: 2%;">
						<a href="p_insert.php" class="btn btn-primary" role="button">Add</a>
					</div>

					<!--table-->
						
							
								
								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table table-bordered table-hover">
											<thead>
												<tr>
													<th>Product Id</th>
													<th>Product Name</th>
													<th>Product Category</th>
													<th>Product image</th>
													<th>Product Price</th>
													<th>Product Quantity</th>
													<th colspan="2">Action</th>
												</tr>
											</thead>
										
									<?php
										if(mysqli_num_rows($result) > 0)
										{
											while ($row = mysqli_fetch_assoc($result)) 
										{
											echo "<tr>";
											echo "<td>" . $row["P_id"] . "</td>";
											echo "<td>" . $row["P_name"] . "</td>";
											echo "<td>" . $row["P_category"] . "</td>";
											echo "<td>" . $row["P_image"] . "</td>";
											echo "<td>" . $row["P_price"] . "</td>";
											echo "<td>" . $row["P_quantity"] . "</td>";
											echo "<td><a class='btn btn-success' href='p_edit.php?id=" . $row["P_id"]."'>Edit</a> </td>";
											echo "<td><a class='btn btn-danger' href='p_delete.php?id=" . $row["P_id"]."' >Delete</a></td>";
											echo "</tr>";
										}
										} else {
											echo "<tr><td></td><td></td><td></td></tr>";
										}
									?>
										</table>
									</div>	
										
									</div>
								</div>
							
							
							<?php
								
							?>

				</form>					
		</div>
	</div>
<!---search-->
	





<script src="js/bootstrap.min.js"></script>
  </body>
</html>
