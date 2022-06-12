<?php

use App\Models\PermissionModel;
use App\Models\GroupPermissionModel;
use App\Models\GroupModel;
use App\Models\ClientModel;
use App\Models\ProviderModel;
use App\Models\DeliveryMenModel;
use App\Models\ProductCategoriesModel;
use App\Models\ProductModel;
use App\Models\SalesOptionsModel;
use App\Models\OrdersModel;
use App\Models\OrdersDetailsModel;
use App\Models\SaleModel;
use App\Models\SellDetailsModel;
use App\Models\ProductPriceModel;
use App\Models\ConfigModel;
use App\Models\SupplyModel;
use App\Models\InventoryModel;


// Function: used to convert a string to revese in order
if (!function_exists("status")) {
	function status($statusId)
	{
		switch ($statusId) {
			case 0:
				return ("<div class='badge badge-danger fw-bolder'>InActif</div>"); 
			case 1:
				return ("<div class='badge badge-success fw-bolder'>Actif</div>"); 
			case 2:
				return ("<div class='badge badge-info fw-bolder'>Réglée</div>"); 
			case 3:
				return ("<div class='badge badge-warning fw-bolder'>Facturée</div>"); 
			case 4:
				return  ("<div class='badge badge-success fw-bolder'>Normalisée</div>"); 
			default:
				return ("<div class='badge badge-danger fw-bolder'>Default status</div>") ; 
		}
	}
}
if (!function_exists("livraison")) {
	function livraison($statusId)
	{
		return ($statusId!= 0) ? ("<div class='badge badge-success fw-bolder'>Oui</div>") : ("<div class='badge badge-danger fw-bolder'>Non</div>"); 
	}
}
if (!function_exists("deleteUser")) {
	function deleteUser($statusId)
	{
		return ($statusId== 1) ? ("<span class='text-danger'>Bannir</span>") : ("<span class='text-success'>Activer</span>"); 
	}
}

if (!function_exists("groups_array")) {
function groups_array($groups)
	{
		$data = [];
		foreach ($groups as $group){
			$data[count($data)] = $group->group_id;
		}
		return $data;
	}
}


if (!function_exists("permission_array")) {
function permission_array($groups)
	{
			if(count($groups) >0)
				return (array) json_decode($groups[0]->permissions);
				return [];
	}
}

if (!function_exists("permission_list_foreach_group")) {
function permission_list_foreach_group()
	{
		$modelGroup = new GroupModel();
		$modelGroupPermission = new GroupPermissionModel();
		$groups = $modelGroup->get()->getResult();
		$data = [];
		foreach ($groups as $group){
			$temp = $modelGroupPermission->get_permission_by_group($group->id);
			if(count($temp) > 0)
				$data[$group->id] =  ((array) json_decode($temp[0]->permissions));
			else
				$data[$group->id] = $temp;

			
			
		}
		return $data;
	}
}

if (!function_exists("permission_list_group")) {
function permission_list_group($id)
	{
		$modelGroupPermission = new GroupPermissionModel();
		$data = [];
			$temp = $modelGroupPermission->get_permission_by_group($id);
			if(count($temp) > 0)
				return((array) json_decode($temp[0]->permissions));
				return $temp;						
	}
}

if (!function_exists("getPermissionByModule")) {
function getPermissionByModule()
	{
		$modelPermission = new PermissionModel();
		$permissions = $modelPermission->getPermissionsGroupByModule();
		$data = [];
		foreach ($permissions as $permission){

			$data[$permission->module] = $modelPermission->where(['module' => $permission->module])->get()->getResult();
		}
		return $data;
	}
}

if (!function_exists("retrivePermissionByModule")) {
function retrivePermissionByModule($permissions)
	{

		$data = [];
		$temp = [];
		$index = "";
		foreach ($permissions as $key => $permission){
			if( $permission->module == $index || $index==""){
				$temp[count($temp)] = $permission;
				$index = $permission->module;
			}else{
				$data[$index] = $temp;
				$temp = [];
				$temp[count($temp)] = $permission;
				$index = $permission->module;
			}
			//$data[$permission->module] = $modelPermission->where(['module' => $permission->module])->get()->getResult();
		}
		if($index!= "" && count($temp)>0)
			$data[$index] = $temp;	
		return $data;
	}
}

