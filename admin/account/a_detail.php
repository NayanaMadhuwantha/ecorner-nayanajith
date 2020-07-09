<?php

include("../db.php");

session_start(); 

  if (!isset($_SESSION['username'])) 
  {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../a_signin.php');
  }

$sql = 'SELECT * FROM tbl_user';
$statement = $connection->prepare($sql);
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);

//search functions
if (isset($_GET["txt_search"]))
	{
	
	$sql = "SELECT * FROM tbl_user WHERE U_username like '".$_GET["txt_search"]."%' OR U_firstname like '".$_GET["txt_search"]."' ";

	}


$conn = mysqli_connect("localhost", "root", "", "ecorner");
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
            <a class="nav-link active" href="a_detail.php">
              Account Management
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="../product/p_detail.php">
              Product Management
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../user/u_detail.php">
              User Management  
            </a>
          </li>
            <li class="nav-item">
                <a class="nav-link" href="a_report.php">
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
			<!---search-->
		<form method="GET" action="a_detail.php">
			
			<div class="row">
				<div  class="col-12 col-sm-12 col-lg-12">
					<h2 align="center">Account Details</h2>
				</div>
				<div class="col-sm-12 col-md-4"  style="padding: 1%;">
					<input  name="txt_search" required="" type="text" class="form-control " id="txt_search" placeholder="Search Account" />
				</div>
				<div class="col-12 col-sm-12 col-md-4" style="padding: 1%;">
					<input type="submit" value="Search" class="btn btn-warning">
					<a href="a_detail.php" class="btn btn-info" role="button">Refresh</a>
				</div>
				<div class=" col-12 col-sm-12 col-md-12" style="padding: 1%;">
					<div class="table-responsive">

						<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>User Id</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Username</th>
								<th>Email</th>
								<th>Password</th>
								<th>Gender</th>
								<th>Country</th>
								<th>Mobile</th>
								<th>Card Number</th>
								<th>Card Date</th>
								<th>Card CVC</th>
								<th>Image</th>
								<th colspan="2">Action</th>
							</tr>
						</thead>
					
				
				
				<?php
					if(mysqli_num_rows($result) > 0)
					{
						while ($row = mysqli_fetch_assoc($result)) 
					{ 
						//viewing data from dataase to the table
						echo "<tr>";
						echo "<td>" . $row["U_id"] . "</td>";
						echo "<td>" . $row["U_firstname"] . "</td>";
						echo "<td>" . $row["U_lastname"] . "</td>";
						echo "<td>" . $row["U_username"] . "</td>";
						echo "<td>" . $row["U_email"] . "</td>";
						echo "<td>" . $row["U_password"] . "</td>";
						echo "<td>" . $row["U_gender"] . "</td>";
						echo "<td>" . $row["U_country"] . "</td>";
						echo "<td>" . $row["U_mobilenumber"] . "</td>";
						echo "<td>" . $row["U_cardtnumber"] . "</td>";
						echo "<td>" . $row["U_carddate"] . "</td>";
						echo "<td>" . $row["U_cardCVC"] . "</td>";
						echo "<td>" . $row["U_image"] . "</td>";
						echo "<td><a class='btn btn-success' href='a_edit.php?id=" . $row["U_id"]."'>Edit</a> </td>";
						echo "<td><a class='btn btn-danger' href='a_delete.php?id=" . $row["U_id"]."' >Delete</a></td>";
						echo "</tr>";
					}
					} else {
						echo "<tr><td></td><td></td><td></td></tr>";
					}
				?>
					</table>
					
				
	                <div class="col-12 col-sm-12 col-md-4" style="padding: 1%;">
					
					<a href="../database.php" class="btn btn-info" role="button">Backup</a>
				    </div>			
					
				</div>	
			</div>

			</div>
			
			
			
			
			
			

			
	</div>



<!--table-->

			
		<div>
		
		<?php
		
		

		
		?>

		</div>
	
		

		




  </body>
</html>
