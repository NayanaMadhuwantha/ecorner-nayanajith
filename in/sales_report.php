<?php
session_start();
date_default_timezone_set("Asia/Colombo");
$dateNow = date("Y-m-d");
$timeNow = date("H:i:s");
$dateTime = $dateNow." ".$timeNow;
$connect = mysqli_connect("localhost", "root", "", "ecorner");
$query = "SELECT * FROM tbl_products";
$result = mysqli_query($connect, $query);
$filter = "2020";
?>

<html>
<head>
    <title>eCorner | Sales Report</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm">
            <center><h2 style="background-color: #6f93ff; color: rgb(247,249,247); border-radius: 3px; padding: 15px">Purchase Pay Report</h2></center>
            <h4 style="color: #103674">eCorner - Coffee Shop Store</h4>
            <h4 style="color: #000b74"><?=$filter?></h4>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table id="table-report" class="display">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Unit Price/LKR</th>
                    <th>Quantity</th>
                    <th>Total/LKR</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $total_categories = 0;
                $total_units = 0;
                $total_price = 0;
                while($row = mysqli_fetch_array($result)) {
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
                    while($row2 = mysqli_fetch_array($result2)) {
                        //var_dump($row2['P_id']);
                        $H_date_time = $row2['H_date_time'];
                        $H_date = explode(" ",$H_date_time)[0];
                        $H_year = explode("-",$H_date)[0];
                        $H_month = explode("-",$H_date)[1];
                        $H_year_and_month = $H_year."-".$H_month;

                        $current_P_quantity += $row2['H_quantity'];
                    }

                    if ($current_P_quantity > 0 && ($H_year == $filter || $H_year_and_month == $filter)){
                        $current_P_total = $current_P_price * $current_P_quantity;
                        $total_units += $current_P_quantity;
                        $total_price += $current_P_total;

                        $total_categories ++;
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
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="container" style="margin-top: 30px;">
    <div class="row">
        <div class="col-md">
            <div class="card text-white bg-success mb-3" style="max-width: 75%;">
                <div class="card-header">Total categories</div>
                <div class="card-body">
                    <center><h1 class="card-title"><?=$total_categories?></h1></center>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card text-white bg-success mb-3" style="max-width: 75%;">
                <div class="card-header">Total units</div>
                <div class="card-body">
                    <center><h1 class="card-title"><?=$total_units?></h1></center>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card text-white bg-success mb-3" style="max-width: 75%;">
                <div class="card-header">Total price/LKR</div>
                <div class="card-body">
                    <center><h1 class="card-title"><?=$total_price?></h1></center>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>


<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>-->
<script>
    /*$(document).ready(function(){
        $('#table-report').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        } );
    });*/
    $(document).ready(function() {
        // Append a caption to the table before the DataTables initialisation
        $('#table-report').append('<caption style="caption-side: bottom">Coffee shop pay purchase report</caption>');

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
