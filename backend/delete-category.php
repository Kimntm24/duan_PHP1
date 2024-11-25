<?php
if (isset($_COOKIE['isLogin'])) {
  include '../conn.php';
  if ($_GET['id']) {
    $conn->exec('DELETE FROM `categories` WHERE `id` = ' . $_GET['id'] . '');
  }
  header('Location: ../backend/categories.php');
} else header('Location: ../frontend/login.php');
