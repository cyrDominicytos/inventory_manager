<?php

namespace App\Controllers;

use App\Libraries\Pdf as GlobalPdf;
use App\Models\InventoryModel;
class Inventory extends BaseController
{
    public  $ionAuth = null;
    public  $validation = null;
    public  $session = null;
    public  $configIonAuth = null;

    /**
	 * Validation list template.
	 *
	 * @var string
	 * @see https://bcit-ci.github.io/CodeIgniter4/libraries/validation.html#configuration
	 */
	protected $validationListTemplate = 'list';
	protected $validationSigneTemplate = 'single';
    protected $modelInventory  = null;

    /**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->ionAuth    = new \IonAuth\Libraries\IonAuth();
        $this->validation = \Config\Services::validation();
        helper(['form', 'url']);
		$this->configIonAuth = config('IonAuth');
		$this->session       = \Config\Services::session();
        
        $this->modelInventory  = new InventoryModel();

        if (! empty($this->configIonAuth->templates['errors']['list']))
		{
			$this->validationListTemplate = $this->configIonAuth->templates['errors']['list'];
		}
	}

 

    public function list()
    {

        if (!$this->ionAuth->loggedIn() || !$this->ionAuth->isAdmin())
		{
			return redirect()->to('/')->with("message", session()->get("message"))->with("code", session()->get("code"));
		}
       
        $data['inventories'] =$this->modelInventory->get()->getResult();
        $data['auth'] = $this->ionAuth;
        return view('inventory/list',$data);
    }

	public function generate_inventory_pdf(){
        //$html = view('generate_pdf', [], true);
		$model = new InventoryModel();
		$data['list']= $model->get()->getResult();
        $html = view('list_pdf/inventory', $data);
		$pdf = new GlobalPdf();
        $pdf->createPDF($html, 'inventaire'.date('YmdHis'), false);
	}
    

}