if (!function_exists("insertPermissions")) {
function insertPermissions($groupId, $request)
	{
		$modelPermission = new PermissionModel();
		$modelGroupPermission = new GroupPermissionModel();
		$permissions = $modelPermission->get()->getResult();
		$data = [];
		foreach ($permissions as $permission){
			if($request->getPost($permission->id) != null){
				$data[$permission->id] =$permission;
				//$modelGroupPermission->insert(["group_id"=> $groupId,"permission_id"=>$permission->id]);
			}
		}
		$modelGroupPermission->insert(["group_id"=> $groupId,"permissions"=>json_encode($data)]);
		return $data;
	}
}

if (!function_exists("updatePermissions")) {
function updatePermissions($groupId, $request)
	{
		$modelPermission = new PermissionModel();
		$modelGroupPermission = new GroupPermissionModel();
		$modelGroupPermission->where("group_id", $groupId)->delete();
		$permissions = $modelPermission->get()->getResult();
		$data = [];
		foreach ($permissions as $permission){
			if($request->getPost($permission->id) != null){
				$data[$permission->id] =$permission;
			}
		}
		$modelGroupPermission->insert(["group_id"=> $groupId,"permissions"=>json_encode($data)]);
		return $data;
	}
}

if (!function_exists("externalParams")) {
function externalParams()
	{
		return [
				"1"=>[
					"title"=>"Liste des clients",
					"externalName"=>"client",
					"table"=>"clients",
				],
				"2"=>[
					"title"=>"Liste des fournisseurs",
					"externalName"=>"fournisseur",
					"externalNewRoute"=>"",
					"table"=>"providers",
				],
				"3"=>[
					"title"=>"Liste des livreurs",
					"externalName"=>"livreur",
					"externalNewRoute"=>"",
					"table"=>"delivery_mens",
				],
				
		];
	}
}

if (!function_exists("externalInsert")) {
function externalInsert($type, $data)
	{
		switch ($type) {
			case '1':
				$clientModel = new ClientModel();
				return $clientModel->insert($data);
			case '2':
				$providerModel = new ProviderModel();
				return $providerModel->insert($data);

			case '3':
				$deliveryMenModel = new DeliveryMenModel();
				return $deliveryMenModel->insert($data);
			
			default:
				return null;
		}
	}
}

if (!function_exists("externalModel")) {
function externalModel($type)
	{
		switch ($type) {
			case '1':
				return new ClientModel();
			case '2':
				return new ProviderModel();

			case '3':
				return new DeliveryMenModel();
			default:
				return null;
		}
	}
}


if (!function_exists("productParams")) {
function productParams()
	{
		return [
				"1"=>[
					"title"=>"Liste des catégories de produit",
					"externalName"=>"catégorie de produit",
					"table"=>"product_categories",
					"externalNewRoute"=>"/product_category",

				],
				"2"=>[
					"title"=>"Liste des options de vente",
					"externalName"=>"options de vente",
					"externalNewRoute"=>"/sales_option",
					"table"=>"sales_options",
				]
				
		];
	}
}



if (!function_exists("productInsert")) {
function productInsert($type, $data)
	{
		switch ($type) {
			case '1':
				$clientModel = new ProductCategoriesModel();
				return $clientModel->insert($data);
			case '2':
				$providerModel = new SalesOptionsModel();
				return $providerModel->insert($data);			
			default:
				return null;
		}
	}
}

if (!function_exists("productModel")) {
function productModel($type)
	{
		switch ($type) {
			case '1':
				return new ProductCategoriesModel();;
			case '2':
				return  new SalesOptionsModel();
			default:
				return null;
		}
	}
}


if (!function_exists("getConfigList")) {
	function getConfigList()
		{
			$modelConfig = new ConfigModel();
			$configList = $modelConfig->get()->getResult();
			$data = [];
			foreach ($configList as $config){
				$data[$config->config_code] = $config;
			}
			return $data;
		}
	}

if (!function_exists("getProductPriceArray")) {
	function getProductPriceArray()
		{
			$model = new ProductPriceModel();

			$results = $model->get()->getResult();
			$data = [];
			foreach ($results as $result){
				$data[$result->product_prices_product_id."".$result->product_prices_sales_option_id] = $result->product_prices_price;
			}
			return  $data;
		}
	}
if (!function_exists("getProductByCategory")) {
	function getProductByCategory($id)
		{
			$model = new ProductModel();
			$results = $model->where('products_product_categorie_id', $id)->get()->getResult();
			$output = '<option value="">Choisissez un produit...</option>';
			foreach ($results as $result){
				$output .= '<option value="'.$result->products_id.'">'.$result->products_name.'</option>';
			}
			return  $output;
		}
	}

