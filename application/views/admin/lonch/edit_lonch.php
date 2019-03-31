<?php $this->load->view('admin/inc/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('admin/inc/sidebar'); ?>
  <?php $total_message_count = $this->user_model->new_message_count(); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Add lonch details</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Lonch</li>
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
                <h3 class="box-title">Edit Lonch</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <?php if($lonch): ?>
			<div class="col-sm-8">
			    <assaid class="customer_profile_info">
					<?php echo form_open_multipart('admin/lonch/edit_lonch/'.$lonch->id); ?>
						<div class="form-group row">
                            <label for="owner_id" class="col-sm-3 col-form-label">Owner</label>
                            <div class="col-sm-9">
                                <select name="owner_id" id="owner_id" class="form-control" required>
                                    <option value="">Select owner....</option>
                                    <?php 
                                    $active_owner=null;
                                    $owner_list = $this->user_model->get_all_user('owner');
                                    if($owner_list){foreach($owner_list as $owner){
                                        if($owner->id==$lonch->owner_id){ $active_owner='selected';}else{ $active_owner=null;}
                                        echo '<option value="'.$owner->id.'" '.$active_owner.'>'.$owner->first_name.' '.$owner->last_name.'</option>';
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
                                    $active_group = null;
                                    if($lonch_groups){foreach($lonch_groups as $group){
                                    if($lonch->group_id==$group->id){$active_group = 'selected';}else{$active_group = null;}
                                        echo '<option value="'.$group->id.'" '.$active_group.'>'.$group->group_name.'</option>';
                                    }}
                                    ?>
                                </select>
                            </div>
                        </div>
					
						<div class="form-group row">
							<label for="lonch_name" class="col-sm-3 col-form-label">Lonch Name(Bangla)</label>
							<div class="col-sm-9">
								<input class="form-control" id="lonch_name" placeholder="Lonch Name in bangla" name="lonch_name" type="text" value="<?php echo $lonch->lonch_name; ?>" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="lonch_name" class="col-sm-3 col-form-label">Lonch Name(English)</label>
							<div class="col-sm-9">
								<input class="form-control" id="lonch_name_eng" placeholder="Lonch Name in english" name="lonch_name_eng" type="text" value="<?php echo $lonch->lonch_name_eng; ?>" required>
							</div>
						</div>
					
						<div class="form-group row">
							<label for="cabin" class="col-sm-3 col-form-label">Total Cabin</label>
							<div class="col-sm-9">
								<input class="form-control" id="cabin" placeholder="Total Cabin" name="cabin" type="number" value="<?php echo $lonch->cabin; ?>" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="lonch_picture" class="col-sm-3 col-form-label">Lonch picture</label>
							<div class="col-sm-9">
							    <input type="file" class="form-control" id="lonch_picture" placeholder="Lonch Picture" name="lonch_picture" style="margin:0;padding:0">
							</div>
						</div>
						<div class="form-group row">
							<label for="sign_up" class="col-sm-3 col-form-label"></label>
							<div class="col-sm-9">
							    <input name="edit_lonch" value="Save Lonch Group" class="btn btn-primary btn-reservation" type="submit">
							</div>
						</div>
						
					<?php echo form_close(); ?>
			    </assaid>
			</div>
          <div class="col-sm-4">
              <img src="<?php echo site_url('uploads/lonch/'.$lonch->picture); ?>" alt="" class="img-responsive">
          </div>
           <?php endif; ?>
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
                <h3 class="box-title">Lonch Floors</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="col-sm-12">
			    <a href="" class="btn btn-success" data-toggle="modal" data-target="#add_floor" lonch-id="<?php echo $lonch->id; ?>"><i class="fa fa-plus"> </i> Add floor</a>
			    <hr>
				<?php $this->load->view('admin/lonch/lonch_floor_edit_update'); ?>
            </div>
            <?php if($lonch_floors): ?>
			<div class="col-sm-12"><?php $this->load->view('admin/lonch/lonch_floor_cabin_plan'); ?></div>
			<div class="col-sm-12">
                <table class="table table-bordered">
                    <tbody>
                    <tr bgcolor="#90EE90">
					  <th align="center">Schedule</th>
                      <th align="center">Floor Name</th>
                      <th align="center">Actual Price</th>
					  <th align="center">Sells Price</th>
					  <th align="center">Commission</th>
                      <th align="center">Total Cabin</th>
					  <th align="center">PLAN</th>
                      <th align="center">Action</th>
                    </tr>
                    <?php 
						//echo count($lonch_floors);exit; 
						$count=1; 
						foreach($lonch_floors as $floor):  
							if($count<count($lonch_floors)){
					?>
								<tr align="center">
									<td><?php echo $floor['schedule']; ?></td>
									<td><?php echo $floor['floor_name']; ?></td>
									<td><?php echo $floor['actual'].$this->config->item('currency_symbol'); ?></td>
									<td><?php echo $floor['sells'].$this->config->item('currency_symbol'); ?></td>
									<td><?php echo $floor['commission'].$this->config->item('currency_symbol'); ?></td>
									<td><?php echo $floor['cabin'];?></td>
									<td><a href="" schedule-id="<?php echo $floor['id']; ?>" floor-id="<?php echo $floor['id']; ?>" floor-name="<?php echo $floor['floor_name']; ?>" lonch-id="<?php echo $lonch->id; ?>" floor-cabin="<?php echo $floor['cabin']; ?>" cabin-view="lonch" data-toggle="modal" data-target="#cabin_plan" class="btn btn-success set_floor_plan"><i class="fa fa-map-o"> </i> Cabin Plan</a></td>
									<td>
									<div class="btn-group">
										<a href="#" target-url="<?php echo site_url('admin/lonch/edit_lonch_floor/'.$lonch->id.'/'.$floor['id'].'/'.$floor['floor_name']); ?>" floor-id="<?php echo $floor['id']; ?>" schedule-id="<?php echo $floor['id']; ?>" floor-name="<?php echo $floor['floor_name']; ?>" cabin-total="<?php echo $floor['cabin']; ?>" class="btn btn-success edit_floor" data-toggle="modal" data-target="#edit_floor_model" ><i class="fa fa-pencil-square-o"></i></a>
										<a href="<?php echo site_url('admin/lonch/delete_lonch_floor/'.$lonch->id.'/'.$floor['id'].'/'.$floor['floor_name']); ?>" class="btn btn-danger" onclick="return confirm('Are you shure...? You really want delete this lonch');"><i class="fa fa-trash"></i></a>
									</div>
									</td>
								</tr>
								
                    <?php 
							$count++; 
							}else{ 
					?>
								<tr bgcolor="#90EE90" align="center">
									<td colspan="2"><strong><?php echo $floor['floor_name']; ?></strong></td>
									<td><strong><?php echo $floor['actual'].$this->config->item('currency_symbol'); ?></strong></td>
									<td><strong><?php echo $floor['sells'].$this->config->item('currency_symbol'); ?></strong></td>
									<td><strong><?php echo $floor['commission'].$this->config->item('currency_symbol'); ?></strong></td>
									<td><strong><?php echo $floor['cabin'];?></strong></td>
									<td></td>
									<td></td>
								</tr>
					<?php
							}
						endforeach; 
					?>
					
                  </tbody>
                </table>
			</div>
           <?php endif; ?>
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
                <h3 class="box-title">Lonch Schedule</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="col-sm-12">
			    <a href="" class="btn btn-success" data-toggle="modal" data-target="#add_schedule" lonch-id="<?php echo $lonch->id; ?>"><i class="fa fa-plus"> </i> Add Schedule</a>
			    <hr>
               
               <?php $this->load->view('admin/lonch/lonch_schedule_edit_update'); ?>
               
            </div>
             <?php if($lonch_schedules): ?>
			<div class="col-sm-12">
			    
			    
			</div>
			<div class="col-sm-12">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                      <th>Day</th>
                      <th>From</th>
                      <th>To</th>
                      <th>Time</th>
                      <th>Action</th>
                    </tr>
                    <?php foreach($lonch_schedules as $schedule): ?>
                    <tr>
                     
                      <td><?php echo $schedule->day; ?></td>
                      <td><?php echo $schedule->from_destination; ?></td>
                      <td><?php echo $schedule->to_destination; ?></td>
                      <td><?php echo $schedule->time; ?></td>

                      <td>
                        <div class="btn-group">
                            <a href="#" target-url="<?php echo site_url('admin/lonch/edit_lonch_schedule/'.$lonch->id.'/'.$schedule->id); ?>" floor-id="<?php echo $schedule->id; ?>" schedule-day="<?php echo $schedule->day; ?>" schedule-from-destination="<?php echo $schedule->from_destination; ?>"  schedule-to-destination="<?php echo $schedule->to_destination; ?>" schedule-time="<?php echo $schedule->time; ?>"  class="btn btn-success edit_schedule" data-toggle="modal" data-target="#edit_schedule_model" ><i class="fa fa-pencil-square-o"></i></a>
                            <a href="<?php echo site_url('admin/lonch/delete_lonch_schedule/'.$lonch->id.'/'.$schedule->id); ?>" class="btn btn-danger" onclick="return confirm('Are you shure...? You really want delete this lonch ');"><i class="fa fa-trash"></i></a>
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

    </section>
    <!-- /.content -->
  </div>
 <?php $this->load->view('admin/inc/footer'); ?>