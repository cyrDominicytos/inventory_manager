<?php
// $request for current request
$request = service('request');
$ionAuth = new \IonAuth\Libraries\IonAuth();
if (session()->has("aside")) {
    $auth_user_permissions = session()->get("user_permission_array");

    echo session()->get("aside");
} else {
    $auth_user_permissions = user_permission_array();
    session()->set('user_permission_array', $auth_user_permissions);
?>
    <?php ob_start(); ?>


    <!--begin::Aside-->
    <div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
        <!--begin::Brand-->
        <div class="aside-logo flex-column-auto" id="kt_aside_logo">
            <!--begin::Logo-->
            <h1>STOCK BAR</h1>
            <!--end::Logo-->
            <!--begin::Aside toggler-->
            <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr074.svg-->
                <span class="svg-icon svg-icon-1 rotate-180">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z" fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </div>
            <!--end::Aside toggler-->
        </div>
        <!--end::Brand-->
        <!--begin::Aside menu-->
        <div class="aside-menu flex-column-fluid">
            <!--begin::Aside Menu-->
            <div class="hover-scroll-overlay-y my-2 py-5 py-lg-8" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
                <!--begin::Menu-->
                <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
                    <div class="menu-item menu-accordion dashboard">
                        <a class="menu-link" href="<?= base_url() ?>/">
                            <span class="menu-icon">
                                <i class="bi bi-bar-chart-steps fs-3"></i>
                            </span>
                            <span class="menu-title">Tableau de bord</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <div class="menu-content pt-8 pb-2">
                            <span class="menu-sectio text-muted text-uppercase fs-8 ls-1" style="color: #fff;">Fonctionnalités</span>
                        </div>
                    </div>
                    <?php if (array_key_exists(21, $auth_user_permissions) || array_key_exists(20, $auth_user_permissions)) : ?>
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion sell">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="bi bi-cash-coin fs-3"></i>
                                </span>
                                <span class="menu-title">Ventes</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                <div class="menu-item menu-accordion">
                                    <?php if (array_key_exists(20, $auth_user_permissions)) : ?>
                                        <a class="menu-link" href="<?= base_url() ?>/sell/new">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Ajouter</span>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (array_key_exists(21, $auth_user_permissions)) : ?>
                                        <a class="menu-link" href="<?= base_url() ?>/sell/list">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Consulter liste</span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (array_key_exists(21, $auth_user_permissions)) : ?>
                                        <a class="menu-link" href="<?= base_url() ?>/sell/sales_point">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Point Ventes</span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (array_key_exists(31, $auth_user_permissions) || array_key_exists(30, $auth_user_permissions)) : ?>
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion order">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="bi bi-card-checklist fs-3"></i>
                                </span>
                                <span class="menu-title">Commandes clients</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                <div class="menu-item menu-accordion">
                                    <?php if (array_key_exists(31, $auth_user_permissions)) : ?>
                                        <a class="menu-link" href="<?= base_url() ?>/order/new">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Ajouter</span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (array_key_exists(30, $auth_user_permissions)) : ?>
                                        <a class="menu-link" href="<?= base_url() ?>/order/list">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Consulter liste</span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion ">
                        <?php if (array_key_exists(40, $auth_user_permissions) || array_key_exists(41, $auth_user_permissions)) : ?>
                            <span class="menu-link supply">
                                <span class="menu-icon">
                                    <i class="bi bi-cart-check fs-3"></i>
                                </span>
                                <span class="menu-title">Approvisionnements</span>
                                <span class="menu-arrow"></span>
                            </span>
                        
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item menu-accordion">
                                <?php if (array_key_exists(41, $auth_user_permissions)) : ?>
                                    <a class="menu-link" href="<?= base_url() ?>/supply/new">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Ajouter</span>
                                    </a>
                                <?php endif; ?>

                                <?php if (array_key_exists(40, $auth_user_permissions)) : ?>
                                    <a class="menu-link" href="<?= base_url() ?>/supply/list">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title ">Consulter liste</span>
                                    </a>
                                <?php endif; ?>
                            </div>

                        </div>
                        <?php endif; ?>

                        <?php if (array_key_exists(50, $auth_user_permissions)) : ?>
                        <div class="menu-item menu-accordion inventory">
                            <a class="menu-link" href="<?= base_url() ?>/inventory">
                                <span class="menu-icon">
                                    <i class="bi bi-grid fs-3"></i>
                                </span>
                                <span class="menu-title">Inventaire du stock</span>
                            </a>
                        </div>
                        <?php endif; ?>
                        <!-- Admin -->
                        <div class="menu-item">
                            <div class="menu-content pt-8 pb-2">
                                <span class="menu-sectio text-muted text-uppercase fs-8 ls-1" style="color: #fff;">Administration</span>
                            </div>
                        </div>
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion sales_option">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="bi bi-archive fs-3"></i>
                                </span>
                                <span class="menu-title">Options de vente</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                <div class="menu-item menu-accordion">*
                                    <?php if (array_key_exists(141, $auth_user_permissions)) : ?>
                                        <a class="menu-link" href="<?= base_url() ?>/sales_option/list_create">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Ajouter</span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (array_key_exists(140, $auth_user_permissions)) : ?>
                                        <a class="menu-link" href="<?= base_url() ?>/sales_option/list">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Consulter liste</span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion product_category">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="bi bi-bookmark-plus fs-3"></i>
                                </span>
                                <span class="menu-title">Catégories Produits</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                <div class="menu-item menu-accordion">
                                    <?php if (array_key_exists(121, $auth_user_permissions)) : ?>
                                        <a class="menu-link" href="<?= base_url() ?>/product_category/list_create">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Ajouter</span>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (array_key_exists(120, $auth_user_permissions)) : ?>
                                        <a class="menu-link" href="<?= base_url() ?>/product_category/list">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title ">Consulter liste</span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion product">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="bi bi-archive fs-3"></i>
                                </span>
                                <span class="menu-title">Produits</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                <div class="menu-item menu-accordion">
                                    <?php if (array_key_exists(131, $auth_user_permissions)) : ?>
                                        <a class="menu-link" href="<?= base_url() ?>/product/list_create">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Ajouter</span>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (array_key_exists(130, $auth_user_permissions)) : ?>
                                        <a class="menu-link" href="<?= base_url() ?>/product/list">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title ">Consulter liste</span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion price">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="bi bi-archive fs-3"></i>
                                </span>
                                <span class="menu-title">Prix de vente</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                <div class="menu-item menu-accordion">
                                    <?php if (array_key_exists(151, $auth_user_permissions)) : ?>
                                        <a class="menu-link" href="<?= base_url() ?>/price/list_create">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Ajouter</span>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (array_key_exists(150, $auth_user_permissions)) : ?>
                                        <a class="menu-link" href="<?= base_url() ?>/price/list">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title ">Consulter liste</span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion client">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="bi bi-person-plus fs-3"></i>
                                </span>
                                <span class="menu-title">Clients</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                <div class="menu-item menu-accordion">
                                    <?php if (array_key_exists(61, $auth_user_permissions)) : ?>
                                        <a class="menu-link" href="<?= base_url() ?>/client/list_create">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Ajouter</span>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (array_key_exists(60, $auth_user_permissions)) : ?>
                                        <a class="menu-link" href="<?= base_url() ?>/client/list">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Consulter liste</span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion fournisseur">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="bi bi-person-plus fs-3"></i>
                                </span>
                                <span class="menu-title">Fournisseurs</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                <div class="menu-item menu-accordion">
                                    <?php if (array_key_exists(71, $auth_user_permissions)) : ?>
                                        <a class="menu-link" href="<?= base_url() ?>/fournisseur/list_create">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Ajouter</span>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (array_key_exists(70, $auth_user_permissions)) : ?>
                                        <a class="menu-link" href="<?= base_url() ?>/fournisseur/list">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Consulter liste</span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion livreur">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="bi bi-person-plus fs-3"></i>
                                </span>
                                <span class="menu-title">Nos Livreurs</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                <div class="menu-item menu-accordion">
                                    <?php if (array_key_exists(81, $auth_user_permissions)) : ?>
                                        <a class="menu-link" href="<?= base_url() ?>/livreur/list_create">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Ajouter</span>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (array_key_exists(80, $auth_user_permissions)) : ?>
                                        <a class="menu-link" href="<?= base_url() ?>/livreur/list">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Consulter liste</span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion users">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="fa fa-user fs-3"></i>
                                </span>
                                <span class="menu-title">Utilisateurs</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                <div class="menu-item menu-accordion">
                                    <?php if (array_key_exists(91, $auth_user_permissions)) : ?>
                                        <a class="menu-link" href="<?= base_url() ?>/register">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Ajouter</span>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (array_key_exists(90, $auth_user_permissions)) : ?>
                                        <a class="menu-link" href="<?= base_url() ?>/users/list">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Consulter liste</span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                            <span class="menu-link groups">
                                <span class="menu-icon">
                                    <i class="bi bi-gear fs-3"></i>
                                </span>
                                <span class="menu-title">Rôles et Permissions </span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                <div class="menu-item menu-accordion">
                                    <?php if (array_key_exists(21, $auth_user_permissions)) : ?>
                                        <a class="menu-link" href="<?= base_url() ?>/groups/new">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Ajouter</span>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (array_key_exists(10, $auth_user_permissions)) : ?>
                                        <a class="menu-link" href="<?= base_url() ?>/groups/list">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Consulter liste</span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if (array_key_exists(100, $auth_user_permissions)) : ?>
                                <div class="menu-item menu-accordion config">
                                    <a class="menu-link" href="<?= base_url() ?>/config">
                                        <span class="menu-icon">
                                            <i class="las la-tools fs-3"></i>
                                        </span>
                                        <span class="menu-title">Paramétrages</span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
                <!--end::Menu-->
            </div>
        </div>

    </div>
    <!--end::Aside-->

    <?php $aside = ob_get_clean();
    session()->set('aside', $aside);
    echo $aside; ?>
<?php
}
?>