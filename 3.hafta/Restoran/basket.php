<?php  
error_reporting(E_ALL);  
ini_set('display_errors', 1);  

session_start();  
include "functions/func.php";  
if (!$_SESSION['role'] == 'customer') {  
    header("Location: index.php?message=Bu sayfayı görüntüleme izniniz yok!");  
    die();  
}  

$userId = $_SESSION['id'];  
$result = getBasketItems($userId);  

?>  

<!DOCTYPE html>  
<html lang="tr">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Sepet</title>  
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
        <?php if (empty($result)): ?>  
            <div class="alert alert-warning" role="alert">  
                Sepette ürün yok!  
            </div>  
        <?php else: ?>  
            <?php foreach ($result as $item): ?>  
                <div class="card mb-4 mt-3" style="width: 18rem;">  
                    <div class="card-body">  
                        <h5 class="card-title"><?php echo htmlspecialchars($item['food_name']); ?></h5>  
                        <p>Açıklama: <?php echo htmlspecialchars($item['note']); ?></p>  
                        <p>Adet: <?php echo htmlspecialchars($item['quantity']); ?></p>  
                        <p>Fiyat: <?php echo htmlspecialchars($item['total_price']); ?>₺</p>  
                        <a href="deleteBasket.php?id=<?php echo $item['id']; ?>" class="btn btn-primary">Sil</a>  
                    </div>  
                </div>  
            <?php endforeach; ?>  
            <form action="addOrder.php" method="POST">  
                <button type="submit" class="btn btn-success">Sipariş Ver</button>  
            </form>  
        <?php endif; ?>  
    </div>  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>  
</body>  
</html>