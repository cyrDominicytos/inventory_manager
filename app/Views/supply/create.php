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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Gestion des approvisionnements</h1>
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
                    <li class="breadcrumb-item text-muted">Nouvel approvisionnement</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark"><?= isset($supply) ? "Modifier un approvisionnement" : "Approvisionner un produit"?></li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center py-1">
                <!--begin::Button-->
                <a href="<?= base_url() ?>/supply/list" class="btn btn-sm btn-primary">Liste des approvisionnements</a>
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
                        <h1 class="text-dark"><?= isset($supply) ? "Modification" : "Enregistrement"?> d'un approvisionnement</h1>
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
                            <form action="<?= base_url() ?><?= isset($supply) ? "/supply/edit" : "/supply/create" ?>" class="form mb-15" method="post" >
                                <?php if (isset($supply)): ?>
								   <input type="hidden" name="id" value="<?=  isset($supply) ? ($supply->supplies_id ) : ("") ?>">
								<?php endif ?>
                            <!--begin::Input group-->
                                <div class="row mb-5">
                                <div id="infoMessage" style="color:red;"><?=  session()->has('message') ? (session()->get('message')) : ("")?></div>

                                    <!--begin::Col-->
                                    <div class="col-md-12 fv-row">
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Nom complet du fournisseur</label>
                                            <div class="d-flex flex-row mb-5 fv-row text-dark">
                                                <select name="provider" aria-label="Selectionnez un profile" data-control="select2" data-placeholder="Attribuer un role..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="provider">
                                                <option value=""  id="0" disabled>Choisissez le fournisseur...</option>									
                                                <?php foreach ($providers as $provider): ?>
                                                    <option value="<?= $provider->providers_id ?>"  id="<?=  $provider->providers_id?>" ><?= $provider->providers_company ?></option>									
                                                <?php endforeach ?>
                                                </select>
                                                <a href="<?= base_url() ?>/fournisseur/list_create"   class="btn btn-primary" id="add_provider_btn">
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
                                                    <option value="<?= $product->products_id ?>"  id="<?=  $product->products_id ?>" <?= set_select('product_prices_product_id', $supply->products_id) ?>><?=$product->products_name ?></option>									
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <!--end::Col-->
                                       <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Options de vente</label>
                                            <select name="product_prices_sales_option_id" aria-label="Selectionnez une option de vente" data-control="select2" data-placeholder="Selectionnez une option de vente..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="product_prices_sales_option_id">
                                                <?php foreach ($sales_options as $sales_option): ?>
                                                    <option value="<?= $sales_option->sales_options_id ?>"  id="<?=  $sales_option->sales_options_id ?>" <?= set_select('product_prices_sales_option_id', $supply->sales_options_id) ?>><?=$sales_option->sales_options_name ?></option>									
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
                                       <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Prix de vente</label>
                                            <input  class="form-control form-control-solid" placeholder="" name="supplies_selling_price"  type="number" min="0" id="supplies_selling_price" value="<?= set_value("supplies_selling_price")	?>"  />
                                        </div>
                                        <!--end::Col-->
                                       <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Prix d'achat</label>
                                            <input  class="form-control form-control-solid" placeholder="" name="supplies_cost"  type="number" min="0" id="supplies_cost" value="<?= set_value("supplies_cost")	?>"  />
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
                                   <button type="button" class="btn btn-primary items-center" id="add">Ajouter au stock</button>
                                </div>
                                <!--end::Submit-->
                                <div class="mb-12 mb-lg-0">
                                    <!--begin::Description-->
                                    <div class="m-0">
                                        <!--begin::Title-->
                                        <h4 class="fs-1 text-gray-800 w-bolder mb-6 text-center">Détails des produits approvisionnés</h4>
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
                                                    <th>Fournisseurs</th>
                                                    <th>Produits</th>
                                                    <th>Options de vente</th>
                                                    <th>PU</th>
                                                    <th>Cout Achat</th>
                                                    <th>Quantités</th>
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
        var base_url = "<?= base_url() ?>";
        var oldprovider = "<?= isset($supply) ? ($supply->supplies_provider_id) : ("") ?>";
        var supply = <?= isset($supply) ? (json_encode($supply)) : (0) ?>;

        var product_price = <?= json_encode($product_price)?>;        
        var provider = document.getElementById("provider");
        var category = document.getElementById("product_categories_id");
        var product = document.getElementById("product_prices_product_id");
        var sale_option = document.getElementById("product_prices_sales_option_id");
        var pu = document.getElementById("supplies_selling_price");
        var cost = document.getElementById("supplies_cost");
        var price = document.getElementById("product_prices_price");
        $(window).on('load', function() {
            if(oldprovider!= 0){
                provider.value = oldprovider;
                provider.dispatchEvent(new Event('change'));
                category.value = oldprovider;
                price.value = supply['supplies_selling_quantity'];
               
               cost.value = supply['supplies_cost'];
               pu.value = supply['supplies_selling_price'];
               
            }

            if(supply!== 0){
                     var indexId = supply['supplies_provider_id']+supply['supplies_products_id']+supply['supplies_sales_options_id'];
                     table_unique[table_unique.length]=indexId;
                  
                     var html = '';
                        html += '<tr class="text-start text-black fw-bolder fs-7">';
                        html += '<td class="text-gray">'+supply['providers_company']+'</td>';
                        html += '<td class="text-gray"><input type="text" required id="provider_list[]" name="provider_list[]" class="form-control" hidden  value='+supply['providers_company']+'/><input type="text" required id="product_list[]" name="product_list[]" class="form-control" hidden  value='+supply['supplies_products_id']+'/><input type="text" required id="option_list[]" name="option_list[]" class="form-control" hidden  value='+supply['supplies_sales_options_id']+' /><input type="text" required id="pu_list[]" name="pu_list[]" class="form-control" hidden  value='+supply['supplies_selling_price']+' /><input type="text" required id="cost_list[]" name="cost_list[]" class="form-control" hidden  value='+supply['supplies_cost']+' /><input type="text" required id="quantity_list[]" name="quantity_list[]" class="form-control" hidden  value='+supply['supplies_selling_quantity']+' />'+supply['products_name']+'</td>';
                        html += '<td class="text-gray">'+supply['sales_options_name']+'</td>';
                        html += '<td class="text-gray">'+supply['supplies_selling_price']+'</td>';
                        html += '<td class="text-gray">'+supply['supplies_cost']+'</td>';
                        html += '<td class="text-gray">'+supply['supplies_selling_quantity']+'</td>';
                        html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove" id="'+indexId+'"><span class="fa fa-minus"></span></button></td></tr>';
                        $('#kt_table_users').append(html);
         
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

    $('#product_prices_sales_option_id').change(function(){
        if($(this).val() != '')
        {
            var value = $(this).val();   
            $('#supplies_selling_price').val(product_price[product.value+sale_option.value]);
            $('#supplies_cost').val(product_price[product.value+sale_option.value]);
        }
    });

    $(document).on('click', '#add', function(){
        if(!checkSelect())
            return;
        var indexId =  provider.value+product.value+sale_option.value;
        if(table_unique.includes(indexId)){
            //row already exists
            var rowId = table_unique.indexOf(indexId)+1;
            var table =  document.getElementById('kt_table_users');
            var html = '<td class="text-gray"><input type="text" required id="provider_list[]" name="provider_list[]" class="form-control" hidden  value='+provider.value+'/><input type="text" required id="product_list[]" name="product_list[]" class="form-control" hidden  value='+product.value+'/><input type="text" required id="option_list[]" name="option_list[]" class="form-control" hidden  value='+sale_option.value+' /><input type="text" required id="pu_list[]" name="pu_list[]" class="form-control" hidden  value='+pu.value+' /><input type="text" required id="cost_list[]" name="cost_list[]" class="form-control" hidden  value='+cost.value+' /><input type="text" required id="quantity_list[]" name="quantity_list[]" class="form-control" hidden  value='+price.value+' />'+product.options[product.selectedIndex].text+'</td>';
            
            var oldValue = table.rows[rowId].cells[5].innerHTML.trim();
            var newValue = parseInt(price.value)+ parseInt(oldValue);
            table.rows[rowId].cells[1].innerHTML = html;
            table.rows[rowId].cells[5].innerHTML = newValue;
        }else{
            //new row
            table_unique[table_unique.length] = indexId;
            var html = '';
            html += '<tr class="text-start text-black fw-bolder fs-7">';
            html += '<td class="text-gray">'+provider.options[provider.selectedIndex].text+'</td>';
            html += '<td class="text-gray"><input type="text" required id="provider_list[]" name="provider_list[]" class="form-control" hidden  value='+provider.value+'/><input type="text" required id="product_list[]" name="product_list[]" class="form-control" hidden  value='+product.value+'/><input type="text" required id="option_list[]" name="option_list[]" class="form-control" hidden  value='+sale_option.value+' /><input type="text" required id="pu_list[]" name="pu_list[]" class="form-control" hidden  value='+pu.value+' /><input type="text" required id="cost_list[]" name="cost_list[]" class="form-control" hidden  value='+cost.value+' /><input type="text" required id="quantity_list[]" name="quantity_list[]" class="form-control" hidden  value='+price.value+' />'+product.options[product.selectedIndex].text+'</td>';
            html += '<td class="text-gray">'+sale_option.options[sale_option.selectedIndex].text+'</td>';
            html += '<td class="text-gray">'+pu.value+'</td>';
            html += '<td class="text-gray">'+cost.value+'</td>';
            html += '<td class="text-gray">'+price.value+'</td>';
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
        console.log(provider.value +" - "+ table_unique.length);
        if(provider.value!== "" && table_unique.length > 0)
            document.getElementById("submit").disabled = false;
        else
            document.getElementById("submit").disabled = true;
    }
    </script>
<?= $this->endSection() ?>

 <?= $this->endSection() ?>