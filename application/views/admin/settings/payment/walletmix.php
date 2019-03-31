<?php $this->load->view('admin/inc/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('admin/inc/sidebar'); ?>
  <?php $total_message_count = $this->user_model->new_message_count(); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Paymet Getway Walletmix Settings
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
                <h3 class="box-title">Walletmix Settings</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             
			<div class="col-sm-8">
			    <assaid class="customer_profile_info">
					<?php echo form_open('admin/settings/walletmix'); ?>
						<div class="form-group row">
							<label for="walletmix_access_username" class="col-sm-3 col-form-label">Access Username</label>
							<div class="col-sm-9">
								<input class="form-control" id="walletmix_access_username" placeholder="Access Username" name="walletmix_access_username" type="text" value="<?php if($this->user_model->get_setting_data('walletmix_access_username')){echo $this->user_model->get_setting_data('walletmix_access_username');} ?>" required>
							</div>
						</div>
					
						<div class="form-group row">
							<label for="walletmix_access_password" class="col-sm-3 col-form-label">Access Password</label>
							<div class="col-sm-9">
								<input class="form-control" id="walletmix_access_password" placeholder="Access Password" name="walletmix_access_password" type="text" value="<?php if($this->user_model->get_setting_data('walletmix_access_password')){echo $this->user_model->get_setting_data('walletmix_access_password');} ?>" required>
							</div>
						</div>
					
						<div class="form-group row">
							<label for="walletmix_access_app_key" class="col-sm-3 col-form-label">Access App Key</label>
							<div class="col-sm-9">
								<input class="form-control" id="walletmix_access_app_key" placeholder="Access App Key" name="walletmix_access_app_key" type="text" value="<?php if($this->user_model->get_setting_data('walletmix_access_app_key')){echo $this->user_model->get_setting_data('walletmix_access_app_key');} ?>" required>
							</div>
						</div>
					
					
						<div class="form-group row">
							<label for="walletmix_access_marchent_id" class="col-sm-3 col-form-label">Access Marchent Id</label>
							<div class="col-sm-9">
								<input class="form-control" id="walletmix_access_marchent_id" placeholder="Access Marchent Id" name="walletmix_access_marchent_id" type="text" value="<?php if($this->user_model->get_setting_data('walletmix_access_marchent_id')){echo $this->user_model->get_setting_data('walletmix_access_marchent_id');} ?>" required>
							</div>
						</div>
					

					
						<div class="form-group row">
							<label for="sign_up" class="col-sm-3 col-form-label">        </label>
							<div class="col-sm-9">
							    <input name="save_settings" value="Save Staff" class="btn btn-primary btn-reservation" type="submit">
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