<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class GroupModel extends Model
{
    protected $table = 'groups';
    protected $primaryKey = 'id';
	protected $returnType = 'array';
    protected $allowedFields = ['id', 'name', 'description', 'display_name'];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


}