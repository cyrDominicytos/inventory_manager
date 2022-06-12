<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SellDetailsModel;
use App\Models\SaleModel;
use App\Models\BillModel;
use App\Libraries\Emecef;


use nguyenary\QRCodeMonkey\QRCode; //Git lib : https://github.com/nguyenary/QRCodeMonkey

class Billing extends BaseController
{

    public function index()
    {
        $data['title'] = 'Liste des Factures';
      //  $billing_model = new BillingModel();
       // $data['bills'] = $billing_model->getBills();
        return view('billing/listBills', $data);
    }

    // PUBLIC FUNCTION TO GENERATE QR CODE
    public function generateQrCode($secret_string = null, $file_name = null){
        if($secret_string == null){
            return false;
        }
        else{
            $qrcode = new QRCode($secret_string);
            $qrcode->setSize(90);
            $qrcode->create(WRITEPATH.'uploads/qrcode/'.$file_name.'.png');
            return true;
        }
    }
    // PUBLIC FUNCTION TO GENERATE QR CODE
    public function generateQrCode2($secret_string = null, $file_name = null){
        $my_app_variables = new \Config\MyAppVariables();
        if($secret_string == null){
            $qrcode = new QRCode($my_app_variables->default_string_to_embed_as_qr_code);
            $qrcode->setSize(90);
            $qrcode->create($my_app_variables->getQrCodeFolder().$my_app_variables->default_qr_code_file_name_for_non_certify_bills.'.png');
        }
        else{
            $qrcode = new QRCode($secret_string);
            $qrcode->setSize(90);
            $qrcode->create($my_app_variables->getQrCodeFolder(). $file_name. '.png');
        }
    }

