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


-- Listage de la structure de la base pour gbarstock
DROP DATABASE IF EXISTS `gbarstock`;
CREATE DATABASE IF NOT EXISTS `gbarstock` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gbarstock`;

-- Listage de la structure de la table gbarstock. bills
DROP TABLE IF EXISTS `bills`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table gbarstock.bills : ~0 rows (environ)
/*!40000 ALTER TABLE `bills` DISABLE KEYS */;
/*!40000 ALTER TABLE `bills` ENABLE KEYS */;

-- Listage de la structure de la table gbarstock. clients
DROP TABLE IF EXISTS `clients`;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Listage des données de la table gbarstock.clients : ~1 rows (environ)
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` (`clients_id`, `clients_ifu`, `clients_company`, `clients_phone_number`, `clients_email`, `clients_address`, `clients_isActive`, `clients_created_at`, `clients_updated_at`) VALUES
	(1, NULL, 'Defaut', '65000000', NULL, NULL, 1, '2022-06-24 03:11:37', '2022-06-24 03:11:37');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;

-- Listage de la structure de la table gbarstock. config
DROP TABLE IF EXISTS `config`;
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

-- Listage des données de la table gbarstock.config : ~11 rows (environ)
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` (`config_id`, `config_code`, `config_name`, `config_description`, `config_value`, `config_created_at`, `config_updated_at`) VALUES
	(1, 1, 'company_name', 'Nom de l\'entreprise', 'STOCK BAR', '2022-03-02 14:52:22', '2022-06-12 17:22:05'),
	(2, 2, 'company_ifu', 'Numéro IFU de l\'entreprise', '0000000000000', '2022-03-02 14:52:22', '2022-06-12 17:22:05'),
	(3, 3, 'company_email', 'Email de l\'entreprise', 'test@test.com', '2022-03-02 14:52:22', '2022-06-12 17:22:05'),
	(4, 4, 'company_phone_number', 'Numéro de téléphone de l\'entreprise', '+229 00 00 00 00', '2022-03-02 14:52:22', '2022-06-12 17:22:05'),
	(5, 5, 'company_address', 'Adresse physique de l\'entreprise', 'Bénin, Cotonou,', '2022-03-02 14:52:22', '2022-06-12 17:22:05'),
	(6, 6, 'company_product_identity', 'Identificateur des produits de l\'entreprise', 'barre_code', '2022-03-02 14:52:22', '2022-03-02 14:52:22'),
	(7, 7, 'company_identity', 'Identifiant de connexion de l\'entreprise', 'email', '2022-03-02 14:52:22', '2022-03-02 14:52:22'),
	(8, 8, 'company_created_at', 'Date de création de l\'entreprise', '2020-03-17', '2022-03-02 14:52:22', '2022-03-04 07:24:24'),
	(9, 9, 'company_site_url', 'Adresse de site web de l\'entreprise', '', '2022-03-02 14:52:22', '2022-06-12 17:22:05'),
	(10, 10, 'company_rccm', 'Registre de commerce de l\'entreprise', '', '2022-03-02 14:52:22', '2022-06-12 17:22:05'),
	(11, 11, 'company_logo', 'Logo de l\'entreprise', 'uploads/logo/company_logo.png', '2022-03-04 07:26:44', '2022-03-04 08:21:36');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

-- Listage de la structure de la table gbarstock. delivery_mens
DROP TABLE IF EXISTS `delivery_mens`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table gbarstock.delivery_mens : ~0 rows (environ)
/*!40000 ALTER TABLE `delivery_mens` DISABLE KEYS */;
/*!40000 ALTER TABLE `delivery_mens` ENABLE KEYS */;

-- Listage de la structure de la table gbarstock. equivalence_quantities
DROP TABLE IF EXISTS `equivalence_quantities`;
CREATE TABLE IF NOT EXISTS `equivalence_quantities` (
  `equivalence_quantities_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `equivalence_quantities_quantity` mediumint(8) unsigned NOT NULL,
  `equivalence_quantities_product_id` mediumint(8) unsigned NOT NULL,
  `eq_default_option_id` mediumint(8) unsigned NOT NULL,
  `equivalence_quantities_relation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `equivalence_quantities_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `equivalence_quantities_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`equivalence_quantities_id`),
  KEY `equivalence_quantities_equivalence_quantities_product_id_foreign` (`equivalence_quantities_product_id`),
  KEY `equivalence_quantities_eq_default_option_id_foreign` (`eq_default_option_id`),
  CONSTRAINT `equivalence_quantities_eq_default_option_id_foreign` FOREIGN KEY (`eq_default_option_id`) REFERENCES `sales_options` (`sales_options_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `equivalence_quantities_equivalence_quantities_product_id_foreign` FOREIGN KEY (`equivalence_quantities_product_id`) REFERENCES `products` (`products_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table gbarstock.equivalence_quantities : ~0 rows (environ)
/*!40000 ALTER TABLE `equivalence_quantities` DISABLE KEYS */;
/*!40000 ALTER TABLE `equivalence_quantities` ENABLE KEYS */;

-- Listage de la structure de la table gbarstock. exonerations
DROP TABLE IF EXISTS `exonerations`;
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

-- Listage des données de la table gbarstock.exonerations : ~6 rows (environ)
/*!40000 ALTER TABLE `exonerations` DISABLE KEYS */;
INSERT INTO `exonerations` (`exonerations_id`, `exonerations_name`, `exonerations_slug`, `exonerations_rate`, `exonerations_created_at`, `exonerations_updated_at`) VALUES
	(1, 'A', '[A : Exonération totale]', '0', '2022-03-02 14:52:22', '2022-03-02 14:52:22'),
	(2, 'B', '[B : 18%]', '18', '2022-03-02 14:52:22', '2022-03-02 14:52:22'),
	(3, 'C', '[C : Exonération totale]', '0', '2022-03-02 14:52:22', '2022-03-02 14:52:22'),
	(4, 'D', '[D : 18%]', '18', '2022-03-02 14:52:22', '2022-03-02 14:52:22'),
	(5, 'E', '[E : Exonération totale]', '0', '2022-03-02 14:52:22', '2022-03-02 14:52:22'),
	(6, 'F', '[F : Exonération totale]', '0', '2022-03-02 14:52:22', '2022-03-02 14:52:22');
/*!40000 ALTER TABLE `exonerations` ENABLE KEYS */;

-- Listage de la structure de la table gbarstock. groups
DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `display_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Listage des données de la table gbarstock.groups : ~2 rows (environ)
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `name`, `display_name`, `description`) VALUES
	(1, 'admin', 'admin', 'Administrateur'),
	(4, 'Comptable', 'Comptable', 'Comptable');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

