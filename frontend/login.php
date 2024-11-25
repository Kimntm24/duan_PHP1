<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="shortcut icon" href="https://preview.redd.it/furina-but-with-the-hoyoverse-wink-v0-6nvwe3hq012b1.png?auto=webp&s=538f731a6dbab46fd0ef9024abe3f5e6e069e070" type="image/x-icon">
  <link rel="stylesheet" href="../css/style.css">
  <title>Login - Furina Shop</title>
</head>

<body>
  <?php
  if (isset($_COOKIE['isLogin'])) header('Location: ../');
  include '../components/header.php';
  ?>

  <main>
    <div class="container">
      <h1 class="text-center">Login</h1>
      <?php
      include '../conn.php';
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = [];
        $minLength = 7;
        $username = $_POST['username'];
        $password = $_POST['password'];

        foreach ($_POST as $key => $value) {
          if (empty(trim($value))) {
            $errors[$key]['required'] = "This field is required";
          }
        }

        if (strlen(trim($username)) < $minLength) {
          $errors['username']['min-length'] = 'Length must be greater than ' . $minLength - 1 . ' characters';
        }

        if (strlen(trim($password)) < $minLength) {
          $errors['password']['min-length'] = 'Length must be greater than ' . $minLength - 1 . ' characters';
        }

        if (empty($errors)) {
          $stmt = $conn->prepare("SELECT * FROM `accounts` WHERE `username` LIKE '$username' AND `password` LIKE '$password'");
          $stmt->execute();
          $account = $stmt->fetch(PDO::FETCH_ASSOC);
          if ($account) {
            setcookie('isLogin', 'true', time() + 60 * 5, '/');
            header('Location: ../index.php');
          } else {
            echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Danger:">
                      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    Invalid username or password
                  </div>';
          }
        }
      }
      ?>

      <form method="post" class="bg-white">
        <div class="mb-3">
          <label for="username" class="form-label">Username:</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
          <?php echo !empty($errors['username']) ? '<p class="text-danger">' . reset($errors['username']) . '</p>' : ''; ?>
        </div>
        <div class="mb-2">
          <label for="password" class="form-label">Password:</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
          <?php echo !empty($errors['password']) ? '<p class="text-danger">' . reset($errors['password']) . '</p>' : ''; ?>
        </div>
        <div class="d-flex justify-content-between">
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="" id="remember">
            <label class="form-check-label" for="remember">
              Remember me
            </label>
          </div>
          <a href="#" style="text-decoration: none;">Forgot password?</a>
        </div>
        <button class="btn btn-primary" type="submit">Login</button>
        <p class="text-center">Don't have an account? <a href="register.php" style="text-decoration: none;">Register</a></p>
      </form>
    </div>
  </main>

  <?php include '../components/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>