<?php 
	$this->load->view('frontend/header'); 
	
	if($this->session->userdata('online_booking_set_min') !== TRUE){
		$online_booking_set_min = date('Y-m-d H:i:s');
		$this->session->set_userdata('online_booking_set_min',$online_booking_set_min);
	}
		
	//echo $this->session->userdata('online_booking_set_min').' ~ '.$this->session->userdata('online_booking_last_min');
	
	if($this->session->userdata('online_booking_set_min')>$this->session->userdata('online_booking_last_min')){
		redirect('cabin');
	}
?>

<section class="date_and_destination_section">
    <div class="container">
       
		<div class="row">
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
       </div>
        
        <?php if(!isset($lonch_groups)): ?>
        <div class="row">
            <div class="col-sm-12">
                <h3 class="form_title"><?=$this->lang->line('body_cabin_booking')?> </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?php echo form_open('cabin/find', array('method'=>'get')); ?>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="from_destination"> <?=$this->lang->line('body_start_journey')?> </label>
                                <select class="form-control" name="from_destination" id="from_destination" placeholder="<?=$this->lang->line('body_start_journey')?>" required>
									<option value=""> <?=$this->lang->line('body_selection')?> </option>
									<?php 
										if(isset($destinations)&&($this->session->userdata('site_lang')=='bd')){
											foreach($destinations as $destination){
												$selected=null;
												if($this->input->get('from_destination')==$destination->name){ $selected='selected'; }else{ $selected=null;}
												echo '<option value="'.$destination->name.'" '.$selected.'>'.$destination->name.'</option>';
											}
										}else if(isset($destinations)&&($this->session->userdata('site_lang')=='en')){
											foreach($destinations as $destination){
												$selected=null;
												if($this->input->get('from_destination')==$destination->name_eng){ $selected='selected'; }else{ $selected=null;}
												echo '<option value="'.$destination->name_eng.'" '.$selected.'>'.$destination->name_eng.'</option>';
											}
										}
									?>
                                </select>
                            </div>
                        </div>
						<div class="col-sm-3">
                            <div class="form-group">
								<label for="to_destination"> <?=$this->lang->line('body_destination')?> </label>
								<select name="to_destination" class="form-control" id="to_destination" placeholder="<?=$this->lang->line('body_destination')?>" required>
									<option value=""> <?=$this->lang->line('body_selection')?> </option>
									<?php 
										if(isset($destinations)&&($this->session->userdata('site_lang')=='bd')){
											foreach($destinations as $destination){
												$selected=null;
												if($this->input->get('to_destination')==$destination->name){ $selected='selected'; }else{ $selected=null;}
												echo '<option value="'.$destination->name.'" '.$selected.'>'.$destination->name.'</option>';
											}
										}else if(isset($destinations)&&($this->session->userdata('site_lang')=='en')){
											foreach($destinations as $destination){
												$selected=null;
												if($this->input->get('to_destination')==$destination->name_eng){ $selected='selected'; }else{ $selected=null;}
												echo '<option value="'.$destination->name_eng.'" '.$selected.'>'.$destination->name_eng.'</option>';
											}
										}
									?>
								</select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
								<label for="journy_date"> <?=$this->lang->line('body_journey_date')?> </label>
								<input type="text" name="journey_date" id="journy_date" class="form-control" placeholder="<?=$this->lang->line('body_journey_date_1')?>" data-date-format="dd/mm/yyyy" value="<?php if($this->input->get('journy_date')){echo $this->input->get('journy_date');}else{echo date('d/m/Y',time());} ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
								<label class="mobile_display_none" >     </label>
								<input type="submit" name="search_cabin_btn" value="<?=$this->lang->line('body_cabin_search')?>" class="form-control btn btn-success search_cabin_btn">
                            </div>
                        </div>
                    </div>

                <?php echo form_close(); ?>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if($this->input->get('search_cabin_btn')): ?>
        <div class="row">
            <div class="col-sm-12">
                <h2 class="lonch_group_list_title"><?=$this->lang->line('body_item_launches')?></h2>
                
               <p class="text-center lonch_info_p"> 
               <?php if($this->session->userdata('site_lang')=='bd'){ echo $this->lonch_model->entobn($this->input->get('journey_date')); }else if($this->session->userdata('site_lang')=='en'){ echo $this->input->get('journey_date'); }?> | 
			   <?php echo $this->input->get('from_destination'); ?> <i class="fa fa-arrow-right"></i> <?php echo $this->input->get('to_destination'); ?> 
			   
               <?php if($this->input->get('group_id')){ echo ' <i class="fa fa-arrow-right"> </i> '; $group=$this->lonch_model->get_group($this->input->get('group_id')); if($group){ if($this->session->userdata('site_lang')=='bd'){ echo $group->group_name; }else if($this->session->userdata('site_lang')=='en'){ echo $group->group_name_eng; }} } ?></p>
               
               <?php if($this->input->get('lonch_id') and $this->input->get('s_id')): 
                $lonch_by_id = $this->lonch_model->get_lonch($this->input->get('lonch_id'));
				//print_r($lonch_by_id);
                $schedule=$this->lonch_model->get_schedule_by_day_new($this->input->get('lonch_id'), $day, $from_destination, $to_destination,$this->input->get('s_id')); 
                //print_r($schedule);exit;
				?>
               <p class="text-center lonch_info_p"><?php if($lonch_by_id){ if($this->session->userdata('site_lang')=='bd'){ echo $lonch_by_id->lonch_name; }else if($this->session->userdata('site_lang')=='en'){ echo $lonch_by_id->lonch_name_eng; } } ?> (<small> <?php if($schedule){echo $schedule->time;} ?></small>)</p>
               <?php endif; ?>
               
                <?php if(isset($lonch_groups)): if(!$this->input->get('group_id')):?>
                <ul class="lonch_group_menu">
                   <?php foreach($lonch_groups as $group): ?>
                    <li><a href="<?php $query = http_build_query($_GET); echo site_url('cabin/find?'.$query.'&group_id='.$group->id);  ?>" title="<?php if($this->session->userdata('site_lang')=='bd'){ echo $group->group_description; }else if($this->session->userdata('site_lang')=='en'){ echo $group->group_description_eng; } ?>"> <?php if($this->session->userdata('site_lang')=='bd'){ echo $group->group_name; }else if($this->session->userdata('site_lang')=='en'){ echo $group->group_name_eng; }?> </a></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                
                <?php if($this->input->get('group_id')): ?>
                <?php if($all_lonch): ?>
                <?php if(!$this->input->get('lonch_id')): ?>
                <ul class="lonch_group_menu">
                   <?php 
					//print_r($all_lonch);
					foreach($all_lonch as $lonch): 
						$schedule=$this->lonch_model->get_schedules_by_day($lonch->id, $day, $from_destination, $to_destination); 
						//print_r($schedule);
						if($schedule){
							foreach($schedule as $schedule){ 
					?>
								<li><a href="<?php $query = http_build_query($_GET); echo site_url('cabin/find?'.$query.'&lonch_id='.$lonch->id.'&s_id='.$schedule->id);  ?>" title="<?php if($this->session->userdata('site_lang')=='bd'){ echo $lonch->lonch_name; }else if($this->session->userdata('site_lang')=='en'){ echo $lonch->lonch_name_eng; } ?>"> 
									<?php if($this->session->userdata('site_lang')=='bd'){ echo $lonch->lonch_name; }else if($this->session->userdata('site_lang')=='en'){ echo $lonch->lonch_name_eng; } ?> 
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
					if($this->input->get('lonch_id')&&$this->input->get('s_id') and ($time_diff==true)): 
						$floors = $this->lonch_model->get_lonch_floors_data_new($this->input->get('lonch_id'),$this->input->get('s_id'));
						//print_r($floors);exit;
						if($floors and !$this->input->get('f_id') and ($time_diff==true)):
                ?>
						<ul class="lonch_group_menu">
						   <?php foreach($floors as $floor): ?>
							<li><a href="<?php $query = http_build_query($_GET); echo site_url('cabin/find?'.$query.'&f_id='.$floor->id.'&f_name='.$floor->floor_name);  ?>" title="<?php echo $floor->floor_name; ?>"> <?php echo $floor->floor_name; ?>  </a></li>
							<?php endforeach; ?>
						</ul>
                <?php endif; else:?>
						<?php if($this->input->get('f_id')&&$this->input->get('f_name')): $single_floor = $this->lonch_model->get_floor_by_name_plan($this->input->get('f_id'),$this->input->get('lonch_id'),$this->input->get('f_name'));?>
							<p class="text-center lonch_info_p"><?php if($single_floor){echo $single_floor->floor_name; }  ?></p>
						<?php endif; ?>
                <?php endif; ?>
                
                <?php endif; else: ?>
                    <h3 class="text-center" style="color: #fcbb44;"><?=$this->lang->line('body_item_no_launches')?> </h3>
                <?php endif; ?>
				<?php if(isset($time_diff) and ($time_diff==false)): ?>
					<h3 class="text-center" style="color: #fcbb44;"><?=$this->lang->line('body_closed')?> </h3>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if($this->input->get('f_id')&&$this->input->get('f_name')): ?>
        <div class="row">
            <div class="col-sm-6 offset-sm-3"><?php $this->load->view('frontend/cabin_sit_plan'); ?></div>
        </div>
        <?php endif; ?>
        
    </div>
</section>         
             

  <?php $this->load->view('frontend/footer'); ?>