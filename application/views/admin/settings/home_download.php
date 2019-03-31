<?php $this->load->view('admin/inc/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('admin/inc/sidebar'); ?>
  <?php $total_message_count = $this->user_model->new_message_count(); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Wbsite HOME DOWNLOAD SETTIGS
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
                <h3 class="box-title">WEBSITE HOME DOWNLOAD SETTINGS</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             
			<div class="col-sm-8">
			    <assaid class="customer_profile_info">
					<?php echo form_open('admin/settings/home_download'); ?>
			
					
						<div class="form-group row">
							<label for="download_title" class="col-sm-3 col-form-label"> DOWNLOAD SECTION TITLE</label>
							<div class="col-sm-9">
								<input class="form-control" id="download_title" placeholder="DOWNLOAD SECTION TITLE" name="download_title" type="text" value="<?php if($this->user_model->get_setting_data('download_title')){echo $this->user_model->get_setting_data('download_title');} ?>" required>
							</div>
						</div>
					
						<div class="form-group row">
							<label for="download_sub_title" class="col-sm-3 col-form-label">DOWNLOAD SECTION SUB TITLE</label>
							<div class="col-sm-9">
                                <div class="input-group">
                                   <span class="input-group-addon"><i class="fa  fa-edit"></i></span>
                                    <input class="form-control" id="download_sub_title" placeholder="DOWNLOAD SECTION SUB TITLE " name="download_sub_title" type="text" value="<?php if($this->user_model->get_setting_data('download_sub_title')){echo $this->user_model->get_setting_data('download_sub_title');} ?>" required>
                                </div>
							</div>
						</div>
					
					
						<div class="form-group row">
							<label for="android_app_link" class="col-sm-3 col-form-label">ANDROID APP LINK</label>
							<div class="col-sm-9">
                                <div class="input-group">
                                   <span class="input-group-addon"><i class="fa  fa-link"></i></span>
                                    <input class="form-control" id="android_app_link" placeholder="ANDROID APP LINK" name="android_app_link" type="text" value="<?php if($this->user_model->get_setting_data('android_app_link')){echo $this->user_model->get_setting_data('android_app_link');} ?>" required>
                                </div>
							</div>
						</div>
					
					
					
						<div class="form-group row">
							<label for="apple_app_link" class="col-sm-3 col-form-label">APPLE APP LINK</label>
							<div class="col-sm-9">
                                <div class="input-group">
                                   <span class="input-group-addon"><i class="fa  fa-link"></i></span>
                                    <input class="form-control" id="apple_app_link" placeholder="APPLE APP LINK" name="apple_app_link" type="text" value="<?php if($this->user_model->get_setting_data('apple_app_link')){echo $this->user_model->get_setting_data('apple_app_link');} ?>" required>
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