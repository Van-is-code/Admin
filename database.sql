CREATE DATABASE IF NOT EXISTS xmouse CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE xmouse;

DROP TABLE IF EXISTS brand;

-- DROP TABLE IF EXISTS gallery;

DROP TABLE IF EXISTS `order`;

DROP TABLE IF EXISTS order_details;

DROP TABLE IF EXISTS product;

DROP TABLE IF EXISTS role;

DROP TABLE IF EXISTS tokenLogin;

DROP TABLE IF EXISTS image;

DROP TABLE IF EXISTS user;

CREATE TABLE brand
(
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(200),
   created_at DATETIME NULL,
  updated_at DATETIME NULL,
   `image` varchar(255) DEFAULT NULL
);

CREATE TABLE product
(
  id INT PRIMARY KEY AUTO_INCREMENT,
  brand_id INT,
  product_name TEXT NULL,
  price FLOAT NULL,
  description VARCHAR(500) NULL,
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  product_code VARCHAR(100)UNIQUE,
  infor_name VARCHAR(255),
  detail VARCHAR(500),
  youtube_link VARCHAR(500),
  size VARCHAR(200),
  weight VARCHAR(200),
  shape VARCHAR(200),
  switch_type VARCHAR(200),
  sensor_type VARCHAR(200),
  warranty VARCHAR(200),
  FOREIGN KEY (brand_id) REFERENCES brand(id)
);

CREATE TABLE image
(
  id INT PRIMARY KEY AUTO_INCREMENT,
  product_id INT NOT NULL,
  image_1 VARCHAR(255),
  image_2 VARCHAR(255),
  image_3 VARCHAR(255),
  image_4 VARCHAR(255),
  image_5 VARCHAR(255),
  FOREIGN KEY (product_id) REFERENCES product(id)
);

CREATE TABLE `order`
(
  id INT PRIMARY KEY AUTO_INCREMENT,
  first_name VARCHAR(100) NULL,
  last_name VARCHAR(100) NULL,
  region VARCHAR(100) NULL,
  address VARCHAR(255) NULL,
  city VARCHAR(100) NULL,
  postal_code VARCHAR(80) NULL,
  card_number INT NULL,
  expiration_date DATETIME NULL,
  security_code VARCHAR(80) NULL,
  name_on_card VARCHAR(100) NULL
 
);

CREATE TABLE order_details
(
  id INT PRIMARY KEY AUTO_INCREMENT,
  order_id INT NOT NULL,
  product_id INT NOT NULL,
  price FLOAT NULL DEFAULT 0.0000,
  quantity INT NULL DEFAULT 0,
  total_money FLOAT NULL DEFAULT 0.0000,
   created_at DATETIME NULL,
  updated_at DATETIME NULL,
   order_code VARCHAR(255) NULL UNIQUE,
  FOREIGN KEY (order_id) REFERENCES `order`(id),
  FOREIGN KEY (product_id) REFERENCES product(id)
);


CREATE TABLE user
(
  id INT PRIMARY KEY AUTO_INCREMENT,
  firstname VARCHAR(100) NULL,
  lastname VARCHAR(100) NULL,
  password VARCHAR(255) NULL,
  email VARCHAR(100) UNIQUE NULL,
  forgot_token VARCHAR(200) NULL,
  active_token VARCHAR(200) NULL,
  status TINYINT NULL,
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  user_code VARCHAR(100) UNIQUE
);

CREATE TABLE admin (
  id INT PRIMARY KEY AUTO_INCREMENT,
  firstname VARCHAR(100) NULL,
  lastname VARCHAR(100) NULL,
  password VARCHAR(255) NULL,
  email VARCHAR(150) UNIQUE NULL,
  admin_code VARCHAR(150) UNIQUE,
  created_at DATETIME NULL,
  updated_at DATETIME NULL
);

