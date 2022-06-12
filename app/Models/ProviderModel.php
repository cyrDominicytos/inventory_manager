<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class ProviderModel extends Model
{
    protected $table = 'providers';
    protected $primaryKey = 'providers_id';
	protected $returnType = 'array';
    protected $allowedFields = [
        'providers_ifu',
         'providers_company',
         'providers_phone_number',
         'providers_email',
         'providers_address',
         'providers_isActive',
        ];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;



}