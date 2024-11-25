<?php
if (isset($_COOKIE['isLogin'])) {

  include '../conn.php';
  if ($_GET['id']) {
    $conn->exec('DELETE FROM `products` WHERE `id` = ' . $_GET['id'] . '');
  }
  header('Location: ../backend/products.php');
} else header('Location: ../frontend/login.php');
