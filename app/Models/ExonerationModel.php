<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class ExonerationModel extends Model
{
    protected $table = 'exonerations';
    protected $primaryKey = 'exonerations_id';
	protected $returnType = 'array';
    protected $allowedFields = ['exonerations_name', 'exonerations_slug', 'exonerations_rate'];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


}