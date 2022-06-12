<?= $this->extend('dashTemplate') ?>
<?php $this->section('title'); echo  getenv('APP_NAME')."| Vue Détailée d'une rôle"; $this->endSection()?>
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
                    <li class="breadcrumb-item text-muted">Administration</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Détails d'un rôle</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center py-1">
                <!--begin::Button-->
                <a href="<?= base_url() ?>/groups/new" class="btn btn-sm btn-primary">Nouveau Rôle</a>
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
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-lg-row">
                <!--begin::Sidebar-->
                <div class="flex-column flex-lg-row-auto w-100 w-lg-200px w-xl-300px mb-10">
                    <!--begin::Card-->
                    <div class="card card-flush">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2 class="mb-0 text-dark text-capitalize"><?= $group->display_name ?></h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Accordion-->
                                    <!--begin::Section-->
                                    <div class="row mb-5">
                                        <?php foreach ($permissions as $key => $permission): ?>
                                            <div class=" col-md-12">
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
                                                    <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0"><?= $key ?></h4>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Heading-->
                                                <!--begin::Body-->
                                                <div id="id_<?= $key; ?>" class="collapse show fs-6 ms-1 d-flex flex-column text-gray-600">
                                                    <?php foreach ($permission as $value): ?>
                                                        <!--begin::Item-->
                                                        <div class="mb-4">
                                                            <div class="d-flex align-items-center py-2">
                                                                <span class="bullet bg-primary me-3"></span><?= $value->name ?>
                                                            </div> 
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
                        <!--end::Card body-->
                        <!--begin::Card footer-->
                        <div class="card-footer pt-0">
                         <a href="<?= base_url()."/groups/update/".$group->id; ?>" class="btn btn-light btn-active-light-primary my-1 text-primary">Editer</a>
                        </div>
                        <!--end::Card footer-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Sidebar-->
                <!--begin::Content-->
                <div class="flex-lg-row-fluid ms-lg-10">
                    <!--begin::Card-->
                    <div class="card card-flush mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header pt-5">
                            <!--begin::Card title-->
                            <div class="card-title">
                                
                                <span class="text-gray-600 fs-6 ms-1">(<?= count($users)?>)</span></h2>
                                <h2 class="d-flex align-items-center text-dark mx-2"><?= count($users) > 1 ? ("utilisateurs attribués") : ("utilisateur attribué")?>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Search-->
                                <div class="d-flex align-items-center position-relative my-1" data-kt-view-roles-table-toolbar="base">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <input type="text" data-kt-roles-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Recherchers" />
                                </div>
                                <!--end::Search-->
                                <!--begin::Group actions-->
                                <div class="d-flex justify-content-end align-items-center d-none" data-kt-view-roles-table-toolbar="selected">
                                    <div class="fw-bolder me-5">
                                    <span class="me-2" data-kt-view-roles-table-select="selected_count"></span>Selection</div>
                                    <button type="button" class="btn btn-danger" data-kt-view-roles-table-select="delete_selected">Supprimer la sélection</button>
                                </div>
                                <!--end::Group actions-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_roles_view_table">
                                <!--begin::Table head-->
                                <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_roles_view_table .form-check-input" value="1" />
                                            </div>
                                        </th>
                                        <th class="min-w-150px">Utilisateur</th>
                                        <th class="min-w-125px">Statut</th>
                                        <th class="min-w-125px">Créé le</th>
                                        <th class="text-end min-w-100px">Actions</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="fw-bold text-gray-600">
                                    <?php foreach ($users as $user): ?>
                                    <tr>
                                        <!--begin::Checkbox-->
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="1" />
                                            </div>
                                        </td>
                                        <!--end::Checkbox-->
                                        <!--begin::User=-->
                                        <td class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="">
                                                    <div class="symbol-label">
                                                        <img src="<?= base_url() ; ?>/public/assets/media/avatars/300-6.jpg" alt="Emma Smith" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::User details-->
                                            <div class="d-flex flex-column">
                                                <a href="" class="text-gray-800 text-hover-primary mb-1"><?= $user->first_name." ".$user->last_name ?></a>
                                                <span><?= $user->email ?></span>
                                            </div>
                                            <!--begin::User details-->
                                        </td>
                                        <!--end::user=-->
                                        <!--begin::Joined date=-->
                                        <td><?= format_date($user->created_at, "d/m/Y à H:i:s")?></td>
                                        <td> <?= status($user->active) ?></td>
                                        <!--end::Joined date=-->
                                        <!--begin::Action=-->
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                            <span class="svg-icon svg-icon-5 m-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon--></a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="<?= base_url()."/user/edit/".$user->id; ?>" class="menu-link px-3">Editer</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <?php if($user->id != $auth->user()->row()->id) : ?>
                                                <div class="menu-item px-3">
                                                    <p class="menu-link px-3"onclick="banish(<?=$user->id ?>, <?=$user->active ?>)" ><?= deleteUser($user->active) ?></p>
                                                </div>
                                                <?php endif ?>
                                                <!--end::Menu item-->
                                            </div>
                                        </td>
                                        <!--end::Action=-->
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Layout-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->
<?= $this->section('javascript') ?>
    <script type="text/javascript">
        var banish_mes = `Vous souhaitez bannir cet utilisateur. <strong>Une fois bannis, il ne pourra plus se connecter à la plateforme tant qu'il ne soit activé à nouveau</strong>,
                <span class="badge badge-primary">Etes-vous sûr de vouloir le bannir ?</span>`;
        var active_mes = `Vous souhaitez activer cet utilisateur. <strong>Une fois activer, il pourra se connecter à nouveau à la plateforme et effectuer des opérations selon son profile</strong>,
                <span class="badge badge-primary">Etes-vous sûr de vouloir l'activer ?</span>`
        function banish(id, banish_type) {
            Swal.fire({
                html: banish_type== 1 ? banish_mes : active_mes,
                icon: banish_type== 1 ? "warning" : "info",
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonText: "J'en suis certain!",
                cancelButtonText: "Non, J'abandonne.",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: 'btn btn-danger'
                }
            }).then((result)=>
                {
                    if(result.value) 
                        {
                            if(banish_type == 1)
                                document.location.href="<?=  base_url(); ?>/user/banish/"+id;
                            else
                                document.location.href="<?=  base_url(); ?>/user/activate/"+id;
                        }
                });     
        }
    </script>
<?= $this->endSection() ?>

 <?= $this->endSection() ?>