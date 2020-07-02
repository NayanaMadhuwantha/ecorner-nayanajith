<?php

include("../db.php");

$id = $_GET['id'];
$sql = 'DELETE FROM tbl_admin WHERE A_id=:id';
$statement = $connection->prepare($sql);
if ($statement->execute([':id' => $id])) 
{
  header("Location: u_detail.php ");
}
?>