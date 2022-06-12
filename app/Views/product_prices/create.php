<!--begin::Modal - Create New-->
<div class="modal fade" id="external_create_new" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" action="<?= base_url(); ?>/price/create" method="post" id="kt_modal_new_address_form">
                <input type="hidden" name="id" id="externalID"  >   
            <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_new_address_header">
                    <!--begin::Modal title-->
                    <h2 class="text-dark" id="modalTitle">Prix de vente d'un produit</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div class="scroll-y me-n7 pe-7" id="kt_modal_new_address_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_new_address_header" data-kt-scroll-wrappers="#kt_modal_new_address_scroll" data-kt-scroll-offset="300px">
                        <div id="infoMessage" style="color:red;">
                            <?=  session()->has('message2') ? (session()->get('message2')) : ("")?>
                        </div>
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                            <label class="form-label fw-bolder text-dark fs-6 required">Catégories</label>
                            <select name="product_categories_id" aria-label="Selectionnez un profile" data-control="select2" data-placeholder="Attribuer un role..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="product_categories_id">
                            <option value=""  id="0">Choisissez une catégorie...</option>									
   
                            <?php foreach ($categories as $categorie): ?>
                                    <option value="<?= $categorie->product_categories_id ?>"  id="<?=  $categorie->product_categories_id?>" <?= set_select('product_categories_id', $categorie->product_categories_id) ?>><?= $categorie->product_categories_name ?></option>									
                                <?php endforeach ?>
                            </select>
                        </div>
                        <!--end::Input group-->
                         <!--begin::Input group-->
                         <div class="d-flex flex-column mb-5 fv-row  text-dark">
                            <label class="form-label fw-bolder text-dark fs-6 required">Produits</label>
                            <select name="product_prices_product_id" aria-label="Selectionnez un produit" data-control="select2" data-placeholder="Selectionnez un produit..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="product_prices_product_id">
                                <?php foreach ($products as $product): ?>
                                    <option value="<?= $product->products_id ?>"  id="<?=  $product->products_id ?>" <?= set_select('product_prices_product_id', $product->products_id) ?>><?=$product->products_name ?></option>									
                                <?php endforeach ?>
                            </select>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                            <label class="form-label fw-bolder text-dark fs-6 required">Options de vente</label>
                            <select name="product_prices_sales_option_id" aria-label="Selectionnez une option de vente" data-control="select2" data-placeholder="Selectionnez une option de vente..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="product_prices_sales_option_id">
                                <?php foreach ($sales_options as $sales_option): ?>
                                    <option value="<?= $sales_option->sales_options_id ?>"  id="<?=  $sales_option->sales_options_id ?>" <?= set_select('product_prices_sales_option_id', $sales_option->sales_options_id) ?>><?=$sales_option->sales_options_name ?></option>									
                                <?php endforeach ?>
                            </select>
                        </div>
                        <!--end::Input group-->
                       
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                             <!--end::Label-->
                             <label class="fw-bolder text-dark fs-6 mb-2 required">Prix de vente</label>
                            <!--end::Label-->
                            <!--end::Input-->
                            <input required class="form-control form-control-solid" placeholder="" name="product_prices_price"  type="number" min="0" id="product_prices_price" value="<?= set_value("product_prices_price")	?>"  />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="reset" id="kt_modal_new_address_cancel" class="btn btn-danger me-3" data-bs-dismiss="modal">Quitter</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="kt_modal_new_address_submit" class="btn btn-primary">
                        <span class="indicator-label" id="submitText">Enregistrer</span>
                        <span class="indicator-progress">Patientez...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Modal - Create New-->