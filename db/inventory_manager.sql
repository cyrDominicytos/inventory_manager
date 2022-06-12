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

-- Listage de la structure de la table inventory_manager. clients
DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `clients_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `clients_ifu` varchar(13) DEFAULT NULL,
  `clients_company` varchar(250) NOT NULL,
  `clients_phone_number` varchar(100) DEFAULT NULL,
  `clients_email` varchar(100) DEFAULT NULL,
  `clients_address` varchar(250) NOT NULL,
  `clients_isActive` tinyint(1) unsigned DEFAULT '1',
  `clients_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `clients_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`clients_id`),
  UNIQUE KEY `clients_ifu` (`clients_ifu`),
  UNIQUE KEY `clients_phone_number` (`clients_phone_number`),
  UNIQUE KEY `clients_email` (`clients_email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.clients : ~0 rows (environ)
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` (`clients_id`, `clients_ifu`, `clients_company`, `clients_phone_number`, `clients_email`, `clients_address`, `clients_isActive`, `clients_created_at`, `clients_updated_at`) VALUES
	(1, '6235197846125', 'ali alissou', '62487956', 'alialissou@gmail.com', 'Aidjèdo', 1, '2022-02-11 17:48:13', '2022-02-11 17:49:17');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. delivery_mens
DROP TABLE IF EXISTS `delivery_mens`;
CREATE TABLE IF NOT EXISTS `delivery_mens` (
  `delivery_mens_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `delivery_mens_ifu` varchar(13) DEFAULT NULL,
  `delivery_mens_company` varchar(250) NOT NULL,
  `delivery_mens_phone_number` varchar(100) DEFAULT NULL,
  `delivery_mens_email` varchar(100) DEFAULT NULL,
  `delivery_mens_address` varchar(250) NOT NULL,
  `delivery_mens_isActive` tinyint(1) unsigned DEFAULT '1',
  `delivery_mens_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `delivery_mens_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`delivery_mens_id`),
  UNIQUE KEY `delivery_mens_ifu` (`delivery_mens_ifu`),
  UNIQUE KEY `delivery_mens_phone_number` (`delivery_mens_phone_number`),
  UNIQUE KEY `delivery_mens_email` (`delivery_mens_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.delivery_mens : ~0 rows (environ)
/*!40000 ALTER TABLE `delivery_mens` DISABLE KEYS */;
/*!40000 ALTER TABLE `delivery_mens` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. groups
DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `display_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.groups : ~5 rows (environ)
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `name`, `display_name`, `description`) VALUES
	(1, 'admin', 'Administrateur', 'Administrateur'),
	(2, 'comptable', 'comptable', 'Comptable'),
	(3, 'vendeur', 'vendeur', 'Vendeur'),
	(4, 'superviseur', 'Superviseur', ''),
	(5, 'Superviseur2', 'Superviseur', '');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. groups_permissions