-- Listage de la structure de la table gbarstock. groups_permissions
DROP TABLE IF EXISTS `groups_permissions`;
CREATE TABLE IF NOT EXISTS `groups_permissions` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` mediumint(8) unsigned NOT NULL,
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groups_permissions_group_id_foreign` (`group_id`),
  CONSTRAINT `groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Listage des données de la table gbarstock.groups_permissions : ~2 rows (environ)
/*!40000 ALTER TABLE `groups_permissions` DISABLE KEYS */;
INSERT INTO `groups_permissions` (`id`, `group_id`, `permissions`) VALUES
	(3, 1, '{"10":{"id":"10","name":"Consulter_Statistiques","module":"Statistiques","description":"Voir le tabeau de bord"},"20":{"id":"20","name":"Consulter_Ventes","module":"Ventes","description":"Consulter la liste des ventes"},"21":{"id":"21","name":"Effectuer_Ventes","module":"Ventes","description":"Vendre un produit"},"22":{"id":"22","name":"Editer_Ventes","module":"Ventes","description":"Editer une vente"},"23":{"id":"23","name":"Supprimer_Ventes","module":"Ventes","description":"Supprimer une vente"},"30":{"id":"30","name":"Consulter_Commandes_Clients","module":"Commandes_Clients","description":"Consulter les commandes des clients"},"31":{"id":"31","name":"Enregistrer_Commandes_Clients","module":"Commandes_Clients","description":"Enregistrer les commandes des clients"},"32":{"id":"32","name":"Editer_Commandes_Clients","module":"Commandes_Clients","description":"Editer les commandes des clients"},"33":{"id":"33","name":"Supprimer_Commandes_Clients","module":"Commandes_Clients","description":"Supprimer les commandes des clients"},"40":{"id":"40","name":"Consulter_Approvisionnements","module":"Approvisionnements","description":"Consulter les approvisionnements de produit"},"41":{"id":"41","name":"Enregistrer_Approvisionnements","module":"Approvisionnements","description":"Enregistrer les approvisionnements de produit"},"42":{"id":"42","name":"Editer_Approvisionnements","module":"Approvisionnements","description":"Editer les approvisionnements de produit"},"43":{"id":"43","name":"Supprimer_Approvisionnements","module":"Approvisionnements","description":"Supprimer les approvisionnements de produit"},"50":{"id":"50","name":"Consulter_Stocks","module":"Stocks","description":"Consulter l\'inventaire de stock"},"60":{"id":"60","name":"Consulter_Clients","module":"Clients","description":"Voir la liste des clients"},"61":{"id":"61","name":"Enregistrer_Clients","module":"Clients","description":"Enregistrer un client"},"62":{"id":"62","name":"Editer_Clients","module":"Clients","description":"Editer un client"},"63":{"id":"63","name":"Supprimer_Clients","module":"Clients","description":"Supprimer un client"},"70":{"id":"70","name":"Consulter_Fournisseurs","module":"Fournisseurs","description":"Voir la liste des fournisseurs"},"71":{"id":"71","name":"Enregistrer_Fournisseurs","module":"Fournisseurs","description":"Enregistrer un fournisseur"},"72":{"id":"72","name":"Editer_Fournisseurs","module":"Fournisseurs","description":"Editer un fournisseur"},"73":{"id":"73","name":"Supprimer_Fournisseurs","module":"Fournisseurs","description":"Supprimer un fournisseur"},"80":{"id":"80","name":"Consulter_Livreurs","module":"Livreurs","description":"Voir la liste des livreurs"},"81":{"id":"81","name":"Enregistrer_Livreurs","module":"Livreurs","description":"Enregistrer un livreur"},"82":{"id":"82","name":"Editer_Livreurs","module":"Livreurs","description":"Editer un livreur"},"83":{"id":"83","name":"Supprimer_Livreurs","module":"Livreurs","description":"Supprimer un livreur"},"90":{"id":"90","name":"Consulter_Utilisateurs","module":"Utilisateurs","description":"Voir la liste des utilisateurs"},"91":{"id":"91","name":"Enregistrer_Utilisateurs","module":"Utilisateurs","description":"Enregistrer un utilisateur"},"92":{"id":"92","name":"Editer_Utilisateurs","module":"Utilisateurs","description":"Editer un utilisateur"},"93":{"id":"93","name":"Supprimer_Utilisateurs","module":"Utilisateurs","description":"Supprimer un utilisateur"},"100":{"id":"100","name":"Consulter_Roles_Permissions","module":"Roles_Permissions","description":"Voir la liste des Roles et Permissions"},"101":{"id":"101","name":"Enregistrer_Roles_Permissions","module":"Roles_Permissions","description":"Enregistrer un R\\u00f4le"},"102":{"id":"102","name":"Editer_Roles_Permissions","module":"Roles_Permissions","description":"Editer un R\\u00f4le"},"103":{"id":"103","name":"Supprimer_Roles_Permissions","module":"Roles_Permissions","description":"Supprimer un R\\u00f4le"},"110":{"id":"110","name":"Consulter_Parametrages","module":"Parametrages","description":"Voir les Param\\u00e9trages"},"112":{"id":"112","name":"Editer_Parametrages","module":"Parametrages","description":"Editer un Param\\u00e9trage"},"120":{"id":"120","name":"Consulter_Categorie","module":"Categories produits","description":"Consulter cat\\u00e9gories des produits"},"121":{"id":"121","name":"Enregistrer_Categorie_Produit","module":"Categories produits","description":"Enregistrer cat\\u00e9gories des produits"},"130":{"id":"130","name":"Consulter_Produit","module":"Produits","description":"Consulter cat\\u00e9gories des produits"},"131":{"id":"131","name":"Enregistrer_Produit","module":"Produits","description":"Enregistrer  des produits"},"140":{"id":"140","name":"Consulter_Option_Vente","module":"Option Vente","description":"Consulter option de vente"},"141":{"id":"141","name":"Enregistrer_Option_Vente","module":"Option Vente","description":"Enregistrer option de vente"},"150":{"id":"150","name":"Consulter_Prix_Vente","module":"Prix de Vente","description":"Consulter prix de vente"},"151":{"id":"151","name":"Enregistrer_Prix_Vente","module":"Prix de Vente","description":"Enregistrer prix de vente"}}'),
	(5, 4, '{"30":{"id":"30","name":"Consulter_Commandes_Clients","module":"Commandes_Clients","description":"Consulter les commandes des clients"},"40":{"id":"40","name":"Consulter_Approvisionnements","module":"Approvisionnements","description":"Consulter les approvisionnements de produit"},"60":{"id":"60","name":"Consulter_Clients","module":"Clients","description":"Voir la liste des clients"},"120":{"id":"120","name":"Consulter_Categorie","module":"Categories produits","description":"Consulter cat\\u00e9gories des produits"}}');
/*!40000 ALTER TABLE `groups_permissions` ENABLE KEYS */;

-- Listage de la structure de la table gbarstock. login_attempts
DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Listage des données de la table gbarstock.login_attempts : ~1 rows (environ)
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
	(6, '::1', 'admin@gmail.com', 1656026235);
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;

-- Listage de la structure de la table gbarstock. migrations
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

-- Listage des données de la table gbarstock.migrations : ~1 rows (environ)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
	(1, '20181211100537', 'IonAuth\\Database\\Migrations\\Migration_Install_ion_auth', '', 'IonAuth', 1646229133, 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Listage de la structure de la table gbarstock. orders
DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `orders_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `orders_status` mediumint(9) NOT NULL DEFAULT '1',
  `orders_amount` double unsigned NOT NULL,
  `orders_reduction` double unsigned NOT NULL DEFAULT '0',
  `orders_is_delivable` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `orders_deliver_man` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `orders_aib` varchar(1) NOT NULL DEFAULT '0',
  `orders_users_id` mediumint(8) unsigned NOT NULL,
  `orders_description` text,
  `orders_client_id` mediumint(8) unsigned NOT NULL,
  `orders_delivery_date` date NOT NULL,
  `orders_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `orders_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`orders_id`),
  KEY `orders_orders_client_id_foreign` (`orders_client_id`),
  CONSTRAINT `orders_orders_client_id_foreign` FOREIGN KEY (`orders_client_id`) REFERENCES `clients` (`clients_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table gbarstock.orders : ~0 rows (environ)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Listage de la structure de la table gbarstock. orders_details
DROP TABLE IF EXISTS `orders_details`;
CREATE TABLE IF NOT EXISTS `orders_details` (
  `orders_details_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `orders_details_amount` double unsigned NOT NULL,
  `orders_details_reduction` mediumint(8) unsigned NOT NULL DEFAULT '0',
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

-- Listage des données de la table gbarstock.orders_details : ~0 rows (environ)
/*!40000 ALTER TABLE `orders_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_details` ENABLE KEYS */;

-- Listage de la structure de la table gbarstock. permissions
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `module` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8;

-- Listage des données de la table gbarstock.permissions : ~44 rows (environ)
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
	(112, 'Editer_Parametrages', 'Parametrages', 'Editer un Paramétrage'),
	(120, 'Consulter_Categorie', 'Categories produits', 'Consulter catégories des produits'),
	(121, 'Enregistrer_Categorie_Produit', 'Categories produits', 'Enregistrer catégories des produits'),
	(130, 'Consulter_Produit', 'Produits', 'Consulter catégories des produits'),
	(131, 'Enregistrer_Produit', 'Produits', 'Enregistrer  des produits'),
	(140, 'Consulter_Option_Vente', 'Option Vente', 'Consulter option de vente'),
	(141, 'Enregistrer_Option_Vente', 'Option Vente', 'Enregistrer option de vente'),
	(150, 'Consulter_Prix_Vente', 'Prix de Vente', 'Consulter prix de vente'),
	(151, 'Enregistrer_Prix_Vente', 'Prix de Vente', 'Enregistrer prix de vente');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Listage de la structure de la table gbarstock. products
DROP TABLE IF EXISTS `products`;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Listage des données de la table gbarstock.products : ~2 rows (environ)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`products_id`, `products_name`, `products_barre_code`, `products_description`, `products_isActive`, `products_product_categorie_id`, `products_exonerations_id`, `products_created_at`, `products_updated_at`) VALUES
	(1, 'Huile Rouge', NULL, '', 1, 2, 1, '2022-06-24 02:04:28', '2022-06-24 02:04:28'),
	(2, 'RIZ GINO', NULL, '', 1, 2, 1, '2022-06-24 02:05:03', '2022-06-24 02:05:03');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Listage de la structure de la table gbarstock. product_categories
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

