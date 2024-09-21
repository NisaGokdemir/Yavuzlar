<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();
    include "functions/func.php";
    if (!$_SESSION['role'] == 'company') {
        header("Location: index.php?message=Bu sayfayı görüntüleme izniniz yok!");
        die();
    }
    if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
    header("Location: login.php?message=Giriş yapmadınız!");
    } 

    $companyId = $_SESSION['company_id'];
    $restaurants = getRestaurantsByCompanyId($companyId);

    if (isset($_GET['id'])) {  
        $foodId = $_GET['id'];  
        $food = getFoodById($foodId);
    }

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

        <form action="updateFoodQuery.php" method="POST" enctype="multipart/form-data">  
            <h5 class="title mb-4 mt-5">Yemek Güncelle</h5>
            <div class="mb-3">  
                <input type="hidden" name="id" value="<?php echo $food['id']; ?>"> 
                <label for="foodName" class="form-label">Ad</label>  
                <input type="text" class="form-control" id="foodName" name="foodName" required value="<?php echo $food['name']; ?>">  
            </div> 
            <div class="mb-3">  
                <label for="foodDesc" class="form-label">Açıklama</label>  
                <input type="text" class="form-control" id="foodDesc" name="foodDesc" required value="<?php echo $food['description']; ?>">  
            </div> 
            <div class="mb-3">  
                <label for="foodPrice" class="form-label">Fiyat</label>  
                <input type="text" class="form-control" id="foodPrice" name="foodPrice" required value="<?php echo $food['price']; ?>">  
            </div>   
            <div class="mb-3">  
                <label for="foodDiscount" class="form-label">Adet</label>  
                <input type="text" class="form-control" id="foodDiscount" name="foodDiscount" required value="<?php echo $food['discount']; ?>">  
            </div>  
            <div class="mb-3">  
                <label for="restaurantId" class="form-label">Restoran</label>  
                <select class="form-select" id="restaurantId" name="restaurantId" required>  
                    <option value="">Seçiniz</option>   
                    <?php foreach ($restaurants as $restaurant): ?>
                        <option value="<?php echo $restaurant['id']; ?>"><?php echo $restaurant['name']; ?></option>  
                    <?php endforeach; ?>  
                </select>  
            </div>
            <div class="mb-3">  
                <label for="foodLogo" class="form-label">Yemek Resmi</label>  
                <input class="form-control" type="file" id="foodLogo" name="foodLogo" required>  
            </div>  
            
            <button type="submit" class="btn btn-primary">Güncelle</button>  
        </form>  
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
