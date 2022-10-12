-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 12, 2022 at 02:17 PM
-- Server version: 10.9.2-MariaDB-log
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `funatic`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(96) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `category` varchar(64) DEFAULT NULL,
  `tags` varchar(128) DEFAULT NULL,
  `featured_image` varchar(128) DEFAULT NULL,
  `meta_title` varchar(128) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `published_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `author_id`, `title`, `slug`, `content`, `category`, `tags`, `featured_image`, `meta_title`, `meta_description`, `published`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Neque porro quisquam est qui dolorem ipsum', 'neque-porro-quisquam-est-qui-dolorem-ipsum', '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eu orci urna. Integer ut justo urna. Fusce tincidunt enim dictum nulla imperdiet sodales. Proin sit amet arcu vitae justo pulvinar accumsan eu vel arcu. Aenean vel dapibus sem. Donec a magna mattis, ornare sem vel, feugiat neque. Aliquam varius auctor augue, sed lacinia magna ultrices et. Phasellus id erat nec nisi interdum dignissim hendrerit id ex. Duis malesuada, dolor eu luctus sodales, enim magna malesuada lacus, a accumsan felis est eu nisi. Sed pretium nunc nunc, vel volutpat nibh mollis interdum. Etiam ut rhoncus erat. Aliquam efficitur quam interdum felis aliquet, ac tincidunt libero commodo. Fusce ligula erat, sollicitudin rhoncus tempus in, dapibus nec erat. Phasellus malesuada tellus mi, non semper ex semper eu. Vestibulum nec dolor dolor. Duis tincidunt neque a augue eleifend malesuada.</div><div><br></div><div>Praesent a lacus vitae arcu ultrices molestie ut et ipsum. Integer justo neque, pellentesque nec lacus ac, viverra eleifend neque. Pellentesque sed urna ullamcorper, porttitor nisl non, fermentum neque. Etiam maximus tristique justo id iaculis. Donec non est est. Mauris volutpat gravida nisl, et ultrices nisi sollicitudin at. Aliquam lectus nunc, venenatis non diam non, fringilla accumsan neque. Duis luctus lacus a dolor pellentesque rutrum. Fusce et euismod sem.</div><div><br></div><div>Aliquam tempus commodo elit. Aliquam eget leo mi. Etiam nec augue efficitur, iaculis turpis et, malesuada mi. Aliquam ac placerat lectus. Nulla pharetra laoreet dolor, vel aliquet nisl bibendum sit amet. Cras dui erat, eleifend pretium luctus in, pharetra eu magna. In hac habitasse platea dictumst. Sed libero ligula, placerat eget ligula eget, consequat aliquet lacus. Cras dignissim porta tellus. Integer suscipit rutrum mauris, sit amet sagittis nisi iaculis sed. In sagittis rhoncus blandit. Aenean interdum est turpis, eu aliquet ante vulputate in.</div><div><br></div><div>Maecenas porta orci a nisl eleifend faucibus. Praesent ullamcorper lorem at neque consequat, ut ornare nisi rutrum. Nunc pellentesque sem sed rutrum posuere. Phasellus nec nunc quam. Quisque pellentesque ligula pulvinar sem tempus consequat. Donec ultrices nulla diam, et luctus ante sodales non. Duis vel neque eget sem fringilla suscipit. Fusce nec aliquet ligula. Quisque consequat sagittis rhoncus. Suspendisse felis leo, laoreet hendrerit sodales eget, ultrices ut augue. Ut semper dictum varius. Suspendisse laoreet pulvinar nisi a fringilla. Phasellus dictum lorem quis fringilla imperdiet. Suspendisse vestibulum ac felis eu scelerisque. Nam euismod sollicitudin quam vel porta. In a sapien ornare, mattis neque vitae, hendrerit nulla.</div><div><br></div><div>Nulla molestie metus ac eleifend gravida. Integer vel tempus risus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus vel purus orci. Nullam mollis elit in turpis aliquam, ut iaculis ipsum feugiat. Ut quis orci lorem. Quisque quis gravida urna. Nulla consectetur lorem vitae vulputate maximus. Fusce et consectetur mi. Vestibulum ac imperdiet ante. Duis posuere leo eu diam faucibus venenatis. Cras nisi nulla, dignissim sit amet viverra in, semper non eros.</div>', 'Mobile Legends', 'game, tournament', 'f4fbb5102a73ec6e48948bdbcd91949b.jpeg', 'Neque porro quisquam est qui dolorem ipsum - Funatic Game Store', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eu orci urna. Integer ut justo urna. Fusce tincidunt enim dictum nulla imperdiet sodales.', 1, '2022-10-04 09:16:31', '2022-10-04 09:16:31', '2022-10-04 09:40:04'),
(2, 1, 'Maecenas commodo ligula eu aliquet lacinia', 'maecenas-commodo-ligula-eu-aliquet-lacinia', '<div>Maecenas commodo ligula eu aliquet lacinia. Mauris a odio tempus, pellentesque orci in, aliquam justo. Curabitur congue accumsan eros ut suscipit. Nullam vel leo lectus. Fusce lacinia dui vitae pulvinar fermentum. In blandit ligula metus. Aliquam non purus non mi euismod pharetra eu sed eros. Maecenas vitae nunc aliquam, convallis massa quis, consectetur orci. Proin laoreet velit a neque ultricies, et fringilla ligula sodales. Integer tempus tempor ante a pretium. Sed aliquet magna imperdiet imperdiet efficitur. Praesent tristique suscipit sodales. In pretium aliquet porttitor. Ut sed pretium orci.</div><div><br></div><div>Integer vestibulum eget felis eu varius. Duis scelerisque nec urna efficitur placerat. Pellentesque porttitor elementum lorem, ullamcorper semper magna aliquam ac. Nam diam purus, vulputate quis efficitur at, placerat a risus. Donec auctor id risus id luctus. Donec eleifend diam eu augue semper sodales. Etiam ultricies dignissim scelerisque. Ut lobortis enim ut orci condimentum vehicula. Duis accumsan id nibh eu bibendum. Morbi ut nisi a lorem efficitur iaculis. Suspendisse fermentum a sem id imperdiet. In sapien risus, lobortis a eleifend eu, molestie nec enim. Nunc eget fringilla massa. Morbi ut dui varius, molestie purus et, fringilla augue. Nullam blandit erat nunc, lacinia luctus ipsum aliquam sed. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</div><div><br></div><div>Quisque tempor, purus vitae consequat fringilla, felis ligula tempor enim, dictum mollis nunc dui eu tellus. Curabitur eget lacus velit. Maecenas vulputate leo sit amet tortor consectetur eleifend. Duis eleifend nisi quis enim laoreet consequat. Integer blandit volutpat turpis vitae sagittis. Integer a quam ullamcorper, malesuada ipsum in, egestas tellus. Mauris eget augue augue. Phasellus consectetur magna et lorem imperdiet, ut mattis nibh varius.</div><div><br></div><div>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam a diam ipsum. Fusce et justo id nisl semper blandit. Ut nibh odio, tincidunt quis lacinia vel, rhoncus nec felis. In egestas sit amet mi vitae fringilla. Phasellus tempor eleifend dolor, sed ornare quam aliquet quis. Cras at consectetur eros. Vivamus sed augue orci. Pellentesque non consequat arcu, at posuere est. Etiam bibendum malesuada rhoncus. Mauris commodo tristique nisl bibendum scelerisque. Suspendisse tristique libero mi, eget euismod lectus rutrum sit amet. Vestibulum nec purus ac justo auctor feugiat. Vestibulum id accumsan elit. Aenean eu nisi maximus est pulvinar consequat. Suspendisse laoreet venenatis vestibulum.</div>', 'Mobile Legends', '', NULL, 'Maecenas commodo ligula eu aliquet lacinia - Funatic Game Store', 'Maecenas commodo ligula eu aliquet lacinia. Mauris a odio tempus, pellentesque orci in, aliquam justo. Curabitur congue accumsan eros ut suscipit.', 1, '2022-10-04 11:21:30', '2022-10-04 11:21:30', '2022-10-04 11:23:31'),
(3, 1, 'Ut luctus at nisl id semper', 'ut-luctus-at-nisl-id-semper', '<div>Ut luctus at nisl id semper. Nullam volutpat laoreet est nec tempor. Pellentesque eu mi nunc. Nullam ac consequat augue. Duis molestie, arcu et fermentum fringilla, risus dui hendrerit purus, vel tristique diam erat quis magna. Nunc dapibus leo eu tincidunt pretium. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nec nulla ac augue tempor imperdiet vitae ac eros. Praesent elementum libero sit amet arcu convallis commodo. Integer scelerisque convallis consequat. Nam vel lorem et sapien eleifend semper.</div><div><br></div><div>Nunc et erat ultricies, mollis risus quis, congue tortor. Cras a dignissim nisl. Ut erat nisi, tempor id metus in, vehicula sodales sapien. Pellentesque semper nibh augue, non congue lorem laoreet maximus. Quisque nec ante vitae diam mattis vestibulum in vel enim. Suspendisse eu blandit magna, vel vestibulum ex. Maecenas sit amet metus at libero aliquet blandit. Vivamus varius eget eros nec sagittis. Nullam tincidunt sit amet sapien vel sagittis. Donec tempus sapien id blandit maximus. Proin et aliquet ex. Vivamus in urna ac urna fringilla tincidunt. Donec placerat elit eget ornare finibus. Fusce viverra, lorem id pharetra congue, eros ex pellentesque elit, ut eleifend urna est sed lectus. Vestibulum consectetur aliquet ipsum, eu vehicula eros luctus ut.</div><div><br></div><div>Nunc non congue erat, quis dignissim mi. Aliquam cursus tincidunt ex id posuere. Mauris eget consequat purus. Nunc eu dolor auctor, interdum arcu sed, ullamcorper velit. Phasellus aliquet rhoncus ante ac elementum. Curabitur a mauris luctus, aliquam purus vitae, placerat risus. In suscipit nisl purus, eu porttitor eros aliquam eget. Mauris turpis velit, tincidunt a massa hendrerit, semper finibus elit. Mauris vitae feugiat nisl. Morbi massa mauris, lacinia ut ex sit amet, pulvinar aliquet mi. Cras tempus, metus id ullamcorper fringilla, lectus ex venenatis velit, sit amet ultrices leo justo ut massa. Cras id quam id risus consectetur aliquam. Duis luctus tellus quis quam maximus feugiat. Donec eu eros vitae velit auctor cursus sed a quam.</div><div><br></div><div>Fusce imperdiet fringilla nisi sed dignissim. Cras eget mi nec odio bibendum cursus et ut lacus. Nunc at nibh elit. Ut ac placerat elit. Integer gravida nisl risus. In rutrum magna arcu, vitae semper sem egestas ut. Vestibulum interdum nulla ligula, ac interdum nulla euismod at.</div><div><br></div><div>Phasellus blandit odio at ultricies sagittis. Sed vehicula ex a malesuada porta. Nam sagittis, lorem vel condimentum blandit, metus quam venenatis velit, a consectetur lorem quam id ligula. Morbi tempor purus nunc, a volutpat urna pharetra id. Nam tempor felis posuere sodales maximus. Nunc sed pharetra tellus. Fusce facilisis ipsum non neque maximus, nec tincidunt risus egestas. Donec sit amet volutpat nunc. Integer sed lorem mauris. Donec vel risus blandit, venenatis dui non, laoreet magna. Ut non feugiat justo. Curabitur laoreet laoreet quam placerat volutpat.</div>', 'Mobile Legends', '', NULL, 'Ut luctus at nisl id semper - Funatic Game Store', 'Ut luctus at nisl id semper. Nullam volutpat laoreet est nec tempor. Pellentesque eu mi nunc. Nullam ac consequat augue. Duis molestie, arcu et fermentum fringilla', 1, '2022-10-04 11:22:17', '2022-10-04 11:22:17', '2022-10-04 11:23:41');

-- --------------------------------------------------------

--
-- Table structure for table `buyers`
--

CREATE TABLE `buyers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(16) NOT NULL,
  `buyer_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`buyer_data`)),
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'member', 'Default group');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` bigint(20) NOT NULL,
  `sender_id` bigint(20) NOT NULL,
  `receiver_id` bigint(20) NOT NULL,
  `title` varchar(64) NOT NULL,
  `message` text NOT NULL,
  `read_on` datetime DEFAULT NULL,
  `sent_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `option_name` varchar(64) NOT NULL,
  `option_value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_name`, `option_value`) VALUES
('site_name', 'Funatic Game Store'),
('site_description', 'Funatic Game Store adalah penyedia layanan voucher game dan jasa joki mobile legend terbaik di Indonesia'),
('author', 'Aditia Pratama Saputra'),
('email', 'aditiap493@gmail.com'),
('timezone', 'Asia/Jakarta'),
('accent_color', 'danger');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `variation_id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_id` varchar(255) NOT NULL,
  `no_invoice` varchar(128) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_price` decimal(18,2) NOT NULL,
  `payment_name` varchar(255) DEFAULT NULL,
  `pay_code` varchar(255) DEFAULT NULL,
  `pay_url` varchar(255) DEFAULT NULL,
  `checkout_url` varchar(255) DEFAULT NULL,
  `status_payment` tinyint(1) NOT NULL DEFAULT 0,
  `status_transaction` tinyint(1) NOT NULL DEFAULT 0,
  `keterangan` varchar(255) DEFAULT NULL,
  `payment_expired` varchar(16) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(96) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `category` varchar(64) DEFAULT NULL,
  `featured_image` varchar(128) DEFAULT NULL,
  `quantity_active` tinyint(1) DEFAULT 0,
  `quantity_field` varchar(128) DEFAULT NULL,
  `customer_id_field` varchar(128) DEFAULT NULL,
  `phone_field` varchar(128) DEFAULT NULL,
  `custom_field` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`custom_field`)),
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `published_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `content`, `category`, `featured_image`, `quantity_active`, `quantity_field`, `customer_id_field`, `phone_field`, `custom_field`, `published`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'Diamond Fast', 'diamond-fast', '<p>Proses Otomatis<br><span style=\"font-size: 1rem;\">Open 24 Jam</span></p><p><span style=\"font-size: 1rem;\">Cara Order :</span></p><ol><li><span style=\"font-size: 1rem;\">Pilih Nominal Diamond</span></li><li><span style=\"font-size: 1rem;\">Pilih Metode Pembayaran</span></li><li><span style=\"font-size: 1rem;\">Masukkan User ID &amp; Zone ID (digabung)</span></li><li><span style=\"font-size: 1rem;\">Masukkan nomor WhatsApp yg benar!</span></li><li><span style=\"font-size: 1rem;\">Klik Beli &amp; lakukan Pembayaran</span></li><li><span style=\"font-size: 1rem;\">Diamond masuk otomatis ke akun Anda</span></li></ol>', 'Mobile Legends', '75e5a3aca7f9df1dabf1af6169cf6682.jpg', 0, '', 'player_id', 'phone', '[{\"type\":\"number\",\"required\":true,\"label\":\"Masukkan ID\",\"description\":\"Masukkan User ID & Zone ID Jadi Satu\",\"placeholder\":\"E.g. 157228049XXXX\",\"className\":\"form-control\",\"name\":\"player_id\"},{\"type\":\"number\",\"required\":true,\"label\":\"No. WhatsApp\",\"description\":\"Masukkan nomor whatsapp diawali dengan angka 0\",\"placeholder\":\"E.g. 08123456XXXX\",\"className\":\"form-control\",\"name\":\"phone\"}]', 1, '2022-09-28 15:04:01', '2022-09-28 15:04:01', '2022-10-06 00:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variation_code` varchar(32) NOT NULL,
  `variation_name` varchar(96) NOT NULL,
  `variation_price` decimal(18,2) NOT NULL,
  `additional_price` decimal(18,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `fromwhere` enum('myself','thirdparty') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`id`, `product_id`, `variation_code`, `variation_name`, `variation_price`, `additional_price`, `status`, `fromwhere`, `created_at`, `updated_at`) VALUES
