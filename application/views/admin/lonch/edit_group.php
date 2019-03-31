<?php $this->load->view('admin/inc/header'); ?>
<!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('admin/inc/sidebar'); ?>
<?php $total_message_count = $this->user_model->new_message_count(); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>Edit group</h1>
			<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Edit Group</li>
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
				<div class="box-header with-border"><h3 class="box-title">Edit group</h3></div><!-- /.box-header -->
				<div class="box-body">
					<div class="col-sm-8">
						<assaid class="customer_profile_info">
							<?php if($group){ echo form_open_multipart('admin/lonch/edit_group/'.$group->id); ?>
								<div class="form-group row">
									<label for="owner_id" class="col-sm-3 col-form-label">Owner</label>
									<div class="col-sm-9">
										<select name="owner_id" id="owner_id" class="form-control" required>
											<option value="">Select owner....</option>
											<?php 
												$owner_list = $this->user_model->get_all_user('owner');
												if($owner_list){
													foreach($owner_list as $owner){
														$selected=null;
														if($group->owner_id==$owner->id){
															$selected="selected";
														}else{
															$selected=null;
														}
														echo '<option value="'.$owner->id.'" '.$selected.'>'.$owner->first_name.' '.$owner->last_name.'</option>';
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="group_name" class="col-sm-3 col-form-label">Group Name(Bangla)</label>
									<div class="col-sm-9">
										<input class="form-control" id="group_name" placeholder="Group Name in bangla" name="group_name" type="text" value="<?php echo $group->group_name; ?>" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="group_name" class="col-sm-3 col-form-label">Group Name(English)</label>
									<div class="col-sm-9">
										<input class="form-control" id="group_name_eng" placeholder="Group Name in english" name="group_name_eng" type="text" value="<?php echo $group->group_name_eng; ?>" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="group_description" class="col-sm-3 col-form-label">Group Description(Bangla)</label>
									<div class="col-sm-9">
										<input class="form-control" id="group_description" placeholder="Group Descripton in bangla" name="group_description" type="text" value="<?php echo $group->group_description; ?>" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="group_description" class="col-sm-3 col-form-label">Group Description(English)</label>
									<div class="col-sm-9">
										<input class="form-control" id="group_description_eng" placeholder="Group Descripton in english" name="group_description_eng" type="text" value="<?php echo $group->group_description_eng; ?>" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="group_picture" class="col-sm-3 col-form-label">Group Picture</label>
									<div class="col-sm-9">
										<input type="file" class="form-control" id="group_picture" placeholder="Group Picture" name="group_picture" style="margin:0;padding:0">
									</div>
								</div>
								<div class="form-group row">
									<label for="sign_up" class="col-sm-3 col-form-label">        </label>
									<div class="col-sm-9">
										<input name="lonch_group" value="Save Lonch Group" class="btn btn-primary btn-reservation" type="submit">
									</div>
								</div>
							<?php echo form_close(); } ?>
						</assaid>
					</div>
					<div class="col-sm-4"><img src="<?php echo site_url('uploads/lonch-group/'.$group->group_picture); ?>" alt="" class="img-responsive"></div>
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
                <h3 class="box-title">Lonch</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <?php if($all_lonch): ?>
			<div class="col-sm-12">
                <table class="table table-bordered">
                    <thead bgcolor="#90EE90">
					  <th align="center">Picture</th>
                      <th align="center">Title</th>
                      <th align="center">Group</th>
					  <th align="center">Owner</th>
                      <th align="center">Action</th>
					</thead>
					<tbody>
                    <?php 
						//print_r($all_lonch);exit;
						foreach($all_lonch as $lonch):  
					?>
								<tr align="center">
									<td style="max-width:100px"><a href="<?php echo site_url('admin/lonch/edit_lonch/'.$lonch->id); ?>"><img src="<?php echo site_url('uploads/lonch/'.$lonch->picture); ?>" alt="" class="img-responsive" style="width:80px"></a></td>
									<td><a href="<?php echo site_url('admin/lonch/edit_lonch/'.$lonch->id); ?>"><?php echo $lonch->lonch_name; ?></a></td>
									<td><?php $group = $this->lonch_model->get_group($lonch->group_id); if($group){echo $group->group_name;}else{echo 'Group Deleted';} ?></td>

									<td>
										<?php 
											$user = $this->user_model->get_user($lonch->owner_id);
											if($user){ echo $user->first_name.' '.$user->last_name; }else{echo 'No owner found';}
										?>
									</td>

									<td>
										<div class="btn-group">
											<a href="<?php echo site_url('admin/lonch/edit_group/'.$group->id.'/'.$lonch->id); ?>" class="btn btn-success"><i class="fa fa-pencil-square-o">Check</i></a>
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
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Schedules</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <?php if($lonch_floors): ?>
			<div class="col-sm-12"><?php $this->load->view('admin/lonch/lonch_floor_cabin_plan'); ?></div>
			<div class="col-sm-12">
                <table class="table table-bordered">
                    <tbody>
                    <tr bgcolor="#90EE90">
						<th align="center">Transaction</th>
						<th align="center">Schedule</th>
						<th align="center">Total Cabin</th>
						<th align="center">Price</th>
                    </tr>
                    <?php 
						//print_r($lonch_floors);exit; 
						$count=1; 
						foreach($lonch_floors as $floor):  
							if($count<count($lonch_floors)){
					?>
								<tr align="center">
									<td><?php echo $floor['t_type']; ?></td>
									<td><?php echo $floor['schedule']; ?></td>
									<td><?php echo $floor['cabin']; ?></td>
									<td><?php echo $floor['actual'].$this->config->item('currency_symbol'); ?></td>
									<!--<td><?php //echo $floor['sells'].$this->config->item('currency_symbol'); ?></td>
									<td><?php //echo $floor['commission'].$this->config->item('currency_symbol'); ?></td>
									<td><?php //echo $floor['cabin'];?></td>
									<td><a href="" schedule-id="<?php //echo $floor['id']; ?>" floor-id="<?//=$floor['id']?>" floor-name="<?//=$floor['floor_name']?>" lonch-id="<?//=$lonch_id?>" floor-cabin="<?//=$floor['cabin']?>" cabin-view="group" data-toggle="modal" data-target="#cabin_plan" class="btn btn-success set_floor_plan"><i class="fa fa-map-o"> </i> Cabin Plan</a></td>-->
								</tr>	
                    <?php 
							$count++; 
							}else{ 
					?>
								<tr bgcolor="#90EE90" align="center">
									<td colspan="2"><strong><?php echo $floor['schedule']; ?></strong></td>
									<td><strong><?php echo $floor['cabin'];?></strong></td>
									<td><strong><?php echo $floor['actual'].$this->config->item('currency_symbol'); ?></strong></td>
									<!--<td><strong><?php //echo $floor['sells'].$this->config->item('currency_symbol'); ?></strong></td>
									<td><strong><?php //echo $floor['commission'].$this->config->item('currency_symbol'); ?></strong></td>
									-->
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
	</section>
	<!-- /.content -->
</div>
<?php $this->load->view('admin/inc/footer'); ?>