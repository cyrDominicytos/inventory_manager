<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class SaleModel extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'sales_id';
	protected $returnType = 'array';
    protected $allowedFields = [
         'sales_status',
         'sales_amount',
         'sales_reduction',
         'sales_is_commanded',
         'sales_is_delivable',
         'sales_deliver_man',
         'sales_delivery_date',
         'sales_client_id',
         'sales_users_id',
         'sales_aib',
        ];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    public function get_sale_list()
    {
       
       return $this->db->table('sales')
        ->join('clients', 'sales.sales_client_id = clients.clients_id')
       // ->join('users', 'sales.sales_users_id = users.id')
        ->select('*')
        ->whereNotIn("clients.clients_company", ["Système"])
        ->get()->getResult();
    }


}