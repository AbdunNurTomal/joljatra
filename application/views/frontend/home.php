<?php $this->load->view('frontend/header'); ?>
<section class="slider_section">
<?php echo $slider; ?>
</section> 

<section class="home_content_section">
    <div class="container text-center">
        <div class="row home_tab_icons">
            <div class="col-4 col-sm-4 single_icons"  style="border:1px solid #DDD">
              <a href="<?php echo site_url('cabin'); ?>">
                <i class="fa fa-shopping-cart"></i>
                <h2><?=$this->lang->line('body_item_cabinbooking')?></h2>
              </a>
            </div>
            <div class="col-4 col-sm-4 single_icons" style="border:1px solid #DDD">
              <a href="<?php echo site_url('page/17'); ?>">
                <i class="fa fa-ship"></i>
                <h2><?=$this->lang->line('body_item_launches')?></h2>
              </a>
            </div>
            <div class="col-4 col-sm-4 single_icons" style="border:1px solid #DDD">
              <a href="<?php echo site_url('terminalmap'); ?>">
                <i class="fa fa-map "></i>
                <h2><?=$this->lang->line('body_item_terminal')?></h2>
              </a>
            </div>
            <div class="col-4 col-sm-4 single_icons" style="border:1px solid #DDD">
              <a href="<?php echo site_url('weather'); ?>">
                <i class="fa fa-skyatlas"></i>
                <h2><?=$this->lang->line('body_item_weather')?> </h2>
              </a>
            </div>
            <div class="col-4 col-sm-4 single_icons" style="border:1px solid #DDD">
              <a href="<?php echo site_url('notices'); ?>">
                <i class="fa fa-file-text "></i>
                <h2><?=$this->lang->line('body_item_notice')?></h2>
              </a>
            </div>
            <div class="col-4 col-sm-4 single_icons" style="border:1px solid #DDD">
              <a href="<?php echo site_url('page/18'); ?>">
                <i class="fa fa-calendar-plus-o"></i>
                <h2><?=$this->lang->line('body_item_lonchservice')?></h2>
              </a>
            </div>
            
            <div class="col-4 col-sm-4 single_icons" style="border:1px solid #DDD">
              <a href="<?php echo site_url('contact'); ?>">
                <i class="fa fa-comments "> </i>
                <h2><?=$this->lang->line('body_item_communication')?></h2>
              </a>
            </div>
            <div class="col-4 col-sm-4 single_icons" style="border:1px solid #DDD">
              <a href="callto:09639200900">
                <i class="fa fa-phone  "></i>
                <h2><?=$this->lang->line('body_item_urgentservice')?></h2>
              </a>
            </div>
            <div class="col-4 col-sm-4 single_icons" style="border:1px solid #DDD">
              <a href="<?php echo site_url('prayertime'); ?>">
                <i class="fa fa-calendar"></i>
                <h2><?=$this->lang->line('body_item_prayertime')?></h2>
              </a>
            </div>
        </div>
    </div>
</section>
<section class="home_download_section text-center">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="block_header"> <?php if($this->user_model->get_setting_data('download_title')){echo $this->user_model->get_setting_data('download_title');} ?> </h1>
                <p style=""> <?php if($this->user_model->get_setting_data('download_sub_title')){echo $this->user_model->get_setting_data('download_sub_title');} ?> </p>
                <h4 class="or-text">or</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <a href="<?php if($this->user_model->get_setting_data('android_app_link')){echo $this->user_model->get_setting_data('android_app_link');} ?>" alt="<?php if($this->user_model->get_setting_data('android_app_link')){echo $this->user_model->get_setting_data('android_app_link');} ?>" class="app-d inline-li-2" target="_blank"><img src="<?php echo site_url('assets/frontend/images/google-playstore.png'); ?>"></a>
                
                <a href="<?php if($this->user_model->get_setting_data('apple_app_link')){echo $this->user_model->get_setting_data('apple_app_link');} ?>" alt="<?php if($this->user_model->get_setting_data('apple_app_link')){echo $this->user_model->get_setting_data('apple_app_link');} ?>" class="app-d-2 inline-li-2" target="_blank"><img src="<?php echo site_url('assets/frontend/images/apple-appstore.png'); ?>"></a>
            </div>
        </div>
    </div>
</section>
<section class="home_testimonial_section text-center">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="section_title"> <?php if($this->user_model->get_setting_data('testimonial_title')){echo $this->user_model->get_setting_data('testimonial_title');} ?>  </h1>
            </div>
        </div>
        <div class="row">
           <?php echo $testimonial; ?>
        </div>
    </div>
</section>
       

<?php $this->load->view('frontend/footer'); ?>