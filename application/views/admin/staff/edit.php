<?php $this->load->view('admin/inc/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('admin/inc/sidebar'); ?>
  <?php $total_message_count = $this->user_model->new_message_count(); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Staff <a href="<?php echo site_url('admin/staff/add_new'); ?>" class="btn btn-success">Add new staff</a>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users List</li>
      </ol>
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
                <h3 class="box-title">Edit staff</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             
              <div class="col-sm-4 text-center">
               <div class="customer_left_bar">
                    <img src="<?php echo site_url('uploads/users/'.$user_data->image); ?>" alt="" class="img-responsive img-thumbnail img-circle">
                   <h4><?php echo $user_data->first_name.' '.$user_data->last_name; ?></h4>
				   
				   <div class="col-sm-12">
					   <div class="update_profile_image">
							<?php echo form_open_multipart('admin/staff/edit_photo/'.$staff_id); ?>
								<span class="simple_heading_upload_bar">215X215 Image wil upload</span>
								<div class="input-group">
									<input class="form-control" name="user_image" type="file" style="width: 100%;height: 100%;padding: 3.5px;" required>
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
			    <assaid class="customer_profile_info">
					<?php echo form_open('admin/staff/edit_staff/'.$staff_id); ?>
						<div class="form-group row">
							<label for="first_name" class="col-sm-3 col-form-label">First Name</label>
							<div class="col-sm-9">
								<input class="form-control" id="first_name" placeholder="First Name" name="first_name" type="text" value="<?php echo $user_data->first_name; ?>" required>
							</div>
						</div>
					
						<div class="form-group row">
							<label for="last_name" class="col-sm-3 col-form-label">Last Name</label>
							<div class="col-sm-9">
								<input class="form-control" id="last_name" placeholder="Last Name" name="last_name" type="text" value="<?php echo $user_data->last_name; ?>" required>
							</div>
						</div>
					
						<div class="form-group row">
							<label for="designation" class="col-sm-3 col-form-label">Designation</label>
							<div class="col-sm-9">
								<input class="form-control" id="designation" placeholder="Designation" name="designation" type="text" value="<?php echo $user_data->designation; ?>" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="salary" class="col-sm-3 col-form-label">Salary</label>
							<div class="col-sm-9">
								
								<div class="input-group">
								    <span class="input-group-addon"><?php echo $this->config->item('currency_symbol'); ?></span>
                                   <input class="form-control" id="salary" placeholder="Salary" name="salary" type="number" value="<?php echo $user_data->salary; ?>" required>
                                    <span class="input-group-addon">.00</span>
								</div>
							</div>
						</div>
			
						<div class="form-group row">
							<label for="phone" class="col-sm-3 col-form-label">Mobile</label>
							<div class="col-sm-9">
								<input class="form-control" id="phone" placeholder="Moobile Number" name="phone" type="text" value="<?php echo $user_data->phone; ?>">
							</div>
						</div>
					
						<div class="form-group row">
							<label for="nid_number" class="col-sm-3 col-form-label">NID Number</label>
							<div class="col-sm-9">
								<input class="form-control" id="nid_number" placeholder="NID number" name="nid_number" type="text" value="<?php echo $user_data->nid_number; ?>">
							</div>
						</div>
					
						<div class="form-group row">
							<label for="passport_number" class="col-sm-3 col-form-label">Passport Number</label>
							<div class="col-sm-9">
								<input class="form-control" id="passport_number" placeholder="Passport number" name="passport_number" type="text" value="<?php echo $user_data->passport_number; ?>">
							</div>
						</div>
					
						<div class="form-group row">
							<label for="email" class="col-sm-3 col-form-label">Email</label>
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
								<input class="form-control" id="address2" placeholder="Address Line 2" name="address2" type="text" value="<?php echo $user_data->address2; ?>" required>
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
							<label for="df" class="col-sm-3 col-form-label">  </label>
							<div class="col-sm-9">
								<input type="submit" name="save_staff" value="Save Changes" class="btn btn-danger btn-reservation" />
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