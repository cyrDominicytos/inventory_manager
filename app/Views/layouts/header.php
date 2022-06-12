<!--begin::Header-->
<div id="kt_header" style="" class="header align-items-stretch">
						<!--begin::Container-->
						<div class="container-fluid d-flex align-items-stretch justify-content-between">
							<!--begin::Aside mobile toggle-->
							<div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
								<div class="btn btn-icon btn-active-color-white" id="kt_aside_mobile_toggle">
									<i class="bi bi-list fs-1"></i>
								</div>
							</div>
							<!--end::Aside mobile toggle-->
							<!--begin::Mobile logo-->
							<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
								<a href="" class="d-lg-none">
									<img alt="Logo" src="<?= base_url(); ?>/public/assets/media/logos/logo-demo13-compact.svg" class="h-25px" />
								</a>
							</div>
							<!--end::Mobile logo-->
							<!--begin::Wrapper-->
							<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
								<!--begin::Navbar-->
								<div class="d-flex align-items-stretch" id="kt_header_nav">
									<!--begin::Menu wrapper-->
									<div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
										<!--begin::Menu-->
										<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">
											<div class="menu-item menu-lg-down-accordion me-lg-1">
												<span class="menu-link py-3">
													<a class="menu-link bg-color hover-overlay br-dark" href="<?= base_url() ?>/sell/new" style="hover{backhround-color:black}"> 
														<span class="menu-title" style="color: #fff;">Nouvelle vente</span>
														<span class="menu-arrow d-lg-none"></span>
													</a>
												</span>
											</div>
											<div class="menu-item menu-lg-down-accordion me-lg-1">
												<span class="menu-link py-3">
													<a class="menu-link bg-color hover-overlay br-dark" href="<?= base_url() ?>/order/new" style="hover{backhround-color:black}"> 
														<span class="menu-title" style="color: #fff;">Nouvelle Commande</span>
														<span class="menu-arrow d-lg-none"></span>
													</a>
												</span>
											</div>
											<div class="menu-item menu-lg-down-accordion me-lg-1">
												<span class="menu-link py-3">
													<a class="menu-link bg-color hover-overlay br-dark" href="<?= base_url() ?>/supply/new" style="hover{backhround-color:black}"> 
														<span class="menu-title" style="color: #fff;">Approvisionnement</span>
														<span class="menu-arrow d-lg-none"></span>
													</a>
												</span>
											</div>
											<div class="menu-item menu-lg-down-accordion me-lg-1">
												<span class="menu-link py-3">
													<a class="menu-link bg-color hover-overlay br-dark" href="<?= base_url() ?>/inventory" style="hover{backhround-color:black}"> 
														<span class="menu-title" style="color: #fff;">Stock</span>
														<span class="menu-arrow d-lg-none"></span>
													</a>
												</span>
											</div>
										</div>
										<!--end::Menu-->
									</div>
									<!--end::Menu wrapper-->
								</div>
								<!--end::Navbar-->
								<!--begin::Toolbar wrapper-->
								<div class="topbar d-flex align-items-stretch flex-shrink-0">
									
									
								
																	
									
									<!--begin::User-->
									<div class="d-flex align-items-stretch" id="kt_header_user_menu_toggle">
										<!--begin::Menu wrapper-->
										<div class="topbar-item cursor-pointer symbol px-3 px-lg-5 me-n3 me-lg-n5 symbol-30px symbol-md-35px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
										<?=  session()->has('identity') ? ($auth->user()->row()->first_name.' '.$auth->user()->row()->last_name) : ("")?> &nbsp;
											<img src="<?= base_url(); ?>/public/assets/media/avatars/blank.png" alt="metronic" />
										</div>
										<!--begin::User account menu-->
										<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
											<!--begin::Menu item-->
											<div class="menu-item px-3">
												<div class="menu-content d-flex align-items-center px-3">
													<!--begin::Avatar-->
													<div class="symbol symbol-50px me-5">
														<img alt="Logo" src="<?= base_url(); ?>/public/assets/media/avatars/blank.png" />
													</div>
													<!--end::Avatar-->
													<!--begin::Username-->
													<div class="d-flex flex-column">
														<div class="fw-bolder d-flex align-items-center fs-5 text-dark"><?=  session()->has('identity') ? ($auth->user()->row()->first_name.''.$auth->user()->row()->last_name) : ("")?>
														<span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2"><?=  session()->has('identity') ? ($auth->getUsersGroups()->getResult()[0]->name) : ("")?></span></div>
														<a href="#" class="fw-bold text-muted text-hover-primary fs-7"><?=  session()->has('identity') ? (session()->get('identity')) : ("")?></a>
													</div>
													<!--end::Username-->
												</div>
											</div>
											<!--end::Menu item-->
											<!--begin::Menu separator-->
											<div class="separator my-2"></div>
											<!--end::Menu separator-->
											<!--begin::Menu item-->
											<div class="menu-item px-5">
												<a href="<?= base_url(); ?>/user/edit/<?=  session()->has('user_id') ? (session()->get('user_id')) : ("")?>" class="menu-link px-5">Mon Profile</a>
											</div>
											<!--end::Menu item-->

											<!--end::Menu item-->
											<!--begin::Menu item-->
											<div class="menu-item px-5">
												<a href="<?php echo base_url();?>/logout" class="menu-link px-5">Déconnexion</a>
											</div>
											<!--end::Menu item-->
										</div>
										<!--end::User account menu-->
										<!--end::Menu wrapper-->
									</div>
									<!--end::User -->
									<!--begin::Heaeder menu toggle-->
									<div class="d-flex align-items-stretch d-lg-none px-3 me-n3" title="Show header menu">
										<div class="topbar-item" id="kt_header_menu_mobile_toggle">
											<i class="bi bi-text-left fs-1"></i>
										</div>
									</div>
									<!--end::Heaeder menu toggle-->
								</div>
								<!--end::Toolbar wrapper-->
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Header-->