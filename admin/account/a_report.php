<?php

include("../db.php");

session_start();
date_default_timezone_set("Asia/Colombo");
$dateNow = date("Y-m-d");
$timeNow = date("H:i:s");
$dateTime = $dateNow." ".$timeNow;
$connect = mysqli_connect("localhost", "root", "", "ecorner");
$query = "SELECT * FROM tbl_products";
$result = mysqli_query($connect, $query);
$filter = null;

if (isset($_POST['back'])){
    $filter = null;
}

if (isset($_POST['year']) && isset($_POST['month'])){
    if (strlen($_POST['year']) == 4 && strlen($_POST['month']) == 2){
        $filter = $_POST['year']."-".$_POST['month'];
    }
    else if (strlen($_POST['year']) == 4){
        $filter = $_POST['year'];
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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
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
                <a class="nav-link active" href="a_report.php">
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
        <?php
        if ($filter) {
                echo "
                
            <div class='container'style='padding-bottom: 0px'>
            <form action='a_report.php' method='post'>
                <input type='hidden' name='back' value='true'>
                <button class='btn btn-success'>Back</button>
            </form>
                <div class='row'>
                
                    <div class='col-sm'>
                        <center><h2 style='background-color: #6f93ff; color: rgb(247,249,247); border-radius: 3px; padding: 15px'>Sales Report</h2></center>
                        <h4 style='color: #103674'>eCorner - Coffee Shop Store</h4>
                        <h4 style='color: #000b74'>$filter</h4>
                    </div>
                </div>
            </div>
            <div class='container'>
                <div class='row'>
                    <div class='col-md-12'>
                        <table id='table-report' class='display'>
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Unit Price/LKR</th>
                                <th>Quantity</th>
                                <th>Total/LKR</th>
                            </tr>
                            </thead>
                            <tbody>";

                $total_categories = 0;
                $total_units = 0;
                $total_price = 0;
                while ($row = mysqli_fetch_array($result)) {
                    $current_P_id = $row['P_id'];
                    $current_P_name = $row['P_name'];
                    $current_P_category = $row['P_category'];
                    $current_P_price = $row['P_price'];
                    $current_P_quantity = 0;

                    //for filter
                    $H_year = null;
                    $H_year_and_month = null;


                    $query2 = "SELECT * FROM tbl_history WHERE P_id = $current_P_id";
                    $result2 = mysqli_query($connect, $query2);
                    while ($row2 = mysqli_fetch_array($result2)) {
                        //var_dump($row2['P_id']);
                        $H_date_time = $row2['H_date_time'];
                        $H_date = explode(" ", $H_date_time)[0];
                        $H_year = explode("-", $H_date)[0];
                        $H_month = explode("-", $H_date)[1];
                        $H_year_and_month = $H_year . "-" . $H_month;

                        $current_P_quantity += $row2['H_quantity'];
                    }

                    if ($current_P_quantity > 0 && ($H_year == $filter || $H_year_and_month == $filter)) {
                        $current_P_total = $current_P_price * $current_P_quantity;
                        $total_units += $current_P_quantity;
                        $total_price += $current_P_total;

                        $total_categories++;
                        echo "
                                    <tr>
                                        <td>$current_P_name</td>
                                        <td>$current_P_category</td>
                                        <td>$current_P_price</td>
                                        <td>$current_P_quantity</td>
                                        <td>$current_P_total</td>
                                    </tr>
                                ";
                    }
                }


                echo "
                            <tr>
                                <td><div style='visibility: hidden; position: absolute;'>z</div><b>Total</b></td>
                                <td></td>
                                <td></td>
                                <td><b>$total_units</b></td>
                                <td><b>$total_price</b></td>
                            </tr>
                        ";

                echo "</tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class='container' style='margin-top: 30px;'>
                <div class='row'>
                    <div class='col-md'>
                        <div class='card text-white bg-success mb-3' style='max-width: 75%;'>
                            <div class='card-header'>Total categories</div>
                            <div class='card-body'>
                                <center><h1 class='card-title'>$total_categories</h1></center>
                            </div>
                        </div>
                    </div>
                    <div class='col-md'>
                        <div class='card text-white bg-success mb-3' style='max-width: 75%;'>
                            <div class='card-header'>Total units</div>
                            <div class='card-body'>
                                <center><h1 class='card-title'>$total_units</h1></center>
                            </div>
                        </div>
                    </div>
                    <div class='col-md'>
                        <div class='card text-white bg-success mb-3' style='max-width: 75%;'>
                            <div class='card-header'>Total price/LKR</div>
                            <div class='card-body'>
                                <center><h1 class='card-title'>$total_price</h1></center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>";
        }
        else{
            echo "
            

            <div class='container'>
            
            <h3>Please select a year and month to generate the sales report</h3>
            <h5>You can generate the annual reports only entering a year</h5>
            <br>
            <form action='a_report.php' method='post'>
            <br>
                <div class='form-group'>
                    <label for='email'>Select year</label>
                    <input type='text' name='year' id='yearpicker' />
                </div>
                <br>
                <div class='form-group'>
                    <label for='email'>Select month</label>
                    <input type='text' name='month' id='monthpicker' />
                </div> 
                <br>
                <button type='submit' class='btn btn-primary'>Submit</button>
            </form>
            </div>";
        }
        ?>
	</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>


<script>
    $("#yearpicker").datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years"
    });
    $("#monthpicker").datepicker({
        format: "mm",
        viewMode: "months",
        minViewMode: "months"
    });
    $(document).ready(function() {
        // Append a caption to the table before the DataTables initialisation
        $('#table-report').append('<caption style="caption-side: bottom">Coffee shop sales report</caption>');

        $('#table-report').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy',
                {
                    extend: 'excel',
                    messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
                },
                {
                    extend: 'pdf',
                    messageBottom: null
                },
                {
                    extend: 'print',
                    messageTop: function () {
                        return '<?=$filter?>';
                    },
                    messageBottom: null
                }
            ]
        } );
    } );
</script>
  </body>
</html>
