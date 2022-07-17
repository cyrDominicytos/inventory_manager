<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class SaleModel extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'sales_id';
	protected $returnType = 'array';
    protected $allowedFields = [
         'sales_status',
         'sales_amount',
         'sales_reduction',
         'sales_is_commanded',
         'sales_is_delivable',
         'sales_deliver_man',
         'sales_delivery_date',
         'sales_client_id',
         'sales_users_id',
         'sales_aib',
        ];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    public function get_sale_list()
    {
       
       return $this->db->table('sales')
        ->join('clients', 'sales.sales_client_id = clients.clients_id')
       // ->join('users', 'sales.sales_users_id = users.id')
        ->select('*')
        ->whereNotIn("clients.clients_company", ["Système"])
        ->get()->getResult();
    }

    public function get_filter_sell_detail($begin, $end)
    {
       
       return $this->db->table('sell_details')
       ->join('sales', 'sales.sales_id = sell_details.sell_details_sales_id')
       ->join('clients', 'sales.sales_client_id = clients.clients_id')
       ->join('users', 'sales.sales_users_id = users.id')
       ->join('products', 'products.products_id = sell_details.sell_details_products_id')
       ->join('exonerations', 'exonerations.exonerations_id = products.products_exonerations_id')
       ->join('sales_options', 'sales_options.sales_options_id = sell_details.sell_details_sales_options_id')
       ->join('product_categories', 'product_categories.product_categories_id = products.products_product_categorie_id')
       ->select('*')
       ->where('sales_created_at >= ', $begin)
      // ->where('sales_created_at <= ', $end)
      // ->where('sales_created_at BETWEEN ', $begin. ' AND '. $end)
      // ->whereNotIn("clients.clients_company", ["Système"])
       ->get()->getResult();
    }


}