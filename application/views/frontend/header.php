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
        <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/frontend/'); ?>css/bootstrap-datepicker.min.css" media="all" />
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="<?php echo site_url('assets/frontend/font-awesome/css/font-awesome.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo site_url('assets/frontend/css/main.css'); ?>">
        <link rel="stylesheet" href="<?php echo site_url('assets/frontend/css/responsive.css'); ?>">
        <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
        
		<link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">
		
    </head>
    <body>
        <input type="hidden" name="site_url" id="site_url" value="<?php echo site_url(); ?>" />

        <div class="wrapper">
           <div class="overlay" id="menu_overlay"></div>
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div id="dismiss">
                    <i class="glyphicon glyphicon-arrow-left"></i>
                </div>

                <div class="sidebar-header">
                    <h3><img src="<?php echo site_url('assets/frontend/images/jolzatra-logo.png'); ?>" alt="" class="img-responsive" style="max-width: 50px;margin-right: 10px;"> <?=$this->lang->line('sidebar_logo_item_joljatra')?></h3>
                </div>

                <ul class="list-unstyled components">
                    <li><a href="<?php echo site_url(); ?>"><i class="fa fa-home"> </i> <?=$this->lang->line('sidebar_item_home')?></a></li>
                    <li><a href="<?php echo site_url('cabin'); ?>"><i class="fa fa-shopping-cart"></i> <?=$this->lang->line('sidebar_item_cabinbooking')?></a></li>
                    <li><a href="<?php echo site_url('page/1'); ?>"><i class="fa fa-info-circle"> </i> <?=$this->lang->line('sidebar_item_about')?></a></li>
                    <li><a href="<?php echo site_url('page/2'); ?>"><i class="fa fa-question-circle "> </i> <?=$this->lang->line('sidebar_item_uses')?></a></li>
                    <li><a href="<?php echo site_url('contact'); ?>"><i class="fa fa-comments "> </i> <?=$this->lang->line('sidebar_item_contact')?></a></li>
                    
                    <!--<li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">হোম</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li><a href="#">হোম</a></li>
                            <li><a href="#">Home 2</a></li>
                            <li><a href="#">Home 3</a></li>
                        </ul>
                    </li>-->
                    
                    <?php if(!$this->user_model->is_user_logd_in()): ?>
                    <li><a href="#" data-toggle="modal" data-target="#sign_up_model"><i class="fa fa-user-plus"></i> <?=$this->lang->line('right_menu_item_signup')?></a></li>
                    <li><a href="#" data-toggle="modal" data-target="#log_in_model" ><i class="fa fa-sign-in"></i> <?=$this->lang->line('right_menu_item_login')?></a></li>
                    <?php else: ?>
                    <li><a href="<?php echo site_url('customer'); ?>"><i class="fa fa-user"></i> <?=$this->lang->line('right_menu_item_profile')?></a></li>
                    <li><a href="#" id="log_out_btn" class="log_out_btn"><i class="fa fa-power-off "></i> <?=$this->lang->line('right_menu_item_logout')?></a></li>
                    <?php  endif; ?>
                </ul>

            </nav>
            <!-- Page Content Holder -->
            <div id="content" >
                <nav class="navbar-default">
                    <div class="container menu_container">
                       <div class="d-flex">
                          <div class="p-2">
                              <button type="button" class="navbar-toggle toggle_bar" id="sidebarCollapse" style="display:block">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                          </div>
                          <div class="p-2">
                              <div class="header_title_text main_logo">
							       <a href="<?php echo site_url(); ?>">
							           <img src="<?php if($this->user_model->get_setting_data('website_logo')){echo site_url('uploads/file/'.$this->user_model->get_setting_data('website_logo'));}else{echo site_url('assets/frontend/images/joljzatra-banner.png');} ?>" alt="<?php if($this->user_model->get_setting_data('website_title')){echo $this->user_model->get_setting_data('website_title');} ?>" class="img-responsive">
							       </a>
							    </div>
                          </div>
                          <div class="ml-auto p-2 d-none d-sm-block d-md-block d-lg-block">
                              <ul class="right_menu_item">
                               <?php if(!$this->user_model->is_user_logd_in()): ?>
                                <li><a href="#" data-toggle="modal" data-target="#sign_up_model"><i class="fa fa-user-plus"> </i> <?=$this->lang->line('right_menu_item_signup')?></a></li>
                                <li><a href="#" data-toggle="modal" data-target="#log_in_model" ><i class="fa fa-sign-in"> </i> <?=$this->lang->line('right_menu_item_login')?></a></li>
                                <?php else: ?>
                                <li><a href="<?php echo site_url('customer'); ?>"><span class="glyphicon glyphicon-user"></span> <?=$this->lang->line('right_menu_item_profile')?></a></li>
                                <li><a href="#" id="log_out_btn" class="log_out_btn"><span class="glyphicon glyphicon-log-in"> </span> <?=$this->lang->line('right_menu_item_logout')?></a></li>
                                <?php  endif; ?>
                              </ul>
                          </div>
                        </div>
                        
                    </div>
                </nav>
                