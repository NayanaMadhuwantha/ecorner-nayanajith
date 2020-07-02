<?php
//database connnection
$dsn = 'mysql:host=localhost;dbname=ecorner';
$username = 'root';
$password = '';
$options = [];
try {
$connection = new PDO($dsn, $username, $password, $options);
} catch(PDOException $e) {

}

$conn = mysqli_connect("localhost", "root", "", "ecorner");