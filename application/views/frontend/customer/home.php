<?php $this->load->view('frontend/header'); ?>

<section class="home_content_section">
	<div class="container custom-padding">
		<div class="row">
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
		</div>
		<div class="row ">
			<div class="col-sm-4 text-center">
               <div class="customer_left_bar">
                    <img src="<?php echo site_url('uploads/users/'.$user_data->image); ?>" alt="" class="img-responsive img-thumbnail img-circle">
                   <h4><?php echo $user_data->first_name.' '.$user_data->last_name; ?></h4>
                   
                   <?php if($this->session->userdata('cart')): ?>
                   <a href="<?php echo site_url('customer/check_out_option'); ?>" class="btn btn-success">You have a cart to check out</a>
                   <?php endif; ?>
                   <a href="<?php echo site_url('customer/list_order'); ?>" class="btn btn-success"> <i class="fa fa-list"></i> List of oll booking </a>
               </div>
			</div>
			<div class="col-sm-8">
			    <h1 class=" customer_profile_header">My Profile <i class="fa fa-user"></i><a title="Edit Profile" href="<?php echo site_url('customer/edit_profile'); ?>" class="btn btn-danger text-right float-right"><i class="fa fa-pencil"></i></a></h1>
			    <assaid class="customer_profile_info">
			        <p><b>First Name:</b> <?php echo $user_data->first_name; ?></p>
			        <p><b>Last Name:</b> <?php echo $user_data->last_name; ?></p>
			        <p><b>User Name:</b> <?php echo $user_data->user_name; ?></p>
			        <p><b>Mobile:</b> <?php echo $user_data->phone; ?></p>
			        <p><b>NID number:</b> <?php echo $user_data->nid_number; ?></p>
			        <p><b>Passport number:</b> <?php echo $user_data->passport_number; ?></p>
			        <p><b>Email:</b> <?php echo $user_data->email; ?></p>
			        <p><b>Birthday:</b> <?php echo $user_data->birthday; ?></p>
			        <p><b>Address line 1:</b> <?php echo $user_data->address1; ?></p>
			        <p><b>Address line 2:</b> <?php echo $user_data->address2; ?></p>
			        <p><b>Country:</b> <?php echo $user_data->country; ?></p>
			        <p><b>City:</b> <?php echo $user_data->city; ?></p>
			        <p><b>State:</b> <?php echo $user_data->state; ?></p>
			        <p><b>Post code:</b> <?php echo $user_data->post_code; ?></p>
			    </assaid>
			</div>
		</div>
	</div>
</section>
<?php $this->load->view('frontend/footer'); ?>