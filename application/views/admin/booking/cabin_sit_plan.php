<div class="plane">
  <div class="cockpit">
    <h1>কেবিন নির্বাচন</h1>
  </div>
<!--  <div class="exit exit--front fuselage"></div>-->
 <?php 
$cabins=0;
$floor_price=0;
$lonch_id=$this->input->get('lonch_id');
$floor_id=$this->input->get('f_id');
$floor_name=$this->input->get('f_name');
$schedule_id=$this->input->get('s_id');
$journey_date=$this->input->get('journey_date');
$search_date = null;
if($journey_date){
    $date_parts = explode('/', $journey_date);
    $search_date = $date_parts[2].'-'.$date_parts[1].'-'.$date_parts[0];
}

if($lonch_id and $floor_id and $floor_name){
    $floor = $this->lonch_model->get_floor_by_name_plan($floor_id,$lonch_id,$floor_name);
    if($floor){
		$cabins = $floor->cabin; 
		//$floor_price=$floor->cabin_price;
		//$floor_name = $floor->floor_name;
	}
}
?>
<?php echo form_open('admin/booking/offline_add_cart', array('method'=>'get')); ?>
 <input type="hidden" name="from_destination" value="<?php echo $this->input->get('from_destination'); ?>">
 <input type="hidden" name="to_destination" value="<?php echo $this->input->get('to_destination'); ?>">
 <input type="hidden" name="journey_date" value="<?php echo $this->input->get('journey_date'); ?>">
 <input type="hidden" name="group_id" value="<?php echo $this->input->get('group_id'); ?>">
 <input type="hidden" name="lonch_id" value="<?php echo $this->input->get('lonch_id'); ?>">
 <input type="hidden" name="s_id" value="<?php echo $this->input->get('s_id'); ?>">
 <input type="hidden" name="f_id" value="<?php echo $this->input->get('f_id'); ?>">
 <input type="hidden" name="floor_name" value="<?php echo $floor_name; ?>">
  <ol class="cabin fuselage">
    <?php 
        $counter=0;
		//print_r($cabins);
        if($cabins){
            for($i=1; $i<=$cabins; $i++){
                $disabled = null;
                $cabin_number = $i;
                $single_cabin_plan = $this->lonch_model->single_cabin_plan($floor_name, $schedule_id, $lonch_id, $floor_id, $cabin_number);
                
				$check_booking = $this->lonch_model->check_single_booking($floor_name,$lonch_id, $floor_id, $schedule_id, $cabin_number, $search_date);
                $seet_title = null;
                $seet_price = null;
                if($check_booking){$disabled = 'disabled';}else{$disabled = null;}
                if($single_cabin_plan){
                    //$cabin_type_id = $single_cabin_plan->cabin_type_id;
                    //$cabin_type = $this->lonch_model->get_cabin_type($cabin_type_id);
                    //if($cabin_type){
                    //    $seet_title = $cabin_type->title;
                    //    $seet_price = $cabin_type->price;
                    //}else{
                    //    $seet_title='G';
                    //    $seet_price=$floor_price;
                    //}
					$seet_title = $single_cabin_plan->cabin_number;
                    $seet_price = $single_cabin_plan->sells_price;
                }else{
                    $seet_title='';
                    $seet_price='';
                }
                $counter++;
                if($counter==1){echo '<li class=""> <ol class="seats" type="A">';}
                
                echo '<li class="seat" title="'.$seet_price.$this->config->item('currency_symbol').'">
                      <input name="cabins[]" type="checkbox" id="c_id_'.$i.'" '.$disabled.' value="'.$i.'" />
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
    
     <button type="submit" class="btn btn-success btn-sm cabin_book_button"> Next <i class="fa fa-arrow-right"></i></button>
     <?php $query = http_build_query($_GET); ?>
     
 </center>
<?php echo form_close(); ?>
 <!-- <div class="exit exit--back fuselage">
    
  </div>-->
</div>