<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="shortcut icon" href="https://preview.redd.it/furina-but-with-the-hoyoverse-wink-v0-6nvwe3hq012b1.png?auto=webp&s=538f731a6dbab46fd0ef9024abe3f5e6e069e070" type="image/x-icon">
  <link rel="stylesheet" href="../css/style.css">
  <title>Add Product - Furina Shop</title>
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
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];

        foreach ($_POST as $key => $value) {
          if (empty(trim($value))) {
            $errors[$key]['required'] = "This field is required";
          }
        }

        if (!filter_var($price, FILTER_VALIDATE_FLOAT)) {
          $errors['price']['valid'] = "Invalid price";
        }

        $file = $_FILES['image'];
        if ($file['size']) {
          $imageTypes = ['image/jpeg', 'image/png', 'image/gif'];
          $maxFileSize = 5 * 1024 * 1024;

          if ($file["error"] == 0) {
            if (!in_array($file["type"], $imageTypes)) {
              $errors['image']['type'] = 'The uploaded file must be an image file (jpeg, png, gif)';
            }

            if ($file["size"] > $maxFileSize) {
              $errors['image']['size'] = 'Upload file size must be less than ' . $maxFileSize / 1024 / 1024 . 'MB';
            }
          }
        } else {
          $errors['image']['required'] = 'This field is required';
        }


        if (empty($errors)) {
          $filename = $file['name'];
          $filename = explode('.', $filename);
          $ext = end($filename);
          $image = uniqid() . '.' . $ext;

          $uploadDir = '../uploads/';

          if (!is_dir($uploadDir)) {
            mkdir($uploadDir);
          }

          move_uploaded_file($file['tmp_name'], $uploadDir . $image);

          $sql = "INSERT INTO `products` (`id`, `name`, `description`, `price`, `category`, `image`) 
                  VALUES (NULL, '$name', '$description', '$price', '$category', '$image')";

          $conn->exec($sql);
          echo '<div class="alert alert-success d-flex align-items-center" role="alert">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Success:">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                  </svg>
                  Product added successfully!
                </div>';
        }
      }
      ?>
      <h1 class="text-center">Add Product</h1>
      <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="product-name" class="form-label">Product name:</label>
          <input type="text" class="form-control" id="product-name" name="name">
          <?php echo !empty($errors['name']) ? '<p class="text-danger">' . reset($errors['name']) . '</p>' : ''; ?>
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description:</label>
          <input type="text" class="form-control" id="description" name="description">
          <?php echo !empty($errors['description']) ? '<p class="text-danger">' . reset($errors['description']) . '</p>' : ''; ?>
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Price:</label>
          <input type="text" class="form-control" id="price" name="price">
          <?php echo !empty($errors['price']) ? '<p class="text-danger">' . reset($errors['price']) . '</p>' : ''; ?>
        </div>
        <div class="mb-3">
          <label for="category" class="form-label">Category:</label>
          <select class="form-select" id="category" name="category">
            <option value="" hidden>-- Select --</option>
            <?php
            $stmt = $conn->prepare("SELECT * FROM `categories` ORDER BY `id` DESC");
            $stmt->execute();
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($categories as $category) {
              echo '<option value="' . $category['name'] . '">' . $category['name'] . '</option>';
            }
            ?>
          </select>
          <?php echo !empty($errors['category']) ? '<p class="text-danger">' . reset($errors['category']) . '</p>' : ''; ?>
        </div>
        <div class="mb-3">
          <label for="room-image" class="form-label">Room Image:</label>
          <img id="currentImage" class="d-block mb-2" style="height: 100px; width: 100px;">
          <input type="file" class="form-control" id="room-image" name="image">
          <?php echo !empty($errors['image']) ? '<p class="text-danger">' . reset($errors['image']) . '</p>' : ''; ?>
        </div>
        <button class="btn btn-primary" type="submit">Save</button>
      </form>
    </div>
  </main>

  <?php include '../components/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script>
    const image = document.querySelector('#currentImage')
    const input = document.querySelector('#room-image')

    input.onchange = () => {
      const [file] = input.files
      if (file) {
        image.src = URL.createObjectURL(file)
      }
    }
  </script>
</body>

</html>