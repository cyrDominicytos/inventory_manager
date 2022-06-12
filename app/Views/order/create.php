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
                                       <!--begin:: Reduction Col-->
                                       <div class="col-md-6 fv-row mt-5">
                                            <div class="d-flex flex-stack mb-8">
                                                <!--begin::Label-->
                                                <div class="me-5">
                                                    <label class="fs-6 fw-bold fw-bolder text-dark">Réduction</label>
                                                    <div class="fs-7 fw-bold text-muted">Appliquer une réduction à ce produit ?</div>
                                                </div>
                                                <!--end::Label-->
                                                <!--begin::Switch-->
                                                <label class="form-check form-switch form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" id="apply" name="apply">
                                                    <span class="form-check-label fw-bold text-muted">Appliquer</span>
                                                </label>
                                                <!--end::Switch-->
                                            </div>
                                        </div>
                                       <!--begin::Col-->
                                        <div class="col-md-6 fv-row mt-5 reduction" style="display:none">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Valeur de la réduction</label>
                                            <div class="d-flex flex-row text-center">
                                                <input  class="form-control form-control-solid" placeholder="" name="reduction1"  type="number" min="0" max="100" value="0" id="reduction1"/>
                                                <label class="fs-6 fw-bold fw-bolder text-dark pt-3 mx-2">%  </label>
                                                <input  class="form-control form-control-solid" placeholder="" name="reduction2"  type="number" min="0" id="reduction2" value="0"  />
                                                <label class="fs-6 fw-bold fw-bolder text-dark pt-3 mx-2">FCFA</label>

                                            </div>
                                        </div>
                                        <!--end: Reduction :Col-->
                                       
                                       <!--end: Reduction :Col-->
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
                                 <!--begin::Details-->
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
                                                    <th>Prix Unitaire</th>
                                                    <th>Quantités</th>
                                                    <th>Réduction</th>
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
                                    <!--begin:: Reduction Col-->
                                    <div class="row">
                                        <div class="col-md-7 fv-row mt-5">
                                            <div class="d-flex flex-stack mb-8 items-center">
                                                <!--begin::Label-->
                                                <div class="me-5">
                                                    <label class="fs-6 fw-bold fw-bolder text-dark">Réduction Totale</label>
                                                    <div class="fs-7 fw-bold text-muted">Appliquer une réduction à toute la commande ?</div>
                                                </div>
                                                <!--end::Label-->
                                                <!--begin::Switch-->
                                                <label class="form-check form-switch form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" id="apply_total" name="apply_total">
                                                    <span class="form-check-label fw-bold text-muted">Appliquer</span>
                                                </label>
                                                <!--end::Switch-->
                                            </div>
                                        </div>
                                        <!--begin::Col reduction_total-->
                                        <div class="col-md-12 fv-row mt-5 reduction_total" style="display:none">
                                            <div class="d-flex flex-row">
                                                <!--begin::Col-->
                                                <div class="col-md-6 fv-row" style="padding-right: 10px;">
                                                    <label class="form-label fw-bolder text-dark fs-6 required">Réduction (en %)</label>
                                                    <input  class="form-control form-control-solid" placeholder="" name="product_prices_price"  type="number" min="0" id="reduction_total1" value="<?= set_value("product_prices_price")	?>"  />
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-md-6 fv-row mx-5" style="margin-left: 10px;">
                                                    <label class="form-label fw-bolder text-dark fs-6 required">Réduction (en FCFA)</label>
                                                    <input  class="form-control form-control-solid" placeholder="" name="product_prices_price"  type="number" min="0" id="reduction_total2" value="<?= set_value("product_prices_price")	?>"  />
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                        </div>
                                        <!--begin::Col reduction_total-->
                                        <div class="col-md-6 fv-row my-5">
                                            <label class="form-label fw-bolder text-dark fs-6">Total des commandes sans réduction </label>
                                            <input  class="form-control form-control-solid" placeholder="" name="amount"  type="number" readonly min="0" id="amount" value="<?= set_value("amount")	?>"  />
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row my-5">
                                            <label class="form-label fw-bolder text-dark fs-6">Total des commandes avec réduction</label>
                                            <input  class="form-control form-control-solid" placeholder="" name="amount_reduce"  type="number" readonly min="0" id="amount_reduce" value="<?= set_value("amount_reduce")	?>"  />
                                        </div>
                                        <!--end::Col-->
                                         <!--begin::Col delivery service-->
                                        <div class="col-md-7 fv-row mt-5">
                                            <div class="d-flex flex-stack mb-8 items-center">
                                                <!--begin::Label-->
                                                <div class="me-5">
                                                    <label class="fs-6 fw-bold fw-bolder text-dark">Livraison</label>
                                                    <div class="fs-7 fw-bold text-muted">Cette commande nécessite-t-elle un service de livraison ? </div>
                                                </div>
                                                <!--end::Label-->
                                                <!--begin::Switch-->
                                                <label class="form-check form-switch form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" id="delivery_service" name="delivery_service">
                                                    <span class="form-check-label fw-bold text-muted delivery_text">Non</span>
                                                </label>
                                                <!--end::Switch-->
                                            </div>
                                        </div>
                                         <div class="col-md-12 fv-row mt-5 delivery_service" style="display:none">
                                            <div class="d-flex flex-row">
                                                <div class="col-md-6 fv-row mx-5" style="margin-left: 10px;">
                                                    <!--begin::Input group-->
                                                    <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                                        <label class="form-label fw-bolder text-dark fs-6 required">Nom complet du livreur</label>
                                                        <div class="d-flex flex-row mb-5 fv-row text-dark">
                                                            <select name="delivery_man" aria-label="Selectionnez un profile" data-control="select2" data-placeholder="Attribuer un role..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="delivery_man">
                                                            <option value=""  id="0" disabled>Choisissez le livreur...</option>									
                                                            <?php foreach ($delivery_mens as $delivery_man): ?>
                                                                <option value="<?= $delivery_man->delivery_mens_id ?>"  id="<?=  $delivery_man->delivery_mens_id?>" ><?= $delivery_man->delivery_mens_company ?></option>									
                                                            <?php endforeach ?>
                                                            </select>
                                                            <a href="<?= base_url() ?>/livreur/list_create"   class="btn btn-primary" id="add_client_btn">
                                                                <i class="fa fa-plus"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                                <!--begin::Col-->
                                                <div class="col-md-6 fv-row mx-5" style="margin-left: 10px;">
                                                    <label class="form-label fw-bolder text-dark fs-6 required">Date de livraison</label>
                                                    <input  class="form-control form-control-solid" placeholder="" name="sales_delivery_date"  type="date" min="0" id="sales_delivery_date" value="<?= set_value("sales_delivery_date")	?>"  />
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                        </div>
                                        <!--end::Col delivery service-->
                                         <!--begin::Col AIB service-->
                                        <div class="col-md-7 fv-row mt-5">
                                            <div class="d-flex flex-stack mb-8 items-center">
                                                <!--begin::Label-->
                                                <div class="me-5">
                                                    <label class="fs-6 fw-bold fw-bolder text-dark">Collecte de l'AIB</label>
                                                    <div class="fs-7 fw-bold text-muted">Avez-vous collecté l'AIB chez ce client ? </div>
                                                </div>
                                                <!--end::Label-->
                                                <!--begin::Switch-->
                                                <label class="form-check form-switch form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" id="aib_service" name="aib_service">
                                                    <span class="form-check-label fw-bold text-muted aib_text">Non</span>
                                                </label>
                                                <!--end::Switch-->
                                            </div>
                                        </div>
                                         <div class="col-md-12 fv-row mt-5 aib_service" style="display:none">
                                            <div class="d-flex flex-row">
                                                <div class="col-md-6 fv-row mx-5" style="margin-left: 10px;">
                                                    <!--begin::Input group-->
                                                    <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                                        <label class="form-label fw-bolder text-dark fs-6 required">Type d'AIB</label>
                                                        <div class="d-flex flex-row mb-5 fv-row text-dark">
                                                            <select name="aib_type" aria-label="Selectionnez un profile" data-control="select2" data-placeholder="Attribuer un role..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="aib_type">
                                                            <option value=""  id="0" disabled>Choisissez le type d'AIB...</option>									
                                                            <option value="A"  id="ticket" >A (AIB 1%)</option>									
                                                            <option value="B"  id="a4" >B (AIB 5%)</option>									
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Col AIB service-->
                                    </div>
                                    <!--end: Reduction :Col--> 

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
                                <!--end::Details--> 
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
        var reduction = 0;
        var montant = 0;
        var base_url = "<?= base_url() ?>";
        var oldClient = "<?= isset($order) ? ($order->orders_client_id) : ("") ?>";
        var order_detail = <?= isset($order) ? (json_encode($order_detail)) : (0) ?>;

        var product_price = <?= json_encode($product_price)?>;
        //var inventory_product_quantity = <?= json_encode($inventory_product_quantity)?>;
        var category = document.getElementById("product_categories_id");
        var product = document.getElementById("product_prices_product_id");
        var sale_option = document.getElementById("product_prices_sales_option_id");
        var price = document.getElementById("product_prices_price");
        var amount = document.getElementById("amount");
        var amount_reduce = document.getElementById("amount_reduce");
        var table =  document.getElementById('kt_table_users');
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
                    montant += Number(element['orders_details_amount']);
                    var html = '';
                    html += '<tr class="text-start text-black fw-bolder fs-7">';
                    html += '<td class="text-gray"><input type="text" required id="product_list[]" name="product_list[]" class="form-control" hidden  value='+element['orders_details_products_id']+'/><input type="text" required id="option_list[]" name="option_list[]" class="form-control" hidden  value='+element['orders_details_sales_options_id']+' /><input type="text" required id="quantity_list[]" name="quantity_list[]" class="form-control" hidden  value='+element['orders_details_quantity']+' /><input type="text" required id="reduction_list[]" name="reduction_list[]" class="form-control" hidden  value='+element['orders_details_reduction']+' /><input type="text" required id="montant_list[]" name="montant_list[]" class="form-control" hidden value='+element['orders_details_amount']+'/>'+element['products_name']+'</td>';
                    html += '<td class="text-gray">'+element['sales_options_name']+'</td>';
                    html += '<td class="text-gray">'+element['orders_default_price']+'</td>';
                    html += '<td class="text-gray">'+element['orders_details_quantity']+'</td>';
                    html += '<td class="text-gray">'+element['orders_details_reduction']+'</td>';
                    html += '<td class="text-gray">'+element['orders_details_amount']+'</td>';
                    html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove" id="'+indexId+'"><span class="fa fa-minus"></span></button></td></tr>';
                    $('#kt_table_users').append(html);
                },  this);

                amount.value = montant
                amount_reduce.value = montant
                              
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
        /*Check if quantity is enongh
        if(parseInt(inventory_product_quantity[indexId]) < parseInt(price.value)){
            quantity_not_enongh("Quantité insuffisante. La quantité en stock restante pour ce produit est : "+inventory_product_quantity[indexId])
            return 0;
        }*/
        //inventory_product_quantity[indexId] = parseInt(inventory_product_quantity[indexId]) - parseInt(price.value);

        if(table_unique.includes(indexId)){
            //row already exists
            var rowId = table_unique.indexOf(indexId)+1;
            montant -= Number(table.rows[rowId].cells[5].innerHTML)
            var oldValue = table.rows[rowId].cells[3].innerHTML.trim();
            var newQuantity = parseInt(price.value)+ parseInt(oldValue);
            var newValue = newQuantity*product_price[indexId];
            if($(".reduction").is(":visible"))
                reduction = (document.getElementById("reduction1").value > 0 ) ? ((document.getElementById("reduction1").value*newValue/100)) : (document.getElementById("reduction2").value);
                //reduction = parseInt(reduction);
            table.rows[rowId].cells[2].innerHTML = product_price[indexId];
            table.rows[rowId].cells[3].innerHTML = newQuantity;
            table.rows[rowId].cells[4].innerHTML = reduction;
            table.rows[rowId].cells[5].innerHTML = newValue - reduction;
            montant += newValue - reduction;
            var html = '<td class="text-gray"><input type="text" required id="product_list[]" name="product_list[]" class="form-control" hidden  value='+product.value+'/><input type="text" required id="option_list[]" name="option_list[]" class="form-control" hidden  value='+sale_option.value+' /><input type="text" required id="quantity_list[]" name="quantity_list[]" class="form-control" hidden  value='+newValue+' /><input type="text" required id="reduction_list[]" name="reduction_list[]" class="form-control" hidden  value='+reduction+' /><input type="text" required id="montant_list[]" name="montant_list[]" class="form-control" hidden value='+(newValue- reduction)+'/>'+product.options[product.selectedIndex].text+'</td>';
            table.rows[rowId].cells[0].innerHTML = html;

        }else{
            //new row
            table_unique[table_unique.length] = indexId;
            var newValue = (product_price[indexId]*price.value);
            if($(".reduction").is(":visible"))
                reduction = (document.getElementById("reduction1").value > 0 ) ? ((document.getElementById("reduction1").value*newValue/100)) : (document.getElementById("reduction2").value);
           // reduction = parseInt(reduction);
           montant += newValue - reduction;
            var html = '';
            html += '<tr class="text-start text-black fw-bolder fs-7">';
            html += '<td class="text-gray"><input type="text" required id="product_list[]" name="product_list[]" class="form-control" hidden  value='+product.value+'/><input type="text" required id="option_list[]" name="option_list[]" class="form-control" hidden  value='+sale_option.value+' /><input type="text" required id="quantity_list[]" name="quantity_list[]" class="form-control" hidden  value='+price.value+' /><input type="text" required id="reduction_list[]" name="reduction_list[]" class="form-control" hidden  value='+reduction+' /><input type="text" required id="montant_list[]" name="montant_list[]" class="form-control" hidden value='+(product_price[indexId]*price.value)+'/>'+product.options[product.selectedIndex].text+'</td>';
            html += '<td class="text-gray">'+sale_option.options[sale_option.selectedIndex].text+'</td>';
            html += '<td class="text-gray">'+product_price[indexId]+'</td>';
            html += '<td class="text-gray">'+price.value+'</td>';
            html += '<td class="text-gray">'+reduction+'</td>';
            html += '<td class="text-gray">'+(newValue - reduction)+'</td>';
            html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove" id="'+indexId+'"><span class="fa fa-minus"></span></button></td></tr>';
            $('#kt_table_users').append(html);

        }
        amount.value = montant
        amount_reduce.value = montant
        checkForm() 
       });
       
       $(document).on('click', '.remove', function(){
        var row_index =$(this).closest("tr").index();
        var rowId =  $(this).attr("id");
        //and quantity
       // inventory_product_quantity[rowId] = parseInt(inventory_product_quantity[rowId]) + Number(table.rows[row_index].cells[3].innerHTML);
        montant -= Number(table.rows[row_index].cells[5].innerHTML)
        amount.value = montant
        amount_reduce.value = montant
        table_unique.splice(row_index-1, 1);

        $(this).closest('tr').remove();
        checkForm();
       });

    //begin reduction toggle
    $(document).on('click', '#apply', function(){
        $('.reduction').toggle(); 
    });
    $(document).on('change', '#reduction1', function(){
        $('#reduction2').val(0); 
    });
    $(document).on('change', '#reduction2', function(){
        $('#reduction1').val(0); 
    });

    //total
    $(document).on('click', '#apply_total', function(){
        $('.reduction_total').toggle();
        reduceTotal(); 
    });
    $(document).on('change', '#reduction_total1', function(){
        $('#reduction_total2').val(0); 
        reduceTotal();
    });
    $(document).on('change', '#reduction_total2', function(){
        $('#reduction_total1').val(0); 
        reduceTotal();
    });
    //delivery
    $(document).on('click', '#delivery_service', function(){
        $('.delivery_text').html($('.delivery_text').html()=="Non" ? "Oui": "Non");
        $('.delivery_service').toggle();
    });
    $(document).on('click', '#bill_service', function(){
        $('.bill_text').html($('.bill_text').html()=="Non" ? "Oui": "Non");
        $('.bill_service').toggle();
    });
    $(document).on('click', '#aib_service', function(){
        $('.aib_text').html($('.bill_text').html()=="Non" ? "Oui": "Non");
        $('.aib_service').toggle();
    });
    //end reduction 

    function checkSelect() {
        if(category.value!== "" && product.value!== "" && sale_option.value!=="")
            return true;
            return false; 
    }
    function checkForm() {
        if(client.value!== "" && table_unique.length > 0)
            document.getElementById("submit").disabled = false;
        else
            document.getElementById("submit").disabled = true;
    }
    function reduceTotal() {
      var reduction = 0;
      if($("#apply_total").is(":visible"))
         reduction = (document.getElementById("reduction_total1").value > 0 ) ? ((document.getElementById("reduction_total1").value*montant/100)) : (document.getElementById("reduction_total2").value);
     amount_reduce.value = montant - reduction;
    }


    //Information dialog 
      
     /* function quantity_not_enongh(mes) {
           Swal.fire({
              html: mes,
              icon: "info",
              buttonsStyling: false,
              confirmButtonText: "C'est compris!",
              customClass: {
                  confirmButton: "btn btn-primary",
              }
          }).then((result)=>
              {
                  if(result.value) 
                     console.log(result.value);                         
              });  
      }*/
    </script>
<?= $this->endSection() ?>

 <?= $this->endSection() ?>