CREATE TABLE tokenLogin
(
  id INT PRIMARY KEY AUTO_INCREMENT,
  token VARCHAR(255) NULL,
  user_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES user(id)
);

-- Đang đổ dữ liệu cho bảng `admin`
INSERT INTO `admin` (`id`, `firstname`, `lastname`, `password`, `email`, `admin_code`, `created_at`, `updated_at`) VALUES
(2, 'Nguyễn Thanh', 'Vân', 'Van02092005', 'thanhvancbg1@gmail.com', 'Admin667cc7d983092', NULL, '2024-06-27 09:00:57'),
(3, 'Nguyễn Quốc', 'Khánh', 'khanhadmin123', 'quockhanhadmin@gmail.com', 'Admin667cc80230b96', NULL, '2024-06-27 09:01:38'),
(4, 'Nguyễn Thanh', 'Phong', 'thanhphong2005', 'thanhphongadmin@gmail.com', 'Admin667cc82724a99', NULL, '2024-06-27 09:02:15'),
(5, 'Bạch Ngọc ', 'Anh', 'ngocanh2005', 'ngocanhadmin@gmail.com', 'Admin667cc86f7c78e', NULL, '2024-06-27 09:03:27'),
(9, 'Lê Nhật', 'Huy', 'nhathuyadmin2005', 'nhathuyadmin@gmail.com', 'Admin667cc8ab492e2', NULL, '2024-06-27 09:04:27'),
(10, 'Admin', '1', 'admin123', 'admin@gmail.com', 'Admin667cc8e9866a4', NULL, '2024-06-27 09:05:29');

-- Đang đổ dữ liệu cho bảng `brand`
INSERT INTO `brand` (`id`, `name`, `created_at`, `updated_at`, `image`) VALUES
(1, 'Ajazz', '2024-06-27 05:37:44', NULL, '667c98381ae4b.png'),
(2, 'Attack Shark', '2024-06-27 05:38:02', NULL, '667c984a8716b.webp'),
(3, 'Delux', '2024-06-27 05:38:25', NULL, '667c98611037b.png'),
(4, 'EndGame', '2024-06-27 05:38:52', NULL, '667c987c2bcef.png'),
(5, 'Finalmouse', '2024-06-27 05:39:13', NULL, '667c98911d12c.png'),
(6, 'Hyperwork', '2024-06-27 05:39:33', NULL, '667c98a57edf1.png'),
(7, 'Lamzu', '2024-06-27 05:40:05', NULL, '667c98c556592.png'),
(8, 'Mchose', '2024-06-27 05:40:37', NULL, '667c98e5e3cee.png'),
(9, 'Ninjutso', '2024-06-27 05:40:58', NULL, '667c98fac8e93.png'),
(10, 'Pwnage', '2024-06-27 05:41:14', NULL, '667c990a26028.jpg'),
(11, 'Razer', '2024-06-27 05:42:00', NULL, '667c9938175da.png'),
(12, 'Asus', '2024-06-27 05:42:53', NULL, '667c996de576d.png'),
(13, 'VGN', '2024-06-27 05:43:24', NULL, '667c998c98ddd.png'),
(14, 'Zowie', '2024-06-27 05:44:20', NULL, '667c99c43fc19.png'),
(15, 'Pulsar', '2024-06-27 05:45:17', NULL, '667c99fdf03fc.avif'),
(16, 'Xtrfy', '2024-06-27 05:45:58', NULL, '667c9a26c256d.avif'),
(17, 'Steelseries', '2024-06-27 05:46:24', NULL, '667c9a4027624.png'),
(18, 'Vancer', '2024-06-27 07:51:59', NULL, '667cb7af3e95f.avif'),
(19, 'Glorious', '2024-06-27 07:58:26', NULL, '667cb9328e421.png');

