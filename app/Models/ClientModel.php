<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class ClientModel extends Model
{
    protected $table = 'clients';
    protected $primaryKey = 'clients_id';
	protected $returnType = 'array';
    protected $allowedFields = [
         'clients_ifu',
         'clients_company',
         'clients_phone_number',
         'clients_email',
         'clients_address',
         'clients_isActive',
        ];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;



}