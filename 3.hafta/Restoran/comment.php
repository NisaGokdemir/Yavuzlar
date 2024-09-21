<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();
    include "functions/func.php";
    if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
    header("Location: login.php?message=Giriş yapmadınız!");
    } 

    $userId = $_SESSION['id'];
    $user = getUserById($userId);

    if (isset($_GET['id'])) {  
      $restaurantId = $_GET['id'];  
      $result = getCommentsByRestaurantId($restaurantId); 
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

  <div class="container py-5 mt-5">
      
  <?php if ($_SESSION['role'] == "customer"): ?>
      <div class="card bg-light">
          <header class="card-header border-0 bg-transparent">
            <a class="fw-semibold text-decoration-none"><?php echo $user['username']; ?></a>
          </header>
          <div class="card-body py-1">
            <form action="addComment.php" method="post">
              <div> 
                <input type="hidden" name="userId" value="<?php echo $userId; ?>"> 
                <input type="hidden" name="restaurantId" value="<?php echo $restaurantId; ?>"> 
                <input type="hidden" name="surname" value="<?php echo $user['surname']; ?>"> 
                <input type="text" class="form-control form-control-sm border border-2 rounded-1 mb-2" id="commentTitle" name="commentTitle" required placeholder="Başlık"> 
                <textarea
                  class="form-control form-control-sm border border-2 rounded-1"
                  id="userComment"
                  name = "userComment"
                  style="height: 50px"
                  placeholder="Yorum ekle..."
                  required
                ></textarea>
                <select class="form-select mt-2 form-control-sm border border-2 rounded-1" id="scoreSelect" name="scoreSelect" required>  
                    <option value="">Puan Seçiniz</option>    
                    <option value="1">1</option>   
                    <option value="2">2</option> 
                    <option value="3">3</option> 
                    <option value="4">4</option> 
                    <option value="5">5</option> 
                    <option value="6">6</option> 
                    <option value="7">7</option> 
                    <option value="8">8</option> 
                    <option value="9">9</option> 
                    <option value="10">10</option> 
                </select>
              </div>
              <footer class="card-footer bg-transparent border-0 text-end">
                <button type="submit" class="btn btn-primary btn-sm">Yorum Yap</button>
              </footer>
            </form>
          </div>
          
      </div>
  <?php endif; ?>
      <aside class="d-flex justify-content-between align-items-center my-4">
        <h4 class="h6">Comments</h4>
      </aside>

      <?php if (!empty($result)): ?>  
        <?php foreach ($result as $comment): ?>  
            <article class="card bg-light mt-3">  
                <header class="card-header border-0 bg-transparent d-flex align-items-center">  
                    <div>   
                        <a class="fw-semibold text-decoration-none"><?php echo $comment['surname']; ?></a>  
                    </div>  
                    <div class="dropdown ms-auto">  
                        <button class="btn btn-link text-decoration-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">  
                            <i class="bi bi-three-dots-vertical"></i>  
                        </button>  
                        <ul class="dropdown-menu">  
                            <li><a class="dropdown-item" href="#">Report</a></li>  
                        </ul>  
                    </div>  
                </header>  
                <div class="card-body py-2 px-3">
                  <p class="card-title"><?php echo $comment['title']; ?></p>
                  <p><?php echo $comment['description']; ?></p>
                </div>  
            </article>  
        <?php endforeach; ?>  
      <?php else: ?>  
          <p>Henüz yorum yapılmamış.</p>  
      <?php endif; ?>  

  </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>