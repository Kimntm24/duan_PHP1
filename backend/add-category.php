<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="shortcut icon" href="https://preview.redd.it/furina-but-with-the-hoyoverse-wink-v0-6nvwe3hq012b1.png?auto=webp&s=538f731a6dbab46fd0ef9024abe3f5e6e069e070" type="image/x-icon">
  <link rel="stylesheet" href="../css/style.css">
  <title>Add Category - Furina Shop</title>
</head>

<body>
  <?php
  if (!isset($_COOKIE['isLogin'])) header('Location: ../frontend/login.php');
  include '../components/header.php';
  ?>

  <main>
    <div class="container">
      <?php
      include '../conn.php';
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = [];

        $name = $_POST['name'];

        if (empty(trim($name))) {
          $errors['name']['required'] = "This field is required";
        }

        if (empty($errors)) {
          $conn->exec("INSERT INTO `categories` (`id`, `name`) VALUES (NULL, '$name')");

          echo '<div class="alert alert-success d-flex align-items-center" role="alert">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Success:">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                  </svg>
                  Category added successfully!
                </div>';
        }
      }
      ?>
      <h1 class="text-center">Add Category</h1>
      <form method="post">
        <div class="input-group">
          <span class="input-group-text" id="basic-addon1">Category name:</span>
          <input id="category-name" name="name" type="text" class="form-control" placeholder="Category name" aria-label="Category name" aria-describedby="basic-addon1">
        </div>
        <?php echo !empty($errors['name']) ? '<p class="m-0">' . reset($errors['name']) . '</p>' : ''; ?>
        <button class="btn btn-primary mt-3" type="submit">Save</button>
      </form>
    </div>
  </main>

  <?php include '../components/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>