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
				   
				   <div class="col-sm-12">
					   <div class="update_profile_image">
							<?php echo form_open_multipart('customer/edit_photo'); ?>
								<span class="simple_heading_upload_bar">215X215 Image wil upload</span>
								<div class="input-group">
									<input class="form-control" name="profile_picture" type="file" style="height: 100%;padding: 3.5px;" required>
									<label class="input-group-btn">
										<input type="submit" value="Upload" class="btn btn-primary" />
									</label>
								</div>
							<?php echo form_close(); ?>
					   </div>
				   </div>
               </div>
			</div>
			<div class="col-sm-8">
			    <h1 class="customer_profile_header" style="margin-bottom:20px">Edit My Profile <i class="fa fa-user"></i></h1>
			    <assaid class="customer_profile_info">
					<?php echo form_open('customer/edit_profile'); ?>
						<div class="form-group row">
							<label for="first_name" class="col-sm-3 col-form-label"><small style="color:red">(<i class="fa fa-star"></i>) </small>First Name</label>
							<div class="col-sm-9">
								<input class="form-control" id="first_name" placeholder="First Name" name="first_name" type="text" value="<?php echo $user_data->first_name; ?>" required>
							</div>
						</div>
					
						<div class="form-group row">
							<label for="last_name" class="col-sm-3 col-form-label"><small style="color:red">(<i class="fa fa-star"></i>) </small>Last Name</label>
							<div class="col-sm-9">
								<input class="form-control" id="last_name" placeholder="Last Name" name="last_name" type="text" value="<?php echo $user_data->last_name; ?>" required>
							</div>
						</div>
					
						<div class="form-group row">
							<label for="inputError" class="col-sm-3 col-form-label">User Name</label>
							<div class="col-sm-9">
								<input id="inputError" class="form-control desabled"  placeholder="User Name" name="user_name" type="text" value="<?php echo $user_data->user_name; ?>" disabled >
							</div>
						</div>
					
						<div class="form-group row">
							<label for="phone" class="col-sm-3 col-form-label"><small style="color:red">(<i class="fa fa-star"></i>) </small>Mobile</label>
							<div class="col-sm-9">
								<input class="form-control" id="phone" placeholder="Moobile Number" name="phone" type="text" value="<?php echo $user_data->phone; ?>">
							</div>
						</div>
					
						<div class="form-group row">
							<label for="nid_number" class="col-sm-3 col-form-label"><small style="color:red">(<i class="fa fa-star"></i>) </small>NID number</label>
							<div class="col-sm-9">
								<input class="form-control" id="nid_number" placeholder="NID Number" name="nid_number" type="text" value="<?php echo $user_data->nid_number; ?>">
							</div>
						</div>
					
						<div class="form-group row">
							<label for="passport_number" class="col-sm-3 col-form-label"><small style="color:red">(<i class="fa fa-star"></i>) </small>Passport number</label>
							<div class="col-sm-9">
								<input class="form-control" id="passport_number" placeholder="Passport Number" name="passport_number" type="text" value="<?php echo $user_data->passport_number; ?>">
							</div>
						</div>
					
						<div class="form-group row">
							<label for="email" class="col-sm-3 col-form-label"><small style="color:red">(<i class="fa fa-star"></i>) </small>Email</label>
							<div class="col-sm-9">
								<input class="form-control" id="email" placeholder="User Email" name="email" type="email" value="<?php echo $user_data->email; ?>" required>
							</div>
						</div>
					
						<div class="form-group row">
							<label for="birthday" class="col-sm-3 col-form-label">Birthday</label>
							<div class="col-sm-9">
								<input class="form-control" id="birthday" placeholder="User Birthday" name="birthday" type="text" value="<?php echo $user_data->birthday; ?>" data-date-format="dd/mm/yyyy">
							</div>
						</div>
						
					
						<div class="form-group row">
							<label for="address1" class="col-sm-3 col-form-label">Address line 1</label>
							<div class="col-sm-9">
								<input class="form-control" id="address1" placeholder="Address Line 1" name="address1" type="text" value="<?php echo $user_data->address1; ?>" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="address2" class="col-sm-3 col-form-label">Address line 2</label>
							<div class="col-sm-9">
								<input class="form-control" id="address2" placeholder="Address Line 1" name="address2" type="text" value="<?php echo $user_data->address1; ?>" required>
							</div>
						</div>
					
						<div class="form-group row">
							<label for="country" class="col-sm-3 col-form-label">Country </label>
							<div class="col-sm-9">
								<input class="form-control" id="country" placeholder="Country" name="country" type="text" value="<?php echo $user_data->country; ?>" required>
							</div>
						</div>
					
						<div class="form-group row">
							<label for="city" class="col-sm-3 col-form-label">City </label>
							<div class="col-sm-9">
								<input class="form-control" id="city" placeholder="city" name="city" type="text" value="<?php echo $user_data->city; ?>" required>
							</div>
						</div>
					
						<div class="form-group row">
							<label for="state" class="col-sm-3 col-form-label">State </label>
							<div class="col-sm-9">
								<input class="form-control" id="state" placeholder="State" name="state" type="text" value="<?php echo $user_data->state; ?>" required>
							</div>
						</div>
					
						<div class="form-group row">
							<label for="post_code" class="col-sm-3 col-form-label">Post Code </label>
							<div class="col-sm-9">
								<input class="form-control" id="post_code" placeholder="Post Code" name="post_code" type="text" value="<?php echo $user_data->post_code; ?>" required>
							</div>
						</div>
					
						<div class="form-group row">
							<label for="df" class="col-sm-3 col-form-label">  </label>
							<div class="col-sm-9">
								<input type="submit" name="save_profile" value="Save Changes" class="btn btn-danger btn-reservation" />
								<a href="<?php echo site_url('customer/change_password'); ?>" class="btn btn-success "> <i class="fa fa-edit"></i> Change Password</a>
							</div>
						</div>
                    
					<?php echo form_close(); ?>
			    </assaid>
			</div>
		</div>
	</div>
</section>
<?php $this->load->view('frontend/footer'); ?>