DROP TABLE IF EXISTS `groups_permissions`;
CREATE TABLE IF NOT EXISTS `groups_permissions` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` mediumint(8) unsigned NOT NULL,
  `permissions` json NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groups_permissions_group_id_foreign` (`group_id`),
  CONSTRAINT `groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.groups_permissions : ~2 rows (environ)
/*!40000 ALTER TABLE `groups_permissions` DISABLE KEYS */;
INSERT INTO `groups_permissions` (`id`, `group_id`, `permissions`) VALUES
	(2, 5, '{"60": {"id": "60", "name": "Consulter_Clients", "module": "Clients", "description": "Voir la liste des clients"}, "61": {"id": "61", "name": "Enregistrer_Clients", "module": "Clients", "description": "Enregistrer un client"}, "62": {"id": "62", "name": "Editer_Clients", "module": "Clients", "description": "Editer un client"}, "63": {"id": "63", "name": "Supprimer_Clients", "module": "Clients", "description": "Supprimer un client"}, "70": {"id": "70", "name": "Consulter_Fournisseurs", "module": "Fournisseurs", "description": "Voir la liste des fournisseurs"}, "71": {"id": "71", "name": "Enregistrer_Fournisseurs", "module": "Fournisseurs", "description": "Enregistrer un fournisseur"}}'),
	(3, 4, '{"30": {"id": "30", "name": "Consulter_Commandes_Clients", "module": "Commandes_Clients", "description": "Consulter les commandes des clients"}, "31": {"id": "31", "name": "Enregistrer_Commandes_Clients", "module": "Commandes_Clients", "description": "Enregistrer les commandes des clients"}, "32": {"id": "32", "name": "Editer_Commandes_Clients", "module": "Commandes_Clients", "description": "Editer les commandes des clients"}, "33": {"id": "33", "name": "Supprimer_Commandes_Clients", "module": "Commandes_Clients", "description": "Supprimer les commandes des clients"}, "40": {"id": "40", "name": "Consulter_Approvisionnements", "module": "Approvisionnements", "description": "Consulter les approvisionnements de produit"}, "41": {"id": "41", "name": "Enregistrer_Approvisionnements", "module": "Approvisionnements", "description": "Enregistrer les approvisionnements de produit"}, "42": {"id": "42", "name": "Editer_Approvisionnements", "module": "Approvisionnements", "description": "Editer les approvisionnements de produit"}, "43": {"id": "43", "name": "Supprimer_Approvisionnements", "module": "Approvisionnements", "description": "Supprimer les approvisionnements de produit"}, "60": {"id": "60", "name": "Consulter_Clients", "module": "Clients", "description": "Voir la liste des clients"}, "61": {"id": "61", "name": "Enregistrer_Clients", "module": "Clients", "description": "Enregistrer un client"}, "62": {"id": "62", "name": "Editer_Clients", "module": "Clients", "description": "Editer un client"}, "63": {"id": "63", "name": "Supprimer_Clients", "module": "Clients", "description": "Supprimer un client"}, "70": {"id": "70", "name": "Consulter_Fournisseurs", "module": "Fournisseurs", "description": "Voir la liste des fournisseurs"}, "71": {"id": "71", "name": "Enregistrer_Fournisseurs", "module": "Fournisseurs", "description": "Enregistrer un fournisseur"}, "72": {"id": "72", "name": "Editer_Fournisseurs", "module": "Fournisseurs", "description": "Editer un fournisseur"}, "73": {"id": "73", "name": "Supprimer_Fournisseurs", "module": "Fournisseurs", "description": "Supprimer un fournisseur"}, "80": {"id": "80", "name": "Consulter_Livreurs", "module": "Livreurs", "description": "Voir la liste des livreurs"}, "81": {"id": "81", "name": "Enregistrer_Livreurs", "module": "Livreurs", "description": "Enregistrer un livreur"}, "82": {"id": "82", "name": "Editer_Livreurs", "module": "Livreurs", "description": "Editer un livreur"}, "83": {"id": "83", "name": "Supprimer_Livreurs", "module": "Livreurs", "description": "Supprimer un livreur"}}'),
	(4, 1, '[]');
/*!40000 ALTER TABLE `groups_permissions` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. login_attempts
DROP TABLE IF EXISTS `login_attempts`;
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
DROP TABLE IF EXISTS `migrations`;
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
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
	(1, '20181211100537', 'IonAuth\\Database\\Migrations\\Migration_Install_ion_auth', '', 'IonAuth', 1644417805, 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. permissions
DROP TABLE IF EXISTS `permissions`;
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
INSERT INTO `permissions` (`id`, `name`, `module`, `description`) VALUES
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
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `products_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `products_name` varchar(100) DEFAULT NULL,
  `products_barre_code` varchar(255) DEFAULT NULL,
  `products_description` text,
  `products_isActive` tinyint(1) unsigned DEFAULT '1',
  `products_product_categorie_id` mediumint(8) unsigned NOT NULL,
  `products_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `products_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`products_id`),
  UNIQUE KEY `products_name` (`products_name`),
  UNIQUE KEY `products_barre_code` (`products_barre_code`),
  KEY `products_products_product_categorie_id_foreign` (`products_product_categorie_id`),
  CONSTRAINT `products_products_product_categorie_id_foreign` FOREIGN KEY (`products_product_categorie_id`) REFERENCES `product_categories` (`product_categories_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.products : ~4 rows (environ)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`products_id`, `products_name`, `products_barre_code`, `products_description`, `products_isActive`, `products_product_categorie_id`, `products_created_at`, `products_updated_at`) VALUES
	(1, 'HUILE', NULL, '', 0, 2, '2022-02-11 11:49:55', '2022-02-11 17:28:53'),
	(2, 'ORDINATEUR HP ELITE BOOK', NULL, '', 1, 1, '2022-02-11 11:55:33', '2022-02-11 17:29:23'),
	(3, 'DISQUE DURE EXTERNE 500GO', NULL, '', 1, 1, '2022-02-11 11:56:06', '2022-02-11 11:56:06'),
	(4, 'POULET', NULL, '', 0, 3, '2022-02-11 11:57:28', '2022-02-11 17:29:12');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. product_categories
DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE IF NOT EXISTS `product_categories` (
  `product_categories_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `product_categories_name` varchar(100) DEFAULT NULL,
  `product_categories_description` text,
  `product_categories_isActive` tinyint(1) unsigned DEFAULT '1',
  `product_categories_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `product_categories_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_categories_id`),
  UNIQUE KEY `product_categories_name` (`product_categories_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.product_categories : ~2 rows (environ)
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` (`product_categories_id`, `product_categories_name`, `product_categories_description`, `product_categories_isActive`, `product_categories_created_at`, `product_categories_updated_at`) VALUES
	(1, 'Matériel Informatique', '', 1, '2022-02-10 15:30:58', '2022-02-10 15:30:58'),
	(2, 'DIVERS', '', 1, '2022-02-11 11:17:26', '2022-02-11 11:17:26'),
	(3, 'POISSONNERIE', '', 1, '2022-02-11 11:17:51', '2022-02-11 11:17:51');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. product_prices
DROP TABLE IF EXISTS `product_prices`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.product_prices : ~0 rows (environ)
/*!40000 ALTER TABLE `product_prices` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_prices` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. providers
DROP TABLE IF EXISTS `providers`;
CREATE TABLE IF NOT EXISTS `providers` (
  `providers_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `providers_ifu` varchar(13) DEFAULT NULL,
  `providers_company` varchar(250) NOT NULL,
  `providers_phone_number` varchar(100) DEFAULT NULL,
  `providers_email` varchar(100) DEFAULT NULL,
  `providers_address` varchar(250) NOT NULL,
  `providers_isActive` tinyint(1) unsigned DEFAULT '1',
  `providers_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `providers_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`providers_id`),
  UNIQUE KEY `providers_ifu` (`providers_ifu`),
  UNIQUE KEY `providers_phone_number` (`providers_phone_number`),
  UNIQUE KEY `providers_email` (`providers_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.providers : ~0 rows (environ)
/*!40000 ALTER TABLE `providers` DISABLE KEYS */;
/*!40000 ALTER TABLE `providers` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. sales_options
DROP TABLE IF EXISTS `sales_options`;
CREATE TABLE IF NOT EXISTS `sales_options` (
  `sales_options_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `sales_options_name` varchar(100) DEFAULT NULL,
  `sales_options_description` text,
  `sales_options_isActive` tinyint(1) unsigned DEFAULT '1',
  `sales_options_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `sales_options_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sales_options_id`),
  UNIQUE KEY `sales_options_name` (`sales_options_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory_manager.sales_options : ~5 rows (environ)
/*!40000 ALTER TABLE `sales_options` DISABLE KEYS */;
INSERT INTO `sales_options` (`sales_options_id`, `sales_options_name`, `sales_options_description`, `sales_options_isActive`, `sales_options_created_at`, `sales_options_updated_at`) VALUES
	(1, 'KG', 'Le KG d\'un produit', 1, '2022-02-10 15:13:34', '2022-02-11 17:38:57'),
	(2, 'LITTRE', 'LE LITTRE D\'UN PRODUIT', 1, '2022-02-10 15:33:03', '2022-02-10 15:33:03'),
	(3, 'SACHET', 'SACHET', 1, '2022-02-10 15:35:10', '2022-02-10 15:35:10'),
	(4, 'PAQUET', '', 1, '2022-02-10 15:35:52', '2022-02-10 15:36:47'),
	(5, 'SAC', 'Le sac d\'un produit', 1, '2022-02-11 17:34:39', '2022-02-11 17:35:16');
/*!40000 ALTER TABLE `sales_options` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. users
DROP TABLE IF EXISTS `users`;
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
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_at`, `updated_at`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `address`) VALUES
	(1, '127.0.0.1', 'administrator', '$2y$12$QW0Ylko9cDPnRKF3Nb1RZOCPYzDjh.2J0wdEuTnS4iWwxrXWg73fO', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, '2022-02-09 15:44:40', '2022-02-16 09:17:27', 1644999447, 1, 'Admin', 'istrator', 'ADMIN', '65656565', 'Cotonou'),
	(2, '127.0.0.1', 'Vendeur', '$2y$08$200Z6ZZbp3RAEXoaWcMA6uJOFicwNZaqk4oDhqTUiFXFe63MG.Daa', 'vendeur@vendeur.com', NULL, '', NULL, NULL, NULL, NULL, NULL, '2022-02-09 15:44:40', '2022-02-09 15:44:40', 1268889823, 1, 'Pierre', 'ALI', 'Seller', '66666666', 'Cotonou');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Listage de la structure de la table inventory_manager. users_groups
DROP TABLE IF EXISTS `users_groups`;
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
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
	(1, 1, 1),
	(2, 2, 2);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
