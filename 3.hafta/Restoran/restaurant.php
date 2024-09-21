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

    $result = getAllRestaurants();
    $companies = getAllCompanies();

    if (isset($_POST['search'])) {
        $name = $_POST['name'];
        $result = searchRestaurantByName($name);
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
        <h5 class="title mb-4 mt-5">Restoranlar</h5>
        <form method="POST" action="">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="name" placeholder="Restoran ismi girin" required>
                <button class="btn btn-outline-secondary" type="submit" name="search">Ara</button>
            </div>
        </form>
        <?php foreach ($result as $restaurant): ?>
            <div class="input-group mb-3">
                <div class="form-control"><?php echo $restaurant['name']; ?></div>
                <a href="infoRestaurant.php?id=<?php echo $restaurant['id']; ?>" class="btn btn-outline-secondary">Görüntüle</a>
                <a href="updateRestaurant.php?id=<?php echo $restaurant['id']; ?>" class="btn btn-outline-secondary">Güncelle</a>
                <a href="deleteRestaurant.php?id=<?php echo $restaurant['id']; ?>" class="btn btn-outline-secondary">Sil</a>
            </div>
        <?php endforeach; ?>

        <form action="addRestaurant.php" method="POST" enctype="multipart/form-data">  
            <h5 class="title mb-4 mt-5">Restoran Ekle</h5>
            <div class="mb-3">  
                <label for="restaurantName" class="form-label">Restoran Adı</label>  
                <input type="text" class="form-control" id="restaurantName" name="restaurantName" required>  
            </div>  
            <div class="mb-3">  
                <label for="restaurantDesc" class="form-label">Açıklama</label>  
                <textarea class="form-control" id="restaurantDesc" name="restaurantDesc" rows="3" required></textarea>  
            </div>  
            <div class="mb-3">  
                <label for="companySelect" class="form-label">Firma</label>  
                <select class="form-select" id="companySelect" name="companyId" required>  
                    <option value="">Seçiniz</option>  
                    <?php foreach ($companies as $company): ?>  
                        <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>  
                    <?php endforeach; ?>  
                </select>  
            </div>  
            <div class="mb-3">  
                <label for="restaurantLogo" class="form-label">Restoran Logosu</label>  
                <input class="form-control" type="file" id="restaurantLogo" name="restaurantLogo" required>  
            </div>  
            <button type="submit" class="btn btn-primary">Ekle</button>  
        </form>  


        
         
        
    </div>
    
    <!-- <div class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-primary" type="button">Button</button>
            <button class="btn btn-primary" type="button">Button</button>
        </div> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
