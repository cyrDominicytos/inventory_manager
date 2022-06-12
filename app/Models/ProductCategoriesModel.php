<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class ProductCategoriesModel extends Model
{
    protected $table = 'product_categories';
    protected $primaryKey = 'product_categories_id';
	protected $returnType = 'array';
    protected $allowedFields = [
         'product_categories_name',
         'product_categories_description',
         'product_categories_isActive',
        ];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;



}