<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_furina_shop";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "actions/connected successfully";
} catch (PDOException $e) {
  echo "actions/connection failed: " . $e->getMessage();
}
