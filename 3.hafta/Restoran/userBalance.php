<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();
    include "functions/func.php";
    if (!$_SESSION['role'] == 'customer') {
        header("Location: index.php?message=Bu sayfayı görüntüleme izniniz yok!");
        die();
    }
    if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
    header("Location: login.php?message=Giriş yapmadınız!");
    } 

    $userId = $_SESSION['id'];
    $result = getUserById($userId);
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

    <div class="container" style="margin-top: 100px;">
    <h5 class="title mb-4 mt-5">Bakiye Yükle</h5>

        <form action="addBalance.php" method="POST" enctype="multipart/form-data">  
            <div class="mb-3">  
                <input type="hidden" name="id" value="<?php echo $result['id']; ?>"> 
                <label for="balance" class="form-label">Bakiye</label>  
                <input readonly type="text" class="form-control" id="balance" name="balance" value="<?php echo $result['balance']; ?>">  
            </div>  
            <div class="mb-3">  
                <label for="newBalance" class="form-label">Yüklenecek Tutar</label>  
                <input type="text" class="form-control" id="newBalance" name="newBalance" required>  
            </div>  
            <button type="submit" class="btn btn-primary">Ekle</button>  
        </form>  
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