-- Listage des données de la table gbarstock.product_categories : ~2 rows (environ)
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` (`product_categories_id`, `product_categories_name`, `product_categories_description`, `product_categories_isActive`, `product_categories_created_at`, `product_categories_updated_at`) VALUES
	(2, 'Divers', '', 1, '2022-06-24 01:56:45', '2022-06-24 01:56:45'),
	(3, 'Brasserie', 'test', 0, '2022-06-24 01:56:58', '2022-06-24 01:57:24');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;

-- Listage de la structure de la table gbarstock. product_prices
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Listage des données de la table gbarstock.product_prices : ~4 rows (environ)
/*!40000 ALTER TABLE `product_prices` DISABLE KEYS */;
INSERT INTO `product_prices` (`product_prices_id`, `product_prices_price`, `product_prices_product_id`, `product_prices_sales_option_id`, `product_prices_created_at`, `product_prices_updated_at`) VALUES
	(1, 800, 1, 1, '2022-06-24 02:05:57', '2022-06-24 02:05:57'),
	(2, 4500, 2, 4, '2022-06-24 02:06:26', '2022-06-24 02:06:26'),
	(3, 800, 2, 1, '2022-06-24 02:06:50', '2022-06-24 02:06:50'),
	(4, 1350, 1, 5, '2022-06-24 02:07:21', '2022-06-24 02:07:21');
/*!40000 ALTER TABLE `product_prices` ENABLE KEYS */;

-- Listage de la structure de la table gbarstock. providers
DROP TABLE IF EXISTS `providers`;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Listage des données de la table gbarstock.providers : ~1 rows (environ)
/*!40000 ALTER TABLE `providers` DISABLE KEYS */;
INSERT INTO `providers` (`providers_id`, `providers_ifu`, `providers_company`, `providers_phone_number`, `providers_email`, `providers_address`, `providers_isActive`, `providers_created_at`, `providers_updated_at`) VALUES
	(1, '0000000000000', 'Defaut', '61000000', NULL, NULL, 1, '2022-06-24 02:09:39', '2022-06-24 02:09:39');
/*!40000 ALTER TABLE `providers` ENABLE KEYS */;

-- Listage de la structure de la table gbarstock. sales
DROP TABLE IF EXISTS `sales`;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Listage des données de la table gbarstock.sales : ~0 rows (environ)
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;

-- Listage de la structure de la table gbarstock. sales_options
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Listage des données de la table gbarstock.sales_options : ~8 rows (environ)
/*!40000 ALTER TABLE `sales_options` DISABLE KEYS */;
INSERT INTO `sales_options` (`sales_options_id`, `sales_options_name`, `sales_options_description`, `sales_options_isActive`, `sales_options_created_at`, `sales_options_updated_at`) VALUES
	(1, 'KG', '', 1, '2022-02-22 11:07:47', '2022-02-22 11:07:47'),
	(2, 'Unité', '', 1, '2022-02-22 11:07:55', '2022-02-22 11:07:55'),
	(3, 'Paquet', '', 1, '2022-02-22 11:08:39', '2022-02-22 11:08:39'),
	(4, 'Sachet', '', 1, '2022-02-22 11:08:48', '2022-02-22 11:08:48'),
	(5, 'Littre', '', 1, '2022-02-22 11:09:11', '2022-02-22 11:09:11'),
	(6, 'Boite', '', 1, '2022-03-02 15:07:13', '2022-03-02 15:07:13'),
	(7, 'Carton', '', 1, '2022-03-02 15:07:29', '2022-03-02 15:07:29'),
	(8, 'Plateau', '', 0, '2022-03-02 15:07:42', '2022-06-12 11:29:02');
/*!40000 ALTER TABLE `sales_options` ENABLE KEYS */;

-- Listage de la structure de la table gbarstock. sell_details
DROP TABLE IF EXISTS `sell_details`;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Listage des données de la table gbarstock.sell_details : ~0 rows (environ)
/*!40000 ALTER TABLE `sell_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `sell_details` ENABLE KEYS */;