if (!function_exists("getSaleOptionsByProduct")) {
	function getSaleOptionsByProduct($id)
		{
			$model = new SalesOptionsModel();
			$results = $model->get_not_set_options_for_product( $id);
			$output = '<option value="">Choisissez une option de vente...</option>';
			foreach ($results->getResult() as $result){
				$output .= '<option value="'.$result->sales_options_id.'">'.$result->sales_options_name.'</option>';
			}
			return  $output;
		}
	}

if (!function_exists("get_assign_options_by_product")) {
	function get_assign_options_by_product($id)
		{
			$model = new ProductPriceModel();
			$results = $model->get_assign_options_by_product($id);
			$output = '<option value="" >Choisissez une option de vente...</option>';
			foreach ($results as $result){
				$output .= '<option value="'.$result->sales_options_id.'">'.$result->sales_options_name.'</option>';
			}
			//dd($output);
			return  $output;
		}
	}

	if (!function_exists("insertOrder")) {
		function insertOrder($request, $ionAuth)
			{

			//	dd($request);
				$amount = 0;
				$modelOrders = new OrdersModel();
				$modelOrderDetails = new OrdersDetailsModel();
				$id = null;
				$id = $modelOrders->insert([
					"orders_client_id"=>$request->getVar('client'),
					"orders_amount"=>0,
					"orders_users_id"=>$ionAuth->user()->row()->id,
					"orders_status"=>1,
					"orders_aib"=> ($request->getVar('aib_service')) ? ($request->getVar('aib_type')): (0),
				]);

				foreach ($request->getVar('product_list') as $key => $product){
					$amount += (int) $request->getVar('montant_list')[$key]; 
				    $modelOrderDetails->insert([
						"orders_details_amount"=>$request->getVar('montant_list')[$key],
						"orders_details_quantity"=>$request->getVar('quantity_list')[$key],
						"orders_details_reduction"=>$request->getVar('reduction'.$key),
						"orders_details_orders_id"=>$id,
						"orders_details_sales_options_id"=>$request->getVar('option_list')[$key],
						"orders_details_products_id"=>$product,
					]);

				}

				$data["orders_amount"] = $amount;
				if($request->getVar('delivery_man'))
				{
					$data["orders_deliver_man"] = $request->getVar('delivery_man');
					$data["orders_delivery_date"] = $request->getVar('sales_delivery_date');
				}
				if($request->getVar('amount_reduce'))
				{
					$data["orders_reduction"] = $request->getVar('amount_reduce');
				}
				$data["orders_amount"] = $request->getVar('amount');
				$modelOrders->update($id,$data);

				return $id;
			}
		}


	if (!function_exists("updateOrder")) {
		function updateOrder($request, $id)
			{
				$modelOrders = new OrdersModel();
				$modelOrdersDetails = new OrdersDetailsModel();
				$result = false;
				$amount = 0;

				//remove all details rows
			    $modelOrdersDetails->where("orders_details_orders_id",$id)->delete();
				foreach ($request->getVar('product_list') as $key => $product){
					//dd($request->getVar('montant_list')); 
					$amount += (int) $request->getVar('montant_list')[$key]; 
					$result = $modelOrdersDetails->insert([
						"orders_details_amount"=>$request->getVar('montant_list')[$key],
						"orders_details_quantity"=>$request->getVar('quantity_list')[$key],
						"orders_details_orders_id"=>$id,
						"orders_details_sales_options_id"=>$request->getVar('option_list')[$key],
						"orders_details_products_id"=>$product,
					]);

				}
				return	$modelOrders->update($id,[
					"orders_amount"=>$amount,
					"orders_client_id"=>$request->getVar('client'),
				]);
			}
		}
	
	if (!function_exists("insertSales")) {
		function insertSales($request, $ionAuth, $sales_is_commanded=false)
			{
				$id = false;
				$amount = 0;
				$modelSale = new SaleModel();
				$modelSellDetails = new SellDetailsModel();
				$id = $modelSale->insert([
					"sales_client_id"=>$request->getVar('client'),
					"sales_amount"=>0,
					"sales_users_id"=>$ionAuth->user()->row()->id,
					"sales_status"=>2,
					"sales_aib"=> ($request->getVar('aib_service')) ? ($request->getVar('aib_type')): (0),
					"sales_is_commanded"=>$sales_is_commanded,
				]);

				foreach ($request->getVar('product_list') as $key => $product){
					//dd($request->getVar('montant_list')); 
					$amount += (int) $request->getVar('montant_list')[$key];
					$data = [
						"sell_details_amount"=>$request->getVar('montant_list')[$key],
						"sell_details_quantity"=>$request->getVar('quantity_list')[$key],
						"sell_details_reduction"=>$request->getVar('reduction_list')[$key],
						"sell_details_sales_id"=>$id,
						"sell_details_sales_options_id"=>$request->getVar('option_list')[$key],
						"sell_details_products_id"=>$product,
					];
				//	if($request->getPost('reduction_list')$request->getVar('reduction_list'))
				    $modelSellDetails->insert($data);

				}
				/*$data = [
					"sell_details_amount"=>$request->getVar('montant_list')[$key],
					"sell_details_quantity"=>$request->getVar('quantity_list')[$key],
					"sell_details_reduction"=>$request->getVar('reduction_list')[$key],
					"sell_details_sales_id"=>$id,
					"sell_details_sales_options_id"=>$request->getVar('option_list')[$key],
					"sell_details_products_id"=>$product,
				];*/
				if($request->getVar('delivery_man'))
					{
						$data["sales_deliver_man"] = $request->getVar('delivery_man');
						$data["sales_delivery_date"] = $request->getVar('sales_delivery_date');
					}
				if($request->getVar('amount_reduce'))
					{
						$data["sales_reduction"] = $request->getVar('amount_reduce');
					}
					
					$data["sales_amount"] = $request->getVar('amount');

				$modelSale->update($id,$data);
				return $id;
			}
		}


	if (!function_exists("updateSales")) {
		function updateSales($request, $id)
			{
				//remove all details rows
				$amount = 0;
				$modelSale = new SaleModel();
				$modelSellDetails = new SellDetailsModel();
				$modelSellDetails->where("sell_details_sales_id",$id)->delete();

				foreach ($request->getVar('product_list') as $key => $product){
					//dd($request->getVar('montant_list')); 
					$amount += (int) $request->getVar('montant_list')[$key]; 
					$result = $modelSellDetails->insert([
						"sell_details_amount"=>$request->getVar('montant_list')[$key],
						"sell_details_quantity"=>$request->getVar('quantity_list')[$key],
						"sell_details_reduction"=>$request->getVar('reduction_list')[$key],
						"sell_details_sales_id"=>$id,
						"sell_details_sales_options_id"=>$request->getVar('option_list')[$key],
						"sell_details_products_id"=>$product,
					]);

				}

				return	$modelSale->update($id,[
					"orders_amount"=>$amount,
					"orders_client_id"=>$request->getVar('client'),
				]);
			}
		}
	

		if (!function_exists("insertSupply")) {
		function insertSupply($request)
			{
				$result = false;
				$modelSupply = new SupplyModel();
				foreach ($request->getVar('product_list') as $key => $product){
					//dd($request->getVar('montant_list')); 
					$result = $modelSupply->insert([
						"supplies_cost"=>$request->getVar('cost_list')[$key],
						"supplies_selling_price"=>$request->getVar('pu_list')[$key],
						"supplies_selling_quantity"=>$request->getVar('quantity_list')[$key],
						"supplies_provider_id"=>$request->getVar('provider_list')[$key],
						"supplies_sales_options_id"=>$request->getVar('option_list')[$key],
						"supplies_products_id"=>$product,
					]);

				}
				return $result;
			}
		}
	
		if (!function_exists("updateSupply")) {
		function updateSupply($request, $id)
			{
				$result = false;
				$modelSupply = new SupplyModel();
			    $modelSupply->where("supplies_id",$id)->delete();
				foreach ($request->getVar('product_list') as $key => $product){
					$result = $modelSupply->insert([
						"supplies_cost"=>$request->getVar('cost_list')[$key],
						"supplies_selling_price"=>$request->getVar('pu_list')[$key],
						"supplies_selling_quantity"=>$request->getVar('quantity_list')[$key],
						"supplies_provider_id"=>$request->getVar('provider_list')[$key],
						"supplies_sales_options_id"=>$request->getVar('option_list')[$key],
						"supplies_products_id"=>$product,
					]);
				}
				return $result;
			}
		}

		//Load inventory quantity foreach existing product
		if (!function_exists("getExistingProductQuantity")) {
			function getExistingProductQuantity()
				{
					$model = new InventoryModel();
		
					$results = $model->get()->getResult();
					$data = [];
					foreach ($results as $result){
						$data[$result->products_id."".$result->sales_options_id] = $result->quantity_inventory;
					}
					return  $data;
				}
			}
		//Load inventory quantity foreach existing product
		if (!function_exists("format_date")) {
			function format_date($text, $format)
				{
					$date=date_create($text);
					return  date_format($date,$format);
				}
			}
?>
