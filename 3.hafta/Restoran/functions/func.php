<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

function Login($usern, $password) {  
    include "db.php";  
    $query = "SELECT * FROM users WHERE username = :usern";  
    $statement = $pdo->prepare($query);  
    $statement->execute([':usern' => $usern]);  
    $user = $statement->fetch();  
    // if ($user && password_verify($password, $user['password'])) {  
    //     return $user;  
    // }  
    // return false;  
    return $user;
}

// Müşteriler

function getActiveCustomers() {
    include "db.php";
    $query = "SELECT * FROM users WHERE role = 'customer' AND deleted_at IS NULL";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}

function getUserById($id) {
    include "db.php";
    $query = "SELECT * FROM users WHERE id = :id AND deleted_at IS NULL";
    $statement = $pdo->prepare($query);
    $statement->execute([':id' => $id]);
    return $statement->fetch();
}

function getUserOrdersByStatus($userId) {
    include "db.php";
    $query = "
        SELECT o.id AS order_id, o.order_status, o.total_price, o.created_at AS order_date,
               GROUP_CONCAT(f.name) AS food_names, GROUP_CONCAT(oi.quantity) AS quantities
        FROM `order` o
        LEFT JOIN order_items oi ON o.id = oi.order_id
        LEFT JOIN food f ON oi.food_id = f.id
        WHERE o.user_id = :userId 
          AND o.deleted_at IS NULL 
          AND (o.order_status = 'Hazırlanıyor' OR o.order_status = 'Yolda')
        GROUP BY o.id
    ";
    $statement = $pdo->prepare($query);
    $statement->execute([':userId' => $userId]);
    return $statement->fetchAll();
}

function softDeleteCustomer($customerId) {
    include "db.php";
    $query = "UPDATE users SET deleted_at = NOW() WHERE id = :id";
    $statement = $pdo->prepare($query);
    $statement->execute([':id' => $customerId]);
}

function searchCustomerByName($name) {
    include "db.php";
    $query = "SELECT * FROM users WHERE role = 'customer' AND deleted_at IS NULL AND name LIKE :name";
    $statement = $pdo->prepare($query);
    $statement->execute([':name' => '%' . $name . '%']);
    return $statement->fetchAll();
}

