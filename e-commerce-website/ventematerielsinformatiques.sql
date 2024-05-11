-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 11, 2023 at 11:44 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ventematerielsinformatiques`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `code_categorie` int NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`code_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`code_categorie`, `nom_categorie`) VALUES
(1, 'PCs'),
(2, 'phones'),
(12, 'electoménager'),
(13, 'impremmerie');

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `mode_paiement` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel_user` varchar(255) NOT NULL,
  `montant` int NOT NULL,
  `etat` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'non accepté ',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`id`, `id_user`, `adresse`, `mode_paiement`, `email`, `tel_user`, `montant`, `etat`) VALUES
(30, '18', 'sakiet eddaier', 'cache', 'd@enis.tn', '27450039', 4200, 'accepté'),
(26, '17', 'sidi mansour', 'cache', 'n@enis.tn', '74747474', 32976, 'accepté'),
(29, '18', 'sakiet eddaier', 'cache', 'd@enis.tn', '27450039', 1400, 'accepté');

-- --------------------------------------------------------

--
-- Table structure for table `commandeproduit`
--

DROP TABLE IF EXISTS `commandeproduit`;
CREATE TABLE IF NOT EXISTS `commandeproduit` (
  `id_commande` int NOT NULL,
  `id_produit` int NOT NULL,
  `quantite` int DEFAULT NULL,
  PRIMARY KEY (`id_commande`,`id_produit`),
  KEY `id_produit` (`id_produit`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `commandeproduit`
--

INSERT INTO `commandeproduit` (`id_commande`, `id_produit`, `quantite`) VALUES
(29, 19, 1),
(30, 19, 3),
(26, 7, 2),
(26, 11, 4);

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  `BrandName` varchar(20) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `prix` double NOT NULL,
  `qte` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `feature` int NOT NULL,
  `code_categorie` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `produit_categorie` (`code_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `BrandName`, `designation`, `prix`, `qte`, `image`, `feature`, `code_categorie`) VALUES
