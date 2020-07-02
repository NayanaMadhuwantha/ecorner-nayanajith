<?php

include("../db.php");

$id = $_GET['id'];
$sql = 'DELETE FROM tbl_products WHERE P_id=:id';
$statement = $connection->prepare($sql);
if ($statement->execute([':id' => $id])) 
{
  header("Location: p_detail.php ");
}
?>