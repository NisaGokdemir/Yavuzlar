<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();
    include "functions/func.php";
    if (!$_SESSION['role'] == 'admin') {
        header("Location: index.php?message=Bu sayfayı görüntüleme izniniz yok!");
        die();
    }

    $id = $_GET['id'];
    $user = getUserById($id);
    $orders = getUserOrdersByStatus($id);

    if (!$user) {
        header("Location: customer.php?message=Müşteri bulunamadı!");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Müşteri Bilgileri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    
    <div class="container" style="margin-top: 100px;">

        <div class="card mb-4" style="width: 18rem;">
            <img src="<?php echo $user['image_path']; ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Müşteri Bilgileri</h5>
                <p>Ad: <?php echo $user['name']; ?></p>
                <p>Soyad: <?php echo $user['surname']; ?></p>
                <p>Kullanıcı Adı: <?php echo $user['username']; ?></p>
                <p>Yetki: <?php echo $user['role']; ?></p>
                <p>Bakiye: <?php echo $user['balance']; ?></p>
            </div>
        </div>

        <?php foreach ($orders as $order): ?>
            <div class="card mb-4" style="width: 18rem;">
                <img src="<?php echo $user['image_path']; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Sipariş No: <?php echo $order['order_id']; ?></h5>
                    <p>Durum: <?php echo $order['order_status']; ?></p>
                    <p>Tarih: <?php echo $order['order_date']; ?></p>
                    <p>Toplam Fiyat: <?php echo $order['total_price']; ?> ₺</p>
                    <p>Yemekler: <?php echo $order['food_names']; ?></p>
                    <p>Adetler: <?php echo $order['quantities']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
        


        <a href="customer.php" class="btn btn-primary mt-3">Geri Dön</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
