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

-- Listage des données de la table inventory_manager.clients : ~2 rows (environ)
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
REPLACE INTO `clients` (`clients_id`, `clients_ifu`, `clients_company`, `clients_phone_number`, `clients_email`, `clients_address`, `clients_isActive`, `clients_created_at`, `clients_updated_at`) VALUES
	(1, NULL, 'Système', NULL, NULL, '', 1, '2022-02-23 13:51:47', '2022-02-23 13:51:47'),
	(2, '1234567891236', 'assogba clément', '+22966757025', 'cyrdominicytos1@gmail.com', 'Rue 560, Cotonou, Bénin', 0, '2022-02-09 13:30:45', '2022-02-09 13:39:15'),
	(3, '1456987123654', 'assouka bili', '+22966757002', 'cyrdominicytos@gmail.com', 'Rue 560, Cotonou, Bénin', 1, '2022-02-09 13:37:49', '2022-02-09 13:37:49');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.config : ~9 rows (environ)
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
REPLACE INTO `config` (`config_id`, `config_code`, `config_name`, `config_description`, `config_value`, `config_created_at`, `config_updated_at`) VALUES
	(1, 1, 'company_name', 'Nom de l\'entreprise', 'MYAH IT COMPANY', '2022-02-23 13:51:47', '2022-02-23 13:51:47'),
	(2, 2, 'company_ifu', 'Numéro IFU de l\'entreprise', '', '2022-02-23 13:51:47', '2022-02-23 13:51:47'),
	(3, 3, 'company_email', 'Email de l\'entreprise', '', '2022-02-23 13:51:47', '2022-02-23 13:51:47'),
	(4, 4, 'company_phone_number', 'Numéro de téléphone de l\'entreprise', '', '2022-02-23 13:51:47', '2022-02-23 13:51:47'),
	(5, 5, 'company_address', 'Adresse physique de l\'entreprise', '', '2022-02-23 13:51:47', '2022-02-23 13:51:47'),
	(6, 6, 'company_product_identity', 'Identificateur des produits de l\'entreprise', 'barre_code', '2022-02-23 13:51:47', '2022-02-23 13:51:47'),
	(7, 7, 'company_identity', 'Identifiant de connexion de l\'entreprise', 'email', '2022-02-23 13:51:47', '2022-02-23 13:51:47'),
	(8, 8, 'company_created_at', 'Date de création de l\'entreprise', '', '2022-02-23 13:51:47', '2022-02-23 13:51:47'),
	(9, 9, 'company_site_url', 'Adresse de site web de l\'entreprise', '', '2022-02-23 13:51:47', '2022-02-23 13:51:47');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.delivery_mens : ~2 rows (environ)
/*!40000 ALTER TABLE `delivery_mens` DISABLE KEYS */;
REPLACE INTO `delivery_mens` (`delivery_mens_id`, `delivery_mens_ifu`, `delivery_mens_company`, `delivery_mens_phone_number`, `delivery_mens_email`, `delivery_mens_address`, `delivery_mens_isActive`, `delivery_mens_created_at`, `delivery_mens_updated_at`) VALUES
	(1, NULL, 'assouka benjamin', '62359847', NULL, '', 0, '2022-02-09 13:41:23', '2022-02-09 13:46:49'),
	(2, '1456987123625', 'ali alissou', '65254897', NULL, '', 1, '2022-02-09 13:46:22', '2022-02-09 13:46:38');
/*!40000 ALTER TABLE `delivery_mens` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.exonerations : ~3 rows (environ)
/*!40000 ALTER TABLE `exonerations` DISABLE KEYS */;
REPLACE INTO `exonerations` (`exonerations_id`, `exonerations_name`, `exonerations_slug`, `exonerations_rate`, `exonerations_created_at`, `exonerations_updated_at`) VALUES
	(1, 'A', '[A : Exonération totale]', '0', '2022-02-23 13:51:47', '2022-02-23 13:51:47'),
	(2, 'B', '[B : 18%]', '18', '2022-02-23 13:51:47', '2022-02-23 13:51:47'),
	(3, 'E', '[E : Exonération totale]', '0', '2022-02-23 13:51:47', '2022-02-23 13:51:47');
/*!40000 ALTER TABLE `exonerations` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.groups : ~3 rows (environ)
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
REPLACE INTO `groups` (`id`, `name`, `display_name`, `description`) VALUES
	(1, 'admin', 'admin', 'Administrateur'),
	(2, 'comptable', 'comptable', 'Comptable'),
	(3, 'vendeur', 'vendeur', 'Vendeur');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.groups_permissions : ~0 rows (environ)
/*!40000 ALTER TABLE `groups_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups_permissions` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.login_attempts : ~0 rows (environ)
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.migrations : ~0 rows (environ)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
REPLACE INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
	(1, '20181211100537', 'IonAuth\\Database\\Migrations\\Migration_Install_ion_auth', '', 'IonAuth', 1645620694, 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.orders : ~0 rows (environ)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.orders_details : ~0 rows (environ)
/*!40000 ALTER TABLE `orders_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_details` ENABLE KEYS */;

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

