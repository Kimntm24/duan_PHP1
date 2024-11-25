<?php
setcookie('isLogin', '', time() - 3600, '/');
header('Location: ../frontend/login.php');
