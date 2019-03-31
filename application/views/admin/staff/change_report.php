<?php $this->load->view('admin/inc/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('admin/inc/sidebar'); ?>
  <?php $total_message_count = $this->user_model->new_message_count(); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $staff->first_name.' '.$staff->last_name ?> Salary report of <?php echo $this->staff_model->get_fullmonth($month).', '.$year; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
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
                <h3 class="box-title">Chnage Stuff salary Status <a href="<?php echo site_url('admin/staff/report/'.$year); ?>" class="btn btn btn-sm btn-success"><i class="fa fa-arrow-left"></i> Back to report</a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             
			<div class="col-sm-8">
			    <assaid class="customer_profile_info">
					<?php echo form_open('admin/staff/change_report/'.$staff->id.'/'.$year.'/'.$month); ?>
						<div class="form-group row">
							<label for="advance" class="col-sm-3 col-form-label">Advanced</label>
							<div class="col-sm-9">
								<div class="input-group">
								    <span class="input-group-addon"><?php echo $this->config->item('currency_symbol'); ?></span>
                                   <input class="form-control" id="advance" placeholder="Advanced" name="advance" type="number" value="<?php if($staff_salary_status and $staff_salary_status->advance)echo $staff_salary_status->advance; ?>">
                                    <span class="input-group-addon">.00</span>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="status" class="col-sm-3 col-form-label">Status</label>
							<div class="col-sm-9">
							    <select name="status" id="status" class="form-control" required>
							        <option value="Unpaid"> Unpaid</option>
							        <option value="Paid" <?php if($staff_salary_status and $staff_salary_status->status=='Paid'){echo 'selected';} ?>>Paid</option>
							    </select>
							</div>
						</div>

					
						<div class="form-group row">
							<label for="sign_up" class="col-sm-3 col-form-label">        </label>
							<div class="col-sm-9">
							    <input name="change_staff_report" value="Change Report" class="btn btn-primary btn-reservation" type="submit">
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