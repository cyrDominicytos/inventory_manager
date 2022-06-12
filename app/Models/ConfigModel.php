<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class ConfigModel extends Model
{
    protected $table = 'config';
    protected $primaryKey = 'config_id';
	protected $returnType = 'array';
    protected $allowedFields = [
         'config_code',
         'config_name',
         'config_description',
         'config_value',
         'config_created_at',
         'config_updated_at',
        ];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;



}