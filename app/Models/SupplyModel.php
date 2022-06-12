<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class SupplyModel extends Model
{
    protected $table = 'supplies';
    protected $primaryKey = 'supplies_id';
	protected $returnType = 'array';
    protected $allowedFields = [
         'supplies_code_barre',
         'supplies_cost',
         'supplies_selling_price',
         'supplies_selling_quantity',
         'supplies_provider_id',
         'supplies_sales_options_id',
         'supplies_products_id',
        ];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function get_supply_list()
    {
       
        return $this->db->table('supplies')
        ->join('products', 'products.products_id = supplies.supplies_products_id')
        ->join('sales_options', 'sales_options.sales_options_id = supplies.supplies_sales_options_id')
        ->join('product_categories', 'product_categories.product_categories_id = products.products_product_categorie_id')
        ->join('exonerations', 'exonerations.exonerations_id = products.products_exonerations_id')
        ->join('providers', 'providers.providers_id = supplies.supplies_provider_id')

        ->select('*')
        ->whereNotIn("providers.providers_company", ["Système"])
        ->get()->getResult();
    }
    public function get_supply($supplieId)
    {
       
        return $this->db->table('supplies')
        ->join('products', 'products.products_id = supplies.supplies_products_id')
        ->join('sales_options', 'sales_options.sales_options_id = supplies.supplies_sales_options_id')
        ->join('product_categories', 'product_categories.product_categories_id = products.products_product_categorie_id')
        ->join('exonerations', 'exonerations.exonerations_id = products.products_exonerations_id')
        ->join('providers', 'providers.providers_id = supplies.supplies_provider_id')
        ->select('*')
        ->where('supplies_id', $supplieId)
        ->whereNotIn("providers.providers_company", ["Système"])
        ->get()->getResult();
    }
    
}