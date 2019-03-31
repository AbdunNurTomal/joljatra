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
				<?php  
					$sesattr = array('success_msg' => '', 'error_msg' => '' );
					$this->session->set_userdata($sesattr); 
				?>
			</div>
			<?php endif; ?>
        </div>
		
		<div class="row">
			<div class="col-sm-12">
				<h2 class="lonch_group_list_title"><?=$this->lang->line('body_launch_cabin')?></h2>
			</div>
		</div>
		
		<?php if($this->input->get('f_id')): ?>
		<div class="row">
			<div class="col-sm-6 offset-sm-3">
				<div class="plane">
					<div class="cockpit">
						<!--Cabin Price And numbers-->
						<p class="text-center lonch_info_p"><?=$this->lang->line('body_cabin_no')?> <?php echo $total_cabins; ?></p>
					
						<?php if(isset($discount)){ ?>
							<p class="text-center lonch_info_p"> <?=$this->lang->line('body_actual_price')?> <?php echo $total_actual_price; ?> <?php echo $this->config->item('currency_symbol') ?></p>
							<p class="text-center lonch_info_p"> <?=$this->lang->line('body_discount_price')?> <?php echo $discount; ?> <?php echo $this->config->item('currency_symbol') ?></p>
							<p class="text-center lonch_info_p"> <?=$this->lang->line('body_payable')?> <?php echo $total_payable_price; ?> <?php echo $this->config->item('currency_symbol') ?></p>
						<?php }else{ ?>
							<p class="text-center lonch_info_p"> <?=$this->lang->line('body_price')?> <?php echo $total_price; ?> <?php echo $this->config->item('currency_symbol') ?></p>
						<?php } ?>
					
						<?php if($this->input->get('f_id')&&$this->input->get('floor_name')): //$single_floor = $this->lonch_model->get_floor($this->input->get('f_id'))?>
							<p class="text-center lonch_info_p"><?php echo $floor_name;//if($single_floor){echo $single_floor->floor_name ;}  ?></p>
						<?php endif; ?>
						<?php  
							$lonch_by_id = $this->lonch_model->get_lonch($this->input->get('lonch_id'));
							$schedule=$this->lonch_model->get_schedule_by_day_new($this->input->get('lonch_id'), $day, $from_destination, $to_destination,$this->input->get('f_id')); 
						?>
						<p class="text-center lonch_info_p"><?php if($lonch_by_id){if($this->session->userdata('site_lang')=='bd'){ echo $lonch_by_id->lonch_name; }else if($this->session->userdata('site_lang')=='en'){ echo $lonch_by_id->lonch_name_eng; } } ?> (<small> <?php if($schedule){echo $schedule->time;} ?></small>)</p>
						<p class="text-center lonch_info_p"> 
						   <?php if($this->session->userdata('site_lang')=='bd'){ echo $this->lonch_model->entobn($this->input->get('journey_date')); }else if($this->session->userdata('site_lang')=='en'){ echo $this->input->get('journey_date'); } ?> |
						   <?php echo $this->input->get('from_destination'); ?> <i class="fa fa-arrow-right"></i> <?php echo $this->input->get('to_destination'); ?> 
						   <?php if($this->input->get('group_id')){ echo ' <i class="fa fa-arrow-right"> </i> '; $group=$this->lonch_model->get_group($this->input->get('group_id')); if($group){ if($this->session->userdata('site_lang')=='bd'){ echo $group->group_name; }else if($this->session->userdata('site_lang')=='en'){ echo $group->group_name_eng; }} } ?>
						</p>
					</div>
					<!--<div class="exit exit--front fuselage"></div>-->
					<?php 
						$cabins=0;
						$floor_price=0;
						$lonch_id=$this->input->get('lonch_id');
						$floor_id=$this->input->get('f_id');
						$schedule_id=$this->input->get('s_id');
						$journey_date=$this->input->get('journey_date');
						$search_date = null;
						$submit_cabins = $this->input->get('cabins');
						if($journey_date){
							$date_parts = explode('/', $journey_date);
							$search_date = $date_parts[2].'-'.$date_parts[1].'-'.$date_parts[0];
						}

						//if($this->input->get('lonch_id') and $this->input->get('f_id')){
						//    $floor = $this->lonch_model->get_floor($this->input->get('f_id'));
						//	//print_r($floor);exit;
						//    if($floor){
						//		//$cabins = $floor->cabin; 
						//		//$floor_price=$floor->cabin_price;
						//		$floor_name=$floor->floor_name;
						//	}
						//}
						if(!isset($discount)){
							echo form_open('cabin/add_to_cart', array('method'=>'get')); 
					?>
						<input type="hidden" name="from_destination" value="<?php echo $this->input->get('from_destination'); ?>">
						<input type="hidden" name="to_destination" value="<?php echo $this->input->get('to_destination'); ?>">
						<input type="hidden" name="journey_date" value="<?php echo $this->input->get('journey_date'); ?>">
						<input type="hidden" name="group_id" value="<?php echo $this->input->get('group_id'); ?>">
						<input type="hidden" name="lonch_id" value="<?php echo $this->input->get('lonch_id'); ?>">
						<input type="hidden" name="s_id" value="<?php echo $this->input->get('s_id'); ?>">
						<input type="hidden" name="f_id" value="<?php echo $this->input->get('f_id'); ?>">
						<input type="hidden" name="floor_name" value="<?php echo $floor_name; ?>">
						<input type="hidden" name="total_cabin" value="<?php echo $total_cabins; ?>">
						<input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
					<?php
						}else{
							echo form_open('cabin/add_to_cart_final', array('method'=>'get')); 
					?>
						<input type="hidden" name="from_destination" value="<?php echo $from_destination; ?>">
						<input type="hidden" name="to_destination" value="<?php echo $to_destination; ?>">
						<input type="hidden" name="journey_date" value="<?php echo $journey_date; ?>">
						<input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
						<input type="hidden" name="lonch_id" value="<?php echo $lonch_id; ?>">
						<input type="hidden" name="s_id" value="<?php echo $s_id; ?>">
						<input type="hidden" name="f_id" value="<?php echo $f_id; ?>">
						<input type="hidden" name="floor_name" value="<?php echo $floor_name; ?>">
						<input type="hidden" name="total_cabin" value="<?php echo $total_cabin; ?>">
						<input type="hidden" name="passenger_name" value="<?php echo $passenger_name; ?>">
						<input type="hidden" name="passenger_phone" value="<?php echo $passenger_phone; ?>">
						<input type="hidden" name="passenger_id" value="<?php echo $passenger_id; ?>">
					<?php } ?>
					
					<ol class="cabin fuselage">
						<?php 
							$counter=0;
							if($cabins){
								for($i=1; $i<=$cabins; $i++){
									$disabled = null;
									$checked = null;
									$cabin_number = $i;
									$single_cabin_plan = $this->lonch_model->single_cabin_plan($floor_name,$schedule_id,$lonch_id, $floor_id, $cabin_number);
									$check_booking = $this->lonch_model->check_single_booking($lonch_id, $floor_id, $schedule_id, $cabin_number, $search_date);
									$seet_title = null;
									$seet_price = null;
									if($check_booking){$disabled = 'disabled';}else{$disabled = null;}
									
									if($single_cabin_plan){
										//$cabin_type_id = $single_cabin_plan->cabin_type_id;
										//$cabin_type = $this->lonch_model->get_cabin_type($cabin_type_id);
										//if($cabin_type){
											$seet_title = $single_cabin_plan->cabin_number;
											$seet_price = $single_cabin_plan->sells_price;
										//}else{
										//    $seet_title='G';
										//    $seet_price=$floor_price;
										//}
									}else{
										$seet_title='';
										$seet_price='';
									}
									
									// submited cabins
									if($submit_cabins){
										if(in_array($i, $submit_cabins)){$checked='checked';}else{$checked=null;}
									}
									$counter++;
									if($counter==1){echo '<li class=""> <ol class="seats" type="A">';}
									
									echo '<li class="seat" title="'.$seet_price.$this->config->item('currency_symbol').'">
										  <input name="cabins[]" type="checkbox" id="c_id_'.$i.'" '.$disabled.' value="'.$i.'" '.$checked.'/>
										  <label for="c_id_'.$i.'">'.$seet_title.'</label>
										</li>';
									
									if($counter==6){echo ' </ol></li>'; $counter=0;}
									
								}
								$cabin_extra = $cabins%6;
								if($cabin_extra!=0){ echo ' </ol></li>';}
							}
						?>
					</ol>
