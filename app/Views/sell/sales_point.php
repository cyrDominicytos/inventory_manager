<?= $this->extend('dashTemplate') ?>
<?php $this->section('title');
echo  getenv('APP_NAME') . "| Gestion des ventes";
$this->endSection() ?>
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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"> Gestion des ventes</h1>
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
                    <li class="breadcrumb-item text-muted text-capitalize">Ventes</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Point des ventes</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center py-1">
                <!--begin::Wrapper-->
                
                <!--end::Wrapper-->
                <!--begin::Button-->
                <a href="<?= base_url() ?>/sell/new" class="btn btn-sm btn-primary" id="kt_toolbar_primary_button">Nouvelle vente</a>
                <!--end::Button-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->
            <div class="card">
                <div id="infoMessage" style="color:red;">
                    <?= session()->has('message2') ? (session()->get('message2')) : ("") ?>
                </div>
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Rechercher" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">

                            <!--begin::Export-->

                            <!--end::Export-->
                            <!--begin::Add user-->
                            <a href="<?= base_url() ?>/sell/new" class="btn btn-primary">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->Nouvelle vente
                            </a>
                            <!--end::Add user-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Group actions-->
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                            <div class="fw-bolder me-5">
                                <span class="me-2" data-kt-user-table-select="selected_count"></span>Sélection
                            </div>
                            <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Supprimer la sélection</button>
                        </div>
                        <!--end::Group actions-->
                        <!--begin::Modal - Adjust Balance-->
                        <div class="modal fade" id="kt_modal_export_users" tabindex="-1" aria-hidden="true">
                            <!--begin::Modal dialog-->
                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                    <!--begin::Modal header-->
                                    <div class="modal-header">
                                        <!--begin::Modal title-->
                                        <h2 class="fw-bolder">Exporter</h2>
                                        <!--end::Modal title-->
                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
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
                                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                        <!--begin::Form-->
                                        <form id="kt_modal_export_users_form" class="form" action="#">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-10">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-bold form-label mb-2">Select Roles:</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select name="role" data-control="select2" data-placeholder="Select a role" data-hide-search="true" class="form-select form-select-solid fw-bolder">
                                                    <option></option>
                                                    <option value="Administrator">Administrator</option>
                                                    <option value="Analyst">Analyst</option>
                                                    <option value="Developer">Developer</option>
                                                    <option value="Support">Support</option>
                                                    <option value="Trial">Trial</option>
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-10">
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold form-label mb-2">Select Export Format:</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select name="format" data-control="select2" data-placeholder="Select a format" data-hide-search="true" class="form-select form-select-solid fw-bolder">
                                                    <option></option>
                                                    <option value="excel">Excel</option>
                                                    <option value="pdf">PDF</option>
                                                    <option value="cvs">CVS</option>
                                                    <option value="zip">ZIP</option>
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Actions-->
                                            <div class="text-center">
                                                <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
                                                <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                                                    <span class="indicator-label">Submit</span>
                                                    <span class="indicator-progress">Please wait...
                                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                            </div>
                                            <!--end::Actions-->
                                        </form>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Modal body-->
                                </div>
                                <!--end::Modal content-->
                            </div>
                            <!--end::Modal dialog-->
                        </div>
                        <!--end::Modal - New Card-->
                        <!--begin::Modal - Add task-->
                        <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
                            <!--begin::Modal dialog-->
                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                    <!--begin::Modal header-->
                                    <div class="modal-header" id="kt_modal_add_user_header">
                                        <!--begin::Modal title-->
                                        <h2 class="fw-bolder">Add User</h2>
                                        <!--end::Modal title-->
                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
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
                                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                        <!--begin::Form-->
                                        <form id="kt_modal_add_user_form" class="form" action="#">
                                            <!--begin::Scroll-->
                                            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-7">
                                                    <!--begin::Label-->
                                                    <label class="d-block fw-bold fs-6 mb-5">Avatar</label>
                                                    <!--end::Label-->
                                                    <!--begin::Image input-->
                                                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                                        <!--begin::Preview existing avatar-->
                                                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url(assets/media/avatars/300-6.jpg);"></div>
                                                        <!--end::Preview existing avatar-->
                                                        <!--begin::Label-->
                                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                                            <i class="bi bi-pencil-fill fs-7"></i>
                                                            <!--begin::Inputs-->
                                                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                                            <input type="hidden" name="avatar_remove" />
                                                            <!--end::Inputs-->
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Cancel-->
                                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                                            <i class="bi bi-x fs-2"></i>
                                                        </span>
                                                        <!--end::Cancel-->
                                                        <!--begin::Remove-->
                                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                                            <i class="bi bi-x fs-2"></i>
                                                        </span>
                                                        <!--end::Remove-->
                                                    </div>
                                                    <!--end::Image input-->
                                                    <!--begin::Hint-->
                                                    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                                    <!--end::Hint-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-7">
                                                    <!--begin::Label-->
                                                    <label class="required fw-bold fs-6 mb-2">Full Name</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="user_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Full name" value="Emma Smith" />
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-7">
                                                    <!--begin::Label-->
                                                    <label class="required fw-bold fs-6 mb-2">Email</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="email" name="user_email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="example@domain.com" value="e.smith@kpmg.com.au" />
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="mb-7">
                                                    <!--begin::Label-->
                                                    <label class="required fw-bold fs-6 mb-5">Role</label>
                                                    <!--end::Label-->
                                                    <!--begin::Roles-->
                                                    <!--begin::Input row-->
                                                    <div class="d-flex fv-row">
                                                        <!--begin::Radio-->
                                                        <div class="form-check form-check-custom form-check-solid">
                                                            <!--begin::Input-->
                                                            <input class="form-check-input me-3" name="user_role" type="radio" value="0" id="kt_modal_update_role_option_0" checked='checked' />
                                                            <!--end::Input-->
                                                            <!--begin::Label-->
                                                            <label class="form-check-label" for="kt_modal_update_role_option_0">
                                                                <div class="fw-bolder text-gray-800">Administrator</div>
                                                                <div class="text-gray-600">Best for business owners and company administrators</div>
                                                            </label>
                                                            <!--end::Label-->
                                                        </div>
                                                        <!--end::Radio-->
                                                    </div>
                                                    <!--end::Input row-->
                                                    <div class='separator separator-dashed my-5'></div>
                                                    <!--begin::Input row-->
                                                    <div class="d-flex fv-row">
                                                        <!--begin::Radio-->
                                                        <div class="form-check form-check-custom form-check-solid">
                                                            <!--begin::Input-->
                                                            <input class="form-check-input me-3" name="user_role" type="radio" value="1" id="kt_modal_update_role_option_1" />
                                                            <!--end::Input-->
                                                            <!--begin::Label-->
                                                            <label class="form-check-label" for="kt_modal_update_role_option_1">
                                                                <div class="fw-bolder text-gray-800">Developer</div>
                                                                <div class="text-gray-600">Best for developers or people primarily using the API</div>
                                                            </label>
                                                            <!--end::Label-->
                                                        </div>
                                                        <!--end::Radio-->
                                                    </div>
                                                    <!--end::Input row-->
                                                    <div class='separator separator-dashed my-5'></div>
                                                    <!--begin::Input row-->
                                                    <div class="d-flex fv-row">
                                                        <!--begin::Radio-->
                                                        <div class="form-check form-check-custom form-check-solid">
                                                            <!--begin::Input-->
                                                            <input class="form-check-input me-3" name="user_role" type="radio" value="2" id="kt_modal_update_role_option_2" />
                                                            <!--end::Input-->
                                                            <!--begin::Label-->
                                                            <label class="form-check-label" for="kt_modal_update_role_option_2">
                                                                <div class="fw-bolder text-gray-800">Analyst</div>
                                                                <div class="text-gray-600">Best for people who need full access to analytics data, but don't need to update business settings</div>
                                                            </label>
                                                            <!--end::Label-->
                                                        </div>
                                                        <!--end::Radio-->
                                                    </div>
                                                    <!--end::Input row-->
                                                    <div class='separator separator-dashed my-5'></div>
                                                    <!--begin::Input row-->
                                                    <div class="d-flex fv-row">
                                                        <!--begin::Radio-->
                                                        <div class="form-check form-check-custom form-check-solid">
                                                            <!--begin::Input-->
                                                            <input class="form-check-input me-3" name="user_role" type="radio" value="3" id="kt_modal_update_role_option_3" />
                                                            <!--end::Input-->
                                                            <!--begin::Label-->
                                                            <label class="form-check-label" for="kt_modal_update_role_option_3">
                                                                <div class="fw-bolder text-gray-800">Support</div>
                                                                <div class="text-gray-600">Best for employees who regularly refund payments and respond to disputes</div>
                                                            </label>
                                                            <!--end::Label-->
                                                        </div>
                                                        <!--end::Radio-->
                                                    </div>
                                                    <!--end::Input row-->
                                                    <div class='separator separator-dashed my-5'></div>
                                                    <!--begin::Input row-->
                                                    <div class="d-flex fv-row">
                                                        <!--begin::Radio-->
                                                        <div class="form-check form-check-custom form-check-solid">
                                                            <!--begin::Input-->
                                                            <input class="form-check-input me-3" name="user_role" type="radio" value="4" id="kt_modal_update_role_option_4" />
                                                            <!--end::Input-->
                                                            <!--begin::Label-->
                                                            <label class="form-check-label" for="kt_modal_update_role_option_4">
                                                                <div class="fw-bolder text-gray-800">Trial</div>
                                                                <div class="text-gray-600">Best for people who need to preview content data, but don't need to make any updates</div>
                                                            </label>
                                                            <!--end::Label-->
                                                        </div>
                                                        <!--end::Radio-->
                                                    </div>
                                                    <!--end::Input row-->
                                                    <!--end::Roles-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Scroll-->
                                            <!--begin::Actions-->
                                            <div class="text-center pt-15">
                                                <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
                                                <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                                                    <span class="indicator-label">Submit</span>
                                                    <span class="indicator-progress">Please wait...
                                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                            </div>
                                            <!--end::Actions-->
                                        </form>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Modal body-->
                                </div>
                                <!--end::Modal content-->
                            </div>
                            <!--end::Modal dialog-->
                        </div>
                        <!--end::Modal - Add task-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4">
                    <div class="row">
                        <div class="col-sm-8">
                            <form action="" method="post" enctype="">
                                <div class="form-group" id="search_form2">
                                    <div class="input-group">
                                        <div class="form-group">
                                            <label class="form-label fw-bolder text-dark fs-6 ">Période Début</label>
                                            <input name="begin" id="begin" type="datetime-local" class="form-control text-dark">
                                        </div>
                                        <div class="form-group" id="search-form">
                                            <label class="form-label fw-bolder text-dark fs-6" id="search-label">Période Fin</label>
                                            <input name="end" id="end" type="datetime-local" class="form-control text-dark">
                                        </div>
                                        <div class="input-group-append" >
                                            <button title="Rechercher"  style="margin-top:30px; color:white" class="btn btn-sm bg-primary text-white" id="search_id"><i class="fas fa-search" style=" color:white"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label fw-bolder text-dark fs-6 ">Exporter le résultat</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <select data-control="select2" data-placeholder="Attribuer un role..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true"  name="export_file_type" id="export_file_type">
                                            <?php foreach (export_file_type() as $key => $val) : ?>
                                                <option value="<?= $key ?>" <?= set_select('', $key) ?>><?= $val ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="input-group-append" >
                                        <button title="Exporter le résultat affiché" class="btn btn-sm btn-success bg-gray" id="export_id" style="height: 100%"><i class="fas fa-download"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5 mt-5" id="kt_table_users">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0"  style="background-image: linear-gradient(to bottom right,#5d6d7e, #FFF, #CCC, #5d6d7e);">
                                <th class="min-w-125px">Dates</th>
                                <th class="min-w-125px">Désignations</th>
                                <th class="min-w-125px">Quantités</th>
                                <th class="min-w-125px">Prix/Vente</th>
                                <th class="min-w-125px">Réductions</th>
                                <th class="min-w-125px">Montant</th>
                                <th class="min-w-125px">Livraison</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="text-gray-600 fw-bold" >
                            <!--begin::Table row-->
                            <?php 
                            foreach ($sales as $temp) :   
                                foreach ($temp as $order) :   ?>
                                    <tr>
                                        <td class="">
                                            <?= format_date($order->sales_created_at, "d/m/Y à H:i:s") ?>
                                        </td>
                                        <td class="">
                                            <?= $order->products_name ?>
                                        </td>
                                        
                                        <td class="">
                                            <?= $order->sell_details_quantity.' ' .$order->sales_options_name ?>
                                        </td>
                                        <td class="">
                                            <?= $order->sell_details_selling_price?>
                                        </td>
                                        <td class="">
                                            <?= $order->sell_details_reduction?>
                                        </td>
                                        <td class="">
                                            <?= $order->sell_details_amount?>
                                        </td>
                                        <td class="">
                                            <?= livraison($order->sales_deliver_man)  ?>
                                        </td>
                                    
                                        <td class="text-end">
                                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                <span class="svg-icon svg-icon-5 m-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                <!--begin::Menu item
                                                    <div class="menu-item px-3">
                                                        <a href="<?= base_url() ?>/sell/update/<?= $order->sales_id ?>"  class="menu-link px-3"><i class="fa fa-edit text-primary py-2"> Editer</i></a>
                                                    </div>
                                                    end::Menu item-->
                                                <?php if ($order->sales_status == 2) : ?>
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="<?= base_url() ?>/sell/invoice/<?= $order->sales_id ?>" class="menu-link px-3"><i class="fa fa-edit text-primary py-2"> Facturée</i></a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                <?php endif; ?>
                                                <?php if ($order->sales_status == 3) : ?>
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="<?= base_url() ?>/sell/normalize/<?= $order->sales_id ?>" class="menu-link px-3"><i class="fa fa-check text-success py-2"> Normalisé</i></a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                <?php endif; ?>
                                                <?php if ($order->sales_status <= 3) : ?>
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <p class="menu-link px-3" onclick='removePrice(<?= $order->sales_id ?>, <?= json_encode($order) ?>)'><i class="fa fa-trash text-danger py-2"> Supprimer</i></p>
                                                    </div>
                                                    <!--end::Menu item-->
                                                <?php endif; ?>
                                                <?php if ($order->sales_status > 2) : ?>
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="<?= base_url() ?>/sell/vue/<?= $order->sales_id ?>" class="menu-link px-3"><i class="fa fa-edit text-primary py-2"> Consulter</i></a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                <?php endif; ?>
                                            </div>
                                            <!--end::Menu-->
                                        </td>

                                    </tr>                                                       
                                <?php  endforeach ?>
                                <tr style="background-image: linear-gradient(to bottom right,#5d6d7e, #FFF, #CCC, #5d6d7e);">
                                    <td colspan="2" style="text-align:left">
                                      <strong style="font-weight: bold; "> Client :</strong> <span >  <?= $order->clients_company ?></span>
                                    </td>
                                    
                                    
                                    <td colspan="2">
                                    <strong style="font-weight: bold; "> Vendeur :</strong> <span ><?= $order->last_name.' '.$order->first_name.' '.$order->first_name?></span>
                                    </td>
                                    
                                    <td colspan="4">
                                    <strong style="font-weight: bold; "> Net Payé :</strong> <span ><?= $order->sales_amount?></span>
                                    </td>   
                                </tr>
                            <?php  endforeach ?>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->
