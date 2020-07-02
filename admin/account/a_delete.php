<?php

include("../db.php");

$id = $_GET['id'];
//delete query 
$sql = 'DELETE FROM tbl_user WHERE U_id=:id';
$statement = $connection->prepare($sql);
if ($statement->execute([':id' => $id])) 
{
  header("Location: a_detail.php ");
}
?>