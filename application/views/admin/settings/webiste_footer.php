<?php $this->load->view('admin/inc/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('admin/inc/sidebar'); ?>
  <?php $total_message_count = $this->user_model->new_message_count(); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Wbsite Footer Settings
      </h1>
     
    </section>
    <!-- Main content -->
    <section class="content">
     
     
     <!--this is error or success message display message-->
     <div class="row" id="message_section">
		    <!--Display the confirmation message -->
            <?php if($this->session->userdata('success_msg') or $this->session->userdata('error_msg')): ?>
			<div class="col-sm-12 message_display_class">
                <?php if($this->session->userdata('success_msg')): ?>
				<div class="alert alert-success alert-dismissable">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Success!</strong> <?php echo $this->session->userdata('success_msg'); ?>
				</div>
                <?php endif; ?>
                <?php if($this->session->userdata('error_msg')): ?>
				<div class="alert alert-danger alert-dismissable">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				 <strong>Faield!</strong> <?php echo $this->session->userdata('error_msg'); ?>
				</div>
                <?php endif; ?>
                <?php if(isset($validation_errors)): ?>
				<div class="alert alert-danger alert-dismissable">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				 <strong>Faield!</strong> <?php echo $validation_errors; ?>
				</div>
                <?php endif; ?>
                <?php  $sesattr = array('success_msg' => '', 'error_msg' => '' );
       $this->session->set_userdata($sesattr); ?>
			</div>
            <?php endif; ?>
		</div>
     <!--this is error or success message display message-->
     
     
      <!-- Small boxes (Stat box) -->
      <div class="row">
       
      <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">WEBSITE FOOTER SETTINGS</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             
			<div class="col-sm-8">
			    <assaid class="customer_profile_info">
					<?php echo form_open('admin/settings/website_footer'); ?>
			
					
						<div class="form-group row">
							<label for="footer_copyright_text" class="col-sm-3 col-form-label">FOOTER COPYRIGHT TEXT</label>
							<div class="col-sm-9">
								<input class="form-control" id="footer_copyright_text" placeholder="FOOTER COPYRIGHT TEXT" name="footer_copyright_text" type="text" value="<?php if($this->user_model->get_setting_data('footer_copyright_text')){echo $this->user_model->get_setting_data('footer_copyright_text');} ?>" required>
							</div>
						</div>
					
						<div class="form-group row">
							<label for="footer_facebook_link" class="col-sm-3 col-form-label">FACEBOOK LINK</label>
							<div class="col-sm-9">
                                <div class="input-group">
                                   <span class="input-group-addon"><i class="fa  fa-facebook"></i></span>
                                    <input class="form-control" id="footer_facebook_link" placeholder="FACEBOOK LINK" name="footer_facebook_link" type="text" value="<?php if($this->user_model->get_setting_data('footer_facebook_link')){echo $this->user_model->get_setting_data('footer_facebook_link');} ?>" required>
                                </div>
							</div>
						</div>
					
					
						<div class="form-group row">
							<label for="footer_twitter_link" class="col-sm-3 col-form-label">TWITTER LINK</label>
							<div class="col-sm-9">
                                <div class="input-group">
                                   <span class="input-group-addon"><i class="fa  fa-twitter"></i></span>
                                    <input class="form-control" id="footer_twitter_link" placeholder="TWITTER LINK" name="footer_twitter_link" type="text" value="<?php if($this->user_model->get_setting_data('footer_twitter_link')){echo $this->user_model->get_setting_data('footer_twitter_link');} ?>" required>
                                </div>
							</div>
						</div>
					
					
					
						<div class="form-group row">
							<label for="footer_linkedin_link" class="col-sm-3 col-form-label">LINKEDIN LINK</label>
							<div class="col-sm-9">
                                <div class="input-group">
                                   <span class="input-group-addon"><i class="fa  fa-linkedin"></i></span>
                                    <input class="form-control" id="footer_linkedin_link" placeholder="LINKEDIN LINK" name="footer_linkedin_link" type="text" value="<?php if($this->user_model->get_setting_data('footer_linkedin_link')){echo $this->user_model->get_setting_data('footer_linkedin_link');} ?>" required>
                                </div>
							</div>
						</div>
					
					
					
						<div class="form-group row">
							<label for="footer_youtube_link" class="col-sm-3 col-form-label">YOUTUBE LINK</label>
							<div class="col-sm-9">
                                <div class="input-group">
                                   <span class="input-group-addon"><i class="fa  fa-youtube"></i></span>
                                    <input class="form-control" id="footer_youtube_link" placeholder="YOUTUBE LINK" name="footer_youtube_link" type="text" value="<?php if($this->user_model->get_setting_data('footer_youtube_link')){echo $this->user_model->get_setting_data('footer_youtube_link');} ?>" required>
                                </div>
							</div>
						</div>
					
					
						<div class="form-group row">
							<label for="footer_google_plus_link" class="col-sm-3 col-form-label">GOOGLE PLUS LINK</label>
							<div class="col-sm-9">
                                <div class="input-group">
                                   <span class="input-group-addon"><i class="fa  fa-google-plus"></i></span>
                                    <input class="form-control" id="footer_google_plus_link" placeholder="GOOGLE PLUS LINK" name="footer_google_plus_link" type="text" value="<?php if($this->user_model->get_setting_data('footer_google_plus_link')){echo $this->user_model->get_setting_data('footer_google_plus_link');} ?>" required>
                                </div>
							</div>
						</div>
					
					
					
					
					
						<div class="form-group row">
							<label for="sign_up" class="col-sm-3 col-form-label">        </label>
							<div class="col-sm-9">
							    <input name="save_settings" value="Save Settings" class="btn btn-primary btn-reservation" type="submit">
							</div>
						</div>
						
					<?php echo form_close(); ?>
			    </assaid>
			</div>
              
           
            </div>
          </div>
        </div>
       
       
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
 <?php $this->load->view('admin/inc/footer'); ?>