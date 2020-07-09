<?php
session_start();
date_default_timezone_set("Asia/Colombo");
$dateNow = date("Y-m-d");
$timeNow = date("H:i:s");
$dateTime = $dateNow." ".$timeNow;
$connect = mysqli_connect("localhost", "root", "", "ecorner");
if(!empty($_SESSION["shopping_cart"])){
    foreach($_SESSION["shopping_cart"] as $keys => $values) {
        //for ($i = 0; $i<$values["product_quantity"];$i++){
            $P_id = $values["product_id"];
            $H_quantity = $values["product_quantity"];

            $query = "SELECT P_quantity FROM tbl_products WHERE P_id = $P_id";
            $result = mysqli_query($connect, $query);
            $quantity = null;
            while($row = mysqli_fetch_array($result)) {
                $quantity = $row['P_quantity'];
            }
            $quantity -= 1;
            $query2 = "UPDATE tbl_products SET P_quantity = '$quantity' WHERE P_id = $P_id";
            if ($connect->query($query2) === TRUE) {
                echo "P_id ".$P_id." Record updated successfully<br>";
            } else {
                echo "Error updating record: " . $connect->error;
            }
            $query3 = "INSERT INTO tbl_history(P_id,H_quantity,H_date_time) VALUES ('$P_id','$H_quantity','$dateTime')";
            if ($connect->query($query3) === TRUE) {
                //echo "P_id ".$P_id." Record updated successfully<br>";
            } else {
                echo "Error updating record: " . $connect->error;
            }
        //}
    }
}
$_SESSION["shopping_cart"] = null;
header('location: index.php');