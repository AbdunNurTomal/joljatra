<?php $this->load->view('admin/inc/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('admin/inc/sidebar'); ?>

<div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> <i class="fa fa-file-text"></i> Offline Booking </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
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

		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				   <?php if(!isset($lonch_groups)): ?>
					<?php echo form_open('admin/booking/offline', array('method'=>'get')); ?>
						<div class="row">
						   <div class="col-sm-3">
								<div class="form-group">
								  <label for="from_destination"> From </label>
								  <select class="form-control" name="from_destination" id="from_destination" placeholder="যাত্রা শুরু" required>
									   <option value=""> Select... </option>
									  <?php if($destinations){foreach($destinations as $destination){
										$selected=null;
										if($this->input->get('from_destination')==$destination->name){
											 $selected='selected';
										}else{ $selected=null;}
										echo '<option value="'.$destination->name.'" '.$selected.'>'.$destination->name.'</option>';
									}} ?>
								  </select>
								</div>
							</div>
						   <div class="col-sm-3">
								<div class="form-group">
								  <label for="to_destination"> To </label>
								  <select name="to_destination" class="form-control" id="to_destination" placeholder="গন্ত্যব্য" required>
									  <option value=""> Select... </option>
									  <?php if($destinations){foreach($destinations as $destination){
										$selected=null;
										if($this->input->get('to_destination')==$destination->name){
											 $selected='selected';
										}else{ $selected=null;}
										echo '<option value="'.$destination->name.'" '.$selected.'>'.$destination->name.'</option>';
									}} ?>
								  </select>
								</div>
							</div>
						   <div class="col-sm-3">
								<div class="form-group">
								  <label for="journy_date"> Journey Date </label>
								  <input type="text" name="journey_date" id="journy_date" class="form-control" placeholder="11/11/2018" data-date-format="dd/mm/yyyy" value="<?php if($this->input->get('journy_date')){echo $this->input->get('journy_date');}else{echo date('d/m/Y',time());} ?>" required>
								</div>
							</div>
						   <div class="col-sm-3">
								<div class="form-group">
								  <label  class="mobile_display_none" >     </label>
								  <input type="submit" name="search_cabin_btn" value="Search Cabin" class="form-control btn btn-success search_cabin_btn" style="margin-top: 5px;">
								</div>
							</div>
						</div>

					<?php echo form_close(); ?>
					<?php endif; ?>
			</div>
        <div class="box-body">
        
        <?php if($this->input->get('search_cabin_btn')): ?>
        <div class="row">
            <div class="col-sm-12">
				<h2 class="lonch_group_list_title text-center"> লঞ্চ সমূহ </h2>

				<p class="text-center lonch_info_p"> 
				<?php echo $this->lonch_model->entobn($this->input->get('journey_date')); ?> | 
				<?php echo $this->input->get('from_destination'); ?> <i class="fa fa-arrow-right"></i> <?php echo $this->input->get('to_destination'); ?> 
				<?php if($this->input->get('group_id')){ echo ' <i class="fa fa-arrow-right"> </i> '; $group=$this->lonch_model->get_group($this->input->get('group_id')); if($group){ echo $group->group_name;} } ?></p>

				<?php if($this->input->get('lonch_id') and $this->input->get('s_id')): 
				$lonch_by_id = $this->lonch_model->get_lonch($this->input->get('lonch_id'));
				$schedule=$this->lonch_model->get_schedule_by_day_new_offline($this->input->get('lonch_id'), $day, $from_destination, $to_destination,$this->input->get('s_id')); 
				?>
				<p class="text-center lonch_info_p"><?php if($lonch_by_id){echo $lonch_by_id->lonch_name; } ?> (<small> <?php if($schedule){echo $schedule->time;} ?></small>)</p>
				<?php endif; ?>
               
                <?php if(isset($lonch_groups)): if(!$this->input->get('group_id')):?>
                <ul class="lonch_group_menu">
                    <?php foreach($lonch_groups as $group): ?>
                    <li><a href="<?php $query = http_build_query($_GET); echo site_url('admin/booking/offline?'.$query.'&group_id='.$group->id);  ?>" title="<?php echo $group->group_description; ?>"> <?php echo $group->group_name; ?> </a></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                
                <?php if($this->input->get('group_id')): ?>
                <?php if($all_lonch): ?>
                <?php if(!$this->input->get('lonch_id')): ?>
                <ul class="lonch_group_menu">
					<?php 
					foreach($all_lonch as $lonch): 
						$schedule=$this->lonch_model->get_schedules_by_day_offline($lonch->id, $day, $from_destination, $to_destination); 
						//print_r($schedule);
						if($schedule){
							foreach($schedule as $schedule){ 
                    ?>
								<li><a href="<?php $query = http_build_query($_GET); echo site_url('admin/booking/offline?'.$query.'&lonch_id='.$lonch->id.'&s_id='.$schedule->id);  ?>" title="<?php echo $lonch->lonch_name; ?>"> <?php echo $lonch->lonch_name; ?> 
									<span class="schedule"><?php if($schedule){echo $day.' '.$schedule->time;}?></span>
								</a></li>
					<?php 
							}
						} 
					endforeach; 
					?>
                </ul>
                <?php endif; ?>
                <?php endif; ?>
                
                <?php 
					if($this->input->get('lonch_id')&&$this->input->get('s_id')): 
                    $floors = $this->lonch_model->get_lonch_floors_data_new($this->input->get('lonch_id'),$this->input->get('s_id'));
					//print_r($floors);//exit;
                    if($floors and !$this->input->get('f_id')):
                ?>
                    <ul class="lonch_group_menu">
                       <?php foreach($floors as $floor): ?>
                        <li><a href="<?php $query = http_build_query($_GET); echo site_url('admin/booking/offline?'.$query.'&f_id='.$floor->id.'&f_name='.$floor->floor_name);  ?>" title="<?php echo $floor->floor_name; ?>"> <?php echo $floor->floor_name; ?>  </a></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                    <?php if($this->input->get('f_id')&&$this->input->get('f_name')): $single_floor = $this->lonch_model->get_floor_by_name_plan($this->input->get('f_id'),$this->input->get('lonch_id'),$this->input->get('f_name')); //print_r($single_floor);?>
                        <p class="text-center lonch_info_p"><?php if($single_floor){echo $single_floor->floor_name ;}  ?></p>
                    <?php endif; ?>
                <?php endif; ?>
                
                <?php endif; else: ?>
                    <h3 class="text-center" style="color: #fcbb44;">কোন লঞ্চ পাওাযায়নি </h3>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if($this->input->get('f_id')&&$this->input->get('f_name')): ?>
        <div class="row"><div class="col-sm-6 col-sm-offset-3"><?php $this->load->view('admin/booking/cabin_sit_plan'); ?></div></div>
        <?php endif; ?>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
         
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
 <?php $this->load->view('admin/inc/footer'); ?>