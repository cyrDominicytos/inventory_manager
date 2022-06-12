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

-- Listage de la structure de déclencheur inventory_manager. product_prices_before_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `product_prices_before_insert` BEFORE INSERT ON `product_prices` FOR EACH ROW BEGIN
IF (SELECT products_id FROM inventory 
	WHERE products_id = NEW.product_prices_product_id 
	AND sales_options_id = NEW.product_prices_sales_option_id) IS null  THEN
	
	INSERT INTO `sell_details` 
			 (`sell_details_amount`,
			  `sell_details_quantity`,
			  `sell_details_sales_options_id`,
			  `sell_details_sales_id`,
			  `sell_details_products_id`
			  ) 
			 VALUES 
			 (0,
			  0,
			  NEW.product_prices_sales_option_id,
			  1,
			  
			  NEW.product_prices_product_id
			  
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
		SET NEW.sell_details_default_price = (SELECT product_prices.product_prices_price FROM product_prices WHERE product_prices.product_prices_product_id = NEW.sell_details_products_id AND product_prices.product_prices_sales_option_id = NEW.sell_details_sales_options_id);
		SET NEW.sell_details_selling_price = (SELECT product_prices.product_prices_price FROM product_prices WHERE product_prices.product_prices_product_id = NEW.sell_details_products_id AND product_prices.product_prices_sales_option_id = NEW.sell_details_sales_options_id);
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
