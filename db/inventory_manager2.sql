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
INSERT INTO `clients` (`clients_id`, `clients_ifu`, `clients_company`, `clients_phone_number`, `clients_email`, `clients_address`, `clients_isActive`, `clients_created_at`, `clients_updated_at`) VALUES
	(1, '1234567891236', 'assogba clément', '+22966757025', 'cyrdominicytos1@gmail.com', 'Rue 560, Cotonou, Bénin', 0, '2022-02-09 13:30:45', '2022-02-09 13:39:15'),
	(2, '1456987123654', 'assouka bili', '+22966757002', 'cyrdominicytos@gmail.com', 'Rue 560, Cotonou, Bénin', 1, '2022-02-09 13:37:49', '2022-02-09 13:37:49');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.delivery_mens : ~2 rows (environ)
/*!40000 ALTER TABLE `delivery_mens` DISABLE KEYS */;
INSERT INTO `delivery_mens` (`delivery_mens_id`, `delivery_mens_ifu`, `delivery_mens_company`, `delivery_mens_phone_number`, `delivery_mens_email`, `delivery_mens_address`, `delivery_mens_isActive`, `delivery_mens_created_at`, `delivery_mens_updated_at`) VALUES
	(1, NULL, 'assouka benjamin', '62359847', NULL, '', 0, '2022-02-09 13:41:23', '2022-02-09 13:46:49'),
	(2, '1456987123625', 'ali alissou', '65254897', NULL, '', 1, '2022-02-09 13:46:22', '2022-02-09 13:46:38');
/*!40000 ALTER TABLE `delivery_mens` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.groups : ~3 rows (environ)
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `name`, `display_name`, `description`) VALUES
	(1, 'admin', 'admin', 'Administrateur'),
	(3, 'vendeur', 'vendeur', 'Vendeur');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.groups_permissions : ~24 rows (environ)
/*!40000 ALTER TABLE `groups_permissions` DISABLE KEYS */;
INSERT INTO `groups_permissions` (`id`, `group_id`, `permission_id`) VALUES
	(90, 1, 10),
	(91, 1, 40),
	(92, 1, 41),
	(93, 1, 42),
	(94, 1, 43),
	(95, 1, 50),
	(96, 1, 70),
	(97, 1, 71),
	(98, 1, 72),
	(99, 1, 73),
	(100, 1, 80),
	(101, 1, 81),
	(102, 1, 82),
	(103, 1, 83),
	(104, 1, 90),
	(105, 1, 91),
	(106, 1, 92),
	(107, 1, 93),
	(108, 1, 100),
	(109, 1, 101),
	(110, 1, 102),
	(111, 1, 103),
	(112, 1, 110),
	(113, 1, 112);
/*!40000 ALTER TABLE `groups_permissions` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.login_attempts : ~1 rows (environ)
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
	(1, '::1', 'admin@admin.comd', 1644403877);
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.migrations : ~1 rows (environ)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
	(1, '20181211100537', 'IonAuth\\Database\\Migrations\\Migration_Install_ion_auth', '', 'IonAuth', 1644317196, 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

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

-- Listage des données de la table inventory_manager.products : ~0 rows (environ)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.product_categories : ~4 rows (environ)
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` (`product_categories_id`, `product_categories_name`, `product_categories_description`, `product_categories_isActive`, `product_categories_created_at`, `product_categories_updated_at`) VALUES
	(1, 'Poissonnerie', '', 1, '2022-02-09 06:14:57', '2022-02-09 06:14:57'),
	(2, 'Brasserie', '', 1, '2022-02-09 06:15:49', '2022-02-09 06:15:49'),
	(3, 'Divers', '', 1, '2022-02-09 06:16:00', '2022-02-09 06:16:00'),
	(4, 'Matériel Informatique', '', 1, '2022-02-09 13:48:51', '2022-02-09 13:49:57');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.product_prices : ~0 rows (environ)
/*!40000 ALTER TABLE `product_prices` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_prices` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.providers : ~1 rows (environ)
/*!40000 ALTER TABLE `providers` DISABLE KEYS */;
INSERT INTO `providers` (`providers_id`, `providers_ifu`, `providers_company`, `providers_phone_number`, `providers_email`, `providers_address`, `providers_isActive`, `providers_created_at`, `providers_updated_at`) VALUES
	(1, '9999999999998', 'it lab', '+2296675756', 'cyr@gmail.com', 'Rue 560, Cotonou, Bénin', 1, '2022-02-09 13:40:13', '2022-02-09 13:40:47');
/*!40000 ALTER TABLE `providers` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.sales_options : ~4 rows (environ)
/*!40000 ALTER TABLE `sales_options` DISABLE KEYS */;
INSERT INTO `sales_options` (`sales_options_id`, `sales_options_name`, `sales_options_description`, `sales_options_isActive`, `sales_options_created_at`, `sales_options_updated_at`) VALUES
	(1, 'Unité', '', 0, '2022-02-09 06:16:19', '2022-02-09 06:34:12'),
	(2, 'KG', '', 1, '2022-02-09 06:16:36', '2022-02-09 06:16:36'),
	(3, 'LITTRES', '', 1, '2022-02-09 13:47:39', '2022-02-09 13:48:19'),
	(4, 'PAQUET', '', 1, '2022-02-09 13:47:55', '2022-02-09 13:47:55');
/*!40000 ALTER TABLE `sales_options` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.users : ~3 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_at`, `updated_at`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `address`) VALUES
	(1, '127.0.0.1', 'administrator', '$2y$12$msBt095/QvjEy7tFhvfPFuEg/nN2S4.JB3RNclZUcHnFQQVwsv4pe', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, '2022-02-08 11:46:43', '2022-02-09 12:52:22', 1644407542, 1, 'Admin', 'istrator', 'ADMIN', '65656565', 'Cotonou'),
	(2, '127.0.0.1', 'Vendeur', '$2y$10$.4lSzBVa22m8wgYAkwf1feDLk9rg21Nzvh6OceOOyH5k7a43WI1wS', 'vendeur@vendeur.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-08 11:46:43', '2022-02-09 12:01:58', 1644404518, 1, 'Pierre', 'ALI', 'Seller', '66666666', 'Cotonou'),
	(3, '::1', 'admin', '$2y$10$ThMlBIydT1tB/P1rOuarGOkd1qgax82W0IMqTjdPUoxri/iU.av/2', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-09 11:56:57', '2022-02-09 11:57:40', NULL, 1, 'Habib', 'LEWHE', '', '+22966757002', 'Rue 560, Cotonou, Bénin');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Listage des données de la table inventory_manager.users_groups : ~3 rows (environ)
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
	(1, 1, 1),
	(3, 3, 3),
	(4, 2, 3);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
