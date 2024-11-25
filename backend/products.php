<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="shortcut icon" href="https://preview.redd.it/furina-but-with-the-hoyoverse-wink-v0-6nvwe3hq012b1.png?auto=webp&s=538f731a6dbab46fd0ef9024abe3f5e6e069e070" type="image/x-icon">
  <link rel="stylesheet" href="../css/style.css">
  <title>Products - Furina Shop</title>
</head>

<body>
  <?php
  if (!isset($_COOKIE['isLogin'])) header('Location: ../frontend/login.php');
  include '../components/header.php';
  ?>

  <main>
    <div class="container">
      <h1 class="text-center">Products</h1>
      <a href="add-product.php" class="btn btn-secondary mb-2 float-end">Add new</a>
      <table class="table table-bordered table-striped table-hover">
        <thead>
          <tr class="text-center">
            <th scope="col" class="py-3 fs-5">ID</th>
            <th scope="col" class="py-3 fs-5">Image</th>
            <th scope="col" class="py-3 fs-5">Name</th>
            <th scope="col" class="py-3 fs-5">Price</th>
            <th scope="col" class="py-3 fs-5">Category</th>
            <th colspan="2" scope="col" class="py-3 fs-5">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include '../conn.php';
          if (isset($_GET['page']) && is_numeric($_GET['page'])) {
            $currentPage = $_GET['page'];
          } else {
            $currentPage = 1;
          }

          $limit = 12;
          $start = ($currentPage - 1) * $limit;

          $stmt = $conn->prepare("SELECT * FROM `products` ORDER BY `id` DESC LIMIT $start, $limit");
          $stmt->execute();
          $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

          foreach ($products as $product) {
            echo '<tr>
                    <th scope="row" class="text-center">' . $product['id'] . '</th>
                    <td><img class="d-block" style="margin: auto; height: 64px; width: 64px;" src="../uploads/' . $product['image'] . '" alt="' . $product['name'] . '"></td>
                    <td>' . $product['name'] . '</td>
                    <td>' . $product['price'] . '</td>
                    <td>' . $product['category'] . '</td>
                    <td><a href="../backend/edit-product.php?id=' . $product['id'] . '" class="btn btn-warning">Edit</a></td>
                    <td><button onclick="confirmDelete(' . $product['id'] . ', \'' . $product['name'] . '\')" type="button" class="btn btn-danger">Delete</button></td>
                  </tr>';
          }
          ?>
        </tbody>
      </table>
      <nav class="mt-3">
        <ul class="pagination justify-content-center">
          <?php
          $currentPagePath = basename(__FILE__);

          if ($currentPage == 1) {
            echo '<li class="page-item disabled"><a class="page-link" href="#">Prev</a></li>';
          } else {
            echo '<li class="page-item"><a class="page-link" href="' . $currentPagePath . '?page=' . $currentPage - 1 . '">Prev</a></li>';
          }

          $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM products");
          $stmt->execute();
          $result = $stmt->fetch(PDO::FETCH_ASSOC);
          $totalItems = $result['total'];
          $totalPages = ceil($totalItems / $limit);

          for ($i = 1; $i <= $totalPages; $i++) {
            if ($i == $currentPage) {
              echo '<li class="page-item active"><a class="page-link" href="' . $currentPagePath . '?page=' . $i . '">' . $i . '</a></li>';
            } else {
              echo '<li class="page-item"><a class="page-link" href="' . $currentPagePath . '?page=' . $i . '">' . $i . '</a></li>';
            }
          }

          if ($currentPage == $totalPages) {
            echo '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
          } else {
            echo '<li class="page-item"><a class="page-link" href="' . $currentPagePath . '?page=' . $currentPage + 1 . '">Next</a></li>';
          }
          ?>
        </ul>
      </nav>
    </div>
  </main>

  <?php include '../components/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script>
    function confirmDelete(id, name) {
      if (confirm(`Are you sure you want to delete "${name}"`)) {
        window.location.href = `../backend/delete-product.php?id='${id}'`
      }
    }
  </script>
</body>

</html>