<?php 

namespace App\Libraries;

require_once dirname(__FILE__).'/EmecefLibrary/vendor/autoload.php';

class Emecef{ 

    public $company_ifu = '0202112473644';
    public $company_operator_name = 'Adeshina YESSOUFOU';

    public static function getConfig(){
        $api_key = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6IjAyMDIxMTI0NzM2NDR8VFMwMTAwMDI1OSIsInJvbGUiOiJUYXhwYXllciIsIm5iZiI6MTYzODQ0NjU4MywiZXhwIjoxNjQ4ODU0MDAwLCJpYXQiOjE2Mzg0NDY1ODMsImlzcyI6ImltcG90cy5iaiIsImF1ZCI6ImltcG90cy5iaiJ9.kACG6yVZZwZ_ojF2_oo-PL1lpRb9IX4-q12OMUIaXm0";
        $config = \Swagger\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');
        $config = \Swagger\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', $api_key);
        return $config;
    }

    public static function getApiInfoInstance($config){
        $apiInfoInstance = new \Swagger\Client\Api\SfeInfoApi(
            // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
            // This is optional, `GuzzleHttp\Client` will be used as default.
            new \GuzzleHttp\Client(array('verify'=> false)),
            $config
        );        
        return $apiInfoInstance;
    }

    public static function getApiInvoiceInstance($config){
        $apiInvoiceInstance = new \Swagger\Client\Api\SfeInvoiceApi(
            // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
            // This is optional, `GuzzleHttp\Client` will be used as default.
            new \GuzzleHttp\Client(array('verify'=> false)),
            $config
        );
        return $apiInvoiceInstance;
    }

} 

?>