<?= $this->section('javascript') ?>
<script type="text/javascript">
    var base_url = "<?= base_url() ?>";
    var active_mes = "Vous souhaitez activer ce produit. Une fois activé, il apparaitra à nouveau dans les modules d'approvisionnement et de vente<span class='badge badge-primary'>Etes-vous sûr de vouloir l'activer ?</span>";
    var export_file_name = "<?= base_url().'/writable/uploads/sale_point/sale_point.pdf' ?>";     

    $(document).ready(function() {
       // alert((document.getElementById("search_form2").style.height+' '+ document.getElementById("end").style.height)+" px")
        document.getElementById("search_id").style.height = document.getElementById("end").style.height;
        //document.getElementById("search_id").style.marginTop  = (document.getElementById("search_form2").style.height- document.getElementById("end").style.height)+"px";
    });search-form
    function removePrice(id, product) {
        let mes = "Etes-vous certain de vouloir suprimer cette vente ?";
        Swal.fire({
            html: mes,
            icon: "warning",
            buttonsStyling: false,
            showCancelButton: true,
            confirmButtonText: "J'en suis certain!",
            cancelButtonText: "Non, J'abandonne.",
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: 'btn btn-danger'
            }
        }).then((result) => {
            if (result.value)
                document.location.href = "<?= base_url(); ?>/sell/delete/" + id;
        });
    }

    function edit(id, product) {
        let table = document.getElementById("kt_table_users");
        document.getElementById("kt_modal_new_address_form").action = "<?= base_url() ?>" + "/price/edit";
        document.getElementById("externalID").value = id;
        document.getElementById("modalTitle").innerHTML = "Mise à jour de produit";
        document.getElementById("submitText").innerHTML = "Sauvegarder";
        document.getElementById("product_categories_id").value = product.product_categories_id;
        document.getElementById("product_prices_product_id").value = product.product_prices_product_id;
        document.getElementById("product_prices_sales_option_id").value = product.product_prices_sales_option_id;
        document.getElementById("product_prices_price").value = product.product_prices_price;

        document.getElementById("product_categories_id").disabled = true;
        document.getElementById("product_prices_product_id").disabled = true;
        document.getElementById("product_prices_sales_option_id").disabled = true;
        //updateCategory(category);

    }

    $(window).on('load', function() {
        if (showModal == 1)
            $('#external_create_new').modal('show');
    });


    $('#product_categories_id').change(function() {
        if ($(this).val() != '') {
            var value = $(this).val();
            $.ajax({
                url: base_url + "/dynamic/product",
                method: "POST",
                data: {
                    id: value
                },
                success: function(result) {
                    $('#product_prices_product_id').html(result);
                }
            })
        }
    });

    $('#product_prices_product_id').change(function() {
        if ($(this).val() != '') {
            var value = $(this).val();
            $.ajax({
                url: base_url + "/dynamic/sale_options",
                method: "POST",
                data: {
                    id: value
                },
                success: function(result) {
                    $('#product_prices_sales_option_id').html(result);
                }
            })
        }
    });

    function initPage() {
        document.getElementById("product_categories_id").value = category;
        document.getElementById("product_categories_id").dispatchEvent(new Event('change'));
    }





    var begin = document.getElementById("begin");
    var end = document.getElementById("end");
    var export_file_type = document.getElementById("export_file_type");
    var export_btn = document.getElementById("export_id");
    var old_begin = "<?= isset($old_begin) ? $old_begin  : 0 ?>";
    var old_end = "<?= isset($old_end) ? $old_end  : 0 ?>";        

    $('#export_id').click(function(){
       if($("#export_file_type").val())
        {
            let begin_date = $("#begin").val();   
            let end_date = $("#end").val();   
            let selected_type = $("#export_file_type").val();   
            $.ajax({
                url: base_url+"/sell/generate_sales_point_pdf",
                method:"POST",
                data:{begin:begin_date, end:end_date, selected_type:selected_type},
                success:function(result)
                {
                    window.open(export_file_name)
                }
            })
        }else{
            let selected_type = $("#export_file_type").val();   
            $.ajax({
                url: base_url+"/sell/generate_sales_point_pdf",
                method:"POST",
                data:{begin:0, end:0, selected_type:selected_type},
                success:function(result)
                {
                  window.open(export_file_name)
                }
            })
        }
    });

   
        
    $('#begin').change(function(){
        end.setAttribute("min", $(this).val());
    });
    $('#end').change(function(){
        begin.setAttribute("max", $(this).val());
    });


    function validate_date(){
        var today = new Date();

        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0 so need to add 1 to make it 1!
        var yyyy = today.getFullYear();
        var hour = today.getHours();
        var minute = today.getMinutes();
        if(dd<10){
        dd='0'+dd
        } 
        if(mm<10){
        mm='0'+mm
        } 

        today = yyyy+'-'+mm+'-'+dd+'T'+hour+':'+minute;
        begin.setAttribute("min", today);
        end.setAttribute("min", today);
    }

    $(window).on('load', function() {
        if(old_begin!=0){
            $('#begin').val(old_begin);
            $('#end').val(old_end);
        }
    });


</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>