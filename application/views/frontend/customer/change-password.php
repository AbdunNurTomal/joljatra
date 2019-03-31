<?php $this->load->view('frontend/header'); ?>

<section class="home_content_section">
	<div class="container custom-padding">
		<div class="row ">
		
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
                <?php  $sesattr = array('success_msg' => '', 'error_msg' => '' );
       $this->session->set_userdata($sesattr); ?>
			</div>
            <?php endif; ?>
            
		<!--/--end of message confirmation-->
			<div class="col-sm-4 text-center">
               <div class="customer_left_bar">
                    <img src="<?php echo site_url('uploads/users/'.$user_data->image); ?>" alt="" class="img-responsive img-thumbnail img-circle">
                   <h4><?php echo $user_data->first_name.' '.$user_data->last_name; ?></h4>
                   
                   <?php if($this->session->userdata('cart')): ?>
                   <a href="<?php echo site_url('customer/check_out_option'); ?>" class="btn btn-success">You have a cart to check out</a>
                   <?php endif; ?>
				   
               </div>
			</div>
			<div class="col-sm-8">
			    <h1 class="customer_profile_header" style="margin-bottom:20px">Edit My Profile <i class="fa fa-user"></i></h1>
			    <assaid class="customer_profile_info">
					<?php echo form_open('customer/change_password'); ?>
						<div class="form-group row">
							<label for="password" class="col-sm-3 col-form-label">New Password</label>
							<div class="col-sm-9">
								<input class="form-control" id="password" placeholder="New Password" name="password" type="password"  required>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="df" class="col-sm-3 col-form-label">  </label>
							<div class="col-sm-9">
								<input type="submit" name="change_password" value="Change Password" class="btn btn-danger btn-reservation" />
								
							</div>
						</div>
                    
					</form>
			    </assaid>
			</div>
		</div>
	</div>
</section>
<?php $this->load->view('frontend/footer'); ?>