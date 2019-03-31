<?php $this->load->view('admin/inc/header'); ?>
<!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('admin/inc/sidebar'); ?>
<?php $total_message_count = $this->user_model->new_message_count(); ?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>SMS SETTINGS</h1>
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
					<div class="box-header with-border"><h3 class="box-title">SMS API SETTINGS</h3></div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="col-sm-12">
							<assaid class="customer_profile_info">
								<?php echo form_open('admin/settings/sms'); ?>
								<div class="form-group row">
									<label for="engineer_bd_sms_api_key" class="col-sm-3 col-form-label">API KEY</label>
									<div class="col-sm-9">
										<input class="form-control" id="engineer_bd_sms_api_key" placeholder="SMS API KEY" name="engineer_bd_sms_api_key" type="text" value="<?php if($this->user_model->get_setting_data('engineer_bd_sms_api_key')){echo $this->user_model->get_setting_data('engineer_bd_sms_api_key');} ?>" required>
									</div>
								</div>

								<div class="form-group row">
									<label for="engineer_bd_sms_sender_id" class="col-sm-3 col-form-label">SENDER ID</label>
									<div class="col-sm-9">
										<input class="form-control" id="engineer_bd_sms_sender_id" placeholder="SENDER ID" name="engineer_bd_sms_sender_id" type="text" value="<?php if($this->user_model->get_setting_data('engineer_bd_sms_sender_id')){echo $this->user_model->get_setting_data('engineer_bd_sms_sender_id');} ?>" required>
									</div>
								</div>

								<div class="form-group row">
									<label for="sign_up_sms" class="col-sm-3 col-form-label">SIGN UP SMS</label>
									<div class="col-sm-9">
										<input class="form-control" id="sign_up_sms" placeholder="SIGN UP SMS" name="sign_up_sms" type="text" value="<?php if($this->user_model->get_setting_data('sign_up_sms')){echo $this->user_model->get_setting_data('sign_up_sms');}?>" required>
									
									</div>
								</div>

								<div class="form-group row">
									<label for="sms_after_booking" class="col-sm-3 col-form-label">SMS AFTER BOOKING</label>
									<div class="col-sm-9">
										<input class="form-control" id="sms_after_booking" placeholder="SMS AFTER BOOKING" name="sms_after_booking" type="text" value="<?php if($this->user_model->get_setting_data('sms_after_booking')){echo $this->user_model->get_setting_data('sms_after_booking');}?>" required>
									</div>
								</div>
								
								<hr class="featurette-divider">
								
								<div class="form-group row">
									<label for="sms_after_booking" class="col-sm-3 col-form-label">SMS BRAODCAST</label>
									<div class="col-sm-9">
										<textarea class="form-control" rows="4" id="sms_broadcast" placeholder="SMS BROADCAST" name="sms_broadcast" type="text" required><?php if($this->user_model->get_setting_data('sms_broadcast')){echo $this->user_model->get_setting_data('sms_broadcast');}?></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label for="save_settings" class="col-sm-3 col-form-label" align="center">
										<input name="save_settings" value="Save All Settings" class="btn btn-primary btn-reservation" type="submit">
									</label>
									<div class="col-sm-9" align="center">
										<input value="SEND TO ALL" class="btn btn-primary btn-sms-broadcast-to-all" type="submit">
										<input value="SEND TO OWNER" class="btn btn-primary btn-sms-broadcast-to-owner" type="submit">
										<input value="SEND ONLY PASSENGER" class="btn btn-primary btn-sms-broadcast-to-passenger" type="submit">
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