(1, 1, 'ML3', 'MOBILELEGEND - 3 Diamond', '1195.00', '700.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(2, 1, 'ML12', 'MOBILELEGEND - 12 Diamond', '3450.00', '500.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(3, 1, 'ML14', 'MOBILELEGEND - 14 Diamond', '3500.00', '900.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(4, 1, 'ML50', 'MOBILELEGEND - 50 Diamond', '13214.00', '1000.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(5, 1, 'ML74', 'MOBILELEGEND - 74 Diamond', '18750.00', '1000.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(6, 1, 'ML86', 'MOBILELEGEND - 86 Diamond', '18880.00', '1100.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(7, 1, 'ML112', 'MOBILELEGEND - 112 Diamond', '25975.00', '2000.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(8, 1, 'ML172', 'MOBILELEGEND - 172 Diamond', '37465.00', '3000.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(9, 1, 'ML185', 'MOBILELEGEND - 185 Diamond', '45650.00', '4000.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(10, 1, 'ML222', 'MOBILELEGEND - 222 Diamond', '56000.00', '5000.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(11, 1, 'ML257', 'MOBILELEGEND - 257 Diamond', '56000.00', '10000.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(12, 1, 'ML284', 'MOBILELEGEND - 284 Diamond', '63390.00', '5000.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(13, 1, 'ML296', 'MOBILELEGEND - 296 Diamond', '72500.00', '5000.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(14, 1, 'ML350', 'MOBILELEGEND - 350 Diamond', '82900.00', '5000.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(15, 1, 'ML370', 'MOBILELEGEND - 370 Diamond', '87000.00', '10000.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(16, 1, 'ML415', 'MOBILELEGEND - 415 Diamond', '98500.00', '15000.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(17, 1, 'ML568', 'MOBILELEGEND - 568 Diamond', '133000.00', '20000.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(18, 1, 'ML706', 'MOBILELEGEND - 706 Diamond', '150400.00', '25000.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(19, 1, 'ML875', 'MOBILELEGEND - 875 Diamond', '192000.00', '30000.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(20, 1, 'ML1000', 'MOBILELEGEND - 1000 Diamond', '225300.00', '35000.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(21, 1, 'ML1159', 'MOBILELEGEND - 1159 Diamond', '269000.00', '40000.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(22, 1, 'ML2010', 'MOBILELEGEND - 2010 Diamond', '467000.00', '50000.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(23, 1, 'ML2195', 'MOBILELEGEND - 2195 Diamond', '451940.00', '40000.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(24, 1, 'ML3688', 'MOBILELEGEND - 3688 Diamond', '750000.00', '70000.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(25, 1, 'ML4830', 'MOBILELEGEND - 4830 Diamond', '1095025.00', '75000.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(26, 1, 'ML5532', 'MOBILELEGEND - 5532 Diamond', '1149000.00', '51000.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(27, 1, 'ML6050', 'MOBILELEGEND - 6050 Diamond', '1400025.00', '49975.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(28, 1, 'ML7502', 'MOBILELEGEND - 7502 Diamond', '1615000.00', '100000.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21'),
(29, 1, 'ML36', 'MOBILELEGEND - 36 Diamond', '10105.00', '1000.00', 1, 'thirdparty', '2022-10-12 12:04:24', '2022-10-12 16:15:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(254) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `avatar` varchar(128) DEFAULT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `uuid` varchar(64) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `fullname`, `phone`, `company`, `avatar`, `last_login`, `uuid`, `ip_address`, `active`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`) VALUES
(1, 'admin@funatic.id', 'administrator', '$argon2id$v=19$m=2048,t=1,p=1$eks4TEdMMWxtRzZna05GWA$A2wGpsXdQpYIMCSBhLxziD1bivndOf1wENiO5ndoSMM', 'Administrator', '085219842984', '-', 'default.png', 1665550298, '7c270c35-855b-528d-622f-9a3e2c04b177', '127.0.0.1', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1653917341),
(2, 'customer@funatic.id', 'customer', '$argon2id$v=19$m=2048,t=1,p=1$M042SDhCU3BNY285bFY4Qw$F5n+3YNb/zHTUx+W2I5M8kjzwFpdX4z87/ZsUuajLl8', 'Customer Funatic', '', '', NULL, NULL, 'df70389e-5c62-f12c-e916-348d1876fb21', '127.0.0.1', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1665125437);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(2, 1, 1),
(3, 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phone` (`phone`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_invoice` (`no_invoice`),
  ADD UNIQUE KEY `transaction_id` (`transaction_id`),
  ADD KEY `product_variation_id` (`variation_id`),
  ADD KEY `buyer_id` (`buyer_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `variation_code` (`variation_code`),
  ADD KEY `id` (`product_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `buyers`
--
ALTER TABLE `buyers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
