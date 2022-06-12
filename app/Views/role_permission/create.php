<?= $this->extend('dashTemplate') ?>
<?php $this->section('title'); echo  getenv('APP_NAME')."| Rôles et Permissions "; $this->endSection()?>
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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Rôles et Permissions</h1>
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
                    <li class="breadcrumb-item text-muted">Rôles et Permissions</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark"><?= isset($group) ? "Modifier un rôle" : "Créer un rôle"?></li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center py-1">
                <!--begin::Button-->
                <a href="<?= base_url() ?>/groups/list" class="btn btn-sm btn-primary">Liste des rôles</a>
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
                        <h1 class="text-dark"><?= isset($group) ? "Modification" : "Création"?> d'un rôle</h1>
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
                            <form action="<?= base_url(); ?><?= isset($group) ? "/groups/edit/".$group->id : '/groups/create'; ?>" class="form mb-15" method="post" >
                                <?php if (isset($group)): ?>
								   <input type="hidden" name="id" value="<?=  $group->id ?>">
								<?php endif ?>
                            <!--begin::Input group-->
                                <div class="row mb-5">
                                <div id="infoMessage" style="color:red;"><?=  session()->has('message') ? (session()->get('message')) : ("")?></div>

                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fw-bolder text-dark fs-6 mb-2">Désignation</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="name" value="<?= isset($group) ? $group->name : set_value('name') ?>" >
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <!--end::Label-->
                                        <label class="required fw-bolder text-dark fs-6 mb-2"> Nom à afficher</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="display_name" value="<?= isset($group) ? $group->display_name : set_value('display_name') ?>" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-12 fv-row">
                                        <!--end::Label-->
                                        <label class="fw-bolder text-dark fs-6 mb-2">Description</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <textarea class="form-control form-control-solid" placeholder="Décrivez l'usage du rôle..." name="description" ><?= isset($group) ? $group->description : set_value('description'); ?></textarea>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Job-->
                                
                                <div class="mb-12 mb-lg-0">
                                    <!--begin::Description-->
                                    <div class="m-0">
                                        <!--begin::Title-->
                                        <h4 class="fs-1 text-gray-800 w-bolder mb-6"><?= isset($group) ? "Mise à jour des" : 'Attribution des'; ?> permissions au rôle</h4>
                                        <!--end::Title-->
                                        <!--begin::Text-->
                                        <p class="fw-bold fs-4 text-gray-600 mb-2">Cochez les permissions que vous souhaiter attribuer à ce rôle sur chaque module</p>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Description-->
                                    <!--begin::Accordion-->
                                    <!--begin::Section-->
                                    <div class="row mb-5">
                                        <?php foreach ($permissions as $key => $permission): ?>
                                            <div class=" col-md-6">
                                                <!--begin::Heading-->
                                                <div class="d-flex align-items-center collapsible py-3 toggle mb-0" data-bs-toggle="collapse" data-bs-target="#id_<?= $key; ?>">
                                                    <!--begin::Icon-->
                                                    <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                                        <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
                                                                <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                                        <span class="svg-icon toggle-off svg-icon-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
                                                                <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black" />
                                                                <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <!--end::Icon-->
                                                    <!--begin::Title-->
                                                    <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">Module <?= $key ?></h4>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Heading-->
                                                <!--begin::Body-->
                                                <div id="id_<?= $key; ?>" class="collapse show fs-6 ms-1">
                                                    <?php foreach ($permission as $value): ?>
                                                        <!--begin::Item-->
                                                        <div class="mb-4">
                                                            <!--begin::Item-->
                                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                                <input type="checkbox"    id="role"  name="<?= $value->id; ?>" value="<?= $value->id; ?>"  <?= isset($group) ? (array_key_exists($value->id,$group_permission) ? ("checked") : "") : ''; ?>>
                                                                <label for="role" class="text-gray-600 fw-bold fs-6" style="margin-left:10px"><?= $value->name; ?></label><br>
                                                            </div>
                                                            <!--end::Item-->
                                                        </div>
                                                        <!--end::Item-->
                                                    <?php endforeach; ?>
                                                </div>
                                                <!--end::Content-->
                                                <!--begin::Separator-->
                                                <div class="separator separator-dashed"></div>
                                                <!--end::Separator-->
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <!--end::Section-->
                                    
                                    <!--end::Accordion-->
                                </div>
                                <!--end::Job-->
            
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

    </script>
<?= $this->endSection() ?>

 <?= $this->endSection() ?>