<?php
$dsn = 'mysql:host=localhost;dbname=ecorner';
$username = 'root';
$password = '';
$options = [];
try {
$connection = new PDO($dsn, $username, $password, $options);
} catch(PDOException $e) {

}

 // mysqli_connect() function opens a new connection to the MySQL server.
  $conn = mysqli_connect("localhost", "root", "", "ecorner");

  ?>