-- Listage de la structure de la table gbarstock. supplies
DROP TABLE IF EXISTS `supplies`;
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- Listage des données de la table gbarstock.supplies : ~0 rows (environ)
/*!40000 ALTER TABLE `supplies` DISABLE KEYS */;
/*!40000 ALTER TABLE `supplies` ENABLE KEYS */;

-- Listage de la structure de la table gbarstock. users
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Listage des données de la table gbarstock.users : ~2 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_at`, `updated_at`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `address`) VALUES
	(1, '127.0.0.1', 'administrator', '$2y$12$Upka3da/v2XVpzxqs3aV0u6dQ6ZGCzW0uNd2YIwj1ir3o6uDIwXw.', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, '2022-03-02 14:52:22', '2022-06-24 08:14:44', 1656051284, 1, 'Admin', 'istrator', 'ADMIN', '65656565', 'Cotonou'),
	(5, '::1', 'Florent', '$2y$10$T.WnHP.lVCzjOZkaSI3UyuCUtOdHDlDUeoMJC2fd9dCQzSXZRQA.O', 'florent@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-19 01:16:20', '2022-06-19 01:16:20', NULL, 1, 'Florent', 'GANIERO', '', '66748925', 'aaaa');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Listage de la structure de la table gbarstock. users_groups
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Listage des données de la table gbarstock.users_groups : ~2 rows (environ)
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
	(1, 1, 1),
	(5, 5, 4);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;

-- Listage de la structure de déclencheur gbarstock. orders_details_before_insert
DROP TRIGGER IF EXISTS `orders_details_before_insert`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `orders_details_before_insert` BEFORE INSERT ON `orders_details` FOR EACH ROW BEGIN
	IF (NEW.orders_details_reduction > 0) THEN
		SET NEW.orders_default_price = (SELECT product_prices.product_prices_price FROM product_prices WHERE product_prices.product_prices_product_id = NEW.orders_details_products_id AND product_prices.product_prices_sales_option_id = NEW.orders_details_sales_options_id);
		SET NEW.orders_selling_price = (NEW.orders_details_amount - NEW.orders_details_reduction)/ NEW.orders_details_quantity;
	ELSE
		SET NEW.orders_details_reduction =0;
		IF (NEW.orders_default_price IS NULL OR NEW.orders_default_price = 0 ) THEN
			SET NEW.orders_default_price = (SELECT product_prices.product_prices_price FROM product_prices WHERE product_prices.product_prices_product_id = NEW.orders_details_products_id AND product_prices.product_prices_sales_option_id = NEW.orders_details_sales_options_id);
			SET NEW.orders_selling_price = NEW.orders_default_price;
		END IF;
	END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Listage de la structure de déclencheur gbarstock. sell_details_before_insert
DROP TRIGGER IF EXISTS `sell_details_before_insert`;
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

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
