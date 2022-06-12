<?= $this->extend('dashTemplate') ?>
<?php $this->section('title'); echo  getenv('APP_NAME')."| Gestion des commandes "; $this->endSection()?>
<?= $this->section('content') ?>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Gestion des commandes</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Nouvelle commande</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark"><?= isset($order) ? "Modifier une commande" : "Enregistrer une commande"?></li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center py-1">
                <!--begin::Button-->
                <a href="<?= base_url() ?>/order/list" class="btn btn-sm btn-primary">Liste des commandes</a>
                <!--end::Button-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Careers - Apply-->
            <div class="card">   
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h1 class="text-dark"><?= isset($order) ? "Modification" : "Enregistrement"?> d'une commande</h1>
                    </div>
                    <!--end::Card title-->
                </div>                                 
                <!--begin::Body-->
                <div class="card-body p-lg-17">
                    <!--begin::Layout-->
                    <div class="d-flex flex-column flex-lg-row mb-17">
                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid me-0 me-lg-20">
                            <!--begin::Form-->
                            <form action="<?= base_url() ?><?= isset($order) ? "/order/edit" : "/order/create" ?>" class="form mb-15" method="post" >
                                <?php if (isset($order)): ?>
								   <input type="hidden" name="id" value="<?=  isset($order) ? ($order->orders_id) : ("") ?>">
								<?php endif ?>
                            <!--begin::Input group-->
                                <div class="row mb-5">
                                <div id="infoMessage" style="color:red;"><?=  session()->has('message') ? (session()->get('message')) : ("")?></div>

                                    <!--begin::Col-->
                                    <div class="col-md-12 fv-row">
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Nom complet du client</label>
                                            <div class="d-flex flex-row mb-5 fv-row text-dark">
                                                <select name="client" aria-label="Selectionnez un profile" data-control="select2" data-placeholder="Attribuer un role..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="client">
                                                <option value=""  id="0" disabled>Choisissez le client...</option>									
                                                <?php foreach ($clients as $client): ?>
                                                    <option value="<?= $client->clients_id ?>"  id="<?=  $client->clients_id?>" ><?= $client->clients_company ?></option>									
                                                <?php endforeach ?>
                                                </select>
                                                <a href="<?= base_url() ?>/client/list_create"   class="btn btn-primary" id="add_client_btn">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="row">
                                       <!--begin::Col-->
                                        <div class="col-md-6">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Catégories</label>
                                            <select name="product_categories_id" aria-label="Selectionnez un profile" data-control="select2" data-placeholder="Attribuer un role..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="product_categories_id">
                                                <option value=""  id="0">Choisissez une catégorie...</option>									
                                                <?php foreach ($categories as $categorie): ?>
                                                    <option value="<?= $categorie->product_categories_id ?>"  id="<?=  $categorie->product_categories_id?>" <?= set_select('product_categories_id', $categorie->product_categories_id) ?>><?= $categorie->product_categories_name ?></option>									
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <!--end::Col-->
                                       <!--begin::Col-->
                                        <div class="col-md-6">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Produits</label>
                                            <select name="product_prices_product_id" aria-label="Selectionnez un produit" data-control="select2" data-placeholder="Selectionnez un produit..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="product_prices_product_id">
                                                <?php foreach ($products as $product): ?>
                                                    <option value="<?= $product->products_id ?>"  id="<?=  $product->products_id ?>" <?= set_select('product_prices_product_id', $product->products_id) ?>><?=$product->products_name ?></option>									
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <!--end::Col-->
                                       <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Options de vente</label>
                                            <select name="product_prices_sales_option_id" aria-label="Selectionnez une option de vente" data-control="select2" data-placeholder="Selectionnez une option de vente..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="product_prices_sales_option_id">
                                                <?php foreach ($sales_options as $sales_option): ?>
                                                    <option value="<?= $sales_option->sales_options_id ?>"  id="<?=  $sales_option->sales_options_id ?>" <?= set_select('product_prices_sales_option_id', $sales_option->sales_options_id) ?>><?=$sales_option->sales_options_name ?></option>									
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <!--end::Col-->
                                       <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Quantité</label>
                                            <input  class="form-control form-control-solid" placeholder="" name="product_prices_price"  type="number" min="0" id="product_prices_price" value="<?= set_value("product_prices_price")	?>"  />
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Job-->
                                <!--begin::Separator-->
                                <div class="separator mb-8"></div>
                                <!--end::Separator-->
                                <!--begin::Submit-->
                                <div class="d-flex flex-column mb-5">
                                   <button type="button" class="btn btn-primary items-center" id="add">Ajouter au panier</button>
                                </div>
                                <!--end::Submit-->
                                <div class="mb-12 mb-lg-0">
                                    <!--begin::Description-->
                                    <div class="m-0">
                                        <!--begin::Title-->
                                        <h4 class="fs-1 text-gray-800 w-bolder mb-6 text-center">Détails des produits ajoutés</h4>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Description-->
                                    <!--begin::Accordion-->
                                    <!--begin::Section-->
                                    <div class="row mb-5">
                                        <div class="table-repsonsive">
                                            <span id="error"></span>
                                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase">
                                                    <th>Produits</th>
                                                    <th>Options de vente</th>
                                                    <th>Quantités</th>
                                                    <th>Montant</th>
                                                    <th>Actions</th>
                                                </tr>
                                                <tbody  class="text-gray-600 fw-bold">
                                                
                                                </tbody>
                                            </table>
                                    
                                        </div>
                                    </div>
                                    <!--begin::Separator-->
                                    <div class="separator mb-8"></div>
                                    <!--end::Separator-->
                                    <div class="d-flex flex-column mb-5">
                                        <!--begin::Button-->
                                        <button type="submit" id="submit" class="btn btn-primary">
                                            <span class="indicator-label" id="submitText">Enregistrer</span>
                                            <span class="indicator-progress">Patientez...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                        <!--end::Button-->
                                        <!-- <input type="submit" class="btn btn-primary" value="Enregistrer"> -->
                                        <!-- <button type="submit" class="btn btn-primary">Enregistrer</button> -->
                                    </div>
                                </div>
                                <!--end::Job-->  
                            </form>
                            <!--end::Form-->
                            
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Layout-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Careers - Apply-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->
<?= $this->section('javascript') ?>
<script type="text/javascript">
        var table_unique = [];
        var nbr_row_add = 0;
        var base_url = "<?= base_url() ?>";
        var oldClient = "<?= isset($order) ? ($order->orders_client_id) : ("") ?>";
        var order_detail = <?= isset($order) ? (json_encode($order_detail)) : (0) ?>;

        var product_price = <?= json_encode($product_price)?>;
        var active_mes = "Vous souhaitez activer ce produit. Une fois activé, il apparaitra à nouveau dans les modules d'approvisionnement et de vente<span class='badge badge-primary'>Etes-vous sûr de vouloir l'activer ?</span>";
        var category = document.getElementById("product_categories_id");
        var product = document.getElementById("product_prices_product_id");
        var sale_option = document.getElementById("product_prices_sales_option_id");
        var price = document.getElementById("product_prices_price");
        $(window).on('load', function() {
            if(oldClient!= 0){
                document.getElementById("client").value = oldClient;
                document.getElementById("client").dispatchEvent(new Event('change'));
            }

            if(order_detail!== 0){
                var indexId = product.value+sale_option.value;

                 order_detail.forEach(function(element) {
                     var indexId = element['orders_details_products_id']+element['orders_details_sales_options_id'];
                     table_unique[table_unique.length] =indexId;
                  
                    var html = '';
                    html += '<tr class="text-start text-black fw-bolder fs-7">';
                    html += '<td class="text-gray"><input type="text" required id="product_list[]" name="product_list[]" class="form-control" hidden  value='+element['orders_details_products_id']+'/><input type="text" required id="option_list[]" name="option_list[]" class="form-control" hidden  value='+element['orders_details_sales_options_id']+' /><input type="text" required id="quantity_list[]" name="quantity_list[]" class="form-control" hidden  value='+element['orders_details_quantity']+' /><input type="text" required id="montant_list[]" name="montant_list[]" class="form-control" hidden value='+element['orders_details_amount']+'/>'+element['products_name']+'</td>';
                    html += '<td class="text-gray">'+element['sales_options_name']+'</td>';
                    html += '<td class="text-gray">'+element['orders_details_quantity']+'</td>';
                    html += '<td class="text-gray">'+element['orders_details_amount']+'</td>';
                    html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove" id="'+indexId+'"><span class="fa fa-minus"></span></button></td></tr>';
                    $('#kt_table_users').append(html);
                },  this);
                              
            }
            checkForm() 
        });

     $('#product_categories_id').change(function(){
        if($(this).val() != '')
        {
            var value = $(this).val();   
            $.ajax({
                url: base_url+"/dynamic/product",
                method:"POST",
                data:{id:value},
                success:function(result)
                {
                $('#product_prices_product_id').html(result);
                }
            })
        }
    });

    $('#product_prices_product_id').change(function(){
        if($(this).val() != '')
        {
            var value = $(this).val();   
            $.ajax({
                url: base_url+"/dynamic/assign_sale_options",
                method:"POST",
                data:{id:value},
                success:function(result)
                {
                $('#product_prices_sales_option_id').html(result);
                }
            })
        }
    });

    $(document).on('click', '#add', function(){
        if(!checkSelect())
            return;
        var indexId = product.value+sale_option.value;
        console.log(table_unique);
        if(table_unique.includes(indexId)){
            //row already exists
            var rowId = table_unique.indexOf(indexId)+1;
            var table =  document.getElementById('kt_table_users');
            var oldValue = table.rows[rowId].cells[2].innerHTML.trim();
            var newValue = parseInt(price.value)+ parseInt(oldValue);
            table.rows[rowId].cells[2].innerHTML = newValue;
            table.rows[rowId].cells[3].innerHTML = newValue * product_price[indexId];
            var html = '<td class="text-gray"><input type="text" required id="product_list[]" name="product_list[]" class="form-control" hidden  value='+product.value+'/><input type="text" required id="option_list[]" name="option_list[]" class="form-control" hidden  value='+sale_option.value+' /><input type="text" required id="quantity_list[]" name="quantity_list[]" class="form-control" hidden  value='+newValue+' /><input type="text" required id="montant_list[]" name="montant_list[]" class="form-control" hidden value='+(newValue * product_price[indexId])+'/>'+product.options[product.selectedIndex].text+'</td>';
            table.rows[rowId].cells[0].innerHTML = html;
        }else{
            //new row
            table_unique[table_unique.length] = indexId;
            var html = '';
            html += '<tr class="text-start text-black fw-bolder fs-7">';
            html += '<td class="text-gray"><input type="text" required id="product_list[]" name="product_list[]" class="form-control" hidden  value='+product.value+'/><input type="text" required id="option_list[]" name="option_list[]" class="form-control" hidden  value='+sale_option.value+' /><input type="text" required id="quantity_list[]" name="quantity_list[]" class="form-control" hidden  value='+price.value+' /><input type="text" required id="montant_list[]" name="montant_list[]" class="form-control" hidden value='+(product_price[indexId]*price.value)+'/>'+product.options[product.selectedIndex].text+'</td>';
            html += '<td class="text-gray">'+sale_option.options[sale_option.selectedIndex].text+'</td>';
            html += '<td class="text-gray">'+price.value+'</td>';
            html += '<td class="text-gray">'+(product_price[indexId]*price.value)+'</td>';
            html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove" id="'+indexId+'"><span class="fa fa-minus"></span></button></td></tr>';
            $('#kt_table_users').append(html);
        }
        checkForm() 
       });
       
       $(document).on('click', '.remove', function(){
        var row_index =$(this).closest("tr").index();
        var rowId =  $(this).attr("id");
        table_unique.splice(row_index-1, 1);
        $(this).closest('tr').remove();
        checkForm();
       });
    function checkSelect() {
        if(category.value!== "" && product.value!== "" && sale_option.value!=="")
            return true;
            return false; 
    }
    function checkForm() {
        console.log(client.value +" - "+ table_unique.length);
        if(client.value!== "" && table_unique.length > 0)
            document.getElementById("submit").disabled = false;
        else
            document.getElementById("submit").disabled = true;
    }
    </script>
<?= $this->endSection() ?>

 <?= $this->endSection() ?>