    // Function to certify bill 
    public function certifyBill($bill_code, $bill_type){
        $emecef = new Emecef();

        $saleModel = new SaleModel();
        $sellDetailsModel = new SellDetailsModel();
        $billModel = new BillModel();
        $config = $emecef->getConfig();
        $bill = $billModel->where("bill_code", $bill_code)->get()->getResult();
        if(!$bill)
            return redirect()->back()->with("message", "La facture que vous essayez de normaliser n'existe pas !")->with("code", 0);
        $bill =  $bill[0];
        
        
        //Get company parameters
        $companyParams = getConfigList();
        $ionAuth    = new \IonAuth\Libraries\IonAuth();
        $apiInvoiceInstance = $emecef->getApiInvoiceInstance($config);

        try {
            $statusReponseDto = $apiInvoiceInstance->apiInvoiceGet();
            //print_r($statusReponseDto);
        } catch (Exception $e) {
            echo 'Exception when calling SfeInvoiceApi->apiInvoiceGet: ', $e->getMessage(), PHP_EOL;
        }

        $body = new \Swagger\Client\Model\InvoiceRequestDataDto(); // \Swagger\Client\Model\InvoiceRequestDataDto | 
        $body->setIfu($companyParams[2]->config_value);//YOUR IFU HERE

        $operatorDto = new \Swagger\Client\Model\OperatorDto();
        $operatorDto->setName($ionAuth->user()->row()->last_name." ".$ionAuth->user()->row()->first_name);
        $body->setOperator($operatorDto);
        $body->setType($bill_type);
        $sale = $saleModel->where("sales_id", $bill->bill_sales_id)->get()->getResult();
        if( $sale[0]->sales_aib != "0")
            $body->setAib($sale[0]->sales_aib);

        $items = array();
        $sellDetails = $sellDetailsModel->get_sell_detail($bill->bill_sales_id);
        // IF PRODUCTS ARE NOT EMPTY
        if($sellDetails){
            foreach($sellDetails as $singleDetail){
                $single_item = new \Swagger\Client\Model\ItemDto();
                $single_item->setName($singleDetail->products_name);
                $single_item->setPrice( (int) $singleDetail->sell_details_selling_price);
                $single_item->setQuantity( (int) $singleDetail->sell_details_quantity);
                $single_item->setTaxGroup($singleDetail->exonerations_name);   // Old value => $single_item->setTaxGroup(\Swagger\Client\Model\TaxGroupTypeEnum::B);
                array_push($items, $single_item);
            }
        }
        $body->setItems($items);
        $invoiceResponseDto = null;
        try {
            $invoiceResponseDto = $apiInvoiceInstance->apiInvoicePost($body);
        } catch (Exception $e) {
            echo 'Exception when calling SfeInvoiceApi->apiInvoicePost: ', $e->getMessage(), PHP_EOL;
        }

        $uid = $invoiceResponseDto['uid']; // string | 
        if (!is_null($uid)){
            try {
                $invoiceDetailsDto = $apiInvoiceInstance->apiInvoiceUidGet($uid);                
                try {
                    $securityElementsDto = $apiInvoiceInstance->apiInvoiceUidConfirmPut($uid);
                  //  dd($securityElementsDto);
                    // Update invoice with security elements MECEF
                   
                    $bill_sec_info = array(
                        'bill_mecef_date_time'=> format_date($securityElementsDto['date_time'], "Y/m/d H:i:s"),
                        'bill_mecef_qr_code'=> $securityElementsDto['qr_code'],
                        'bill_mecef_code_dgi'=> $securityElementsDto['code_me_ce_fdgi'],
                        'bill_mecef_counters'=> $securityElementsDto['counters'],
                        'bill_mecef_nim'=> $securityElementsDto['nim'],
                        'bill_certify_bill'=>1,

                        'bill_taa'=> $invoiceResponseDto['taa'],
                        'bill_tab'=> $invoiceResponseDto['tab'],
                        'bill_tac'=> $invoiceResponseDto['tac'], 
                        'bill_tad'=> $invoiceResponseDto['tad'],
                        'bill_tae'=> $invoiceResponseDto['tae'],
                        'bill_taf'=> $invoiceResponseDto['taf'],
                        'bill_hab'=> $invoiceResponseDto['hab'],
                        'bill_had'=> $invoiceResponseDto['had'],
                        'bill_vab'=> $invoiceResponseDto['vab'],
                        'bill_vad'=> $invoiceResponseDto['vad'],
                        'bill_total'=> $invoiceResponseDto['total'],
                        'bill_aib'=> $invoiceResponseDto['aib'],
                        'bill_ts'=> $invoiceResponseDto['ts'],


                        'bill_certify_by'=> $ionAuth->user()->row()->id,
                        'bill_type'=> $bill_type,
                        'bill_uid'=> $uid,

                    );
                    //dd($bill_sec_info);
                    //Get Bill id from db
                    //$single_bill = $billing_model->getBills($bill_code);
                    // And update based on single uniq id
                    if($billModel->update($bill->bill_id, $bill_sec_info)){
                        // If update success, generate QRCODE and store it, then redirect to view bill with bill_code variable
                        $this->generateQrCode($bill_sec_info['bill_mecef_qr_code'], $bill_code);
                        $saleModel->update($bill->bill_sales_id,[
                            "sales_status" => 4,
                        ]);
                        return true;
                    }
                    else{
                        echo 'Non mis à jour en local';
                        return false;
                    }

                } catch (Exception $e) {
                    echo 'Exception when calling SfeInvoiceApi->apiInvoiceUidConfirmPut: ', $e->getMessage(), PHP_EOL;
                } 
            } catch (Exception $e) {
                echo 'Exception when calling SfeInvoiceApi->apiInvoiceUidConfirmPut: ', $e->getMessage(), PHP_EOL;
            }
        }
    }


