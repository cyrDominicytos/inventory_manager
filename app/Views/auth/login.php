<?= $this->extend('authTempate') ?>
<?php $this->section('title'); echo  getenv('APP_NAME')."| Login"; $this->endSection()?>
<?= $this->section('content') ?>
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Aside-->
				<div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative customBg" >
					<!--begin::Wrapper-->
					<div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
						<!--begin::Content-->
						<div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
							<!--begin::Logo-->
							<a href="../../demo12/dist/index.html" class="py-9 mb-5">
								<img alt="Logo" src="<?= base_url(); ?>/public/assets/media/logos/logo-2.svg " class="h-60px" />
							</a>
							<!--end::Logo-->
							<!--begin::Title-->
							<h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #fff;">Bienvenue sur <?= getenv('APP_NAME') ?></h1>
							<!--end::Title-->
							<!--begin::Description-->
							<p class="fw-bold fs-2" style="color: #fff;">Votre Application 
							<br />de gestion de stock et de comptabilité</p>
							<!--end::Description-->
						</div>
						<!--end::Content-->
						<!--begin::Illustration-->
						<div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px">
                             <!-- Owl-Carousel -->
                            <div class="owl-carousel owl-theme">
                                <img src="<?= base_url(); ?>/public/assets/media/presentation/pre1.png" alt="" class="login_img">
                                <img src="<?= base_url(); ?>/public/assets/media/presentation/pre2.png" alt="" class="login_img">
                                <img src="<?= base_url(); ?>/public/assets/media/presentation/pre3.png" alt="" class="login_img">
                                <img src="<?= base_url(); ?>/public/assets/media/presentation/pre4.png" alt="" class="login_img">
                                <img src="<?= base_url(); ?>/public/assets/media/presentation/pre5.png" alt="" class="login_img">                                
                            </div>
                            <!-- /Owl-Carousel -->
                        </div>
						<!--end::Illustration-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Aside-->
				<!--begin::Body-->
				<div class="d-flex flex-column flex-lg-row-fluid py-10">
					<!--begin::Content-->
					<div class="d-flex flex-center flex-column flex-column-fluid">
						<!--begin::Wrapper-->
						<div class="w-lg-500px p-10 p-lg-15 mx-auto">
							<!--begin::Form-->
							<form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="<?= base_url(); ?>/sign_in" method="post">
								<!--begin::Heading-->
								<div class="text-center mb-10">
									<!--begin::Title-->
									<h1 class="text-dark mb-3">Connexion à <?= getenv('APP_NAME') ?></h1>
									<!--end::Title-->
									<!--begin::Link-->
									<div id="infoMessage" style="color:red;"><?=  session()->has('message') ? (session()->get('message')) : ("")?></div>
									<!-- <div class="text-gray-400 fw-bold fs-4">Vous n'avez pas de compte? -->
									<!-- <a href="<?=base_url(); ?>/register" class="link-primary fw-bolder">Inscrivez-vous</a></div> -->
									<!--end::Link-->
								</div>
								<!--begin::Heading-->
								<!--begin::Input group-->
								<div class="fv-row mb-10">
									<!--begin::Label-->
									<label class="form-label fs-6 fw-bolder text-dark">Email <sup class="mySup">*</sup></label>
									<!--end::Label-->
									<!--begin::Input-->
									<input class="form-control form-control-lg form-control-solid" type="text" name="email" autocomplete="off" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="fv-row mb-10">
									<!--begin::Wrapper-->
									<div class="d-flex flex-stack mb-2">
										<!--begin::Label-->
										<label class="form-label fw-bolder text-dark fs-6 mb-0">Mot de passe <sup class="mySup">*</sup></label>
										<!--end::Label-->
										<!--begin::Link-->
										<a href="../../demo12/dist/authentication/layouts/aside/password-reset.html" class="link-primary fs-6 fw-bolder">Mot de passe oublié ?</a>
										<!--end::Link-->
									</div>
									<!--end::Wrapper-->
									<!--begin::Input-->
									<input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<!--begin::Actions-->
								<div class="text-center">
									<!--begin::Submit button-->
									<button type="submit" id="kt_sign_in_submi" class="btn btn-lg btn-primary w-100 mb-5 customBg">
										<span class="indicator-label">Continuer</span>
										<span class="indicator-progress">Patientez...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>
									<!--end::Submit button-->
									<!--begin::Separator
									<div class="text-center text-muted text-uppercase fw-bolder mb-5">or</div>
									
									<a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
									<img alt="Logo" src="<?= base_url(); ?>/public/assets/media/svg/brand-logos/google-icon.svg " class="h-20px me-3" />Continue with Google</a>
									
									<a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
									<img alt="Logo" src="<?= base_url(); ?>/public/assets/media/svg/brand-logos/facebook-4.svg " class="h-20px me-3" />Continue with Facebook</a>
									
									<a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100">
									<img alt="Logo" src="<?= base_url(); ?>/public/assets/media/svg/brand-logos/apple-black.svg " class="h-20px me-3" />Continue with Apple</a>
									-->
								</div>
								<!--end::Actions-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					<div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
						<!--begin::Footer-->
						<div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
						<!--begin::Links-->
						<div class="d-flex flex-center fw-bold fs-6">
							<a href="<?= getenv('DEV_SITE_URL') ?>" class="text-muted text-hover-primary px-2" target="_blank">A propos</a>
							<a href="mailto:<?= getenv('DEV_MAIL') ?>" class="text-muted text-hover-primary px-2" target="_blank">Nous contacter</a>
						</div>
						<!--end::Links-->
					</div>
					<!--end::Footer-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
 <?= $this->endSection() ?>