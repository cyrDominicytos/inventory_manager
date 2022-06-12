-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Listage de la structure de la table inventory_manager. bills
CREATE TABLE IF NOT EXISTS `bills` (
  `bill_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `bill_mecef_date_time` datetime DEFAULT NULL,
  `bill_code` varchar(100) DEFAULT NULL,
  `bill_type` varchar(10) DEFAULT NULL,
  `bill_mecef_qr_code` varchar(100) DEFAULT NULL,
  `bill_mecef_code_dgi` varchar(50) DEFAULT NULL,
  `bill_mecef_counters` varchar(50) DEFAULT NULL,
  `bill_mecef_nim` varchar(50) DEFAULT NULL,
  `bill_certify_bill` varchar(50) DEFAULT NULL,
  `bill_taa` mediumint(9) DEFAULT NULL,
  `bill_tab` mediumint(9) DEFAULT NULL,
  `bill_tac` mediumint(9) DEFAULT NULL,
  `bill_tad` mediumint(9) DEFAULT NULL,
  `bill_tae` mediumint(9) DEFAULT NULL,
  `bill_taf` mediumint(9) DEFAULT NULL,
  `bill_hab` mediumint(9) DEFAULT NULL,
  `bill_had` mediumint(9) DEFAULT NULL,
  `bill_vab` mediumint(9) DEFAULT NULL,
  `bill_vad` mediumint(9) DEFAULT NULL,
  `bill_aib` mediumint(9) DEFAULT NULL,
  `bill_ts` mediumint(9) DEFAULT NULL,
  `bill_total` mediumint(9) DEFAULT NULL,
  `bill_uid` varchar(50) DEFAULT NULL,
  `bill_generate_by` mediumint(8) unsigned NOT NULL,
  `bill_sales_id` mediumint(8) unsigned NOT NULL,
  `bill_certify_by` mediumint(8) unsigned DEFAULT NULL,
  `bill_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `bill_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`bill_id`),
  UNIQUE KEY `bill_code` (`bill_code`),
  KEY `bills_bill_generate_by_foreign` (`bill_generate_by`),
  KEY `bills_bill_sales_id_foreign` (`bill_sales_id`),
  CONSTRAINT `bills_bill_generate_by_foreign` FOREIGN KEY (`bill_generate_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `bills_bill_sales_id_foreign` FOREIGN KEY (`bill_sales_id`) REFERENCES `sales` (`sales_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.bills : ~1 rows (environ)
/*!40000 ALTER TABLE `bills` DISABLE KEYS */;
REPLACE INTO `bills` (`bill_id`, `bill_mecef_date_time`, `bill_code`, `bill_type`, `bill_mecef_qr_code`, `bill_mecef_code_dgi`, `bill_mecef_counters`, `bill_mecef_nim`, `bill_certify_bill`, `bill_taa`, `bill_tab`, `bill_tac`, `bill_tad`, `bill_tae`, `bill_taf`, `bill_hab`, `bill_had`, `bill_vab`, `bill_vad`, `bill_aib`, `bill_ts`, `bill_total`, `bill_uid`, `bill_generate_by`, `bill_sales_id`, `bill_certify_by`, `bill_created_at`, `bill_updated_at`) VALUES
	(5, '2022-03-03 08:06:26', 'FV0239', 'FV', 'F;TS01000259;TEST6G4I65YBFXOO2YSWR52G;0202112473644;20220303080626', 'TEST-6G4I-65YB-FXOO-2YSW-R52G', '220/242 FV', 'TS01000259', '1', 1351800, 530000, 20000, 17500, 8000, 6750, 449153, 14831, 80847, 2669, 18010, 0, 1952060, NULL, 1, 5, 1, '2022-03-02 17:45:30', '2022-03-03 08:06:26'),
	(7, '2022-03-03 08:19:34', 'FV4875', 'FV', 'F;TS01000259;TESTGRKJ7BSJ2XLCEXPESWWM;0202112473644;20220303081934', 'TEST-GRKJ-7BSJ-2XLC-EXPE-SWWM', '221/243 FV', 'TS01000259', '1', 0, 7600000, 0, 0, 0, 0, 6440678, 0, 1159322, 0, 0, 0, 7600000, NULL, 1, 6, 1, '2022-03-02 20:00:33', '2022-03-03 08:19:33');
/*!40000 ALTER TABLE `bills` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. clients
CREATE TABLE IF NOT EXISTS `clients` (
  `clients_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `clients_ifu` varchar(13) DEFAULT NULL,
  `clients_company` varchar(250) NOT NULL,
  `clients_phone_number` varchar(100) DEFAULT NULL,
  `clients_email` varchar(100) DEFAULT NULL,
  `clients_address` varchar(250) DEFAULT NULL,
  `clients_isActive` tinyint(1) unsigned DEFAULT '1',
  `clients_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `clients_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`clients_id`),
  UNIQUE KEY `clients_ifu` (`clients_ifu`),
  UNIQUE KEY `clients_phone_number` (`clients_phone_number`),
  UNIQUE KEY `clients_email` (`clients_email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.clients : ~4 rows (environ)
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
REPLACE INTO `clients` (`clients_id`, `clients_ifu`, `clients_company`, `clients_phone_number`, `clients_email`, `clients_address`, `clients_isActive`, `clients_created_at`, `clients_updated_at`) VALUES
	(1, NULL, 'Système', NULL, NULL, NULL, 1, '2022-03-02 14:52:22', '2022-03-02 14:52:22'),
	(2, NULL, 'ASSOGBA Clément', '+22966757001', 'cyrdominicytos@gmail.com', 'Rue 560, Cotonou, Bénin', 1, '2022-03-02 15:02:19', '2022-03-02 15:02:19'),
	(3, NULL, 'MABROUK', '0022992356478', NULL, NULL, 1, '2022-03-02 15:02:59', '2022-03-02 15:02:59'),
	(4, NULL, 'ZODIAQUE', '0022963415789', NULL, NULL, 1, '2022-03-02 15:03:26', '2022-03-02 15:03:26');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. config
CREATE TABLE IF NOT EXISTS `config` (
  `config_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `config_code` mediumint(8) unsigned NOT NULL,
  `config_name` varchar(100) NOT NULL,
  `config_description` text NOT NULL,
  `config_value` text NOT NULL,
  `config_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `config_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.config : ~11 rows (environ)
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
REPLACE INTO `config` (`config_id`, `config_code`, `config_name`, `config_description`, `config_value`, `config_created_at`, `config_updated_at`) VALUES
	(1, 1, 'company_name', 'Nom de l\'entreprise', 'MYAH IT COMPANY', '2022-03-02 14:52:22', '2022-03-02 14:52:22'),
	(2, 2, 'company_ifu', 'Numéro IFU de l\'entreprise', '0202112473644', '2022-03-02 14:52:22', '2022-03-02 14:52:22'),
	(3, 3, 'company_email', 'Email de l\'entreprise', 'contact@myahitcompany.com', '2022-03-02 14:52:22', '2022-03-02 14:52:22'),
	(4, 4, 'company_phone_number', 'Numéro de téléphone de l\'entreprise', '+229 69 93 67 67', '2022-03-02 14:52:22', '2022-03-02 14:52:22'),
	(5, 5, 'company_address', 'Adresse physique de l\'entreprise', 'Bénin, Cotonou, Agla', '2022-03-02 14:52:22', '2022-03-02 14:52:22'),
	(6, 6, 'company_product_identity', 'Identificateur des produits de l\'entreprise', 'barre_code', '2022-03-02 14:52:22', '2022-03-02 14:52:22'),
	(7, 7, 'company_identity', 'Identifiant de connexion de l\'entreprise', 'email', '2022-03-02 14:52:22', '2022-03-02 14:52:22'),
	(8, 8, 'company_created_at', 'Date de création de l\'entreprise', '2020-03-17', '2022-03-02 14:52:22', '2022-03-04 07:24:24'),
	(9, 9, 'company_site_url', 'Adresse de site web de l\'entreprise', 'https://www.myahitcompany.com', '2022-03-02 14:52:22', '2022-03-02 14:52:22'),
	(10, 10, 'company_rccm', 'Registre de commerce de l\'entreprise', 'RCCM RB/ABC/21 B', '2022-03-02 14:52:22', '2022-03-02 14:52:22'),
	(11, 11, 'company_logo', 'Logo de l\'entreprise', 'uploads/logo/company_logo.png', '2022-03-04 07:26:44', '2022-03-04 08:21:36');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. delivery_mens
CREATE TABLE IF NOT EXISTS `delivery_mens` (
  `delivery_mens_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `delivery_mens_ifu` varchar(13) DEFAULT NULL,
  `delivery_mens_company` varchar(250) NOT NULL,
  `delivery_mens_phone_number` varchar(100) DEFAULT NULL,
  `delivery_mens_email` varchar(100) DEFAULT NULL,
  `delivery_mens_address` varchar(250) DEFAULT NULL,
  `delivery_mens_isActive` tinyint(1) unsigned DEFAULT '1',
  `delivery_mens_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `delivery_mens_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`delivery_mens_id`),
  UNIQUE KEY `delivery_mens_ifu` (`delivery_mens_ifu`),
  UNIQUE KEY `delivery_mens_phone_number` (`delivery_mens_phone_number`),
  UNIQUE KEY `delivery_mens_email` (`delivery_mens_email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.delivery_mens : ~2 rows (environ)
/*!40000 ALTER TABLE `delivery_mens` DISABLE KEYS */;
REPLACE INTO `delivery_mens` (`delivery_mens_id`, `delivery_mens_ifu`, `delivery_mens_company`, `delivery_mens_phone_number`, `delivery_mens_email`, `delivery_mens_address`, `delivery_mens_isActive`, `delivery_mens_created_at`, `delivery_mens_updated_at`) VALUES
	(1, NULL, 'JOEL DJAGLI', '+22966757002', 'joel@gmail.com', 'Rue 560, Cotonou, Bénin', 1, '2022-03-02 15:05:34', '2022-03-02 15:05:34'),
	(2, NULL, 'SOSSOU Jean EXPRESSO', '65487952', NULL, NULL, 1, '2022-03-02 15:06:03', '2022-03-02 15:06:03'),
	(3, NULL, 'HE SYSTEM', '+22966757548', 'contact-hesystem@gmail.com', 'Rue 560, Cotonou, Bénin', 1, '2022-03-02 15:06:48', '2022-03-02 15:06:48');
/*!40000 ALTER TABLE `delivery_mens` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. exonerations
CREATE TABLE IF NOT EXISTS `exonerations` (
  `exonerations_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `exonerations_name` varchar(100) DEFAULT NULL,
  `exonerations_slug` varchar(255) DEFAULT NULL,
  `exonerations_rate` text,
  `exonerations_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `exonerations_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`exonerations_id`),
  UNIQUE KEY `exonerations_name` (`exonerations_name`),
  UNIQUE KEY `exonerations_slug` (`exonerations_slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.exonerations : ~6 rows (environ)
/*!40000 ALTER TABLE `exonerations` DISABLE KEYS */;
REPLACE INTO `exonerations` (`exonerations_id`, `exonerations_name`, `exonerations_slug`, `exonerations_rate`, `exonerations_created_at`, `exonerations_updated_at`) VALUES
	(1, 'A', '[A : Exonération totale]', '0', '2022-03-02 14:52:22', '2022-03-02 14:52:22'),
	(2, 'B', '[B : 18%]', '18', '2022-03-02 14:52:22', '2022-03-02 14:52:22'),
	(3, 'C', '[C : Exonération totale]', '0', '2022-03-02 14:52:22', '2022-03-02 14:52:22'),
	(4, 'D', '[D : 18%]', '18', '2022-03-02 14:52:22', '2022-03-02 14:52:22'),
	(5, 'E', '[E : Exonération totale]', '0', '2022-03-02 14:52:22', '2022-03-02 14:52:22'),
	(6, 'F', '[F : Exonération totale]', '0', '2022-03-02 14:52:22', '2022-03-02 14:52:22');
/*!40000 ALTER TABLE `exonerations` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. groups
CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `display_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.groups : ~3 rows (environ)
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
REPLACE INTO `groups` (`id`, `name`, `display_name`, `description`) VALUES
	(1, 'admin', 'admin', 'Administrateur'),
	(2, 'comptable', 'comptable', 'Comptable'),
	(3, 'vendeur', 'vendeur', 'Vendeur');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. groups_permissions
CREATE TABLE IF NOT EXISTS `groups_permissions` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` mediumint(8) unsigned NOT NULL,
  `permissions` json NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groups_permissions_group_id_foreign` (`group_id`),
  CONSTRAINT `groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.groups_permissions : ~0 rows (environ)
/*!40000 ALTER TABLE `groups_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups_permissions` ENABLE KEYS */;

-- Listage de la structure de la vue inventory_manager. inventory
-- Création d'une table temporaire pour palier aux erreurs de dépendances de VIEW
CREATE TABLE `inventory` (
	`product_categories_id` MEDIUMINT(8) UNSIGNED NOT NULL,
	`product_categories_name` VARCHAR(100) NULL COLLATE 'utf8_general_ci',
	`product_categories_description` TEXT NULL COLLATE 'utf8_general_ci',
	`product_categories_isActive` TINYINT(1) UNSIGNED NULL,
	`product_categories_created_at` DATETIME NULL,
	`product_categories_updated_at` DATETIME NULL,
	`products_id` MEDIUMINT(8) UNSIGNED NOT NULL,
	`products_name` VARCHAR(100) NULL COLLATE 'utf8_general_ci',
	`sales_options_id` MEDIUMINT(8) UNSIGNED NOT NULL,
	`sales_options_name` VARCHAR(100) NULL COLLATE 'utf8_general_ci',
	`supply_quantity_total` DECIMAL(30,0) NULL,
	`sell_quantity_total` DECIMAL(30,0) NULL,
	`quantity_inventory` DECIMAL(31,0) NULL
) ENGINE=MyISAM;

-- Listage de la structure de la table inventory_manager. login_attempts
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.login_attempts : ~0 rows (environ)
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.migrations : ~0 rows (environ)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
REPLACE INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
	(1, '20181211100537', 'IonAuth\\Database\\Migrations\\Migration_Install_ion_auth', '', 'IonAuth', 1646229133, 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. orders
CREATE TABLE IF NOT EXISTS `orders` (
  `orders_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `orders_status` mediumint(9) NOT NULL DEFAULT '1',
  `orders_amount` double unsigned NOT NULL,
  `orders_description` text,
  `orders_client_id` mediumint(8) unsigned NOT NULL,
  `orders_delivery_date` date NOT NULL,
  `orders_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `orders_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`orders_id`),
  KEY `orders_orders_client_id_foreign` (`orders_client_id`),
  CONSTRAINT `orders_orders_client_id_foreign` FOREIGN KEY (`orders_client_id`) REFERENCES `clients` (`clients_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.orders : ~0 rows (environ)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. orders_details
CREATE TABLE IF NOT EXISTS `orders_details` (
  `orders_details_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `orders_details_amount` double unsigned NOT NULL,
  `orders_details_quantity` mediumint(8) unsigned NOT NULL,
  `orders_details_orders_id` mediumint(8) unsigned NOT NULL,
  `orders_details_sales_options_id` mediumint(8) unsigned NOT NULL,
  `orders_details_products_id` mediumint(8) unsigned NOT NULL,
  `orders_default_price` double NOT NULL DEFAULT '0',
  `orders_selling_price` double NOT NULL DEFAULT '0',
  `orders_details_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `orders_details_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`orders_details_id`),
  KEY `orders_details_orders_details_orders_id_foreign` (`orders_details_orders_id`),
  KEY `orders_details_orders_details_products_id_foreign` (`orders_details_products_id`),
  KEY `orders_details_orders_details_sales_options_id_foreign` (`orders_details_sales_options_id`),
  CONSTRAINT `orders_details_orders_details_orders_id_foreign` FOREIGN KEY (`orders_details_orders_id`) REFERENCES `orders` (`orders_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `orders_details_orders_details_products_id_foreign` FOREIGN KEY (`orders_details_products_id`) REFERENCES `products` (`products_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `orders_details_orders_details_sales_options_id_foreign` FOREIGN KEY (`orders_details_sales_options_id`) REFERENCES `sales_options` (`sales_options_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.orders_details : ~0 rows (environ)
/*!40000 ALTER TABLE `orders_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_details` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `module` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.permissions : ~36 rows (environ)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
REPLACE INTO `permissions` (`id`, `name`, `module`, `description`) VALUES
	(10, 'Consulter_Statistiques', 'Statistiques', 'Voir le tabeau de bord'),
	(20, 'Consulter_Ventes', 'Ventes', 'Consulter la liste des ventes'),
	(21, 'Effectuer_Ventes', 'Ventes', 'Vendre un produit'),
	(22, 'Editer_Ventes', 'Ventes', 'Editer une vente'),
	(23, 'Supprimer_Ventes', 'Ventes', 'Supprimer une vente'),
	(30, 'Consulter_Commandes_Clients', 'Commandes_Clients', 'Consulter les commandes des clients'),
	(31, 'Enregistrer_Commandes_Clients', 'Commandes_Clients', 'Enregistrer les commandes des clients'),
	(32, 'Editer_Commandes_Clients', 'Commandes_Clients', 'Editer les commandes des clients'),
	(33, 'Supprimer_Commandes_Clients', 'Commandes_Clients', 'Supprimer les commandes des clients'),
	(40, 'Consulter_Approvisionnements', 'Approvisionnements', 'Consulter les approvisionnements de produit'),
	(41, 'Enregistrer_Approvisionnements', 'Approvisionnements', 'Enregistrer les approvisionnements de produit'),
	(42, 'Editer_Approvisionnements', 'Approvisionnements', 'Editer les approvisionnements de produit'),
	(43, 'Supprimer_Approvisionnements', 'Approvisionnements', 'Supprimer les approvisionnements de produit'),
	(50, 'Consulter_Stocks', 'Stocks', 'Consulter l\'inventaire de stock'),
	(60, 'Consulter_Clients', 'Clients', 'Voir la liste des clients'),
	(61, 'Enregistrer_Clients', 'Clients', 'Enregistrer un client'),
	(62, 'Editer_Clients', 'Clients', 'Editer un client'),
	(63, 'Supprimer_Clients', 'Clients', 'Supprimer un client'),
	(70, 'Consulter_Fournisseurs', 'Fournisseurs', 'Voir la liste des fournisseurs'),
	(71, 'Enregistrer_Fournisseurs', 'Fournisseurs', 'Enregistrer un fournisseur'),
	(72, 'Editer_Fournisseurs', 'Fournisseurs', 'Editer un fournisseur'),
	(73, 'Supprimer_Fournisseurs', 'Fournisseurs', 'Supprimer un fournisseur'),
	(80, 'Consulter_Livreurs', 'Livreurs', 'Voir la liste des livreurs'),
	(81, 'Enregistrer_Livreurs', 'Livreurs', 'Enregistrer un livreur'),
	(82, 'Editer_Livreurs', 'Livreurs', 'Editer un livreur'),
	(83, 'Supprimer_Livreurs', 'Livreurs', 'Supprimer un livreur'),
	(90, 'Consulter_Utilisateurs', 'Utilisateurs', 'Voir la liste des utilisateurs'),
	(91, 'Enregistrer_Utilisateurs', 'Utilisateurs', 'Enregistrer un utilisateur'),
	(92, 'Editer_Utilisateurs', 'Utilisateurs', 'Editer un utilisateur'),
	(93, 'Supprimer_Utilisateurs', 'Utilisateurs', 'Supprimer un utilisateur'),
	(100, 'Consulter_Roles_Permissions', 'Roles_Permissions', 'Voir la liste des Roles et Permissions'),
	(101, 'Enregistrer_Roles_Permissions', 'Roles_Permissions', 'Enregistrer un Rôle'),
	(102, 'Editer_Roles_Permissions', 'Roles_Permissions', 'Editer un Rôle'),
	(103, 'Supprimer_Roles_Permissions', 'Roles_Permissions', 'Supprimer un Rôle'),
	(110, 'Consulter_Parametrages', 'Parametrages', 'Voir les Paramétrages'),
	(112, 'Editer_Parametrages', 'Parametrages', 'Editer un Paramétrage');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. products
CREATE TABLE IF NOT EXISTS `products` (
  `products_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `products_name` varchar(100) DEFAULT NULL,
  `products_barre_code` varchar(255) DEFAULT NULL,
  `products_description` text,
  `products_isActive` tinyint(1) unsigned DEFAULT '1',
  `products_product_categorie_id` mediumint(8) unsigned NOT NULL,
  `products_exonerations_id` mediumint(8) unsigned NOT NULL,
  `products_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `products_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`products_id`),
  UNIQUE KEY `products_name` (`products_name`),
  UNIQUE KEY `products_barre_code` (`products_barre_code`),
  KEY `products_products_product_categorie_id_foreign` (`products_product_categorie_id`),
  KEY `products_products_exonerations_id_foreign` (`products_exonerations_id`),
  CONSTRAINT `products_products_exonerations_id_foreign` FOREIGN KEY (`products_exonerations_id`) REFERENCES `exonerations` (`exonerations_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `products_products_product_categorie_id_foreign` FOREIGN KEY (`products_product_categorie_id`) REFERENCES `product_categories` (`product_categories_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.products : ~9 rows (environ)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
REPLACE INTO `products` (`products_id`, `products_name`, `products_barre_code`, `products_description`, `products_isActive`, `products_product_categorie_id`, `products_exonerations_id`, `products_created_at`, `products_updated_at`) VALUES
	(1, 'ORDINATEUR HP ELITE BOOK', NULL, '', 1, 1, 1, '2022-02-22 11:09:47', '2022-03-02 15:09:34'),
	(2, 'Ordinateur TOSHIBA', NULL, '', 1, 1, 2, '2022-02-22 11:10:15', '2022-03-02 15:09:43'),
	(3, 'SOURIS', NULL, '', 1, 1, 3, '2022-02-22 11:10:33', '2022-03-02 15:09:53'),
	(4, 'CLE USB', NULL, '', 1, 1, 4, '2022-02-22 11:10:45', '2022-03-02 15:10:05'),
	(5, 'RIZ GINO', NULL, '', 1, 2, 5, '2022-02-22 11:11:06', '2022-03-02 15:10:17'),
	(6, 'HUILE D\'ARACHIDE', NULL, '', 1, 2, 6, '2022-02-22 11:11:30', '2022-03-02 15:12:40'),
	(7, 'HUILE ROUGE', NULL, '', 1, 2, 1, '2022-02-22 11:11:42', '2022-03-02 15:14:38'),
	(8, 'MISSEUR', NULL, '', 1, 3, 4, '2022-02-22 11:12:03', '2022-03-02 15:13:08'),
	(9, 'FER A REPASSER', NULL, '', 1, 3, 2, '2022-02-22 11:12:27', '2022-03-02 15:12:54');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. product_categories
CREATE TABLE IF NOT EXISTS `product_categories` (
  `product_categories_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `product_categories_name` varchar(100) DEFAULT NULL,
  `product_categories_description` text,
  `product_categories_isActive` tinyint(1) unsigned DEFAULT '1',
  `product_categories_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `product_categories_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_categories_id`),
  UNIQUE KEY `product_categories_name` (`product_categories_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.product_categories : ~3 rows (environ)
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
REPLACE INTO `product_categories` (`product_categories_id`, `product_categories_name`, `product_categories_description`, `product_categories_isActive`, `product_categories_created_at`, `product_categories_updated_at`) VALUES
	(1, 'Matériel Informatique', '', 1, '2022-02-22 11:06:47', '2022-02-22 11:06:47'),
	(2, 'Divers', '', 1, '2022-02-22 11:06:56', '2022-02-22 11:06:56'),
	(3, 'Appareils Electroménager', '', 1, '2022-02-22 11:07:20', '2022-02-22 11:07:20'),
	(4, 'Vêtement', '', 1, '2022-03-02 15:08:31', '2022-03-02 15:08:31');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. product_prices
CREATE TABLE IF NOT EXISTS `product_prices` (
  `product_prices_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `product_prices_price` double NOT NULL DEFAULT '0',
  `product_prices_product_id` mediumint(8) unsigned NOT NULL,
  `product_prices_sales_option_id` mediumint(8) unsigned NOT NULL,
  `product_prices_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `product_prices_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_prices_id`),
  KEY `product_prices_product_prices_product_id_foreign` (`product_prices_product_id`),
  KEY `product_prices_product_prices_sales_option_id_foreign` (`product_prices_sales_option_id`),
  CONSTRAINT `product_prices_product_prices_product_id_foreign` FOREIGN KEY (`product_prices_product_id`) REFERENCES `products` (`products_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `product_prices_product_prices_sales_option_id_foreign` FOREIGN KEY (`product_prices_sales_option_id`) REFERENCES `sales_options` (`sales_options_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.product_prices : ~8 rows (environ)
/*!40000 ALTER TABLE `product_prices` DISABLE KEYS */;
REPLACE INTO `product_prices` (`product_prices_id`, `product_prices_price`, `product_prices_product_id`, `product_prices_sales_option_id`, `product_prices_created_at`, `product_prices_updated_at`) VALUES
	(1, 450000, 1, 2, '2022-03-02 15:43:52', '2022-03-02 15:43:52'),
	(2, 380000, 2, 2, '2022-03-02 15:59:32', '2022-03-02 15:59:32'),
	(3, 5000, 3, 2, '2022-03-02 15:59:50', '2022-03-02 15:59:50'),
	(4, 3500, 4, 2, '2022-03-02 16:00:14', '2022-03-02 16:00:14'),
	(5, 800, 5, 1, '2022-03-02 16:00:39', '2022-03-02 16:00:39'),
	(6, 1350, 6, 5, '2022-03-02 16:00:57', '2022-03-02 16:00:57'),
	(7, 900, 7, 5, '2022-03-02 16:01:17', '2022-03-02 16:01:17'),
	(8, 27000, 8, 2, '2022-03-02 16:01:35', '2022-03-02 16:01:35'),
	(9, 75000, 9, 2, '2022-03-02 16:01:56', '2022-03-02 16:01:56');
/*!40000 ALTER TABLE `product_prices` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. providers
CREATE TABLE IF NOT EXISTS `providers` (
  `providers_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `providers_ifu` varchar(13) DEFAULT NULL,
  `providers_company` varchar(250) NOT NULL,
  `providers_phone_number` varchar(100) DEFAULT NULL,
  `providers_email` varchar(100) DEFAULT NULL,
  `providers_address` varchar(250) DEFAULT NULL,
  `providers_isActive` tinyint(1) unsigned DEFAULT '1',
  `providers_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `providers_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`providers_id`),
  UNIQUE KEY `providers_ifu` (`providers_ifu`),
  UNIQUE KEY `providers_phone_number` (`providers_phone_number`),
  UNIQUE KEY `providers_email` (`providers_email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.providers : ~4 rows (environ)
/*!40000 ALTER TABLE `providers` DISABLE KEYS */;
REPLACE INTO `providers` (`providers_id`, `providers_ifu`, `providers_company`, `providers_phone_number`, `providers_email`, `providers_address`, `providers_isActive`, `providers_created_at`, `providers_updated_at`) VALUES
	(1, NULL, 'Système', NULL, NULL, NULL, 1, '2022-03-02 14:52:22', '2022-03-02 14:52:22'),
	(2, NULL, 'IT LAB', '22354876', NULL, NULL, 1, '2022-03-02 15:03:50', '2022-03-02 15:03:50'),
	(3, NULL, 'GLOBAL TECH', '21365478', NULL, NULL, 1, '2022-03-02 15:04:23', '2022-03-02 15:04:23'),
	(4, NULL, 'ZENITH', '51487932', NULL, NULL, 1, '2022-03-02 15:04:47', '2022-03-02 15:04:47');
/*!40000 ALTER TABLE `providers` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. sales
CREATE TABLE IF NOT EXISTS `sales` (
  `sales_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `sales_status` mediumint(9) NOT NULL DEFAULT '1',
  `sales_amount` double unsigned NOT NULL,
  `sales_reduction` double unsigned NOT NULL DEFAULT '0',
  `sales_is_commanded` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `sales_is_delivable` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `sales_deliver_man` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `sales_aib` varchar(1) NOT NULL DEFAULT '0',
  `sales_delivery_date` date NOT NULL,
  `sales_client_id` mediumint(8) unsigned NOT NULL,
  `sales_users_id` mediumint(8) unsigned NOT NULL,
  `sales_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `sales_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sales_id`),
  KEY `sales_sales_client_id_foreign` (`sales_client_id`),
  CONSTRAINT `sales_sales_client_id_foreign` FOREIGN KEY (`sales_client_id`) REFERENCES `clients` (`clients_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.sales : ~2 rows (environ)
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
REPLACE INTO `sales` (`sales_id`, `sales_status`, `sales_amount`, `sales_reduction`, `sales_is_commanded`, `sales_is_delivable`, `sales_deliver_man`, `sales_aib`, `sales_delivery_date`, `sales_client_id`, `sales_users_id`, `sales_created_at`, `sales_updated_at`) VALUES
	(1, 1, 0, 0, 0, 0, 0, '0', '0000-00-00', 1, 0, '2022-03-02 14:52:22', '2022-03-02 14:52:22'),
	(5, 4, 1934050, 1934050, 0, 0, 1, 'A', '0000-00-00', 2, 1, '2022-03-02 17:45:23', '2022-03-03 08:06:28'),
	(6, 4, 7600000, 7600000, 0, 0, 1, '0', '0000-00-00', 3, 1, '2022-03-02 19:43:31', '2022-03-03 08:19:35');
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. sales_options
CREATE TABLE IF NOT EXISTS `sales_options` (
  `sales_options_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `sales_options_name` varchar(100) DEFAULT NULL,
  `sales_options_description` text,
  `sales_options_isActive` tinyint(1) unsigned DEFAULT '1',
  `sales_options_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `sales_options_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sales_options_id`),
  UNIQUE KEY `sales_options_name` (`sales_options_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.sales_options : ~7 rows (environ)
/*!40000 ALTER TABLE `sales_options` DISABLE KEYS */;
REPLACE INTO `sales_options` (`sales_options_id`, `sales_options_name`, `sales_options_description`, `sales_options_isActive`, `sales_options_created_at`, `sales_options_updated_at`) VALUES
	(1, 'KG', '', 1, '2022-02-22 11:07:47', '2022-02-22 11:07:47'),
	(2, 'Unité', '', 1, '2022-02-22 11:07:55', '2022-02-22 11:07:55'),
	(3, 'Paquet', '', 1, '2022-02-22 11:08:39', '2022-02-22 11:08:39'),
	(4, 'Sachet', '', 1, '2022-02-22 11:08:48', '2022-02-22 11:08:48'),
	(5, 'Littre', '', 1, '2022-02-22 11:09:11', '2022-02-22 11:09:11'),
	(6, 'Boite', '', 1, '2022-03-02 15:07:13', '2022-03-02 15:07:13'),
	(7, 'Carton', '', 1, '2022-03-02 15:07:29', '2022-03-02 15:07:29'),
	(8, 'Plateau', '', 1, '2022-03-02 15:07:42', '2022-03-02 15:07:42');
/*!40000 ALTER TABLE `sales_options` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. sell_details
CREATE TABLE IF NOT EXISTS `sell_details` (
  `sell_details_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `sell_details_amount` double unsigned NOT NULL,
  `sell_details_quantity` mediumint(8) unsigned NOT NULL,
  `sell_details_reduction` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `sell_details_sales_options_id` mediumint(8) unsigned NOT NULL,
  `sell_details_sales_id` mediumint(8) unsigned NOT NULL,
  `sell_details_products_id` mediumint(8) unsigned NOT NULL,
  `sell_details_default_price` double NOT NULL DEFAULT '0',
  `sell_details_selling_price` double NOT NULL DEFAULT '0',
  `sell_details_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `sell_details_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sell_details_id`),
  KEY `sell_details_sell_details_sales_id_foreign` (`sell_details_sales_id`),
  KEY `sell_details_sell_details_products_id_foreign` (`sell_details_products_id`),
  KEY `sell_details_sell_details_sales_options_id_foreign` (`sell_details_sales_options_id`),
  CONSTRAINT `sell_details_sell_details_products_id_foreign` FOREIGN KEY (`sell_details_products_id`) REFERENCES `products` (`products_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `sell_details_sell_details_sales_id_foreign` FOREIGN KEY (`sell_details_sales_id`) REFERENCES `sales` (`sales_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `sell_details_sell_details_sales_options_id_foreign` FOREIGN KEY (`sell_details_sales_options_id`) REFERENCES `sales_options` (`sales_options_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.sell_details : ~17 rows (environ)
/*!40000 ALTER TABLE `sell_details` DISABLE KEYS */;
REPLACE INTO `sell_details` (`sell_details_id`, `sell_details_amount`, `sell_details_quantity`, `sell_details_reduction`, `sell_details_sales_options_id`, `sell_details_sales_id`, `sell_details_products_id`, `sell_details_default_price`, `sell_details_selling_price`, `sell_details_created_at`, `sell_details_updated_at`) VALUES
	(1, 0, 0, 0, 2, 1, 1, 450000, 450000, '2022-03-02 15:43:52', '2022-03-02 15:43:52'),
	(3, 0, 0, 0, 2, 1, 2, 380000, 380000, '2022-03-02 15:59:32', '2022-03-02 15:59:32'),
	(4, 0, 0, 0, 2, 1, 3, 5000, 5000, '2022-03-02 15:59:50', '2022-03-02 15:59:50'),
	(5, 0, 0, 0, 2, 1, 4, 3500, 3500, '2022-03-02 16:00:14', '2022-03-02 16:00:14'),
	(6, 0, 0, 0, 1, 1, 5, 800, 800, '2022-03-02 16:00:39', '2022-03-02 16:00:39'),
	(7, 0, 0, 0, 5, 1, 6, 1350, 1350, '2022-03-02 16:00:57', '2022-03-02 16:00:57'),
	(8, 0, 0, 0, 5, 1, 7, 900, 900, '2022-03-02 16:01:17', '2022-03-02 16:01:17'),
	(9, 0, 0, 0, 2, 1, 8, 27000, 27000, '2022-03-02 16:01:35', '2022-03-02 16:01:35'),
	(10, 0, 0, 0, 2, 1, 9, 75000, 75000, '2022-03-02 16:01:56', '2022-03-02 16:01:56'),
	(20, 1350000, 3, 0, 2, 5, 1, 450000, 450000, '2022-03-02 17:45:23', '2022-03-02 17:45:23'),
	(21, 380000, 1, 0, 2, 5, 2, 380000, 380000, '2022-03-02 17:45:23', '2022-03-02 17:45:23'),
	(22, 20000, 4, 0, 2, 5, 3, 5000, 5000, '2022-03-02 17:45:23', '2022-03-02 17:45:23'),
	(23, 17500, 5, 0, 2, 5, 4, 3500, 3500, '2022-03-02 17:45:23', '2022-03-02 17:45:23'),
	(24, 8000, 10, 0, 1, 5, 5, 800, 800, '2022-03-02 17:45:23', '2022-03-02 17:45:23'),
	(25, 6750, 5, 0, 5, 5, 6, 1350, 1350, '2022-03-02 17:45:23', '2022-03-02 17:45:23'),
	(26, 1800, 2, 0, 5, 5, 7, 900, 900, '2022-03-02 17:45:23', '2022-03-02 17:45:23'),
	(27, 150000, 2, 0, 2, 5, 9, 75000, 75000, '2022-03-02 17:45:23', '2022-03-02 17:45:23'),
	(28, 7600000, 20, 0, 2, 6, 2, 380000, 380000, '2022-03-02 19:43:31', '2022-03-02 19:43:31');
/*!40000 ALTER TABLE `sell_details` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. supplies
CREATE TABLE IF NOT EXISTS `supplies` (
  `supplies_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `supplies_code_barre` text,
  `supplies_cost` double unsigned NOT NULL,
  `supplies_selling_price` double unsigned NOT NULL,
  `supplies_selling_quantity` mediumint(8) unsigned NOT NULL,
  `supplies_provider_id` mediumint(8) unsigned NOT NULL,
  `supplies_sales_options_id` mediumint(8) unsigned NOT NULL,
  `supplies_products_id` mediumint(8) unsigned NOT NULL,
  `supplies_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `supplies_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`supplies_id`),
  KEY `supplies_supplies_provider_id_foreign` (`supplies_provider_id`),
  KEY `supplies_supplies_sales_options_id_foreign` (`supplies_sales_options_id`),
  KEY `supplies_supplies_products_id_foreign` (`supplies_products_id`),
  CONSTRAINT `supplies_supplies_products_id_foreign` FOREIGN KEY (`supplies_products_id`) REFERENCES `products` (`products_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `supplies_supplies_provider_id_foreign` FOREIGN KEY (`supplies_provider_id`) REFERENCES `providers` (`providers_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `supplies_supplies_sales_options_id_foreign` FOREIGN KEY (`supplies_sales_options_id`) REFERENCES `sales_options` (`sales_options_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.supplies : ~18 rows (environ)
/*!40000 ALTER TABLE `supplies` DISABLE KEYS */;
REPLACE INTO `supplies` (`supplies_id`, `supplies_code_barre`, `supplies_cost`, `supplies_selling_price`, `supplies_selling_quantity`, `supplies_provider_id`, `supplies_sales_options_id`, `supplies_products_id`, `supplies_created_at`, `supplies_updated_at`) VALUES
	(1, NULL, 0, 450000, 0, 1, 2, 1, '2022-03-02 15:43:52', '2022-03-02 15:43:52'),
	(2, NULL, 450000, 500000, 100, 3, 2, 1, '2022-03-02 15:58:47', '2022-03-02 15:58:47'),
	(3, NULL, 0, 380000, 0, 1, 2, 2, '2022-03-02 15:59:32', '2022-03-02 15:59:32'),
	(4, NULL, 0, 5000, 0, 1, 2, 3, '2022-03-02 15:59:50', '2022-03-02 15:59:50'),
	(5, NULL, 0, 3500, 0, 1, 2, 4, '2022-03-02 16:00:14', '2022-03-02 16:00:14'),
	(6, NULL, 0, 800, 0, 1, 1, 5, '2022-03-02 16:00:39', '2022-03-02 16:00:39'),
	(7, NULL, 0, 1350, 0, 1, 5, 6, '2022-03-02 16:00:57', '2022-03-02 16:00:57'),
	(8, NULL, 0, 900, 0, 1, 5, 7, '2022-03-02 16:01:17', '2022-03-02 16:01:17'),
	(9, NULL, 0, 27000, 0, 1, 2, 8, '2022-03-02 16:01:35', '2022-03-02 16:01:35'),
	(10, NULL, 0, 75000, 0, 1, 2, 9, '2022-03-02 16:01:56', '2022-03-02 16:01:56'),
	(11, NULL, 450000, 49000, 35, 3, 2, 1, '2022-03-02 17:11:08', '2022-03-02 17:11:08'),
	(12, NULL, 380000, 450000, 90, 3, 2, 2, '2022-03-02 17:11:08', '2022-03-02 17:11:08'),
	(13, NULL, 3500, 5000, 40, 3, 2, 3, '2022-03-02 17:11:08', '2022-03-02 17:11:08'),
	(14, NULL, 2000, 3500, 300, 3, 2, 4, '2022-03-02 17:11:08', '2022-03-02 17:11:08'),
	(15, NULL, 500, 800, 150, 3, 1, 5, '2022-03-02 17:11:08', '2022-03-02 17:11:08'),
	(16, NULL, 700, 1350, 300, 3, 5, 6, '2022-03-02 17:11:08', '2022-03-02 17:11:08'),
	(17, NULL, 600, 900, 50, 3, 5, 7, '2022-03-02 17:11:08', '2022-03-02 17:11:08'),
	(18, NULL, 45000, 75000, 30, 4, 2, 9, '2022-03-02 17:11:08', '2022-03-02 17:11:08');
/*!40000 ALTER TABLE `supplies` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `company` varchar(150) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `activation_selector` (`activation_selector`),
  UNIQUE KEY `forgotten_password_selector` (`forgotten_password_selector`),
  UNIQUE KEY `remember_selector` (`remember_selector`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.users : ~2 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_at`, `updated_at`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `address`) VALUES
	(1, '127.0.0.1', 'administrator', '$2y$12$Upka3da/v2XVpzxqs3aV0u6dQ6ZGCzW0uNd2YIwj1ir3o6uDIwXw.', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, '2022-03-02 14:52:22', '2022-03-04 07:19:11', 1646374751, 1, 'Admin', 'istrator', 'ADMIN', '65656565', 'Cotonou'),
	(2, '127.0.0.1', 'Vendeur', '$2y$08$200Z6ZZbp3RAEXoaWcMA6uJOFicwNZaqk4oDhqTUiFXFe63MG.Daa', 'vendeur@vendeur.com', NULL, '', NULL, NULL, NULL, NULL, NULL, '2022-03-02 14:52:22', '2022-03-02 14:52:22', 1268889823, 1, 'Pierre', 'ALI', 'Seller', '66666666', 'Cotonou');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. users_groups
CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_groups_user_id_foreign` (`user_id`),
  KEY `users_groups_group_id_foreign` (`group_id`),
  CONSTRAINT `users_groups_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `users_groups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.users_groups : ~2 rows (environ)
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
REPLACE INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
	(1, 1, 1),
	(2, 2, 2);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;

-- Listage de la structure de déclencheur inventory_manager. product_prices_after_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `product_prices_after_delete` AFTER DELETE ON `product_prices` FOR EACH ROW BEGIN
	DELETE FROM sell_details WHERE sell_details.sell_details_products_id = OLD.product_prices_product_id 
	AND sell_details.sell_details_sales_options_id = OLD.product_prices_sales_option_id AND sell_details.sell_details_quantity = 0;
	
	DELETE FROM supplies WHERE supplies.supplies_products_id = OLD.product_prices_product_id 
	AND supplies.supplies_sales_options_id = OLD.product_prices_sales_option_id AND supplies.supplies_selling_quantity = 0 AND supplies.supplies_provider_id = 1;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Listage de la structure de déclencheur inventory_manager. product_prices_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `product_prices_after_insert` AFTER INSERT ON `product_prices` FOR EACH ROW BEGIN
IF (SELECT products_id FROM inventory 
	WHERE products_id = NEW.product_prices_product_id 
	AND sales_options_id = NEW.product_prices_sales_option_id) IS null  THEN
	
	INSERT INTO `sell_details` 
			 (`sell_details_amount`,
			  `sell_details_quantity`,
			  `sell_details_sales_options_id`,
			  `sell_details_sales_id`,
			  `sell_details_products_id`,
			  `sell_details_default_price`,
			  `sell_details_selling_price`
			  ) 
			 VALUES 
			 (0,
			  0,
			  NEW.product_prices_sales_option_id,
			  1,
			  NEW.product_prices_product_id,
			  NEW.product_prices_price,
			  NEW.product_prices_price
			  );
			  
			  INSERT INTO `supplies` 
			 (`supplies_cost`,
			  `supplies_selling_price`,
			  `supplies_selling_quantity`,
			  `supplies_provider_id`,
			  `supplies_sales_options_id`,
			  `supplies_products_id`
			  ) 
			 VALUES 
			 (0,
			  NEW.product_prices_price,
			  0,
			  1,
			  NEW.product_prices_sales_option_id,
			  NEW.product_prices_product_id			  
			  );

END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Listage de la structure de déclencheur inventory_manager. sell_details_before_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `sell_details_before_insert` BEFORE INSERT ON `sell_details` FOR EACH ROW BEGIN
	IF (NEW.sell_details_reduction > 0) THEN
		SET NEW.sell_details_default_price = (SELECT product_prices.product_prices_price FROM product_prices WHERE product_prices.product_prices_product_id = NEW.sell_details_products_id AND product_prices.product_prices_sales_option_id = NEW.sell_details_sales_options_id);
		SET NEW.sell_details_selling_price = (NEW.sell_details_amount - NEW.sell_details_reduction)/ NEW.sell_details_quantity;
	ELSE
		IF (NEW.sell_details_default_price IS NULL OR NEW.sell_details_default_price = 0 ) THEN
			SET NEW.sell_details_default_price = (SELECT product_prices.product_prices_price FROM product_prices WHERE product_prices.product_prices_product_id = NEW.sell_details_products_id AND product_prices.product_prices_sales_option_id = NEW.sell_details_sales_options_id);
			SET NEW.sell_details_selling_price = NEW.sell_details_default_price;
		END IF;
	END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Listage de la structure de la vue inventory_manager. inventory
-- Suppression de la table temporaire et création finale de la structure d'une vue
DROP TABLE IF EXISTS `inventory`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `inventory` AS SELECT 

product_categories.`*`,
products.products_id,products.products_name,
sales_options.sales_options_id,sales_options.sales_options_name,

SUM(supplies.supplies_selling_quantity) AS supply_quantity_total,


(SELECT SUM(sell_details.sell_details_quantity) FROM sell_details 
WHERE sell_details.sell_details_sales_options_id = sales_options.sales_options_id AND sell_details.sell_details_products_id=products.products_id) AS sell_quantity_total,

(
SUM(supplies.supplies_selling_quantity) 
- 
(SELECT SUM(sell_details.sell_details_quantity) FROM sell_details 
 WHERE sell_details.sell_details_sales_options_id = sales_options.sales_options_id AND sell_details.sell_details_products_id=products.products_id 
)
) AS quantity_inventory


FROM  sales_options, product_categories, products, supplies
WHERE supplies.supplies_products_id = products.products_id
AND supplies.supplies_sales_options_id = sales_options.sales_options_id
AND product_categories.product_categories_id = products.products_product_categorie_id


GROUP BY
products.products_id, 
sales_options.sales_options_id ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
