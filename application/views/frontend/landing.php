<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" type="image/png" href="">
        
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo site_url('assets/frontend/images/favicons'); ?>/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo site_url('assets/frontend/images/favicons'); ?>/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo site_url('assets/frontend/images/favicons'); ?>/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo site_url('assets/frontend/images/favicons'); ?>/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo site_url('assets/frontend/images/favicons'); ?>/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo site_url('assets/frontend/images/favicons'); ?>/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo site_url('assets/frontend/images/favicons'); ?>/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo site_url('assets/frontend/images/favicons'); ?>/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo site_url('assets/frontend/images/favicons'); ?>/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo site_url('assets/frontend/images/favicons'); ?>/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo site_url('assets/frontend/images/favicons'); ?>/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo site_url('assets/frontend/images/favicons'); ?>/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo site_url('assets/frontend/images/favicons'); ?>/favicon-16x16.png">
        <link rel="manifest" href="<?php echo site_url('assets/frontend/images/favicons'); ?>/manifest.json">
		
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?php echo site_url('assets/frontend/images/favicons'); ?>/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <title><?php if($this->user_model->get_setting_data('website_title')){echo $this->user_model->get_setting_data('website_title');} ?></title>
        <meta name="keyword" content="<?php if($this->user_model->get_setting_data('website_meta_keyword')){echo $this->user_model->get_setting_data('website_meta_keyword');} ?>">
        
        <meta name="description" content="<?php if($this->user_model->get_setting_data('website_meta_description')){echo $this->user_model->get_setting_data('website_meta_description');} ?>">

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <link rel='stylesheet' href='<?php echo site_url('assets/frontend/css/glyp-icon.css'); ?>' />
         <!-- Our Custom CSS -->
        <link rel="stylesheet" href="<?php echo site_url('assets/frontend/font-awesome/css/font-awesome.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo site_url('assets/frontend/css/responsive.css'); ?>">
		
		<link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">
		<style>
			.modal-content {
			  width:100%;
			}

			.modal-dialog-centered {
			  display:-webkit-box;
			  display:-ms-flexbox;
			  display:flex;
			  -webkit-box-align:center;
			  -ms-flex-align:center;
			  align-items:center;
			  min-height:calc(100% - (.5rem * 2));
			}

			@media (min-width: 576px) {
			  .modal-dialog-centered {
				min-height:calc(100% - (1.75rem * 2));
			  }
			}
			/*This style for home tabs*/
			.home_content_section{padding: 50px 0px}
			.home_tab_icons{}
			.home_tab_icons .single_icons{padding-top: 15px;padding-bottom: 10px; border: 1px solid #AEAEAE66;border-color: #AEAEAE66;}
			.home_tab_icons .single_icons a{display: block;text-decoration: none;color: #118971;}
			.home_tab_icons .single_icons a:hover{ color: #cd9432;}
			.home_tab_icons .single_icons:hover{ border-color: #cd9432;}
			.home_tab_icons .single_icons i{font-size: 70px;}
			.home_tab_icons .single_icons h2{font-size: 22px;margin-top: 15px;}
		</style>
    </head>
    <body>
	
		<div class="modal fade" id="languageModal" tabindex="-1" role="dialog" aria-labelledby="languageModalTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
			<div class="modal-content">
			  <div class="modal-body" align="center">
					<div class="col-sm-12">
						<div class="row home_tab_icons">
							<div class="col-6 col-sm-6 single_icons" style="border:1px solid #DDD">
								<a href="<?php echo site_url('multilanguageswitcher/language_switch/bd'); ?>" language="bangla" class="bangla-language">
									<span class="flag-icon flag-icon-bd fa-lg"></span><h2>বাংলা</h2>
								</a>
							</div>
							<div class="col-6 col-sm-6 single_icons"  style="border:1px solid #DDD" class="english-language">
								<a href="<?php echo site_url('multilanguageswitcher/language_switch/en'); ?>" language="english" class="english-language">
									<span class="flag-icon flag-icon-us fa-lg"></span><h2>ENGLISH</h2>
								</a>
							</div>
						</div>
					</div>
			  </div>
		  </div>
		</div>
	
		
	<!-- jQuery CDN -->
	<script  src="https://code.jquery.com/jquery-3.3.1.min.js"  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$("#languageModal").modal({
				backdrop: 'static',
				keyboard: false
			});
		});
	</script>
</body>
</html>