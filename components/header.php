<header class="fixed-top bg-white" style="box-shadow: inset 0 -1px 0 0 #eaeaea;">
  <?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  ?>
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="<?php $root ?>/furina-shop/">Furina <span class="fs-6 fw-light">Shop</span></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Frontend
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="<?php $root ?>/furina-shop/frontend/products.php">All Products</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <?php
              if (isset($_COOKIE['isLogin'])) {
              ?>
                <li><a class="dropdown-item" href="<?php $root ?>/furina-shop/frontend/logout.php">Logout</a></li>
              <?php
              } else {
              ?>
                <li><a class="dropdown-item" href="<?php $root ?>/furina-shop/frontend/login.php">Login</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?php $root ?>/furina-shop/frontend/register.php">Register</a></li>
              <?php
              }
              ?>
            </ul>
          </li>
          <?php
          if (isset($_COOKIE['isLogin'])) {
          ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Backend
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="<?php $root ?>/furina-shop/backend/categories.php">Categories</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?php $root ?>/furina-shop/backend/products.php">Products</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?php $root ?>/furina-shop/backend/add-category.php">Add Category</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?php $root ?>/furina-shop/backend/add-product.php">Add Product</a></li>
              </ul>
            </li>
          <?php
          }
          ?>
        </ul>
        <form class="d-flex">
          <input disabled class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="button">Search</button>
        </form>
      </div>
    </div>
  </nav>
</header>