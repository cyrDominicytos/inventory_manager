<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class SellDetailsModel extends Model
{
    protected $table = 'sell_details';
    protected $primaryKey = 'sell_details_id';
	protected $returnType = 'array';
    protected $allowedFields = [
         'sell_details_amount',
         'sell_details_quantity',
         'sell_details_reduction',
         'sell_details_sales_id',
         'sell_details_sales_options_id',
         'sell_details_products_id',
         'sell_details_default_price',
         'sell_details_selling_price',
        ];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    public function get_sell_detail($sellId)
    {
       
       return $this->db->table('sell_details')
       ->join('sales', 'sales.sales_id = sell_details.sell_details_sales_id')
       ->join('clients', 'sales.sales_client_id = clients.clients_id')
       ->join('products', 'products.products_id = sell_details.sell_details_products_id')
       ->join('exonerations', 'exonerations.exonerations_id = products.products_exonerations_id')
       ->join('sales_options', 'sales_options.sales_options_id = sell_details.sell_details_sales_options_id')
       ->join('product_categories', 'product_categories.product_categories_id = products.products_product_categorie_id')
       ->select('*')
       ->where('sales_id', $sellId)
       ->whereNotIn("clients.clients_company", ["Système"])
       ->get()->getResult();
    }
}