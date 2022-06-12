<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class ProductPriceModel extends Model
{
    protected $table = 'product_prices';
    protected $primaryKey = 'product_prices_id';
	protected $returnType = 'array';
    protected $allowedFields = [
         'product_prices_price',
         'product_prices_product_id',
         'product_prices_sales_option_id',
        ];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function get_product_price_list()
    {
       
       return $this->db->table('product_prices')
       ->join('products', 'product_prices.product_prices_product_id = products.products_id')
       ->join('sales_options', 'product_prices.product_prices_sales_option_id = sales_options.sales_options_id')
       ->join('product_categories', 'products.products_product_categorie_id = product_categories.product_categories_id')
       ->select('*')
       ->get()->getResult();
    }
    public function get_assign_options_by_product($productId)
    {
       
       return $this->db->table('product_prices')
       ->join('products', 'product_prices.product_prices_product_id = products.products_id')
       ->join('sales_options', 'product_prices.product_prices_sales_option_id = sales_options.sales_options_id')
       ->join('product_categories', 'products.products_product_categorie_id = product_categories.product_categories_id')
       ->select('*')
       ->where('products_id', $productId)
       ->get()->getResult();
    }
    public function get_product($productId)
    {
       
       return $this->db->table('product_prices')
       ->join('product_categories', 'product_prices.product_prices_product_categorie_id = product_categories.product_categories_id')
        ->select('*')
        ->where('product_prices_id', $productId)
        ->get()->getResult();
    }
    public function get_product_list_by_category_id($categoryproductId)
    {
       
       return $this->db->table('product_prices')->join('product_categories', 'product_prices.product_prices_product_categorie_id = product_categories.product_categories_id')
        ->select('*')
        ->where('product_categories_id', $categoryproductId)
        ->get()->getResult();
    }

}