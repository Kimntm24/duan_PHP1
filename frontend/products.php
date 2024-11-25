<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="shortcut icon" href="https://preview.redd.it/furina-but-with-the-hoyoverse-wink-v0-6nvwe3hq012b1.png?auto=webp&s=538f731a6dbab46fd0ef9024abe3f5e6e069e070" type="image/x-icon">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/product-hover.css">
  <title>All Products - Furina Shop</title>
</head>

<body>
  <?php include '../components/header.php'; ?>

  <main>
    <div class="container">
      <h1 class="text-center">All Products</h1>
      <div class=" row">
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
          echo '<div class="product col-lg-3 col-md-4 col-sm-6 d-flex justify-content-center mt-3">
                  <div class="card">
                    <img src="../uploads/' . $product['image'] . '" class="card-img-top" alt="' . $product['name'] . '">
                    <div class="card-body">
                      <h5 class="card-title mb-3">' . $product['name'] . '</h5>
                      <p class="card-text mb-0 fw-bold">$' . $product['price'] . '</p>
                      <p class="card-text">Category: ' . $product['category'] . '</p>
                      <a href="#" class="btn btn-primary w-100"><i class="fa-solid fa-cart-shopping me-1"></i>View Detail</a>
                    </div>
                  </div>
                </div>';
        }
        ?>
        <nav class="mt-3">
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
    </div>
  </main>

  <?php include '../components/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>