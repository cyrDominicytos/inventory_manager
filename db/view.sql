================ Inventory View===================
CREATE OR REPLACE VIEW inventory AS

SELECT 

product_categories.`*`,
products.products_id,products.products_name,
sales_options.sales_options_id,sales_options.sales_options_name,

SUM(supplies.supplies_selling_quantity) AS supply_quantity_total,

(SELECT SUM(sell_details.sell_details_quantity) FROM sell_details 
WHERE sell_details.sell_details_sales_options_id = sales_options.sales_options_id AND sell_details.sell_details_products_id=products.products_id 
GROUP BY
products.products_id, 
sales_options.sales_options_id) AS sell_quantity_total,

(
SUM(supplies.supplies_selling_quantity) 
- 
	(SELECT SUM(sell_details.sell_details_quantity) FROM sell_details 
	WHERE sell_details.sell_details_sales_options_id = sales_options.sales_options_id AND sell_details.sell_details_products_id=products.products_id 
	GROUP BY
	products.products_id, 


================= product_prices_after_delete TRIGGER =======

CREATE DEFINER=`root`@`localhost` TRIGGER `product_prices_after_delete` AFTER DELETE ON `product_prices` FOR EACH ROW BEGIN
	DELETE FROM sell_details WHERE sell_details.sell_details_products_id = OLD.product_prices_product_id 
	AND sell_details.sell_details_sales_options_id = OLD.product_prices_sales_option_id AND sell_details.sell_details_quantity = 0;
	
	DELETE FROM supplies WHERE supplies.supplies_products_id = OLD.product_prices_product_id 
	AND supplies.supplies_sales_options_id = OLD.product_prices_sales_option_id AND supplies.supplies_selling_quantity = 0 AND supplies.supplies_provider_id = 1;
END


================= product_prices_before_insert TRIGGER =======
CREATE DEFINER=`root`@`localhost` TRIGGER `product_prices_before_insert` BEFORE INSERT ON `product_prices` FOR EACH ROW BEGIN
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
END