-- Đang đổ dữ liệu cho bảng `product`
INSERT INTO `product` (`id`, `brand_id`, `product_name`, `price`, `description`, `created_at`, `updated_at`, `product_code`, `infor_name`, `detail`, `youtube_link`, `size`, `weight`, `shape`, `switch_type`, `sensor_type`, `warranty`) VALUES
(1, 5, 'Finalmouse Starlight Pro - TenZ Limited Edition', 181.82, 'Breakthrough, Innovation, and Creativity are the words that describe Finalmouse: a company founded to create mice and products in a creative and unique way, different from the rest of the world. Following the ScreaM One mouse—a collaboration with the legendary headshot machine ScreaM, famous in the CSGO community and currently in Valorant—Finalmouse&#039;s name has reached a global level.\r\nFinalmouse pioneered the ultra-light mouse movement with the Ultralight Pro, a legendary mouse that forever changed the gaming mouse industry with its ultra-lightweight, hollow design to optimize weight and balance distribution. All Finalmouse products are known for being limited editions that sell out within hours. If you have the chance to own a Finalmouse mouse, it is undoubtedly a gem in your gaming mouse collection.', '2024-06-27 07:29:37', NULL, 'FSPTLD', 'Wireless Mouse Made from Ultra-Light Magnesium', 'Finalmouse collaborated with Tyson &quot;TenZ&quot; Ngo, one of the most famous players in the game Valorant, to create the special edition Starlight Pro TenZ mouse. This ultra-lightweight wireless mouse features a shell made of ultra-durable magnesium metal, setting it apart significantly from other products worldwide.\r\nThe Starlight Pro TenZ is equipped with the high-precision Finalsensor, capable of up to 450 IPS, allowing gamers to execute high-speed and accurate maneuvers. Its Tournament Wi', 'https://www.youtube.com/watch?v=eTAl-MfcjMM', '121 x 56.7 x 36.7 mm', '~47 grams', 'Ambidextrous', 'Kailh GM 8.0', ' Finalsensor, 20,000 DPI, 450+ IPS', '  24 months'),
(2, 9, 'Ninjutso Sora', 98.32, 'Designed for claw grip and suitable for fingertip grip, the Ninjutso Sora weighs just 45 grams. Combined with the latest Pixart PAW3395 sensor, low-latency SnappyFire wireless technology, and a battery life of up to 70 hours, the Ninjutso Sora is meticulously crafted to help you aim and track targets easily, providing the highest advantage in your matches.', '2024-06-27 07:33:45', NULL, 'NS001', 'Super light weight and no holes!', 'The best mouse Ninjutso has ever created, the Sora, features the latest frame design and new material research to minimize side flex and creaking. With no holes and a weight of just 45 grams, it&#039;s one of the lightest and most robust medium-sized mice on the market today.', 'https://www.youtube.com/watch?v=EdtcYZl2KPs&ab_channel=PhongC%C3%A1chXanh', '120.8mm x 59mm x 37.3mm', '45g (+/- 2g)', 'Symmetrical', 'Huano Pink Dot', 'Pixart PAW3395, 26,000 DPI, 650 IPS, 50g acceleration', ' 12 months replacement'),
(3, 7, 'Lamzu Thorn', 98.25, 'Supports 4KHz wireless connectivity. Nordic MCU chip.\r\nNew ergonomic design with a high back.\r\nUltra-lightweight at only 52 grams.', '2024-06-27 07:38:00', '2024-06-27 07:38:37', 'LH001', 'Lamzu Thorn - The latest ergonomic wireless gaming mouse from Lamzu.', 'As a newcomer in the FPS gaming mouse scene, Lamzu proves it is no amateur, with many reviewers worldwide considering it one of the most outstanding and worth-trying new brands in recent years.', 'https://www.youtube.com/watch?v=SUNw3b6ae3o&t=1s&ab_channel=PhongC%C3%A1chXanh', '119 x 65 x 42 mm', '52g', 'Ergonomic design', 'Optical Switch', 'Pixart PAW3395, 26,000 DPI, 650 IPS, 50g acceleration', ' 12 months replacement'),
(4, 15, 'Pulsar X2H', 98.25, 'Internal structure redesigned to reduce weight and increase sturdiness\r\nSupports 4000Hz report rate with Nordic MCU (4000Hz dongle sold separately)\r\nVarious small improvements to enhance user experience\r\nDesigned in Korea', '2024-06-27 07:42:13', NULL, 'PX2H', 'Pulsar X2H - Higher back, narrower sides', 'Introducing the Pulsar X2H, a brand new ultra-lightweight mouse in the X2 series with a higher back design compared to the original X2. Featuring the high-performance PAW3395 sensor and premium Nordic MCU, it ensures the best gaming experience. Combined with 2.4GHz lag-free wireless technology, it delivers the highest responsiveness for gaming.', 'https://www.youtube.com/watch?v=mQLwSZMDTJY&ab_channel=PhongC%C3%A1chXanh', '120mm x 65mm x 39mm', '54g (+/- 1g)', ' Symmetrical with a high hump', 'Optical Switch', 'Pixart PAW3395 , 26,000 DPI , 650 IPS , 50g acceleration', ' 24 months replacement'),
(5, 10, 'Pwnage StormBreaker', 147.04, 'Weighing only 51g and made from magnesium metal: 33% lighter than aluminum, 50% lighter than titanium, and 75% lighter than steel.\r\nPolling rate of 2000Hz: balances mouse latency and computer processing capability. Latest Pixart PAW3395 sensor: 26,000 DPI, 650 IPS.\r\nNordic nRF52840 MCU optimizes connectivity performance and battery life: 120 hours on a 2-hour charge.', '2024-06-27 07:46:17', NULL, 'PSB210', 'Made from premium magnesium alloy', 'Feel the premium magnesium alloy in the palm of your hand.', 'https://www.youtube.com/watch?v=7wdutOL1uy8&ab_channel=PhongC%C3%A1chXanh', ' 122 x 64 x 42 mm', ' ~51 grams', 'Ergonomic design', 'Omron 20M', 'Pixart PAW3395 , 26,000 DPI , 650 IPS , 50 G', ' 12 months'),
(6, 16, 'CHERRY Xtrfy M8', 64.83, 'The Xtrfy M8 gaming mouse is a top-tier wireless mouse with exceptional performance and a unique design. Featuring a low-profile front, the Xtrfy M8 Wireless is specially designed to enhance control and precision.', '2024-06-27 07:49:34', NULL, 'CXM8', 'The All-New Xtrfy M8!', 'Introducing the Xtrfy M8 Wireless - the latest gaming mouse from the storied gaming gear family of Cherry Xtrfy, hailing from Sweden in Northern Europe.', 'https://www.youtube.com/watch?v=4cDLNDc10iI&ab_channel=PhongC%C3%A1chXanh', '118 x 60.5 x 38.5 mm', '55 g', 'Symmetrical with a low-profile front', 'Kailh GM 8.0', 'Pixart PAW3395 26,000 DPI, 650 IPS, 50 G, Motion Sync support (can be enabled/disabled)', ' 12 months replacement'),
(7, 18, 'Vancer Thrash', 125.34, 'Exclusive Feature: Integrated LCD Screen on Wireless Dongle\r\nMulti-Information Display: Battery, DPI, polling rate, LOD, Motion Sync.\r\nPatented by Vancer (registered exclusively)', '2024-06-27 07:55:09', NULL, 'VT271', 'Perfect Design', 'Vancer Thrash and Groove are designed for professional gamers and gaming gear enthusiasts who are always seeking the most comfortable mouse shapes to achieve the highest gaming performance.', 'https://www.youtube.com/watch?v=QZjUk9sGUpg&ab_channel=Krozah', '123 x 62 x 40 mm', '49 ± 2 grams', 'Symmetrical, right-hand oriented', 'Huano Blue Shell Pink Dot Transparent', ' Pixart PAW3395 26,000 DPI, 650 IPS, 50g acceleration', '  12 months replacement'),
(8, 19, 'Glorious model D pro', 59.39, 'Battery life of over 80 hours.\r\nExclusive Glorious BAMF sensor with 19,000 DPI - 400 IPS.\r\nGlorious switches with 80 million clicks durability.\r\n100% pure PTFE mouse feet.\r\nCompletely redesigned shell mold.\r\nTextured surface for enhanced grip.', '2024-06-27 08:01:33', NULL, 'GMDP', 'Forge Edition - Limited edition version only sold once!', 'The Glorious Model D Pro is the latest wireless mouse model but is produced in limited quantities through the Glorious Forge project. With a range of improvements such as a weight of 58 grams, no holes, 80 million click switches, and the latest Glorious BAMF sensor, it will not disappoint you. Especially, this is a limited edition product - you can only own it through pre-order and a Glorious Forge logo on the product confirms that you are one of the pioneers to own this limited edition mouse.', 'https://www.youtube.com/watch?v=skJpXXDo6FY&source_ve_path=OTY3MTQ&feature=emb_imp_woyt', '128 x 42 x 67 mm', '58g', 'Ergonomic design', 'Glorious 80 million clicks', 'Glorious BAMF, 100 - 19000 DPI, 400 IPS', ' 24 months for replacement'),
(9, 19, 'Glorious model O wireless', 90.9, 'Exclusive Glorious BAMF Sensor - 19000 DPI / 400 IPS.\r\nBattery life of 71 hours.\r\n100% pure PTFE G-Skates mouse feet.\r\nGlorious CORE software for advanced parameter adjustments.\r\nOmron switch with 20 million clicks.', '2024-06-27 08:05:34', NULL, 'GMOW', 'The legendary Model O is now available in a wireless version!', 'The Glorious Model O Wireless is the most successful mouse from Glorious to date. This model has sparked the ultra-lightweight wireless mouse trend that is currently very popular! Weighing only 69g, you can comfortably use the mouse all day without worrying about hand fatigue or wrist pain like with other heavier mice.', 'https://www.youtube.com/watch?v=PiwNLAeKSrs&ab_channel=Th%E1%BA%BFGi%E1%BB%9BiPh%E1%BB%A5Ki%E1%BB%87n', '128 x 38 x 66 mm', '69g', 'Ambidextrous', 'Omron 20 million clicks', 'Glorious BAMF, 100 - 19,000 DPI, 400 IPS', ' 24 months for replacement'),
(10, 19, 'Glorious model O', 50.65, 'Via ultra-flexible, anti-tangle Ascended Cord\r\nPixArt PMW3360, 12,000 DPI, 250+ IPS\r\nG-Skates, 100% pure PTFE\r\nOmron, 20 million clicks', '2024-06-27 08:07:56', NULL, 'GMO', 'Glorious Model O - Glorious&#039; Most Successful Mouse of All Time', 'As the first and most successful mouse line from Glorious, the Model O pioneered the era of ultra-light mice for everyone. This prestigious model has won numerous awards for Glorious since its launch. The Glorious Model O features an ambidextrous shape with dimensions suitable for medium to large hands, making it comfortable for all grip styles.', 'https://www.youtube.com/watch?v=o_9Q7xPLe1U&ab_channel=DrDebox', '128 x 38 x 66 mm', '67g (excluding cable)', 'Ambidextrous', ' Omron 20 million clicks', 'PixArt PMW3360, 100 - 12,000 DPI, 250 IPS', ' 24 months for replacement'),
(11, 11, 'Razer DeathAdder V3 Pro Wireless', 123.38, 'UPGRADEABLE TO TRUE 8K HZ WIRELESS POLLING RATE.\r\nRAZER FOCUS PRO 30K OPTICAL SENSOR.', '2024-06-27 08:13:05', NULL, 'RDV3', 'Ultra lightweight.', 'With its incredible weight optimization, the Razer DeathAdder V3 Pro is one of the lightest ergonomic esports mice ever created—all while improving upon its user experience.', 'https://www.youtube.com/watch?v=GwfHj7uYXak&ab_channel=Insidegram', '128 x 68 x 44 mm', ' 64g', 'Ergonomic design', ' Optical Gen-3', 'Focus Pro 30K Optical Sensor', NULL),
(12, 12, 'ROG Harpe Ace Aim Lab Edition', 149.99, 'Pro-Tested Form Factor.\r\nAim Lab Settings Optimizer.\r\nLightweight 54-gram design.\r\nROG AimPoint optical sensor.\r\nROG SpeedNova wireless technology.\r\nROG Paracord and 100% PTFE mouse feet.', '2024-06-27 08:17:21', NULL, 'ROGHE', 'Choose Your ROG Harpe Ace Aim Lab Edition', 'Pro-Tested Form Factor: Mouse shape co-developed with esports professionals to ensure maximum stability and control when flicking and tracking\r\nAim Lab Settings Optimizer: Synergistic software analyzes user strengths and play styles to tailor mouse settings uniquely to the player\r\nLightweight 54-gram design: Extreme weight reduction through meticulous engineering and innovative bio-based nylon material construction\r\nROG AimPoint optical sensor: Next-gen 36,000‑dpi optical sensor with industry-le', 'https://www.youtube.com/watch?v=Y854VLwC8do&ab_channel=Tinht%E1%BA%BF', '', '', '', '', '', ' '),
(13, 17, 'Steelseries Prime+', 78.19, 'The unique design of Prestige OM™ switches is crafted for professional-level gaming intensity. Utilizing neodymium magnets to deliver the most stable clicks ever, with durability up to 100 million clicks, it sets a new standard in the industry. Prestige OM™ switches also employ infrared light beams to ensure lightning-fast response times in gaming.', '2024-06-27 08:20:38', NULL, 'SPP', 'Victory is everything.', 'Developed in collaboration with world-leading esports professionals, every aspect of the SteelSeries Prime+ gaming mouse is meticulously designed with one goal in mind: VICTORY', 'https://www.youtube.com/watch?v=SaWaAHkXKys&ab_channel=TheProvokedPrawn', '125.3 x 59 x 23 mm', '71 grams (Without the cable).', ' Ergonomic, Right-Handed', 'Prestige OM™ mechanical switches', 'SteelSeries TrueMove Pro+', ' '),
(14, 4, 'Endgame Gear OP1we Wireless', 86.05, 'Optimized claw grip design\r\nSwitch Kailh GO Optical, the latest generation\r\nStable 1000Hz connection', '2024-06-27 08:24:13', NULL, 'EGOW', '', '', 'https://www.youtube.com/watch?v=iNkbSROceKs&ab_channel=hausgaming', '118.2 x 60.5 x 37.2 mm', '58.5 g', 'Symmetrical', 'Kailh GO Optical', 'PixArt PAW3370 19000 CPI, 50 G, 400 IPS', ' '),
(15, 8, 'Mchose A5 Pro Max', 98.25, 'Top-tier optical sensor.\r\nUltra-lightweight structure.\r\nMain controller NORDIC.', '2024-06-27 08:28:16', NULL, 'MA5PX', 'Mchose A5 Pro Max.', 'Unfortunately, I don&#039;t have information or details specifically about the Mchose A5 Pro mouse as it seems to be a product released after my last update. If you have specific features or aspects you&#039;d like to discuss or analyze about the Mchose A5 Pro, feel free to ask!', 'https://www.youtube.com/watch?v=KIbdcDIlrB0&ab_channel=RVEverything', '123 x 61 x 39 mm', ' 58g', 'Symmetrical', 'Optical Switch', 'Pixart PAW3395, 26,000 DPI, 650 IPS, 50g acceleration', ' '),
(16, 2, 'Attack Shark X3', 36.54, '49g SUPERLIGHT, PixArt PAW3395 Gaming Sensor, BT/2.4G Wireless/Wired, 6 Adjustable DPI up to 26000, 200 hrs Battery.', '2024-06-27 08:35:09', NULL, 'ASX3', 'ATTACK SHARK X3.', 'As a newcomer in the FPS gaming mouse scene, Lamzu proves it is no amateur, with many reviewers worldwide considering it one of the most outstanding and worth-trying new brands in recent years.', 'https://www.youtube.com/watch?v=ByDcUtnDDo0&ab_channel=Lagry', ' 118.5 x 61 x 39.7 mm', '49g±3g', 'Symmetrical', 'KAILH SWITCH', '', ' '),
(19, 13, 'VGN Dragonfly F1', 45.99, 'Supports 4KHz wireless connectivity. Nordic MCU chip.\r\nNew ergonomic design with a high back.\r\nUltra-lightweight at only 52 grams.', '2024-06-27 08:40:58', NULL, 'VGNF1', 'Elevate Your Gaming Experience.', 'Unleash your potential with the VGN Dragonfly F1 Series Ultra-Lightweight Wireless Mouse. Crafted for gamers who demand precision, speed, and comfort, this exceptional gaming mouse boasts a plethora of cutting-edge features that redefine your gaming encounters.\r\nUltra-Lightweight Performance: Weighing in at just 49g, the Dragonfly F1 Series features a revolutionary lightweight design that defies imagination. Its ultra-lightweight mold and ergonomic curved buttons ensure fatigue-free gaming sessi', 'https://www.youtube.com/watch?v=iZlxz90xohE&ab_channel=in%E5%A4%96%E8%AE%BE', '121,2 x 63,5 x 37,6mm', ' 49g', 'Symmetrical', 'Kailh Golden Black Manbo Micro', 'Pixart PAW3395, 26,000 DPI, 650 IPS, 50g acceleration', ' '),
(20, 6, 'HyperWork Helios', 42.83, 'Symmetrical Design: Suitable for both Palm and Claw Grip.\r\nWireless Gaming Mouse featuring Pixart PAW3395 sensor and 3 connectivity modes: Wired, Wireless 2.4G, and Bluetooth.\r\nSuper lightweight, weighing only 59 grams.', '2024-06-27 08:44:35', NULL, 'HWH1', 'HyperWork Helios.', 'Helios is HyperWork&#039;s first gaming mouse aimed at users seeking high performance and a unique user experience.', 'https://www.youtube.com/watch?v=3g37YtvtGkQ&ab_channel=Tinht%E1%BA%BF', '118 x 60 x 36mm', ' 59g (±2g)', '', '', 'Pixart PAW3395, 26,000 DPI, 650 IPS, 50g acceleration', '  12 months replacement'),
(21, 14, 'Zowie U2', 129.27, 'Wireless mouse, symmetrical design specifically tailored for eSports gaming.\r\nA symmetrical design with curved sides maximizes flexibility for movement in various angles.\r\nSimple plug and play connectivity, no drivers required', '2024-06-27 08:51:50', NULL, 'ZU2', 'U2 Wireless eSports Gaming Mouse', 'Tailor-made for Claw-Grip; Optimize multi-angle movement.', 'https://www.youtube.com/watch?v=AZTrSYquqQI&ab_channel=Insidegram', '124 x 65 x 58 mm', ' 60g', 'Symmetrical', '', 'PAW3395', ' 12 months'),
(22, 3, 'Delux M800 Pro', 34.97, 'Lightweight symmetrical design.\r\nPro Gaming Sensor—PAW3370.\r\nKaihua GM8.0.\r\nTTC Wheel Encoder.', '2024-06-27 08:57:10', NULL, 'DM8P', 'Lightweight symmetrical design. Pro Gaming Sensor—PAW3370. Kaihua GM8.0. TTC Wheel Encoder.', '', 'https://www.youtube.com/watch?v=MVS0j6rNzXA&t=1s&ab_channel=Kh%C3%B4ngT%E1%BB%8Bch', '123.6 x 63.8 x 38.3 mm', '70g±3g', '', 'Kaihua GM8.0', '', ' 12 months');