-- Listage des données de la table inventory_manager.products : ~9 rows (environ)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
REPLACE INTO `products` (`products_id`, `products_name`, `products_barre_code`, `products_description`, `products_isActive`, `products_product_categorie_id`, `products_exonerations_id`, `products_created_at`, `products_updated_at`) VALUES
	(1, 'ORDINATEUR HP ELITE BOOK', NULL, '', 1, 1, 1, '2022-02-22 11:09:47', '2022-02-22 11:09:47'),
	(2, 'Ordinateur TOSHIBA', NULL, '', 1, 1, 1, '2022-02-22 11:10:15', '2022-02-22 11:10:15'),
	(3, 'SOURIS', NULL, '', 1, 1, 1, '2022-02-22 11:10:33', '2022-02-22 11:10:33'),
	(4, 'CLE USB', NULL, '', 1, 1, 1, '2022-02-22 11:10:45', '2022-02-22 11:10:45'),
	(5, 'RIZ GINO', NULL, '', 1, 2, 1, '2022-02-22 11:11:06', '2022-02-22 11:11:06'),
	(6, 'HUILE D ARACHIDE', NULL, '', 1, 2, 1, '2022-02-22 11:11:30', '2022-02-23 16:13:26'),
	(7, 'HUILE ROUGE', NULL, '', 1, 1, 1, '2022-02-22 11:11:42', '2022-02-22 11:11:42'),
	(8, 'MISSEUR', NULL, '', 1, 3, 1, '2022-02-22 11:12:03', '2022-02-22 11:12:03'),
	(9, 'FER A REPASSER', NULL, '', 1, 3, 1, '2022-02-22 11:12:27', '2022-02-22 11:12:27');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.product_categories : ~3 rows (environ)
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
REPLACE INTO `product_categories` (`product_categories_id`, `product_categories_name`, `product_categories_description`, `product_categories_isActive`, `product_categories_created_at`, `product_categories_updated_at`) VALUES
	(1, 'Matériel Informatique', '', 1, '2022-02-22 11:06:47', '2022-02-22 11:06:47'),
	(2, 'Divers', '', 1, '2022-02-22 11:06:56', '2022-02-22 11:06:56'),
	(3, 'Appareils Electroménager', '', 1, '2022-02-22 11:07:20', '2022-02-22 11:07:20');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.product_prices : ~5 rows (environ)
/*!40000 ALTER TABLE `product_prices` DISABLE KEYS */;
REPLACE INTO `product_prices` (`product_prices_id`, `product_prices_price`, `product_prices_product_id`, `product_prices_sales_option_id`, `product_prices_created_at`, `product_prices_updated_at`) VALUES
	(13, 350000, 1, 2, '2022-02-23 16:28:34', '2022-02-23 16:28:34'),
	(14, 450000, 2, 2, '2022-02-23 16:28:57', '2022-02-23 16:28:57'),
	(15, 5000, 3, 2, '2022-02-28 13:46:26', '2022-02-28 13:46:26'),
	(16, 1300, 5, 5, '2022-02-28 13:48:06', '2022-02-28 13:48:06'),
	(17, 800, 5, 1, '2022-02-28 13:48:25', '2022-02-28 13:48:25');
/*!40000 ALTER TABLE `product_prices` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.providers : ~3 rows (environ)
/*!40000 ALTER TABLE `providers` DISABLE KEYS */;
REPLACE INTO `providers` (`providers_id`, `providers_ifu`, `providers_company`, `providers_phone_number`, `providers_email`, `providers_address`, `providers_isActive`, `providers_created_at`, `providers_updated_at`) VALUES
	(1, 'Système', 'Système', 'Système', 'Système', 'Système', 1, '2022-02-23 16:21:20', '2022-02-23 16:21:20'),
	(2, NULL, 'HE SYSTEM', '+22966757001', 'cyrdominicytos@gmail.com', 'Rue 560, Cotonou, Bénin', 1, '2022-02-23 16:32:40', '2022-02-23 16:32:40'),
	(3, NULL, 'IT LAB', '+22966757002', NULL, 'Rue 560, Cotonou, Bénin', 1, '2022-02-23 16:33:04', '2022-02-23 16:33:04');
