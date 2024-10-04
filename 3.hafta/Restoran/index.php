<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "functions/func.php";
if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
  header("Location: login.php?message=Giriş yapmadınız!");
} else {
  $foods = getFoodsWithRestaurants();
  $userId = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <nav class="navbar bg-body-tertiary fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><?php echo $_SESSION['role'];?></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><?php echo $_SESSION['name'];?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Ana Sayfa</a>
            </li>
            <?php if ($_SESSION['role'] == "admin"): ?>
              <li class="nav-item">
                <a class="nav-link" href="customer.php">Müşteriler</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="company.php">Firmalar</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cupon.php">Kupon Yönetimi</a>
              </li>
            <?php endif; ?>
            <?php if ($_SESSION['role'] == "company"): ?>
              <li class="nav-item">
                <a class="nav-link" href="companyFood.php">Yemek Servisi</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="companyOrder.php">Sipariş Yönetimi</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="restaurant.php">Restoranlar</a>
              </li>
            <?php endif; ?>
            <?php if ($_SESSION['role'] == "customer"): ?>
              <li class="nav-item">
                <a class="nav-link" href="profile.php">Profil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="basket.php">Sepetim</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="userOrder.php">Siparişlerim</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="userBalance.php">Para Yükle</a>
              </li>
            <?php endif; ?>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Çıkış Yap</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <section class="mt-5" style="background-color: #eee;">
    <div class="container py-5">
        <div class="row justify-content-center mb-3">
          <?php
          foreach ($foods as $food) {
              $restaurant_rating = getRestaurantRating($food['restaurant_id']);
              $final_price = getFoodPriceWithCoupon($food['restaurant_id'], $food['price']);
          ?>
          <input type="hidden" name="userId" value="<?php echo $userId; ?>"> 
          <input type="hidden" name="foodId" value="<?php echo $food['id']; ?>"> 
          <div class="col-md-12 col-xl-10 mb-4">
            <div class="card shadow-0 border rounded-3">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                    <div class="bg-image hover-zoom ripple rounded ripple-surface">
                      <img src="<?php echo $food['food_image']; ?>" class="w-100" />
                      <a href="">
                        <div class="hover-overlay">
                          <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-6 col-xl-6">
                    <h5><?php echo $food['food_name']; ?></h5>
                    <p><?php echo $food['food_description']; ?></p>
                    <h6><?php echo $food['restaurant_name']; ?> Restoranı</h6>
                    <p>Restoran Puanı: <?php echo $restaurant_rating ? $restaurant_rating : 'Puan yok'; ?></p>
                  </div>
                  <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                    <div class="d-flex flex-row align-items-center mb-1">
                      <h4 class="mb-1 me-1">₺<?php echo number_format($final_price, 2); ?></h4>
                      <?php if ($food['discount'] > 0): ?>
                        <span class="text-danger"><s>₺<?php echo number_format($food['price'], 2); ?></s></span>
                      <?php endif; ?>
                    </div>
                    <div class="d-flex flex-column mt-4">
                      <?php if ($_SESSION['role'] == "customer"): ?>
                        <a class="btn btn-primary btn-sm" type="submit" href="addBasket.php?id=<?php echo $food['id']; ?>">Sepete Ekle</a>
                      <?php endif; ?>
                      <a class="btn btn-outline-primary btn-sm mt-2" type="button" href="comment.php?id=<?php echo $food['restaurant_id']; ?>">Yorumlar</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php
          }
          ?>
        </div> 
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<?php } ?>
