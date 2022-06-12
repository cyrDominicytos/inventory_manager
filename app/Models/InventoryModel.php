<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class InventoryModel extends Model
{
    protected $table = 'inventory';
   // protected $primaryKey = 'supplies_id';
	protected $returnType = 'array';
    /*protected $allowedFields = [
         'supplies_code_barre',
         'supplies_cost',
         'supplies_selling_price',
         'supplies_selling_quantity',
         'supplies_provider_id',
         'supplies_sales_options_id',
         'supplies_products_id',
        ];*/

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

        
}