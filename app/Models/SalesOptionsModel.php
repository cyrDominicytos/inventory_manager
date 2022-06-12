<?php 
namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;
class SalesOptionsModel extends Model
{
    protected $table = 'sales_options';
    protected $primaryKey = 'sales_options_id';
	protected $returnType = 'array';
    protected $allowedFields = [
         'sales_options_name',
         'sales_options_description',
         'sales_options_isActive',
        ];

      
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    public function get_not_set_options_for_product($productId)
    {
        $sql = "SELECT * FROM sales_options WHERE sales_options_id  NOT IN (SELECT product_prices_sales_option_id FROM product_prices WHERE product_prices_product_id=?)";
        return  $this->table('sales_options')->query($sql, [$productId]);
    }
    

}