/*!40000 ALTER TABLE `providers` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.sales : ~5 rows (environ)
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
REPLACE INTO `sales` (`sales_id`, `sales_status`, `sales_amount`, `sales_reduction`, `sales_is_commanded`, `sales_is_delivable`, `sales_deliver_man`, `sales_delivery_date`, `sales_client_id`, `sales_created_at`, `sales_updated_at`) VALUES
	(1, 1, 0, 0, 0, 0, 0, '0000-00-00', 1, '2022-02-23 13:51:47', '2022-02-23 13:51:47'),
	(2, 1, 0, 0, 0, 0, 0, '0000-00-00', 2, '2022-02-28 12:50:29', '2022-02-28 12:50:29'),
	(3, 1, 1750000, 0, 0, 0, 0, '0000-00-00', 2, '2022-02-28 13:22:32', '2022-02-28 13:22:32'),
	(4, 1, 2238000, 2238000, 0, 0, 0, '0000-00-00', 2, '2022-02-28 14:09:43', '2022-02-28 14:09:44'),
	(5, 1, 19500, 19000, 0, 0, 0, '2022-03-04', 3, '2022-02-28 14:25:34', '2022-02-28 14:25:35');
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.sales_options : ~5 rows (environ)
/*!40000 ALTER TABLE `sales_options` DISABLE KEYS */;
REPLACE INTO `sales_options` (`sales_options_id`, `sales_options_name`, `sales_options_description`, `sales_options_isActive`, `sales_options_created_at`, `sales_options_updated_at`) VALUES
	(1, 'KG', '', 1, '2022-02-22 11:07:47', '2022-02-22 11:07:47'),
	(2, 'Unité', '', 1, '2022-02-22 11:07:55', '2022-02-22 11:07:55'),
	(3, 'Paquet', '', 1, '2022-02-22 11:08:39', '2022-02-22 11:08:39'),
	(4, 'Sachet', '', 1, '2022-02-22 11:08:48', '2022-02-22 11:08:48'),
	(5, 'Littre', '', 1, '2022-02-22 11:09:11', '2022-02-22 11:09:11');
/*!40000 ALTER TABLE `sales_options` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.sell_details : ~8 rows (environ)
/*!40000 ALTER TABLE `sell_details` DISABLE KEYS */;
REPLACE INTO `sell_details` (`sell_details_id`, `sell_details_amount`, `sell_details_quantity`, `sell_details_reduction`, `sell_details_sales_options_id`, `sell_details_sales_id`, `sell_details_products_id`, `sell_details_created_at`, `sell_details_updated_at`) VALUES
	(1, 1750000, 5, 0, 2, 3, 1, '2022-02-28 13:22:32', '2022-02-28 13:22:32'),
	(2, 0, 0, 0, 2, 1, 3, '2022-02-28 13:46:26', '2022-02-28 13:46:26'),
	(3, 0, 0, 0, 5, 1, 5, '2022-02-28 13:48:06', '2022-02-28 13:48:06'),
	(4, 0, 0, 0, 1, 1, 5, '2022-02-28 13:48:25', '2022-02-28 13:48:25'),
	(5, 1400000, 4, 0, 2, 4, 1, '2022-02-28 14:09:43', '2022-02-28 14:09:43'),
	(6, 900000, 2, 0, 2, 4, 2, '2022-02-28 14:09:44', '2022-02-28 14:09:44'),
	(7, 10000, 2, 0, 2, 4, 3, '2022-02-28 14:09:44', '2022-02-28 14:09:44'),
	(8, 19500, 15, 0, 5, 5, 5, '2022-02-28 14:25:35', '2022-02-28 14:25:35');
/*!40000 ALTER TABLE `sell_details` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.supplies : ~3 rows (environ)
/*!40000 ALTER TABLE `supplies` DISABLE KEYS */;
REPLACE INTO `supplies` (`supplies_id`, `supplies_code_barre`, `supplies_cost`, `supplies_selling_price`, `supplies_selling_quantity`, `supplies_provider_id`, `supplies_sales_options_id`, `supplies_products_id`, `supplies_created_at`, `supplies_updated_at`) VALUES
	(1, NULL, 0, 5000, 0, 1, 2, 3, '2022-02-28 13:46:26', '2022-02-28 13:46:26'),
	(2, NULL, 0, 1300, 0, 1, 5, 5, '2022-02-28 13:48:06', '2022-02-28 13:48:06'),
	(3, NULL, 0, 800, 0, 1, 1, 5, '2022-02-28 13:48:25', '2022-02-28 13:48:25');
/*!40000 ALTER TABLE `supplies` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.users : ~2 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_at`, `updated_at`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `address`) VALUES
	(1, '127.0.0.1', 'administrator', '$2y$12$caoses2LIMJL19KUJstjSepsseVL9/JzlXa9LhTJIpXwXkNzBxyMK', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, '2022-02-23 13:51:46', '2022-02-28 09:57:30', 1646038650, 1, 'Admin', 'istrator', 'ADMIN', '65656565', 'Cotonou'),
	(2, '127.0.0.1', 'Vendeur', '$2y$08$200Z6ZZbp3RAEXoaWcMA6uJOFicwNZaqk4oDhqTUiFXFe63MG.Daa', 'vendeur@vendeur.com', NULL, '', NULL, NULL, NULL, NULL, NULL, '2022-02-23 13:51:46', '2022-02-23 13:51:46', 1268889823, 1, 'Pierre', 'ALI', 'Seller', '66666666', 'Cotonou');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.users_groups : ~2 rows (environ)
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
REPLACE INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
	(1, 1, 1),
	(2, 2, 2);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