-- Đang đổ dữ liệu cho bảng `image`
INSERT INTO `image` (`id`, `product_id`, `image_1`, `image_2`, `image_3`, `image_4`, `image_5`) VALUES
(1, 1, '667cb27107aec.webp', '667cb27107af0.webp', '667cb27107af1.webp', '667cb27107af2.webp', '667cb27107af3.webp'),
(2, 2, '667cb36930301.webp', '667cb36930308.webp', '667cb36930309.webp', '667cb3693030a.webp', '667cb3693030b.webp'),
(3, 3, '667cb46871f8e.webp', '667cb46871f94.webp', '667cb46871f95.webp', '667cb46871f96.webp', '667cb46871f97.webp'),
(4, 4, '667cb565036e6.webp', '667cb565036eb.webp', '667cb565036ec.webp', '667cb565036ed.webp', '667cb565036ee.webp'),
(5, 5, '667cb65905b1e.webp', '667cb65905b23.webp', '667cb65905b24.webp', '667cb65905b25.webp', '667cb65905b26.webp'),
(6, 6, '667cb71e784f3.webp', '667cb71e784f9.webp', '667cb71e784fb.webp', '667cb71e784fc.webp', '667cb71e784fd.webp'),
(7, 7, '667cb86ddcbb0.webp', '667cb86ddcbb4.webp', '667cb86ddcbb5.webp', '667cb86ddcbb6.webp', '667cb86ddcbb7.webp'),
(8, 8, '667cb9eda8daa.webp', '667cb9eda8db1.webp', '667cb9eda8db2.webp', '667cb9eda8db3.webp', '667cb9eda8db4.webp'),
(9, 9, '667cbade6d701.webp', '667cbade6d706.webp', '667cbade6d707.webp', '667cbade6d708.jpg', '667cbade6d709.jpg'),
(10, 10, '667cbb6c2682b.webp', '667cbb6c26830.webp', '667cbb6c26831.webp', '667cbb6c26832.webp', '667cbb6c26833.webp'),
(11, 11, '667cbca1ca39a.webp', '667cbca1ca39e.webp', '667cbca1ca39f.webp', '667cbca1ca3a0.webp', '667cbca1ca3a1.webp'),
(12, 12, '667cbda113fa1.webp', '667cbda113fa7.webp', '667cbda113fa8.webp', '667cbda113fa9.webp', '667cbda113faa.webp'),
(13, 13, '667cbe66bccda.webp', '667cbe66bccde.png', '667cbe66bccdf.png', '667cbe66bcce0.webp', '667cbe66bcce1.webp'),
(14, 14, '667cbf3de68d7.webp', '667cbf3de68dd.webp', '667cbf3de68de.webp', '667cbf3de68df.webp', '667cbf3de68e0.webp'),
(15, 15, '667cc0300c0b7.png', '667cc0300c0bc.png', NULL, NULL, NULL),
(16, 16, '667cc1cd94f59.jpg', '667cc1cd94f5e.webp', NULL, NULL, NULL),
(17, 19, '667cc32acbe51.webp', '667cc32acbe5a.webp', '667cc32acbe5b.webp', NULL, NULL),
(18, 20, '667cc40344a42.webp', '667cc40344a47.webp', '667cc40344a48.webp', NULL, NULL),
(19, 21, '667cc5b6c07db.webp', '667cc5b6c07e0.webp', '667cc5b6c07e1.webp', '667cc5b6c07e2.webp', '667cc5b6c07e3.webp'),
(20, 22, '667cc6f678479.png', '667cc6f67847f.png', '667cc6f678480.png', NULL, NULL);
COMMIT;
