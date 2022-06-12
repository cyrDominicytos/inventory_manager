<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'products_id';
	protected $returnType = 'array';
    protected $allowedFields = [
         'products_name',
         'products_barre_code',
         'products_description',
         'products_isActive',
         'products_product_categorie_id',
         'products_exonerations_id',
        ];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function get_product_list()
    {
       
       return $this->db->table('products')
        ->join('product_categories', 'products.products_product_categorie_id = product_categories.product_categories_id')
        ->join('exonerations', 'exonerations.exonerations_id = products.products_exonerations_id')
        ->select('*')
        ->get()->getResult();
    }
    public function get_product($productId)
    {
       
       return $this->db->table('products')
       ->join('product_categories', 'products.products_product_categorie_id = product_categories.product_categories_id')
       ->join('exonerations', 'exonerations.exonerations_id = products.products_exonerations_id')
        ->select('*')
        ->where('products_id', $productId)
        ->get()->getResult();
    }
    public function get_product_list_by_category_id($categoryproductId)
    {
       
       return $this->db->table('products')
       ->join('product_categories', 'products.products_product_categorie_id = product_categories.product_categories_id')
       ->join('exonerations', 'exonerations.exonerations_id = products.products_exonerations_id')
       ->select('*')
        ->where('product_categories_id', $categoryproductId)
        ->get()->getResult();
    }

}