(3, 'Smartphone Apple IPhone 11, 128Go, Ecran 6.1\" -Black', 'Iphone', 'iPhone 11, Écran Liquid Retina HD IPS 6.1\" (1792x828p), résistant à la poussière et à l’eau (IP68), Processeur Puce A13 Bionic (CPU 6core, GPU 4core), Stockage 128Go, Appareil photo Arriere Double 12Mpx ultra grand-angle et grand-angle, Appareil Avant 12M', 2289, 5, 'inc/images/produitImg/bestseller3.webp', 1, 2),
(4, 'Pc Portable Asus Chromebook (CX1400), Celeron N3350, 8Go, 14\" FHD', 'ASUS', 'PC Portable Asus Chromebook CX1400CNA-EK0101, Processeur Intel® Celeron™ N3350( jusqu’à 2,4 GHz, 2 Mo cache), Mémoire : RAM 8Go, Stockage : 32Go eMMC, Graphique : Intel UHD Graphics, Connectique : 2x USB 3.2 Gen 1 Type-A 2x USB 3.2 Gen 1 Type-C prenant en', 939, 50, 'inc/images/produitImg/asus2.webp', 0, 1),
(5, 'Pc Portable Asus Chromebook 15 (CX1500), Pentium N6000, 8Go, 15.6\" FHD', 'ASUS', 'PC Portable Asus Chromebook CX1500CKA-EJ0021, CPU Intel Pentium Silver N6000 Quad core (1.1GHz to 3.3GHz 4Mo smart cache), Mémoire RAM 8Go LPDDR4X Stockage 32Go eMMC, Graphique Intel UHD Graphics, Wi-Fi6, Bluetooth 5, 2xUSB-A 3.2 Gen1, 2xUSB-C 3.2 Gen1, 1', 1129, 50, 'inc/images/produitImg/asus3.webp', 0, 1),
(6, 'Pc Portable Gamer DELL INSPIRON G15 I5-10é,8Go,GTX1650,Ecran 15.6\" FHD', 'Dell', 'Processeur Intel Core i5-10500H Hexa-Core( 2.5 GHz up to 4.5 GHz Turbo, 12 Mo de mémoire cache), Mémoire RAM 8 Go DDR4, Disque Dur 512 Go SSD M.2 PCIe NVMe, Carte Graphique NVIDIA GeForce GTX1650 4 Go GDDR6 , Wifi, Bluetooth, HDMI, Ecran 15.6\" FULL HD.\r\n\r', 2289, 30, 'inc/images/produitImg/dell1.webp', 0, 1),
(7, 'Pc Portable Gamer MSI GF63 Thin 11UC-600FR, I5-11ème, 16Go, RTX 3050, 15.6\" FHD 144Hz', 'MSI', 'Processeur Intel I5-11400H HEXA-CORE (to 4.5GHz 12 Mo Smart Cache), RAM 16Go DDR4, Disque Dur 512Go SSD NVMe, Graphique NVIDIA GeForce RTX 3050 4Go GDDR6, Clavier Rétroéclairé, 15.6\" FHD 144Hz.\r\n\r\nSystème: Win 11\r\n\r\nGarantie: 2 ans', 3890, 34, 'inc/images/produitImg/msi1.webp', 0, 1),
(8, 'Pc Portable Gamer MSI GF63 Thin11SC-612XFR I7-11ème, 8Go, GTX 1650, Ecran 15.6\" 144Hz', 'MSI', 'Processeur Intel Core i7-11800H Octa-Core (2.3GHz to 4.6GHz Turbo 12 Mo de mémoire cache), Mémoire RAM 8Go DDR4, Disque Dur 512Go SSD NVMe, Carte Graphique NVIDIA GeForce GTX1650 Max Q 4Go GDDR6, Clavier Rétroéclairage Rouge, Ecran FHD 15.6\" 144Hz.\r\n\r\nGar', 2000, 20, 'inc/images/produitImg/msi2.webp', 0, 1),
(10, 'Smartphone Apple IPhone 13 Pro Graphite, 256Go, Ecran 6.1\"', 'Iphone', 'iPhone 13 Pro, Écran Super Retina XDR OLED 6.1\" (2532 x 1170p) à 460 ppp, Résistance aux éclaboussures, à l’eau et à la poussière IP68, Processeur Apple A15 Bionic Hexa-Core,(CPU 6core, GPU 5core, Neural Engine 16core),Stockage 256Go, Double appareil phot', 6299, 6, 'inc/images/produitImg/iphone1.webp', 0, 2),
(11, 'Smartphone Apple IPhone 13 Pro Max, 128Go, Ecran 6.7\", Gold', 'Iphone', 'iPhone 13 Pro Max, Écran Super Retina XDR OLED 6.7\" (2778 x 1284p) à 458 ppp, Résistance aux éclaboussures, à l’eau et à la poussière IP68, Processeur Apple A15 Bionic Hexa-Core,(CPU 6core, GPU 5core, Neural Engine 16core),Stockage 128Go, Double appareil ', 6299, -6, 'inc/images/produitImg/iphone2.webp', 0, 2),
(12, 'Smartphone Apple IPhone 11, 64Go, Ecran 6.1\" -White', 'Iphone', 'Phone 11, Écran Liquid Retina HD IPS 6.1\" (1792x828p), résistant à la poussière et à l’eau (IP68), Processeur Puce A13 Bionic (CPU 6core, GPU 4core), Stockage 64Go, Appareil photo Arriere Double 12Mpx ultra grand-angle et grand-angle, Appareil Avant 12Mpx', 2289, 10, 'inc/images/produitImg/iphone3.webp', 0, 2),
(13, 'SMARTPHONE INFINIX SMART 7 HD 2GO 64GO - BLANC', 'INFINIX', 'Écran 6.6\" LCD IPS (720 x 1612pixels), 500nits - Système d\'exploitation: Android 12 (édition Go) - Mémoire RAM: 2Go - Stockage: 64Go - Appareil Photo Arriére: 8MP + 0.08MP et Appareil Photo Frontale: 5 MP - Connectivité: 4G, WiFi et Bluetooth 5.0 - Batter', 1299, 5, 'inc/images/produitImg/tel1.webp', 0, 2),
(14, 'SMARTPHONE SAMSUNG GALAXY A24 8GO 128GO NOIR + CHARGEUR SECTEUR 25W OFFERT', 'SAMSUNG', 'Écran 6.5\" Super AMOLED (1080 x 2340px FHD+) -  Processeur: Mediatek MT8781 Hélio G99 (6nm) Octa Core (Cortex-A76 2x2,2 GHz et Cortex-A55 6x2,0 GHz) - Système d\'exploitation: Android 13, ONE UI 5.1 - Mémoire RAM: 8Go - Stockage: 128Go - Appareil photo Arr', 1200, 15, 'inc/images/produitImg/tel2.webp', 0, 2),
(15, 'SMARTPHONE SAMSUNG GALAXY A34 5G 8GO 128GO VERT LIME + CHARGEUR SECTEUR 25W OFFERT', 'SAMSUNG', 'Écran Super AMOLED 6.6\" (1080 x 2340 pixels) - Verre Corning Gorilla 5 - Système d\'exploitation: Android 13 - Processeur: Mediatek MT6877V Dimensity 1080 (6 nm) Octa Core (2x2,6 GHz Cortex-A78 et 6x2,0 GHz Cortex-A55), Mali-G68 MC4 - Mémoire RAM: 8Go - St', 1500, 40, 'inc/images/produitImg/tel3.webp', 0, 2),
(19, 'pc portable', 'asus', 'Écran Super AMOLED 6.6\" (1080 x 2340 pixels) - Verre Corning Gorilla 5 - Système d\'exploitation: Android 13 - Processeur: Mediatek MT6877V Dimensity 1080 (6 nm) Octa Core (2x2,6 GHz Cortex-A78 et 6x2,0 GHz Cortex-A55), Mali-G68 MC4 - Mémoire RAM: 8Go - St', 1400, 6, 'inc/images/produitImg/asusNouveau.webp', 1, 1),
(20, 'Pc AIO ASUS V241EAK-WA149W I5-11ème,8Go, Écran 23.8\"FHD', 'asus', 'pc Bureau asus V241EAK, Processeur Intel Core I5-1135G7 Quad-core (2.40GHz Up To 4.20GHz, 8Mo Intel Smart Cache), Mémoire RAM 8Go DDR4, Disque Dur 1To + 128Go SSD, Carte Graphique Intel Iris Xᵉ, Wifi 5, Bluetooth, 1xRJ45 Gigabit Ethernet, 1x USB 2.0 Type-', 2669, 30, 'inc/images/produitImg/pcAio.webp', 1, 1),
(21, 'PC Portable APPLE MacBook Air, Apple M1, 8Go, 256Go SSD, Ecran Retina 13\" -Grey', 'mack', 'APPLE MACBOOK AIR, PROCESSEUR APPLE M1 (CPU 8 CORE, GPU 7 CORE, NEURAL ENGINE 16 CORE), RAM 8GO, DISQUE 256GO SSD, WIFI 6AX, BLUETOOTH 5.0, 2XTHUNDERBOLT 4/USB-C, CASQUE 3,5MM, LECTEUR BIOMÉTRIQUE, CLAVIER MAGIC RÉTROÉCLAIRÉ, CAPTEUR ID TACTILE, ECRAN RET', 3789, 10, 'inc/images/produitImg/mack1.webp', 1, 1),
(22, 'Pc Portable ASUS ROG Zephyrus GU603HM-K8004T I7-11é, RTX3060, Ecran 16\" WQXGA165Hz', 'asus', 'Pc Portable Gamer ROG Zephyrus, Processeur intel Core i7-11800H Octa-Core (2.30 GHz up to 4.60 GHz, 24 Mo intel smart Cache), Mémoire RAM 16Go DDR4, Disque Dur 1To SSD, Carte Graphique NVIDIA® GeForce RTX™ 3060 6G GDDR6, WiFi 6, Bluetooth, Clavier rétroéc', 5879, 12, 'inc/images/produitImg/rog.webp', 1, 1),
(23, 'Smartphone Apple IPhone 14 Pro - 128Go, Ecran 6.1\", Deep Purple', 'iphone', 'iPhone 14 Pro, Écran Super Retina XDR OLED 6.1\" (2556 x 1179 px) à 460 ppp, Revêtement oléophobe résistant aux traces de doigts, Processeur Apple A16 Bionic, (CPU 6core, GPU 5core), Stockage 128 Go, appareil photo 48Mpx Principale, 12Mp Ultra Wide, Enregi', 6369, 12, 'inc/images/produitImg/iphoneM.webp', 1, 2),
(24, 'Pc Portable Gamer Asus ROG Flow X13 GV301RA-LJ034W, R7-6800HS, RX 6850M XT, Ecran 13.4\" FHD Tactile', 'asus', 'Processeur AMD Ryzen 7-6800HS Octa-Core(3.20GHz up to 4.70GHz,20MB Cache),Mémoire RAM 16Go DDR5,Disque dur 1To SSD PCIe 4.0 NVMe M.2,Carte graphique externe AMD Radeon™ RX 6850M XT, Clavier chiclet rétroéclairé, Ecran 13.4\"FHD 120Hz tactile.  Système: Win', 4900, 10, 'inc/images/produitImg/n.webp', 0, 1),
(25, 'aa', 'asus', 'amal', 40, 10, 'inc/images/produitImg/iphone3.webp', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `role` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `pwd`, `role`) VALUES
(17, 'n', 'n', 'n@enis.tn', 'n', 'admin'),
(18, 'd', 'd', 'd@enis.tn', 'd', 'client');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_categorie` FOREIGN KEY (`code_categorie`) REFERENCES `categorie` (`code_categorie`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
