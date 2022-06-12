<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class BillModel extends Model
{
    protected $table = 'bills';
    protected $primaryKey = 'bill_id';
	protected $returnType = 'array';
    protected $allowedFields = [
         'bill_mecef_date_time',
         'bill_mecef_qr_code',
         'bill_code',
         'bill_mecef_code_dgi',
         'bill_mecef_counters',
         'bill_mecef_nim',
         'bill_certify_bill',
         'bill_taa',
         'bill_tab',
         'bill_tac',
         'bill_tad',
         'bill_tae',
         'bill_taf',
         'bill_hab',
         'bill_had',
         'bill_vab',
         'bill_vad',
         'bill_aib',
         'bill_ts',
         'bill_total',
         'bill_generate_by',
         'bill_sales_id',
         'bill_certify_by',
         'bill_type',
        ];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    public function get_sale_list()
    {
       
       return $this->db->table('sales')
        ->join('clients', 'sales.sales_client_id = clients.clients_id')
        ->select('*')
        ->whereNotIn("clients.clients_company", ["Système"])
        ->get()->getResult();
    }
    public function isCodeUniq(string $code){
        $result = $this->db->table('bills') ->select('*')->where("bills.bill_code",$code )->get()->getResult();
        if($result)
            return false;
            return true;   
      }

}