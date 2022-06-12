<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class DeliveryMenModel extends Model
{
    protected $table = 'delivery_mens';
    protected $primaryKey = 'delivery_mens_id';
	protected $returnType = 'array';
    protected $allowedFields = [
        'delivery_mens_ifu',
         'delivery_mens_company',
         'delivery_mens_phone_number',
         'delivery_mens_email',
         'delivery_mens_address',
         'delivery_mens_isActive',
        ];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;



}