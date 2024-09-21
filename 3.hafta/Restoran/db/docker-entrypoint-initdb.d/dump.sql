-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 21 Eyl 2024, 20:06:21
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `food_management`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `basket`
--

INSERT INTO `basket` (`id`, `user_id`, `food_id`, `note`, `quantity`, `created_at`, `deleted_at`) VALUES
(1, 1, 1, 'Extra spicy', 2, '2024-09-21 17:43:10', NULL),
(2, 1, 2, 'No onions', 1, '2024-09-21 17:43:10', NULL),
(3, 2, 3, 'Less salt', 3, '2024-09-21 17:43:10', NULL),
(4, 3, 1, '', 1, '2024-09-21 17:43:10', '2024-09-21 18:00:36'),
(5, 3, 4, 'Allergic to nuts', 1, '2024-09-21 17:43:10', '2024-09-21 18:00:36'),
(6, 3, 4, 'acısız olsun', 2, '2024-09-21 17:52:17', '2024-09-21 18:00:36'),
(7, 3, 1, 'acısız olsun', 1, '2024-09-21 18:01:05', NULL),
(8, 3, 2, 'acılı olsun', 1, '2024-09-21 18:01:14', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `restaurant_id`, `surname`, `title`, `description`, `score`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 1, 'Doe', 'Great Food', 'The food at Restaurant A1 was amazing!', 5, '2024-09-21 17:42:40', '2024-09-21 17:42:40', NULL),
(2, 1, 2, 'Smith', 'Nice Place', 'Restaurant A2 has a great ambiance.', 4, '2024-09-21 17:42:40', '2024-09-21 17:42:40', NULL),
(3, 2, 3, 'Brown', 'Loved It', 'I really enjoyed my meal at Restaurant B1.', 5, '2024-09-21 17:42:40', '2024-09-21 17:42:40', NULL),
(4, 2, 1, 'Johnson', 'Not Bad', 'Food A1 was okay.', 3, '2024-09-21 17:42:40', '2024-09-21 17:42:40', NULL),
(5, 3, 3, 'Williams', 'Perfect', 'I will definitely come back!', 5, '2024-09-21 17:42:40', '2024-09-21 17:42:40', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `logo_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `company`
--

INSERT INTO `company` (`id`, `name`, `description`, `logo_path`, `created_at`, `deleted_at`) VALUES
(1, 'Company A', 'Description for Company A', './uploads/anime.png', '2024-09-21 17:41:28', NULL),
(2, 'Company B', 'Description for Company B', './uploads/anime.png', '2024-09-21 17:41:28', NULL),
(3, 'Company C', 'Description for Company C', './uploads/anime.png', '2024-09-21 17:41:28', NULL),
(4, 'Company D', 'Description for Company D', './uploads/anime.png', '2024-09-21 17:41:28', NULL),
(5, 'Company E', 'Description for Company E', './uploads/anime.png', '2024-09-21 17:41:28', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cupon`
--

CREATE TABLE `cupon` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `cupon`
--

INSERT INTO `cupon` (`id`, `restaurant_id`, `name`, `discount`, `created_at`, `deleted_at`) VALUES
(1, 1, 'Discount 10%', 10.00, '2024-09-21 17:42:55', NULL),
(2, 1, 'Discount 20%', 20.00, '2024-09-21 17:42:55', NULL),
(3, 2, 'Discount 5%', 5.00, '2024-09-21 17:42:55', NULL),
(4, 3, 'Free Drink', 0.00, '2024-09-21 17:42:55', NULL),
(5, 3, 'Discount 15%', 15.00, '2024-09-21 17:42:55', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `food`
--

INSERT INTO `food` (`id`, `restaurant_id`, `name`, `description`, `image_path`, `price`, `discount`, `created_at`, `deleted_at`) VALUES
(1, 1, 'Food A1', 'Description for Food A1', './uploads/anime.png', 10.00, 0.00, '2024-09-21 17:42:16', NULL),
(2, 1, 'Food A2', 'Description for Food A2', './uploads/anime.png', 15.00, 1.00, '2024-09-21 17:42:16', NULL),
(3, 2, 'Food A3', 'Description for Food A3', './uploads/anime.png', 8.00, 0.00, '2024-09-21 17:42:16', NULL),
(4, 3, 'Food B1', 'Description for Food B1', './uploads/anime.png', 12.00, 2.00, '2024-09-21 17:42:16', NULL),
(5, 3, 'Food B2', 'Description for Food B2', './uploads/anime.png', 5.00, 0.00, '2024-09-21 17:42:16', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_status` varchar(255) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `order`
--

INSERT INTO `order` (`id`, `user_id`, `order_status`, `total_price`, `created_at`, `deleted_at`) VALUES
(1, 1, 'Teslim edildi', 25.00, '2024-09-21 17:43:25', NULL),
(2, 2, 'Hazırlanıyor', 31.00, '2024-09-21 17:43:25', NULL),
(3, 3, 'Yolda', 50.00, '2024-09-21 17:43:25', NULL),
(4, 1, 'Teslim edildi', 10.00, '2024-09-21 17:43:25', NULL),
(5, 2, 'Hazırlanıyor', 15.00, '2024-09-21 17:43:25', NULL),
(6, 3, 'Hazırlanıyor', 45.00, '2024-09-21 18:00:36', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `food_id`, `quantity`, `price`, `deleted_at`) VALUES
(1, 1, 1, 2, 20.00, NULL),
(2, 1, 2, 1, 5.00, NULL),
(3, 2, 3, 1, 8.00, NULL),
(4, 3, 4, 2, 20.00, NULL),
(5, 4, 1, 1, 10.00, NULL),
(6, NULL, 1, 1, 9.00, NULL),
(7, NULL, 4, 1, 12.00, NULL),
(8, NULL, 4, 2, 12.00, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `restaurant`
--

INSERT INTO `restaurant` (`id`, `company_id`, `name`, `description`, `image_path`, `created_at`, `deleted_at`) VALUES
(1, 1, 'Restaurant A1', 'Description for Restaurant A1', './uploads/anime.png', '2024-09-21 17:41:47', NULL),
(2, 1, 'Restaurant A2', 'Description for Restaurant A2', './uploads/anime.png', '2024-09-21 17:41:47', NULL),
(3, 2, 'Restaurant B1', 'Description for Restaurant B1', './uploads/anime.png', '2024-09-21 17:41:47', NULL),
(4, 2, 'Restaurant B2', 'Description for Restaurant B2', './uploads/anime.png', '2024-09-21 17:41:47', NULL),
(5, 3, 'Restaurant C1', 'Description for Restaurant C1', './uploads/anime.png', '2024-09-21 17:41:47', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `balance` decimal(10,2) DEFAULT 5000.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `company_id`, `role`, `name`, `username`, `password`, `balance`, `created_at`, `deleted_at`, `image_path`, `surname`) VALUES
(1, NULL, 'admin', 'admin', 'admin', '$argon2id$v=19$m=65536,t=4,p=1$RThFRFRkQVVWYTNNL2hmUQ$1ToWUklOBN/kqTr9LVBGsQmhjNJArVWqqjTCFbNh5uk', 500.00, '2024-09-21 17:35:11', NULL, './uploads/anime.png', 'admin'),
(2, NULL, 'company', 'frieren', 'frieren', '$argon2id$v=19$m=65536,t=4,p=1$a0s2ak0yeDhEQ095TGZ2VA$XJ5vbbjnsaLrJU24079kWX9XlDw8xJUDpWEbFZGNi7k', 5000.00, '2024-09-21 17:36:47', NULL, './uploads/anime.png', 'elf'),
(3, NULL, 'customer', 'fern', 'fern', '$argon2id$v=19$m=65536,t=4,p=1$Lk9DUURsVXoyVDRtcXRSbA$r8IpVutHMDGEnpwej3h8rMBC4cg9TRqbtxy2U5Gy4u0', 4001.00, '2024-09-21 17:37:16', NULL, './uploads/anime.png', 'stark');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Tablo için indeksler `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Tablo için indeksler `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `cupon`
--
ALTER TABLE `cupon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Tablo için indeksler `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Tablo için indeksler `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Tablo için indeksler `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Tablo için indeksler `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `cupon`
--
ALTER TABLE `cupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `basket_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`);

--
-- Tablo kısıtlamaları `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`);

--
-- Tablo kısıtlamaları `cupon`
--
ALTER TABLE `cupon`
  ADD CONSTRAINT `cupon_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`);

--
-- Tablo kısıtlamaları `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`);

--
-- Tablo kısıtlamaları `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`);

--
-- Tablo kısıtlamaları `restaurant`
--
ALTER TABLE `restaurant`
  ADD CONSTRAINT `restaurant_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Tablo kısıtlamaları `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
