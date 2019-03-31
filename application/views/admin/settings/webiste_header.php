<?php $this->load->view('admin/inc/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('admin/inc/sidebar'); ?>
  <?php $total_message_count = $this->user_model->new_message_count(); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Wbsite Header Settings
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
                <h3 class="box-title">WEBSITE HEADER SETTINGS</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             
			<div class="col-sm-8">
			    <assaid class="customer_profile_info">
					<?php echo form_open_multipart('admin/settings/website_header'); ?>
						<div class="form-group row">
							<label for="website_logo" class="col-sm-3 col-form-label">WEBSITE LOGO</label>
							<div class="col-sm-9">
							    <input style="padding:0px" type="file" class="form-control" name="website_logo" id="website_logo">
								
							</div>
						</div>
					
						<div class="form-group row">
							<label for="website_title" class="col-sm-3 col-form-label">WEBSITE TITLE</label>
							<div class="col-sm-9">
								<input class="form-control" id="website_title" placeholder="WEBSITE TITLE" name="website_title" type="text" value="<?php if($this->user_model->get_setting_data('website_title')){echo $this->user_model->get_setting_data('website_title');} ?>" required>
							</div>
						</div>
					
						<div class="form-group row">
							<label for="website_meta_keyword" class="col-sm-3 col-form-label">META KEYWORD</label>
							<div class="col-sm-9">
							    <textarea class="form-control" name="website_meta_keyword" id="website_meta_keyword" cols="30" rows="6" placeholder="Joljatra, Easy Cabin booking, Launch, Bd Launch" required><?php if($this->user_model->get_setting_data('website_meta_keyword')){echo $this->user_model->get_setting_data('website_meta_keyword');}?></textarea>
								
							</div>
						</div>
					
						<div class="form-group row">
							<label for="website_meta_description" class="col-sm-3 col-form-label">META DESCRIPTION</label>
							<div class="col-sm-9">
							    <textarea class="form-control" name="website_meta_description" id="website_meta_description" cols="30" rows="6" placeholder="Joljatra.com is most popular website for online launch cabin booking. You can by online cabin by using your bkas." required><?php if($this->user_model->get_setting_data('website_meta_description')){echo $this->user_model->get_setting_data('website_meta_description');}?></textarea>
								
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
              
              <div class="col-sm-4">
                <img src="<?php echo site_url('uploads/file/'.$this->user_model->get_setting_data('website_logo')); ?>" alt="Websit Logo" class="img-responsive">
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