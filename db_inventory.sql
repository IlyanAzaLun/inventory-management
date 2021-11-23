-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 23, 2021 at 11:42 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `invoice_id` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `date_due` varchar(255) NOT NULL,
  `to_customer_destination` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `shipping_cost` varchar(255) NOT NULL,
  `discount` varchar(25) NOT NULL,
  `other_cost` varchar(255) NOT NULL,
  `grand_total` varchar(255) NOT NULL,
  `status_item` tinyint(1) NOT NULL,
  `status_validation` tinyint(1) NOT NULL,
  `status_payment` tinyint(1) NOT NULL,
  `status_settlement` tinyint(1) NOT NULL,
  `status_active` tinyint(1) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`invoice_id`, `date`, `date_due`, `to_customer_destination`, `order_id`, `sub_total`, `shipping_cost`, `discount`, `other_cost`, `grand_total`, `status_item`, `status_validation`, `status_payment`, `status_settlement`, `status_active`, `note`) VALUES
('Iv-0000000001', '1637578143', '1638182943', 'C0001', 'Or-0000000001', '1,550,000', '10,000', '', '10,000', '1,520,000', 1, 0, 1, 1, 1, ''),
('Iv-0000000002', '1637578202', '1638183002', 'C0002', 'Or-0000000002', '250,000', '10,000', '', '10,000', '268,000', 2, 0, 0, 0, 1, 'Langganan'),
('Iv-0000000003', '1637578235', '1638183035', 'C0001', 'Or-0000000003', '2,800,000', '10,000', '', '10,000', '2,790,000', 3, 0, 1, 2, 1, 'langganan'),
('Iv-0000000004', '1637578271', '1638183071', 'C0001', 'Or-0000000004', '200,000', '100,000', '', '10,000', '290,000', 0, 0, 0, 0, 1, ''),
('Iv-0000000005', '1637578511', '1638183311', 'C0002', 'Or-0000000005', '30,000,000', '10,000', '', '10,000', '28,500,000', 0, 0, 0, 0, 0, ''),
('Iv-0000000006', '1637660415', '1638265215', 'C0001', 'Or-0000000006', '1,510,000', '100,000', '10', '10,000', '1,470,000', 0, 0, 0, 0, 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum eius voluptatum, autem consequuntur iusto, praesentium, quo id commodi minima quidem consectetur sit et non ex omnis qui perferendis doloribus, alias.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE `tbl_item` (
  `item_code` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_category` varchar(255) NOT NULL,
  `MG` varchar(255) NOT NULL,
  `ML` varchar(255) NOT NULL,
  `VG` varchar(255) NOT NULL,
  `PG` varchar(255) NOT NULL,
  `falvour` varchar(255) NOT NULL,
  `brand_1` varchar(255) NOT NULL,
  `brand_2` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `unit` varchar(25) NOT NULL,
  `capital_price` varchar(255) NOT NULL,
  `selling_price` varchar(255) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`item_code`, `item_name`, `item_category`, `MG`, `ML`, `VG`, `PG`, `falvour`, `brand_1`, `brand_2`, `quantity`, `unit`, `capital_price`, `selling_price`, `note`) VALUES
('ACC-0001', 'HAT', 'ACC', '', '', '', '', '', '', '', 300, 'pcs', '50.000', '55.000', 'assets/images/LQD-001.jpg'),
('BAT-0001', 'ABC', 'BATTERY', '', '', '', '', '', '', '', 100, 'pcs', '30.000', '40.000', 'Battre AA'),
('LIQ-FC-0001', 'Acai Pomegranate Nic Salt E-Liquid by Bloom', 'LIQUID FREEBASE CREAMY', '12', '12', '12', '12', '50', 'Unknown', '', 300, 'pac', '250.000', '300.000', 'assets/images/LQD-001.jpg'),
('LIQ-SF-0001', 'MARJAN', 'LIQUID SALT FRUITY', '12', '12', '12', '12', 'Orange', 'BED', '', 20, 'pac', '80.000', '950.000', 'Note');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_history`
--

CREATE TABLE `tbl_item_history` (
  `history_id` int(11) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `previous_selling_price` varchar(255) NOT NULL,
  `previous_capital_price` varchar(255) NOT NULL,
  `previous_quantity` varchar(255) NOT NULL,
  `update_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_item_history`
--

INSERT INTO `tbl_item_history` (`history_id`, `item_code`, `previous_selling_price`, `previous_capital_price`, `previous_quantity`, `update_at`) VALUES
(1, 'ACC-0001', '55000', '50000', '300', 1637301630),
(2, 'ACC-0001', '55001', '50001', '298', 1637311571),
(3, 'ACC-0001', '55000', '50000', '298', 1637380025),
(4, 'ACC-0001', '55001', '50001', '300', 1637382338),
(5, 'BAT-0001', '3000', '2500', '0', 1637382351),
(6, 'BAT-0001', '3000', '2500', '0', 1637383084),
(7, 'BAT-0001', '3000', '2500', '10', 1637383110),
(8, 'ACC-0001', '55001', '50001', '300', 1637397827),
(9, 'LIQ-FC-0001', '300000', '250000', '300', 1637397866),
(10, 'BAT-0001', '3.000', '3', '100', 1637397905),
(11, 'BAT-0001', '4', '3', '100', 1637397918),
(12, 'LIQ-SF-0001', '4000000', '2000000', '20', 1637397967),
(13, 'LIQ-SF-0001', '950.000', '900.000', '20', 1637397987);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `index_order` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `unit` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`index_order`, `order_id`, `item_id`, `price`, `quantity`, `unit`) VALUES
('2065915e-3c3a-413e-9425-9466a3d9f1c2', 'Or-0000000006', 'LIQ-SF-0001', '950.000', 1, 'pac'),
('27902fd5-1f8f-4474-8e7d-f0ece5d5db5c', 'Or-0000000006', 'ACC-0001', '55.000', 4, 'pcs'),
('27af44b2-a44d-4aea-a65f-70827af62fae', 'Or-0000000006', 'LIQ-FC-0001', '300.000', 1, 'pac'),
('6a014557-6dab-4564-8aa4-995cd407361b', 'Or-0000000001', 'LIQ-SF-0001', '950.000', 1, 'pac'),
('c51b8517-5c0c-4b28-a0a4-0bd182f68266', 'Or-0000000002', 'LIQ-FC-0001', '300.000', 1, 'pac'),
('c72e5b71-bb57-4922-915e-296ad23b8c66', 'Or-0000000006', 'BAT-0001', '40.000', 1, 'pcs'),
('cc541575-289d-4774-b9ea-472b5f196108', 'Or-0000000003', 'LIQ-SF-0001', '950.000', 3, 'pac'),
('cd79dd58-a2ba-4c5a-a21a-aa0ecf39da89', 'Or-0000000005', 'LIQ-FC-0001', '300.000', 100, 'pac'),
('cda09821-333b-4e66-b0b9-79b58ad23067', 'Or-0000000004', 'BAT-0001', '40.000', 5, 'pcs'),
('e2a6f64a-a450-4e90-8ece-9d2af8e1a5de', 'Or-0000000001', 'LIQ-FC-0001', '300.000', 2, 'pac');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id` varchar(255) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`id`, `role_name`) VALUES
('190f670e-4907-11ec-8cc8-1be21be013bc', 'Marketing'),
('5347d8a4-4925-11ec-8cc8-1be21be013bc', 'Supplier'),
('752c0ad8-4925-11ec-8cc8-1be21be013bc', 'Customer'),
('c046aeb0-40f9-11ec-ae08-0d3b0460d819', 'Administrator'),
('c046d399-40f9-11ec-ae08-0d3b0460d819', 'Finance'),
('df9a5008-49c5-11ec-915b-5cac4cba0f32', 'Shipping');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` varchar(255) NOT NULL,
  `user_fullname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` varchar(128) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `role_id` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_fullname`, `user_email`, `user_image`, `user_password`, `role_id`, `is_active`, `date_created`) VALUES
('50f859c9-73d1-4217-b2e4-7d9e59be7fc4', 'Iyang Agung Supriatna', 'iyang_agung_s@protonmail.com', 'assets/images/default.jpg', '$2y$10$C6IJzcNTEsdxZHelB62J9u/nMOL0Z1kQyK5PWGoI.Wnm/0R4ouX8a', 'c046aeb0-40f9-11ec-ae08-0d3b0460d819', 1, 1636431432),
('ec61343b-6863-43a6-a064-03a9ca551c4d', 'Nurlaila Azizah', 'nurlailahazizah@gmail.com', 'assets/images/default.jpg', '$2y$10$uftpjkRFSEniBKlXUegI7uIG6HqsfAmF6RaPv42AHekTjlHd5HViW', 'c046d399-40f9-11ec-ae08-0d3b0460d819', 1, 1636465803);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_access_menu`
--

CREATE TABLE `tbl_user_access_menu` (
  `id` varchar(255) NOT NULL,
  `role_id` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_access_menu`
--

INSERT INTO `tbl_user_access_menu` (`id`, `role_id`, `category_id`) VALUES
('35a0197f-4129-11ec-ae08-0d3b0460d819', 'c046aeb0-40f9-11ec-ae08-0d3b0460d819', 'dec9f1e2-4127-11ec-ae08-0d3b0460d819'),
('35a0301d-4129-11ec-ae08-0d3b0460d819', 'c046aeb0-40f9-11ec-ae08-0d3b0460d819', 'deca10c9-4127-11ec-ae08-0d3b0460d819'),
('458f224e-4129-11ec-ae08-0d3b0460d819', 'c046d399-40f9-11ec-ae08-0d3b0460d819', 'deca10c9-4127-11ec-ae08-0d3b0460d819'),
('6e33a609-4166-11ec-ae08-0d3b0460d819', 'c046d399-40f9-11ec-ae08-0d3b0460d819', '41baae76-4166-11ec-ae08-0d3b0460d819'),
('6e33bb7b-4166-11ec-ae08-0d3b0460d819', 'c046aeb0-40f9-11ec-ae08-0d3b0460d819', '41baae76-4166-11ec-ae08-0d3b0460d819'),
('6e5f0953-4907-11ec-8cc8-1be21be013bc', 'c046aeb0-40f9-11ec-ae08-0d3b0460d819', '85f50b77-69ec-44e7-8a54-def0e8a1efea'),
('70ce988e-415c-11ec-ae08-0d3b0460d819', 'c046aeb0-40f9-11ec-ae08-0d3b0460d819', '85f50b77-69ec-44e7-8a54-def0e8a1efec'),
('70ceb125-415c-11ec-ae08-0d3b0460d819', 'c046d399-40f9-11ec-ae08-0d3b0460d819', '85f50b77-69ec-44e7-8a54-def0e8a1efec'),
('962123a9-4907-11ec-8cc8-1be21be013bc', '190f670e-4907-11ec-8cc8-1be21be013bc', '85f50b77-69ec-44e7-8a54-def0e8a1efea'),
('96213c68-4907-11ec-8cc8-1be21be013bc', 'c046d399-40f9-11ec-ae08-0d3b0460d819', '85f50b77-69ec-44e7-8a54-def0e8a1efea');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_information`
--

CREATE TABLE `tbl_user_information` (
  `user_id` varchar(255) NOT NULL,
  `user_fullname` varchar(255) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `user_address` text NOT NULL,
  `village` varchar(255) NOT NULL,
  `sub-district` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `user_contact_phone` varchar(15) NOT NULL,
  `user_contact_email` varchar(35) NOT NULL,
  `role_id` varchar(255) NOT NULL,
  `type_id` varchar(255) NOT NULL COMMENT 'WS, Agen Biasa, Agen Special, Distri, Dll',
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_information`
--

INSERT INTO `tbl_user_information` (`user_id`, `user_fullname`, `owner_name`, `user_address`, `village`, `sub-district`, `district`, `province`, `zip`, `user_contact_phone`, `user_contact_email`, `role_id`, `type_id`, `note`) VALUES
('50f859c9-73d1-4217-b2e4-7d9e59be7fc4', 'Iyang Agung Supriatna', '', 'Jl. Tanjungkerta, Dsn. Panteneun Rt 004/Rw 006', 'Ds Licin', 'Kec. Cimalaka', 'Kab. Sumedang', 'Prov. Jawabarat', '432345', '628986102327', 'iyang_agung_s@protonmail.com', 'c046aeb0-40f9-11ec-ae08-0d3b0460d819', '', 'Administrator'),
('C0001', 'Alphine', 'Alpha sagala', 'Jl. Sunda 30,', 'Margaluyu', 'Cimaung', 'Bandung', 'Jawabarat', '346345', '8099923847', 'Alphine@admin.com', '752c0ad8-4925-11ec-8cc8-1be21be013bc', 'Agen biasa', 'Customer'),
('C0002', 'Relife', 'John Doe', 'St. 123, ABC', 'Downtown', 'Subdistrict', 'Distric', 'USA', '987234', '98972093842', 'johndoe@example.com', '752c0ad8-4925-11ec-8cc8-1be21be013bc', 'Agen biasa', 'Customer'),
('S0001', 'Supseller', 'Jhonson', 'St. 423 D', 'A', 'B', 'C', 'D', '345098', '09283097345', 'Jhon@mail.com', '5347d8a4-4925-11ec-8cc8-1be21be013bc', 'Supplier', 'Supplier');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_menu`
--

CREATE TABLE `tbl_user_menu` (
  `menu_id` varchar(255) NOT NULL,
  `parent_id` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `menu_controller` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_menu`
--

INSERT INTO `tbl_user_menu` (`menu_id`, `parent_id`, `category_id`, `title`, `url`, `menu_controller`, `icon`, `is_active`) VALUES
('0db37be1-41fa-464d-8a29-a3772811884b', '', '85f50b77-69ec-44e7-8a54-def0e8a1efec', 'Barang', '', '', 'fa fa-tw fa-box', 1),
('14f5eed6-0fac-4375-a7d3-bb51f28d3c86', 'a93e3526-4134-11ec-ae08-0d3b0460d819', 'dec9f1e2-4127-11ec-ae08-0d3b0460d819', 'Peran', 'configuration/role', 'Role', 'fa fa-tw fa-dice', 1),
('203419ab-490a-11ec-8cc8-1be21be013bc', '', '85f50b77-69ec-44e7-8a54-def0e8a1efec', 'Pelanggan', 'customer', 'customer', 'fas fa-tw fa-child', 1),
('2a34eff1-b6aa-4eee-b2ed-feafb892719f', 'a93e3526-4134-11ec-ae08-0d3b0460d819', 'dec9f1e2-4127-11ec-ae08-0d3b0460d819', 'Daftar pengguna', 'user', 'user', 'fa fa-tw fa-users', 1),
('2b008579-4135-11ec-ae08-0d3b0460d819', 'a93e3526-4134-11ec-ae08-0d3b0460d819', 'dec9f1e2-4127-11ec-ae08-0d3b0460d819', 'Menu', 'configuration/menu', 'Menu', 'fas fa-tw fa-th-large', 1),
('34bb5023-c344-4a17-afcf-b5a986e7911c', '', '85f50b77-69ec-44e7-8a54-def0e8a1efea', 'Penjualan', 'sale', 'selling', 'fa fa-tw fa-file-invoice text-danger', 1),
('52eacc07-eed3-43e8-9e93-0310749aa3be', '0db37be1-41fa-464d-8a29-a3772811884b', '85f50b77-69ec-44e7-8a54-def0e8a1efec', 'Tambah barang', 'items', 'Items', 'far fa-tw fa-circle text-primary', 1),
('9dd386cb-4909-11ec-8cc8-1be21be013bc', '', '85f50b77-69ec-44e7-8a54-def0e8a1efec', 'Pemasok', 'supplier', 'supplier', 'fas fa-tw fa-people-carry', 1),
('a14b5cea-6c32-436c-a474-09ff17b934bd', '', 'deca10c9-4127-11ec-ae08-0d3b0460d819', 'Riwayat aktivitas', 'activity', 'activity', 'fas fa-tw fa-history', 1),
('a87acd37-4166-11ec-ae08-0d3b0460d819', '', '41baae76-4166-11ec-ae08-0d3b0460d819', 'Dashboard', 'dashboard', 'Welcome', 'fas fa-tachometer-alt', 1),
('a93e3526-4134-11ec-ae08-0d3b0460d819', '', 'dec9f1e2-4127-11ec-ae08-0d3b0460d819', 'Konfigurasi', '', '', 'fa fa-tw fa-cog', 1),
('b6f27b24-4128-11ec-ae08-0d3b0460d819', '', 'deca10c9-4127-11ec-ae08-0d3b0460d819', 'Profilku', 'user', '', 'fas fa-tw fa-user', 1),
('f5902e19-08f5-4e7e-91d5-9295e167012b', '', '85f50b77-69ec-44e7-8a54-def0e8a1efea', 'Pembelian', 'purchase', 'purchasing', 'fa fa-tw fa-file-invoice text-warning', 1),
('f8b6ef10-eb05-4fb7-bb19-66866379bf49', '0db37be1-41fa-464d-8a29-a3772811884b', '85f50b77-69ec-44e7-8a54-def0e8a1efec', 'Tambah persediaan barang', 'stocks', 'stock', 'far fa-tw fa-circle text-primary', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_menu_category`
--

CREATE TABLE `tbl_user_menu_category` (
  `category_id` varchar(255) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_menu_category`
--

INSERT INTO `tbl_user_menu_category` (`category_id`, `category_name`) VALUES
('41baae76-4166-11ec-ae08-0d3b0460d819', ''),
('85f50b77-69ec-44e7-8a54-def0e8a1efea', 'INVOICE'),
('85f50b77-69ec-44e7-8a54-def0e8a1efec', 'MASTER DATA'),
('dec9f1e2-4127-11ec-ae08-0d3b0460d819', 'CONFIGURATION'),
('deca10c9-4127-11ec-ae08-0d3b0460d819', 'INFORMATION');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD PRIMARY KEY (`item_code`);

--
-- Indexes for table `tbl_item_history`
--
ALTER TABLE `tbl_item_history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`index_order`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_access_menu`
--
ALTER TABLE `tbl_user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_information`
--
ALTER TABLE `tbl_user_information`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_menu`
--
ALTER TABLE `tbl_user_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `tbl_user_menu_category`
--
ALTER TABLE `tbl_user_menu_category`
  ADD PRIMARY KEY (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_item_history`
--
ALTER TABLE `tbl_item_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
