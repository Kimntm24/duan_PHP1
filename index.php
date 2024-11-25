<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="shortcut icon" href="https://preview.redd.it/furina-but-with-the-hoyoverse-wink-v0-6nvwe3hq012b1.png?auto=webp&s=538f731a6dbab46fd0ef9024abe3f5e6e069e070" type="image/x-icon">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/product-hover.css">
  <title>Furina Shop</title>
</head>

<body>
  <?php include 'components/header.php'; ?>

  <main>
    <div class=" container">
      <?php include 'components/banner.php'; ?>

      <section class="mt-4">
        <h2 class="mb-3">LATEST PRODUCTS</h2>
        <div class="row">
          <?php
          include 'conn.php';
          if (isset($conn)) {
            $stmt = $conn->prepare("SELECT * FROM `products` ORDER BY `id` DESC;");
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $limit = 12 * 2;
            for ($i = 0; $i < count($products) && $i < $limit; $i++) {
              echo '<div class="product col-lg-3 col-md-4 col-sm-6 d-flex justify-content-center mt-3">
                      <div class="card">
                        <img src="uploads/' . $products[$i]['image'] . '" class="card-img-top" alt="' . $products[$i]['name'] . '">
                        <div class="card-body">
                          <h5 class="card-title mb-3">' . $products[$i]['name'] . '</h5>
                          <p class="card-text mb-0 fw-bold">$' . $products[$i]['price'] . '</p>
                          <p class="card-text">Category: ' . $products[$i]['category'] . '</p>
                          <a href="#" class="btn btn-primary w-100"><i class="fa-solid fa-cart-shopping me-1"></i>View Detail</a>
                        </div>
                      </div>
                    </div>';
            }
          }
          ?>
        </div>
      </section>

      <!-- <section class="mt-4">
        <h2 class="mb-3">SMARTPHONE</h2>
        <div class=" row">
          <?php
          // if (isset($conn)) {
          //   $limit = 4;
          //   $count = 0;
          //   for ($i = 0; $i < count($products) && $count < $limit; $i++) {
          //     if ($products[$i]['category'] === 'Smartphone') {
          //       $count++;
          //       echo '<div class="product col-lg-3 col-md-4 col-sm-6 d-flex justify-content-center mt-3">
          //             <div class="card">
          //               <img src="uploads/' . $products[$i]['image'] . '" class="card-img-top" alt="' . $products[$i]['name'] . '">
          //               <div class="card-body">
          //                 <h5 class="card-title mb-3">' . $products[$i]['name'] . '</h5>
          //                 <p class="card-text mb-0 fw-bold">$' . $products[$i]['price'] . '</p>
          //                 <p class="card-text">Category: ' . $products[$i]['category'] . '</p>
          //                 <a href="#" class="btn btn-primary w-100"><i class="fa-solid fa-cart-shopping me-1"></i>View Detail</a>
          //               </div>
          //             </div>
          //           </div>';
          //     }
          //   }
          // }
          ?>
        </div>
      </section> -->
    </div>
  </main>

  <?php include 'components/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>