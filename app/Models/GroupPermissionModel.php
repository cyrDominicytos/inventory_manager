<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class GroupPermissionModel extends Model
{
    protected $table = 'groups_permissions';
    protected $primaryKey = 'group_id, permission_id';
	protected $returnType = 'array';
    protected $allowedFields = ['group_id', 'permissions'];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;



    public function get_permission_by_group($group)
    {
       
        return $this->db->table('groups_permissions')->select('*')
        ->where('groups_permissions.group_id', $group)
        ->get()->getResult();
    
    }
    public function get_goupId($group)
    {
       
        return $this->db->table('groups_permissions')->select('permissions')
        ->where('group_id', $group)
        ->get()->getResult();
    
    }

}