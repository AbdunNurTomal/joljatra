<?php $this->load->view('admin/inc/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('admin/inc/sidebar'); ?>
  <?php $total_message_count = $this->user_model->new_message_count(); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add new user 
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add new user</li>
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
                <h3 class="box-title">Add new user</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             
			<div class="col-sm-8">
			    <assaid class="customer_profile_info">
					<?php echo form_open('admin/users/add_new'); ?>
						<div class="form-group row">
							<label for="first_name" class="col-sm-3 col-form-label">First Name</label>
							<div class="col-sm-9">
								<input class="form-control" id="first_name" placeholder="First Name" name="first_name" type="text" value="<?php echo $this->input->post('first_name'); ?>" required>
							</div>
						</div>
					
						<div class="form-group row">
							<label for="last_name" class="col-sm-3 col-form-label">Last Name</label>
							<div class="col-sm-9">
								<input class="form-control" id="last_name" placeholder="Last Name" name="last_name" type="text" value="<?php echo $this->input->post('last_name'); ?>" required>
							</div>
						</div>
					
						<div class="form-group row">
							<label for="user_name" class="col-sm-3 col-form-label">User Name</label>
							<div class="col-sm-9">
								<input class="form-control" id="user_name" placeholder="User Name" name="user_name" type="text" value="<?php echo $this->input->post('user_name'); ?>" required>
							</div>
						</div>
					
						<div class="form-group row">
							<label for="email" class="col-sm-3 col-form-label">Email</label>
							<div class="col-sm-9">
								<input class="form-control" id="email" placeholder="User Email" name="email" type="email" value="<?php echo $this->input->post('email'); ?>" required>
							</div>
						</div>
					
						<div class="form-group row">
							<label for="type" class="col-sm-3 col-form-label">Type</label>
							<div class="col-sm-9">
							    <select name="type" id="type" class="form-control user_type" required>
							        <option value="">Select type....</option>
							        
							        
							        <option value="owner" <?php if($this->input->post('type') and $this->input->post('type')=='owner'){echo 'selected';} ?> > Owner</option>
							        
							        <option value="manager" <?php if($this->input->post('type') and $this->input->post('type')=='manager'){echo 'selected';} ?> >Manager</option>
							        
							        <option value="passenger" <?php if($this->input->post('type') and $this->input->post('type')=='passenger'){echo 'selected';} ?> >User</option>
							    </select>
							</div>
						</div>
					
						<div class="display_for_manager active" style="display:none">
						  <div class="form-group row">
                                <label for="owner_id" class="col-sm-3 col-form-label">Manager Of</label>
                                <div class="col-sm-9">
                                    <select name="owner_id" id="owner_id" class="form-control owner_id">
                                        <option value="">Select owner....</option>
                                        <?php 
                                        $owner_list = $this->user_model->get_all_user('owner');
                                        if($owner_list){foreach($owner_list as $owner){
                                            echo '<option value="'.$owner->id.'">'.$owner->first_name.' '.$owner->last_name.'</option>';
                                        }}
                                        ?>
                                    </select>
                                </div>
                            </div>
						  <div class="form-group row">
                                <label for="lonch_id" class="col-sm-3 col-form-label">Lonch</label>
                                <div class="col-sm-9">
                                    <select name="lonch_id" id="lonch_id" class="form-control lonch_id">
                                        <option value="">Select lonch....</option>
                                       
                                    </select>
                                </div>
                            </div>
						</div>
						
						<div class="form-group row">
							<label for="password" class="col-sm-3 col-form-label">Password</label>
							<div class="col-sm-9">
								<input class="form-control" id="password" placeholder="User Password" name="password" type="password" value="<?php echo $this->input->post('password'); ?>" required>
							</div>
						</div>
					
						<div class="form-group row">
							<label for="sign_up" class="col-sm-3 col-form-label">        </label>
							<div class="col-sm-9">
							    <input name="sign_up" value="Save User" class="btn btn-primary btn-reservation" type="submit">
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