<?= $this->extend('dashTemplate') ?>
<?php $this->section('title'); echo  getenv('APP_NAME')."| Gestion des configurations "; $this->endSection()?>
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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Paramétrage</h1>
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
                    <li class="breadcrumb-item text-muted">Paramétrage</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Mise à jour des configurations</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
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
                        <h1 class="text-dark">Configurations de l'application</h1>
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
                            <form action="<?= base_url() ?>/config/save" class="form mb-15" method="post" enctype="multipart/form-data" >
                            <!--begin::Input group-->
                                <div class="row mb-5">
                                <div id="infoMessage" style="color:red;"><?=  session()->has('error') ? (session()->get('error')) : ("")?></div>

                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fw-bolder text-dark fs-6 mb-2">Nom complet de l'entreprise</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="company_name" value="<?= !session()->has('error')  ? $configList[1]->config_value : set_value('company_name') ?>" >
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <!--end::Label-->
                                        <label class="required fw-bolder text-dark fs-6 mb-2"> Numéro IFU</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="company_ifu" value="<?= !session()->has('error') ? $configList[2]->config_value : set_value('company_ifu') ?>" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <!--end::Label-->
                                        <label class="required fw-bolder text-dark fs-6 mb-2"> Email</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="company_email" value="<?= !session()->has('error')  ? $configList[3]->config_value : set_value('company_email') ?>" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <!--end::Label-->
                                        <label class="required fw-bolder text-dark fs-6 mb-2">Téléphone</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="company_phone_number" value="<?= !session()->has('error')  ? $configList[4]->config_value : set_value('company_phone_number') ?>" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <!--end::Label-->
                                        <label class="required fw-bolder text-dark fs-6 mb-2">Adresse de l'entreprise</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="company_address" value="<?= !session()->has('error')  ? $configList[5]->config_value : set_value('company_address') ?>" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fw-bolder text-dark fs-6 mb-2">Identificateur des produits</label>
                                        <select name="company_product_identity" aria-label="Selectionnez un profile" data-control="select2" data-placeholder="Attribuer un role..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="company_product_identity">
                                                <option value="none"  <?= set_select('company_product_identity', !session()->has('error')  ? $configList[6]->config_value : set_value('company_product_identity')) ?>> Aucun identificateur</option>									                                
                                                <option value="barre_code"  <?= set_select('company_product_identity', !session()->has('error')  ? $configList[6]->config_value : set_value('company_product_identity')) ?>> Code QR</option>									                                
                                                <option value="qr_code"  <?= set_select('company_product_identity', !session()->has('error')  ? $configList[6]->config_value : set_value('company_product_identity')) ?>> Code Barre</option>									                                
                                        </select>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fw-bolder text-dark fs-6 mb-2">Identificateur de connexion</label>
                                        <select name="company_identity" aria-label="Selectionnez un profile" data-control="select2" data-placeholder="Attribuer un role..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="company_identity">
                                                <option value="none"  <?= set_select('company_identity', !session()->has('error')  ? $configList[7]->config_value : set_value('company_identity')) ?>> Aucun identificateur</option>									                                
                                                <option value="email"  <?= set_select('company_identity', !session()->has('error')  ? $configList[7]->config_value : set_value('company_identity')) ?>> Adresse email</option>									                                
                                                <option value="username"  <?= set_select('company_identity', !session()->has('error')  ? $configList[7]->config_value : set_value('company_identity')) ?>> Nom d'utilisateur</option>									                                
                                        </select>
                                    </div>
                                    <!--end::Col-->
                                     <!--begin::Col-->
                                     <div class="col-md-6 fv-row">
                                        <!--end::Label-->
                                        <label class="fw-bolder text-dark fs-6 mb-2">Date de création</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="date" class="form-control form-control-solid" placeholder="" name="company_created_at" value="<?= !session()->has('error')  ? $configList[8]->config_value : set_value('company_created_at') ?>" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                     <div class="col-md-6 fv-row">
                                        <!--end::Label-->
                                        <label class="fw-bolder text-dark fs-6 mb-2">Adresse de site web</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="company_site_url" value="<?= !session()->has('error')  ? $configList[9]->config_value : set_value('company_site_url') ?>" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                     <div class="col-md-6 fv-row">
                                        <!--end::Label-->
                                        <label class="fw-bolder text-dark fs-6 mb-2">Registre de commerce</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="company_rccm" value="<?= !session()->has('error')  ? $configList[10]->config_value : set_value('company_rccm') ?>" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                     <div class="col-md-6 fv-row">
                                        <!--end::Label-->
                                        <label class="fw-bolder text-dark fs-6 mb-2">Logo (Image : png, jpj ou jpeg)</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="file" class="form-control form-control-solid" placeholder="" name="company_logo" value="<?= !session()->has('error')  ? $configList[11]->config_value : set_value('company_logo') ?>" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                               
            
                                <!--begin::Separator-->
                                <div class="separator mb-8"></div>
                                <!--end::Separator-->
                                <!--begin::Submit-->
                                <button type="submit" class="btn btn-primary" id="kt_careers_submit_button">
                                    <!--begin::Indicator-->
                                    <span class="indicator-label"><?= isset($group) ? "Mettre à jour" : 'Sauvegarder'; ?></span>
                                    <span class="indicator-progress">Veuillez patienter...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator-->
                                </button>
                                <!--end::Submit-->
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
        document.getElementById("company_product_identity").value ="<?= !session()->has('error')  ? $configList[6]->config_value : set_value('company_product_identity')?>";
        document.getElementById("company_identity").value ="<?= !session()->has('error')  ? $configList[7]->config_value : set_value('company_identity')?>";
    </script>
<?= $this->endSection() ?>

 <?= $this->endSection() ?>