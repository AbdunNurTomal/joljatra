<?php $this->load->view('admin/inc/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('admin/inc/sidebar'); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Discount Rules</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Discount Rules</li>
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
<script type="text/javascript">

</script>  
     <?php $this->output->delete_cache(); ?>
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border"><h3 class="box-title">Add Rules</h3></div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="col-sm-12">
						<assaid class="customer_profile_info">
							<?php echo form_open('admin/booking/add_discount_rules', array('method'=>'get')); ?>							
							<div class="form-group row">
								<div class="col-sm-3">
									Booking Type
									<select name="transaction_type" id="transaction_type" class="form-control">
										<option value="" >Select</option>
										<option value="online" <?php if($this->input->get('transaction_type')=='online'){echo 'selected';} ?> >Online</option>
										<option value="offline" <?php if($this->input->get('transaction_type')=='offline'){echo 'selected';} ?> >Offline</option>
									</select>
								</div>
								<div class="col-sm-3">
									Travel<input class="form-control" id="travel" placeholder="travel count" name="travel" type="number" value="<?php //echo $lonch->lonch_name; ?>">
								</div>
								<div class="col-sm-3">
									Passenger phone<input class="form-control" id="passenger_phone" placeholder="passenger phone" name="passenger_phone" type="number" value="<?php //echo $lonch->cabin; ?>" >
								</div>
								<div class="col-sm-3">
									Percentage<input class="form-control" id="discount_percent" placeholder="%" name="discount_percent" type="number" value="<?php //echo $lonch->cabin; ?>" required>
								</div>
							</div>	
							
							<div class="form-group row">
								<div class="col-sm-3">
									Group Name
									<select name="group" id="group" class="form-control group">
										<option value="" selected>Select group....</option>
										<?php 
										$group_list = $this->lonch_model->lonch_groups();
										if($group_list){
											foreach($group_list as $group){
												echo '<option value="'.$group->id.'">'.$group->group_name.'</option>';
											}
										}
										?>
									</select>
								</div>
								<div class="col-sm-3">
									Lonch Name
									<select name="lonch" id="lonch" class="form-control lonch">
										<option value="">Select lonch....</option>
										<?php 
										$lonch_list = $this->lonch_model->all_lonch();
										if($lonch_list){
											foreach($lonch_list as $lonch){
												echo '<option value="'.$lonch->id.'">'.$lonch->lonch_name.'</option>';
											}
										}
										?>
									</select>
								</div>
								<div class="col-sm-3">
									Schedule
									<select name="schedule" id="schedule" class="form-control schedule">
										<option value="" selected>Select schedule....</option>
									</select>
								</div>
								<div class="col-sm-3">
									Floor Name
									<select name="floor" id="floor" class="form-control floor">
										<option value="">Select floor....</option>
									</select>
								</div>
							</div>
										
							<div class="form-group row">
								<div class="col-sm-6">
									Journey Date from<input type="text" name="from_date" id="from_date" class="form-control" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" value="">
								</div>
								<div class="col-sm-6">
									to<input type="text" name="to_date" id="to_date" class="form-control" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" value="">
								</div>
							</div>
							<div class="col-sm-3"></br>
								<input name="save_rules" value="Save Rules" class="btn btn-primary btn-reservation" type="submit">
							</div>							
							<?php echo form_close(); ?>
						</assaid>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.row (main row) -->
	<!-- Small boxes (Stat box) -->
      <div class="row">
      <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">All Discount Rules</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!--<div class="col-sm-12">
			    <a href="" class="btn btn-success" data-toggle="modal" data-target="#add_schedule" lonch-id="<?php //echo $lonch->id; ?>"><i class="fa fa-plus"> </i> Add Schedule</a>
			    <hr><?php //$this->load->view('admin/lonch/lonch_schedule_edit_update'); ?>
            </div>-->
            <?php if($discount_data):?>
			<div class="col-sm-12"></div>
			<div class="col-sm-12">
                <table class="table table-bordered">
					<thead>
						<tr bgcolor="#90EE90">
							<th>Type</th>
							<th>From</th>
							<th>to</th>
							<th>Group</th>
							<th>Lonch</th>
							<th>Schedule</th>
							<th>Floor</th>
							<th>Travel</th>
							<th>Passenger</br>Phone</th>
							<th>%</th>
							<th>Created</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
                    <?php foreach($discount_data as $discount): $dfloor='floor';?>
                    <tr>
                      <td><?php echo $discount->transaction_type; ?></td>
					  <td><?php echo $discount->journey_from_date; ?></td>
                      <td><?php echo $discount->journey_to_date; ?></td>
					  <td><?php if($discount->group_id!=0){$group = $this->lonch_model->get_group($discount->group_id);echo $group->group_name;}else{echo'';} ?></td>
					  <td><?php if($discount->lonch_id!=0){$lonch = $this->lonch_model->get_lonch($discount->lonch_id);echo $lonch->lonch_name;}else{echo'';} ?></td>
					  <td><?php if(($discount->lonch_id!=0)&&($discount->schedule_id!=0)){$schedule = $this->lonch_model->get_lonch_schedule_name($discount->schedule_id,$discount->lonch_id);echo $schedule;$data_floor = $this->lonch_model->get_lonch_floors_name_data($discount->lonch_id,$discount->schedule_id);}else{echo'';$dfloor='';} ?></td>
					  <td><?php if($dfloor!=''){echo $data_floor->floor_name;}else{ echo '';} ?></td>
					  <td><?php echo $discount->travel; ?></td>
					  <td><?php if($discount->p_phone!=''){echo $discount->p_phone;}else{$discount->p_phone='0';} ?></td>
					  <td><?php echo $discount->percentage; ?></td>
                     
                      <td><?php $date=explode(' ',$discount->create_date);echo $date[0]; ?></td>

                      <td>
                        <div class="btn-group">
                            <a href="<?php echo site_url('admin/booking/search_passenger_for_rules/'.$discount->transaction_type.'/'.$discount->group_id.'/'.$discount->lonch_id.'/'.$discount->schedule_id.'/'.$discount->floor_id.'/'.$discount->travel.'/'.$discount->p_id.'/'.$discount->p_phone.'/'.$discount->percentage.'/'.$discount->journey_from_date.'/'.$discount->journey_to_date); ?>" class="btn btn-success" ><i class="fa fa-search"></i></a>
                            <a href="<?php echo site_url('admin/booking/delete_discount_rules/'.$discount->id); ?>" class="btn btn-danger" onclick="return confirm('Are you shure...? You really want delete this lonch ');"><i class="fa fa-trash"></i></a>
                        </div>
                      </td>
                    </tr>
                    <?php endforeach; ?>
					</tbody>
                </table>
			</div>
           <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row (main row) --> 
        <!-- /.box-body -->
      <!-- /.box -->

    </section>
    <!-- /.content -->
	 </div>
 <?php $this->load->view('admin/inc/footer'); ?>