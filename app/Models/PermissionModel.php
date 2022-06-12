<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class PermissionModel extends Model
{
    protected $table = 'permissions';
    protected $primaryKey = 'id';
	protected $returnType = 'array';
    protected $allowedFields = ['name', 'module', 'description'];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;



  public function get_permission_by_group($group)
   {
      
       return $this->db->table('permissions')->join('groups_permissions', 'permissions.id = groups_permissions.permission_id')
       ->select('name, permissions.id as permission_id, group_id ')
       ->where('groups_permissions.group_id', $group)
       ->get()->getResultArray();
   
   }

   public function getPermissionsGroupByModule()
    {
        $builder =  $this->db->table('permissions');
       
        $builder->select('*');
        return $builder->groupBy('module')->get()->getResult();
    
    }

}