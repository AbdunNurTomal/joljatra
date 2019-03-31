<?php $this->load->view('admin/inc/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('admin/inc/sidebar'); ?>
  <?php $total_message_count = $this->user_model->new_message_count(); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add new staff 
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add new staff</li>
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
                <h3 class="box-title">Add new staff</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             
			<div class="col-sm-8">
			    <assaid class="customer_profile_info">
					<?php echo form_open('admin/staff/add_new'); ?>
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
							<label for="designation" class="col-sm-3 col-form-label">Designation</label>
							<div class="col-sm-9">
								<input class="form-control" id="designation" placeholder="Designation" name="designation" type="text" value="<?php echo $this->input->post('designation'); ?>" required>
							</div>
						</div>
					
		
					
						<div class="form-group row">
							<label for="salary" class="col-sm-3 col-form-label">Salary</label>
							<div class="col-sm-9">
								
								<div class="input-group">
								    <span class="input-group-addon"><?php echo $this->config->item('currency_symbol'); ?></span>
                                   <input class="form-control" id="salary" placeholder="Salary" name="salary" type="number" value="<?php echo $this->input->post('salary'); ?>" required>
                                    <span class="input-group-addon">.00</span>
								</div>
							</div>
						</div>
                    
					   
					
						<div class="form-group row">
							<label for="email" class="col-sm-3 col-form-label">Email</label>
							<div class="col-sm-9">
								<input class="form-control" id="email" placeholder="User Email" name="email" type="email" value="<?php echo $this->input->post('email'); ?>" required>
							</div>
						</div>
					

					
						<div class="form-group row">
							<label for="sign_up" class="col-sm-3 col-form-label">        </label>
							<div class="col-sm-9">
							    <input name="save_staff" value="Save Staff" class="btn btn-primary btn-reservation" type="submit">
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