<center> 
    <!--<button type="submit" class="btn btn-success btn-sm cabin_book_button"> নেক্সট <i class="fa fa-arrow-right"></i></button>-->
    <?php if($this->user_id!==null and $this->user_type=='passenger'):  ?>
        <a href="<?php $query = http_build_query($_GET); echo site_url('cabin/get_payment/?'.$query);?>" class="btn btn-success btn-sm cabin_book_button"><?=$this->lang->line('body_payment_option')?> <i class="fa fa-arrow-right"></i></a>
    <?php  else: ?>
    <a href="#" class="btn btn-success btn-sm cabin_book_button" data-toggle="modal" data-target="#sign_up_model"><i class="fa fa-user-plus"> </i> <?=$this->lang->line('right_menu_item_signup')?></a>
     
    <a href="#" class="btn btn-success btn-sm cabin_book_button" data-toggle="modal" data-target="#log_in_model"><i class="fa fa-sign-in"> </i>  <?=$this->lang->line('right_menu_item_login')?></a>
    <?php endif; ?>
</center>
<?php echo form_close(); ?>
 <!-- <div class="exit exit--back fuselage"></div>-->
</div>
</div>
</div>
<?php endif; ?>

</div>
</section>         
<?php $this->load->view('frontend/footer'); ?>