function getDeletedCustomers() {
    include "db.php";
    $query = "SELECT * FROM users WHERE deleted_at IS NOT NULL";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

function addCustomer($name, $surname, $user, $password, $balance, $image_path, $role) {  
    include "db.php";  
    //$hashedPassword = password_hash($password, PASSWORD_ARGON2ID);  
    $query = "INSERT INTO users (name, surname, username, password, balance, image_path, role) VALUES (:name, :surname, :user, :password, :balance, :logo, :role)";  
    $statement = $pdo->prepare($query);  
    $statement->execute([  
        ':name' => $name,  
        ':surname' => $surname,  
        ':user' => $user,  
        ':password' => $password,  
        ':balance' => $balance,  
        ':logo' => $image_path,  
        ':role' => $role  
    ]);    
}  

// Firmalar

function addCompany($name, $description, $logo_path) {  
    include "db.php";  
    $query = "INSERT INTO company (name, description, logo_path) VALUES (:name, :description, :logo_path)";  
    $statement = $pdo->prepare($query);  
    $statement->execute([  
        ':name' => $name,  
        ':description' => $description,  
        ':logo_path' => $logo_path  
    ]);  
}

function deleteCompanyById($companyId) {  
    include "db.php";  
    $query = "UPDATE company SET deleted_at = NOW() WHERE id = :id";  
    $statement = $pdo->prepare($query);  
    $statement->execute([':id' => $companyId]);  
}

function searchCompanyByName($name) {  
    include "db.php";  
    $query = "SELECT * FROM company WHERE name LIKE :name AND deleted_at IS NULL";  
    $statement = $pdo->prepare($query);  
    $statement->execute([':name' => '%' . $name . '%']);  
    return $statement->fetchAll();  
}

function getAllCompanies() {  
    include "db.php";  
    $query = "SELECT * FROM company WHERE deleted_at IS NULL";  
    $statement = $pdo->prepare($query);  
    $statement->execute();  
    return $statement->fetchAll();  
}

function getCompanyById($companyId) {  
    include "db.php";  
    $query = "SELECT * FROM company WHERE id = :id AND deleted_at IS NULL";  
    $statement = $pdo->prepare($query);  
    $statement->execute([':id' => $companyId]);  
    return $statement->fetch();  
}

function getFoodsByCompanyId($companyId) {  
    include "db.php";  
    $query = "  
        SELECT f.*   
        FROM food f  
        INNER JOIN restaurant r ON f.restaurant_id = r.id  
        WHERE r.company_id = :companyId AND f.deleted_at IS NULL  
    ";  
    $statement = $pdo->prepare($query);  
    $statement->execute([':companyId' => $companyId]);  
    return $statement->fetchAll();  
}

function updateCompany($id, $name, $description, $logo_path) {  
    include "db.php";  
    $query = "UPDATE company SET name = :name, description = :description, logo_path = :logo_path WHERE id = :id AND deleted_at IS NULL";  
    $statement = $pdo->prepare($query);  
    $statement->execute([  
        ':name' => $name,  
        ':description' => $description,  
        ':logo_path' => $logo_path,  
        ':id' => $id  
    ]);  
    return $statement->rowCount();
}

//Kuponlar

function addCupon($name, $discount, $restaurantId = null) {  
    include "db.php";  
    $query = "INSERT INTO cupon (restaurant_id, name, discount, created_at) VALUES (:restaurant_id, :name, :discount, NOW())";  
    $statement = $pdo->prepare($query);  
    $statement->execute([  
        ':restaurant_id' => $restaurantId,  
        ':name' => $name,  
        ':discount' => $discount  
    ]);  
}   

function softDeleteCupon($cuponId) {  
    include "db.php";  
    $query = "UPDATE cupon SET deleted_at = NOW() WHERE id = :id";  
    $statement = $pdo->prepare($query);  
    $statement->execute([':id' => $cuponId]);  
}  

function getActiveCupons() {  
    include "db.php";  
    $query = "SELECT * FROM cupon WHERE deleted_at IS NULL";  
    $statement = $pdo->prepare($query);  
    $statement->execute();  
    return $statement->fetchAll();  
}  

function searchCuponByName($name) {  
    include "db.php";  
    $query = "SELECT * FROM cupon WHERE name LIKE :name AND deleted_at IS NULL";  
    $statement = $pdo->prepare($query);  
    $statement->execute([':name' => '%' . $name . '%']);  
    return $statement->fetchAll();  
}  

function updateCupon($id, $name, $discount) {  
    include "db.php";  
    $query = "UPDATE cupon SET name = :name, discount = :discount WHERE id = :id AND deleted_at IS NULL";  
    $statement = $pdo->prepare($query);  
    return $statement->execute([  
        ':id' => $id,  
        ':name' => $name,  
        ':discount' => $discount  
    ]);  
}

function getCuponById($id) {  
    include "db.php";  
    $query = "SELECT * FROM cupon WHERE id = :id AND deleted_at IS NULL";  
    $statement = $pdo->prepare($query);  
    $statement->execute([':id' => $id]);  
    return $statement->fetch();  
} 

//Restoranlar 

function deleteRestaurantById($restaurantId) {  
    include "db.php";  
    $query = "UPDATE restaurant SET deleted_at = NOW() WHERE id = :id";  
    $statement = $pdo->prepare($query);  
    $statement->execute([':id' => $restaurantId]);  
}  

function getRestaurantById($restaurantId) {  
    include "db.php";  
    $query = "SELECT * FROM restaurant WHERE id = :id AND deleted_at IS NULL";  
    $statement = $pdo->prepare($query);  
    $statement->execute([':id' => $restaurantId]);  
    return $statement->fetch();  
}  

function getCompanyByRestaurantId($restaurantId) {  
    include "db.php";  
    $query = "  
        SELECT c.*  
        FROM company c  
        INNER JOIN restaurant r ON c.id = r.company_id  
        WHERE r.id = :restaurantId AND r.deleted_at IS NULL  
    ";  
    $statement = $pdo->prepare($query);  
    $statement->execute([':restaurantId' => $restaurantId]);  
    return $statement->fetch();  
}  

function searchRestaurantByName($name) {  
    include "db.php";  
    $query = "SELECT * FROM restaurant WHERE name LIKE :name AND deleted_at IS NULL";  
    $statement = $pdo->prepare($query);  
    $statement->execute([':name' => '%' . $name . '%']);  
    return $statement->fetchAll();  
}  

function getAllRestaurants() {  
    include "db.php";  
    $query = "SELECT * FROM restaurant WHERE deleted_at IS NULL";  
    $statement = $pdo->prepare($query);  
    $statement->execute();  
    return $statement->fetchAll();  
}  

function addRestaurant($companyId, $name, $description, $image_path) {  
    include "db.php";  
    $query = "INSERT INTO restaurant (company_id, name, description, image_path, created_at) VALUES (:company_id, :name, :description, :image_path, NOW())";  
    $statement = $pdo->prepare($query);  
    $statement->execute([  
        ':company_id' => $companyId,  
        ':name' => $name,  
        ':description' => $description,  
        ':image_path' => $image_path  
    ]);  
}

function updateRestaurant($id, $name, $description, $companyId, $imagePath) {  
    include "db.php";   
    $query = "UPDATE restaurant SET name = :name, description = :description, company_id = :companyId, image_path = :imagePath WHERE id = :id AND deleted_at IS NULL";  
    $statement = $pdo->prepare($query);   
    return $statement->execute([  
        ':id' => $id,  
        ':name' => $name,  
        ':description' => $description,  
        ':companyId' => $companyId,  
        ':imagePath' => $imagePath  
    ]);  
}  

function getOrdersByCompany($company_id) {
    include "db.php"; 
    $query = "
        SELECT 
            o.id AS order_id, 
            o.order_status, 
            o.total_price, 
            o.created_at, 
            r.name AS restaurant_name, 
            u.name AS customer_name, 
            u.surname AS customer_surname
        FROM `order` o
        JOIN `order_items` oi ON o.id = oi.order_id
        JOIN `food` f ON oi.food_id = f.id
        JOIN `restaurant` r ON f.restaurant_id = r.id
        JOIN `users` u ON o.user_id = u.id
        WHERE r.company_id = :company_id
        AND o.order_status IN ('Hazırlanıyor', 'Yolda')
        GROUP BY o.id, o.order_status, o.total_price, o.created_at, r.name, u.name, u.surname
        ORDER BY o.created_at DESC
    ";
    $statement = $pdo->prepare($query);
    $statement->execute([
        ':company_id' => $company_id
    ]);
    $orders = $statement->fetchAll();
    return $orders;
}


function updateOrderStatus($id, $newStatus) {
    include "db.php";
    $query = "UPDATE `order` SET order_status = :order_status WHERE id = :id AND deleted_at IS NULL";
    $statement = $pdo->prepare($query);
    return $statement->execute([
        ':id' => $id,
        ':order_status' => $newStatus
    ]);
}

// Yemek Servisi

function getFoodsByCompany($companyId) {
    include "db.php"; 
    $query = "SELECT food.* FROM food 
              JOIN restaurant ON food.restaurant_id = restaurant.id 
              WHERE restaurant.company_id = :company_id AND food.deleted_at IS NULL";
    
    $statement = $pdo->prepare($query);
    $statement->execute([':company_id' => $companyId]);
    return $statement->fetchAll();
}

function softDeleteFoodById($id) {
    include "db.php";
    $query = "UPDATE food SET deleted_at = NOW() WHERE id = :id";
    $statement = $pdo->prepare($query);
    return $statement->execute([':id' => $id]);
}

function addFood($name, $description, $price, $discount, $restaurantId, $imagePath) {
    include "db.php";
    $query = "INSERT INTO food (name, description, price, discount, restaurant_id, image_path, created_at) 
              VALUES (:name, :description, :price, :discount, :restaurant_id, :image_path, NOW())";
    $statement = $pdo->prepare($query);
    return $statement->execute([
        ':name' => $name,
        ':description' => $description,
        ':price' => $price,
        ':discount' => $discount,
        ':restaurant_id' => $restaurantId,
        ':image_path' => $imagePath
    ]);
}

function updateFoodById($id, $name, $description, $price, $discount, $restaurantId, $imagePath) {
    include "db.php"; 
    $query = "UPDATE food 
              SET name = :name, description = :description, price = :price, discount = :discount,
              restaurant_id = :restaurant_id, image_path = :image_path 
              WHERE id = :id AND deleted_at IS NULL";
    
    $statement = $pdo->prepare($query);
    return $statement->execute([
        ':id' => $id,
        ':name' => $name,
        ':description' => $description,
        ':price' => $price,
        'discount' => $discount,
        ':restaurant_id' => $restaurantId,
        ':image_path' => $imagePath
    ]);
}

function searchFoodByName($name) {
    include "db.php";
    $query = "SELECT * FROM food WHERE name LIKE :name AND deleted_at IS NULL";
    $statement = $pdo->prepare($query);
    $statement->execute([':name' => '%' . $name . '%']);
    return $statement->fetchAll();
}

function getRestaurantsByCompanyId($companyId) {
    include "db.php";
    $query = "SELECT * FROM restaurant WHERE company_id = :companyId AND deleted_at IS NULL";
    $statement = $pdo->prepare($query);
    $statement->execute([':companyId' => $companyId]);
    return $statement->fetchAll();
}

function getCuponsWithoutRestaurant() {
    include "db.php";
    $query = "SELECT * FROM cupon WHERE restaurant_id IS NULL AND deleted_at IS NULL";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}

function updateCuponRestaurantById($id, $restaurant_id) {
    include "db.php";
    $query = "UPDATE cupon SET restaurant_id = :restaurant_id WHERE id = :id AND deleted_at IS NULL";  
    $statement = $pdo->prepare($query);  
    return $statement->execute([
        ':id' => $id,  
        ':restaurant_id' => $restaurant_id 
    ]);
}

function getFoodById($foodId) {  
    include "db.php";  
    $query = "SELECT * FROM food WHERE id = :id AND deleted_at IS NULL";  
    $statement = $pdo->prepare($query);  
    $statement->execute([':id' => $foodId]);  
    return $statement->fetch();  
}

//Profil 

function updateUserById($userId, $name, $surname, $user, $image_path) {  
    include "db.php";  
    $query = "UPDATE users   
              SET name = :name,   
                  surname = :surname,   
                  username = :user,    
                  image_path = :image_path   
              WHERE id = :user_id AND deleted_at IS NULL";  

    $statement = $pdo->prepare($query);  
    return $statement->execute([  
        ':user_id' => $userId,  
        ':name' => $name,  
        ':surname' => $surname,  
        ':user' => $user,    
        ':image_path' => $image_path 
    ]);  
}

// Bakiye

function updateUserBalance($userId, $newBalance) {  
    include "db.php"; 
    $stmt = $pdo->prepare("SELECT balance FROM users WHERE id = :user_id");  
    $stmt->execute([':user_id' => $userId]);  
    $result = $stmt->fetch();  

    $currentBalance = $result['balance'];  
    $updateBalance = $currentBalance + $newBalance;    
    $newquery = "UPDATE users SET balance = :new_balance WHERE id = :user_id";  
    $statement = $pdo->prepare($newquery);  

    return $statement->execute([  
        ':new_balance' => $updateBalance,  
        ':user_id' => $userId  
    ]);  
}

//Sipariş

function getActiveOrders($userId) {  
    include "db.php"; 
    $query = "  
        SELECT o.id AS order_id, o.order_status, o.total_price, f.name AS food_name, oi.quantity  
        FROM `order` o  
        JOIN order_items oi ON o.id = oi.order_id  
        JOIN food f ON oi.food_id = f.id  
        WHERE o.user_id = :user_id AND (o.order_status = 'Hazırlanıyor' OR o.order_status = 'Yolda')  
        ORDER BY o.created_at DESC  
    ";  
    
    $statement = $pdo->prepare($query);  
    $statement->execute([':user_id' => $userId]);  
    return $statement->fetchAll(); 
}

function getPastOrders($userId) {  
    include "db.php"; 
    $query = "  
        SELECT o.id AS order_id, o.order_status, o.total_price, f.name AS food_name, oi.quantity  
        FROM `order` o  
        JOIN order_items oi ON o.id = oi.order_id  
        JOIN food f ON oi.food_id = f.id  
        WHERE o.user_id = :user_id AND o.order_status = 'Teslim Edildi'  
        ORDER BY o.created_at DESC  
    ";  
    $statement = $pdo->prepare($query);  
    $statement->execute([':user_id' => $userId]);  
    return $statement->fetchAll(); 
}

// Anasayfa

function getFoodsWithRestaurants() {
    include "db.php"; 
    $query = "SELECT f.id, f.name as food_name, f.description as food_description, f.price, f.discount, f.image_path as food_image,
                   r.name as restaurant_name, r.id as restaurant_id, r.description as restaurant_description, r.image_path as restaurant_image
            FROM food f
            JOIN restaurant r ON f.restaurant_id = r.id
            WHERE f.deleted_at IS NULL";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}

function getRestaurantRating($restaurant_id) {
    include "db.php"; 
    $query = "SELECT AVG(score) as avg_score FROM comments WHERE restaurant_id = :restaurant_id AND deleted_at IS NULL";
    $statement = $pdo->prepare($query);
    $statement->execute([':restaurant_id' => $restaurant_id]);
    $row = $statement->fetch();
    return round($row['avg_score'], 1);
}

function getFoodPriceWithCoupon($restaurant_id, $price) {
    include "db.php"; 
    $query = "SELECT discount FROM cupon WHERE restaurant_id = :restaurant_id AND deleted_at IS NULL";
    $statement = $pdo->prepare($query);
    $statement->execute([':restaurant_id' => $restaurant_id]);
    $row = $statement->fetch();
    if ($row) {
        $discount = $row['discount'];
        return $price - ($price * ($discount / 100));
    }
    return $price;
}


// Yorumlar

function getCommentsByRestaurantId($restaurantId) {
    include "db.php"; 
    $query = "SELECT c.id, c.surname, c.title, c.description, c.score, c.created_at
            FROM comments c
            WHERE c.restaurant_id = :restaurant_id AND c.deleted_at IS NULL";

        $statement = $pdo->prepare($query);
        $statement->execute([':restaurant_id' => $restaurantId]);
        $comments = $statement->fetchAll();
        return $comments;
}

function addComment($userId, $restaurantId, $surname, $title, $description, $score) {
    include "db.php"; 
    $query = "INSERT INTO comments (user_id, restaurant_id, surname, title, description, score, created_at)
              VALUES (:user_id, :restaurant_id, :surname, :title, :description, :score, NOW())";

    $statement = $pdo->prepare($query);
    $statement->execute([
        ':user_id' => $userId,
        ':restaurant_id' => $restaurantId,
        ':surname' => $surname,
        ':title' => $title,
        ':description' => $description,
        ':score' => $score
    ]);
}

//Sepet

function addToBasket($userId, $foodId, $note, $quantity) {
    include "db.php"; 
    $query = "INSERT INTO basket (user_id, food_id, note, quantity, created_at)
              VALUES (:user_id, :food_id, :note, :quantity, NOW())";

    $statement = $pdo->prepare($query);
    $statement->execute([
        ':user_id' => $userId,
        ':food_id' => $foodId,
        ':note' => $note,
        ':quantity' => $quantity
    ]);
}

function getBasketItems($userId) {
    include "db.php";
    $query = "SELECT b.id, f.name AS food_name, b.note, b.quantity, f.price, f.restaurant_id
              FROM basket b
              JOIN food f ON b.food_id = f.id
              WHERE b.user_id = :user_id AND b.deleted_at IS NULL";
    
    $statement = $pdo->prepare($query);
    $statement->execute([':user_id' => $userId]);
    $items = $statement->fetchAll();
    $basketItems = [];
    foreach ($items as $item) {
        $discountedPrice = getFoodPriceWithCoupon($item['restaurant_id'], $item['price']);
        $basketItems[] = [
            'id' => $item['id'],
            'food_name' => $item['food_name'],
            'note' => $item['note'],
            'quantity' => $item['quantity'],
            'original_price' => $item['price'],
            'discounted_price' => $discountedPrice,
            'total_price' => $discountedPrice * $item['quantity']
        ];
    }
    return $basketItems;
}

function deleteFromBasket($basketId) {
    include "db.php";
    $query = "UPDATE basket SET deleted_at = NOW() WHERE id = :id";
    $statement = $pdo->prepare($query);
    $statement->execute([':id' => $basketId]);
}

function createOrder($userId) {  
    include "db.php";  
     
    $query = "SELECT b.id, b.food_id, b.quantity, f.price, f.restaurant_id   
              FROM basket b   
              JOIN food f ON b.food_id = f.id   
              WHERE b.user_id = :user_id AND b.deleted_at IS NULL";  
              
    $statement = $pdo->prepare($query);  
    $statement->execute([':user_id' => $userId]);  
    $basketItems = $statement->fetchAll();  

    $totalPrice = 0;  
    foreach ($basketItems as $item) {  
        $discountedPrice = getFoodPriceWithCoupon($item['restaurant_id'], $item['price']);  
        $totalPrice += $discountedPrice * $item['quantity'];  
    }  

    $orderQuery = "INSERT INTO `order` (user_id, order_status, total_price) VALUES (:user_id, 'Hazırlanıyor', :total_price)";  
    $orderstatement = $pdo->prepare($orderQuery);  
    $orderstatement->execute([  
        ':user_id' => $userId,  
        ':total_price' => $totalPrice  
    ]);  
    $orderId = $pdo->lastInsertId();  

    foreach ($basketItems as $item) {  
        $discountedPrice = getFoodPriceWithCoupon($item['restaurant_id'], $item['price']);  
        $orderItemsQuery = "INSERT INTO order_items (order_id, food_id, quantity, price)   
                            VALUES (:order_id, :food_id, :quantity, :price)";  
        $orderItemsstatement = $pdo->prepare($orderItemsQuery);  
        $orderItemsstatement->execute([  
            ':order_id' => $orderId,   
            ':food_id' => $item['food_id'],  
            ':quantity' => $item['quantity'],  
            ':price' => $discountedPrice   
        ]);  
          
        deleteFromBasket($item['id']);  
    }   
}
?>