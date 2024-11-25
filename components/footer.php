<footer class="pt-5 mt-4" style="border-top: 1px solid #eaeaea;">
  <?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  ?>
  <div class="container">
    <div class="row">
      <div class="col-6 col-md-3 mb-3">
        <h5>Frontend</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="<?php $root ?>/furina-shop/frontend/products.php" class="nav-link p-0 text-muted">All Products</a></li>
          <?php
          if (isset($_COOKIE['isLogin'])) {
          ?>
            <li class="nav-item mb-2"><a href="<?php $root ?>/furina-shop/frontend/logout.php" class="nav-link p-0 text-muted">Logout</a></li>
          <?php } else { ?>
            <li class="nav-item mb-2"><a href="<?php $root ?>/furina-shop/frontend/login.php" class="nav-link p-0 text-muted">Login</a></li>
            <li class="nav-item mb-2"><a href="<?php $root ?>/furina-shop/frontend/register.php" class="nav-link p-0 text-muted">Register</a></li>
          <?php } ?>
        </ul>
      </div>

      <div class="col-6 col-md-3 mb-3">
        <?php
        if (isset($_COOKIE['isLogin'])) {
        ?>
          <h5>Backend</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="<?php $root ?>/furina-shop/backend/categories.php" class="nav-link p-0 text-muted">Categories</a></li>
            <li class="nav-item mb-2"><a href="<?php $root ?>/furina-shop/backend/products.php" class="nav-link p-0 text-muted">Products</a></li>
            <li class="nav-item mb-2"><a href="<?php $root ?>/furina-shop/backend/add-category.php" class="nav-link p-0 text-muted">Add Category</a></li>
            <li class="nav-item mb-2"><a href="<?php $root ?>/furina-shop/backend/add-product.php" class="nav-link p-0 text-muted">Add Product</a></li>
          </ul>
        <?php
        }
        ?>
      </div>

      <div class="col-md-5 offset-md-1 mb-3">
        <form>
          <h5>Subscribe to our newsletter</h5>
          <p>Monthly digest of what's new and exciting from us.</p>
          <div class="d-flex flex-column flex-sm-row w-100 gap-2">
            <label for="newsletter1" class="visually-hidden">Email address</label>
            <input disabled id="newsletter1" type="text" class="form-control" placeholder="Email address">
            <button class="btn btn-primary" type="button">Subscribe</button>
          </div>
        </form>
      </div>
    </div>

    <div class="d-flex flex-column flex-sm-row justify-content-between py-4 mt-4 border-top">
      <p>&copy; 2023 Furina Shop. All rights reserved.</p>
      <ul class="list-unstyled d-flex">
        <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24">
              <use xlink:href="#twitter" />
            </svg></a></li>
        <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24">
              <use xlink:href="#instagram" />
            </svg></a></li>
        <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24">
              <use xlink:href="#facebook" />
            </svg></a></li>
      </ul>
    </div>
  </div>
</footer>