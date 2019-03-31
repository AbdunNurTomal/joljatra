<?php $this->load->view('admin/inc/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('admin/inc/sidebar'); ?>
  <?php $total_message_count = $this->user_model->new_message_count(); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add new group 
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add new Group</li>
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
                <h3 class="box-title">Add new group</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             
			<div class="col-sm-8">
			    <assaid class="customer_profile_info">
					<?php echo form_open_multipart('admin/lonch/add_new_lonch'); ?>
						<div class="form-group row">
                            <label for="owner_id" class="col-sm-3 col-form-label">Owner</label>
                            <div class="col-sm-9">
                                <select name="owner_id" id="owner_id" class="form-control" required>
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
                            <label for="group_id" class="col-sm-3 col-form-label">Group</label>
                            <div class="col-sm-9">
                                <select name="group_id" id="group_id" class="form-control" required>
                                    <option value="">Select Group....</option>
                                    <?php
                                    if($lonch_groups){foreach($lonch_groups as $group){
                                        echo '<option value="'.$group->id.'">'.$group->group_name.'</option>';
                                    }}
                                    ?>
                                </select>
                            </div>
                        </div>
					
						<div class="form-group row">
							<label for="lonch_name" class="col-sm-3 col-form-label">Lonch Name(Bangla)</label>
							<div class="col-sm-9">
								<input class="form-control" id="lonch_name" placeholder="Lonch Name in bangla" name="lonch_name" type="text" value="<?php echo $this->input->post('lonch_name'); ?>" required>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="lonch_name" class="col-sm-3 col-form-label">Lonch Name(English)</label>
							<div class="col-sm-9">
								<input class="form-control" id="lonch_name_eng" placeholder="Lonch Name in english" name="lonch_name_eng" type="text" value="<?php echo $this->input->post('lonch_name_eng'); ?>" required>
							</div>
						</div>
					
						<div class="form-group row">
							<label for="cabin" class="col-sm-3 col-form-label">Total Cabin</label>
							<div class="col-sm-9">
								<input class="form-control" id="cabin" placeholder="Total Cabin" name="cabin" type="number" value="<?php echo $this->input->post('cabin'); ?>" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="lonch_picture" class="col-sm-3 col-form-label">Lonch picture</label>
							<div class="col-sm-9">
							    <input type="file" class="form-control" id="lonch_picture" placeholder="Lonch Picture" name="lonch_picture" style="margin:0;padding:0">
							</div>
						</div>
					
					
					
						<div class="form-group row">
							<label for="sign_up" class="col-sm-3 col-form-label">        </label>
							<div class="col-sm-9">
							    <input name="new_lonch" value="Save Lonch Group" class="btn btn-primary btn-reservation" type="submit">
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