    // FUNCTION TO VIEW THE BILL 
    public function viewBill($bill_code  = null){
        if($bill_code == null){
            die("Attention, facture introuvable !");
        }
        $data['title'] = 'Facture '.$bill_code;
        $data['bill_code'] = $bill_code;
        $billing_model = new BillingModel();
        $patient_model = new PatientModel();
        $insurance_model = new InsuranceModel();
        $data['bill_details'] = $billing_model->getBills($bill_code);
        if($data['bill_details']->bill_total_insurance_part > 0){ // IF THERE IS INSURANCE DETAILS
            $data['insurance_police_details'] = $insurance_model->getInsurancesPolices($data['bill_details']->bill_insurance_police);
            $data['insurance_details'] = $insurance_model->getInsurances($data['insurance_police_details'][0]['insurance_id']);
        }
        $data['billed_products'] = $billing_model->getBilledProducts($bill_code);
        $data['billed_cares'] = $billing_model->getBilledCares($bill_code);

        $data['patient_details'] =  $patient_model->getPatients($data['bill_details']->bill_patient_matricule);

        $ionAuth = new \IonAuth\Libraries\IonAuth();
        $data['teller_agent'] = $ionAuth->user($data['bill_details']->bill_user_id)->row();

        return view('billing/viewBill', $data);
    }

    // FUNCTION TO VIEW THE BILL  TICKET CAISSE
    public function viewBillReceiptFormat($bill_code){
        if($bill_code == null){
            die("Attention, facture introuvable !");
        }
        $data['title'] = 'Ticket de caisse pour facture '.$bill_code;
        $data['bill_code'] = $bill_code;
        $billing_model = new BillingModel();
        $patient_model = new PatientModel();
        $insurance_model = new InsuranceModel();
        $data['bill_details'] = $billing_model->getBills($bill_code);
        if($data['bill_details']->bill_total_insurance_part > 0){ // IF THERE IS INSURANCE DETAILS
            $data['insurance_police_details'] = $insurance_model->getInsurancesPolices($data['bill_details']->bill_insurance_police);
            $data['insurance_details'] = $insurance_model->getInsurances($data['insurance_police_details'][0]['insurance_id']);
        }
        $data['billed_products'] = $billing_model->getBilledProducts($bill_code);
        $data['billed_cares'] = $billing_model->getBilledCares($bill_code);

        $data['patient_details'] =  $patient_model->getPatients($data['bill_details']->bill_patient_matricule);

        $ionAuth = new \IonAuth\Libraries\IonAuth();
        $data['teller_agent'] = $ionAuth->user($data['bill_details']->bill_user_id)->row();

        return view('billing/viewBillReceiptFormat', $data);
    }


    // FUNCTION TO BILL SALE
    public function generateBill($saleId, $type)
    {
        $bill_code = $this->generateBillCode($type);
        $billModel = new BillModel();
        $saleModel = new SaleModel();
        $ionAuth    = new \IonAuth\Libraries\IonAuth();

        $billModel->insert([
            "bill_code" => $bill_code,
            "bill_sales_id" => $saleId,
            "bill_generate_by" =>  $ionAuth->user()->row()->id,
        ]);
        $saleModel->update($saleId,[
            "sales_status" => 3,
        ]);
        return $bill_code;
    }


    // FUNCTION TO GENERATE THE BILL CODE
    public function generateBillCode($type="FV"){
        $billing_model = new BillModel();
        helper('text'); // Helper that generate strings use docs for usage
        // Do generate mat string while the mat is not uniq after DataBase checking
        do{
            $random_length = 4; //random_string('nozero',1); // Generate a random length  which is numeric value(except 0) from 1 to 9
            $random_gen_code = random_string('numeric', $random_length); // String type, and length : alnum, numeric
            $random_mat = $type. $random_gen_code;
        }while(! $billing_model->isCodeUniq($random_mat));
        return $random_mat;
    }

    // FUNCTION TO RESET FORM FIELDS 
    public function resetFormFields($array_fields){
        foreach($array_fields as $key => $value){
            $array_fields[$key] = '';
        }
        return $array_fields;
    }

}
