<?php
namespace App\Validation;
use App\Models\ProductPriceModel;
class CustomRules{

  // Rule is to validate mobile number digits
  public function mobileValidation(string $str, string $fields, array $data){
    
    /*Checking: Number must start from 5-9{Rest Numbers}*/
    if(preg_match( '/^[5-9]{1}[0-9]+/', $data['mobile'])){
      
      /*Checking: Mobile number must be of 10 digits*/
      $bool = preg_match('/^[0-9]{10}+$/', $data['mobile']);
      return $bool == 0 ? false : true; 
      
    }else{
      
      return false;
    }
  }

  // Check if product has already this price
  public function unique_price(string $str, string $fields, array $data){
    $model = new ProductPriceModel();
    $result = $model->where("product_prices_product_id", $data['product_prices_product_id'])->where("product_prices_sales_option_id", $data['product_prices_sales_option_id'])->get()->getResult();
    if($result)
        return false;
        return true;   
  }


}
