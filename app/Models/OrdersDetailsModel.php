<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class OrdersDetailsModel extends Model
{
    protected $table = 'orders_details';
    protected $primaryKey = 'orders_details_id';
	protected $returnType = 'array';
    protected $allowedFields = [
         'orders_details_amount',
         'orders_details_quantity',
         'orders_details_orders_id',
         'orders_details_sales_options_id',
         'orders_details_products_id',

         'orders_details_reduction',
         'orders_default_price',
         'orders_selling_price',    
        ];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    public function get_order_detail($orderId)
    {
       
       return $this->db->table('orders_details')
       ->join('orders', 'orders.orders_id = orders_details.orders_details_orders_id')
       ->join('clients', 'orders.orders_client_id = clients.clients_id')
       ->join('products', 'products.products_id = orders_details.orders_details_products_id')
       ->join('exonerations', 'exonerations.exonerations_id = products.products_exonerations_id')
       ->join('sales_options', 'sales_options.sales_options_id = orders_details.orders_details_sales_options_id')
       ->join('product_categories', 'product_categories.product_categories_id = products.products_product_categorie_id')
       ->select('*')
       ->where('orders_id', $orderId)
       ->whereNotIn("clients.clients_company", ["Système"])
       ->get()->getResult();
    }
}