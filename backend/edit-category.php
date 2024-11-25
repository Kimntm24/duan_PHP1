<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="shortcut icon" href="https://preview.redd.it/furina-but-with-the-hoyoverse-wink-v0-6nvwe3hq012b1.png?auto=webp&s=538f731a6dbab46fd0ef9024abe3f5e6e069e070" type="image/x-icon">
  <link rel="stylesheet" href="../css/style.css">
  <title>Edit Category - Furina Shop</title>
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
      if ($_GET['id']) {
        $id = $_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM `categories` WHERE `id` = $id");
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
      } else {
        header('Location: ../backend/categories.php');
      }

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = [];

        $name = $_POST['name'];

        if (empty(trim($name))) {
          $errors['name']['required'] = "This field is required";
        }

        if (empty($errors)) {
          $conn->exec("UPDATE `categories` SET `name` = '$name' WHERE `categories`.`id` = $id");
          header('Location: ../backend/categories.php');
        }
      }
      ?>
      <h1 class="text-center">Edit Category</h1>
      <form method="post">
        <div class="input-group">
          <span class="input-group-text" id="basic-addon1">Category name:</span>
          <input id="category-name" name="name" type="text" class="form-control" placeholder="Category name" aria-label="Category name" aria-describedby="basic-addon1" value="<?php echo $product['name']; ?>">
        </div>
        <?php echo !empty($errors['name']) ? '<p class="text-danger">' . reset($errors['name']) . '</p>' : ''; ?>
        <button class="btn btn-primary mt-3" type="submit">Save</button>
      </form>
    </div>
  </main>

  <?php include '../components/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>