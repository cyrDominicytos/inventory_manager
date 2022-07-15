CREATE OR REPLACE VIEW inventory AS

SELECT 
*,
sum(`supplies`.`supplies_selling_quantity`) AS `supply_quantity_total`,
(sum(`sell_details`.`sell_details_quantity`) ) AS `sell_quantity_total`,
 
(sum(`supplies`.`supplies_selling_quantity`) - sum(`sell_details`.`sell_details_quantity`)) AS `quantity_inventory` 

 FROM
 supplies LEFT JOIN sell_details ON supplies.supplies_sales_options_id = sell_details.sell_details_sales_options_id
 AND supplies.supplies_products_id = sell_details.sell_details_products_id
 LEFT JOIN products ON supplies.supplies_products_id = products.products_id
 LEFT JOIN sales_options ON supplies.supplies_sales_options_id = sales_options.sales_options_id
 LEFT JOIN product_categories ON product_categories.product_categories_id = products.products_product_categorie_id
 GROUP BY supplies.supplies_products_id, supplies.supplies_sales_options_id;