<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class UserGroupModel extends Model
{
    protected $table = 'users_groups';
    protected $primaryKey = 'id';
	protected $returnType = 'array';
    protected $allowedFields = ['user_id', 'group_id'];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    public function get_permission_by_group($group)
    {
       
        return $this->db->table('permissions');
    
    }
    public function getAssignedGroups()
    {
        $builder =  $this->db->table('users_groups');
       
        $builder->select('group_id');
        return $builder->groupBy('group_id')->get()->getResult();
    
    }

}