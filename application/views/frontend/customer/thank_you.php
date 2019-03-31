<?php $this->load->view('frontend/header'); ?>

<section class="home_content_section">
	<div class="container custom-padding">
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
		<div class="row ">
			<div class="col-sm-4 text-center">
               <div class="customer_left_bar">
                    <img src="<?php echo site_url('uploads/users/'.$user_data->image); ?>" alt="" class="img-responsive img-thumbnail img-circle">
                   <h4><?php echo $user_data->first_name.' '.$user_data->last_name; ?></h4>
                   
                   <?php if($this->session->userdata('cart')): ?>
                   <a href="<?php echo site_url('customer/check_out_option'); ?>" class="btn btn-success">You have a cart to check out</a>
                   <?php endif; ?>
                   <a href="<?php echo site_url('customer/list_order'); ?>" class="btn btn-success"> <i class="fa fa-list"></i> List of oll booking </a>
               </div>
			</div>
			<div class="col-sm-6">
			<?php if($booking and $booking_list_single):
						$cabins=null;
						$floor = $this->lonch_model->get_floor($booking_list_single->floor_id);
                        if($floor){
                            $cabins = $floor->cabin; 
							//$floor_price=$floor->cabin_price;
                        }
						$lonch = $this->lonch_model->get_lonch($booking->lonch_id);
			?>
			<div class="booking_information">
			    <table class="table table-bordered">
			        <thead>
                    <tr><h1>জলযাত্রা </h1></tr>
			            <tr>
			                <th colspan="3" class="ticket_print_copy">
			                    <p>বোকিং আই,ডিঃ- <?php echo $booking->id ?></p>
			                    <p> যাত্রার দিকঃ- <?php echo $booking->from_destination.'~'.$booking->to_destination; ?></p>
			                    <p> তারিখঃ-   <?php echo $booking->journey_date; ?></p>
			                    
			                </th>
			                <th colspan="3"  class="ticket_print_copy">
			                    <p> লঞ্চের নামঃ-  <?php echo $lonch->lonch_name; ?></p>
			                    <p> লঞ্চের স্তরঃ-  <?php echo $floor->floor_name; ?></p>
			                    <p> মূল্যঃ-  <?php echo $booking->total_price.$this->config->item('currency_symbol'); ?></p>
			                </th>
			            </tr>
			        </thead>
			        <tbody class="tex-center">
                        <?php 
                        
                            $counter=0;
                            if($cabins){
                                for($i=1; $i<=$cabins; $i++){
                                    $disabled = null;
                                    $checked = null;
                                    $cabin_number = $i;
                                    $single_cabin_plan = $this->lonch_model->single_cabin_plan($floor->floor_name,$booking_list_single->floor_id,$booking->lonch_id, $booking_list_single->floor_id, $cabin_number);
                                    
                                    if($single_cabin_plan){
                                        //$cabin_type_id = $single_cabin_plan->cabin_type_id;
                                        //$cabin_type = $this->lonch_model->get_cabin_type($cabin_type_id);
                                        //if($cabin_type){
                                        //    $seet_title = $cabin_type->title;
                                        //    $seet_price = $cabin_type->price;
                                        //}
										//else{
                                        //    $seet_title='G';
                                        //    $seet_price=$floor_price;
                                        //}
										$seet_title = $single_cabin_plan->cabin_number;
										$seet_price = $single_cabin_plan->sells_price;
                                    }else{
                                        $seet_title='';
                                        $seet_price='';
                                    }

                                    // submited cabins
                                    if($submit_cabins){
                                        if(in_array($i, $submit_cabins)){$checked='cabin_select_print';}else{$checked=null;}
                                    }
                                    $counter++;
                                    if($counter==1){echo '<tr>';}

                                    echo '<td class="'.$checked.'">'.$seet_title.'</td>';

                                    if($counter==6){echo ' </tr>'; $counter=0;}

                                }
                                $cabin_extra = $cabins%6;
                                if($cabin_extra!=0){ echo ' </tr>';}
                            }
                        ?>
			       
			        </tbody>
			    </table>
			</div>
          <a target="_blank" href="<?php echo site_url('customer/print_order/'.$booking->id); ?>" class="btn btn-success cabin_book_button"><i class="fa fa-print"></i> প্রিন্ট </a>
           <?php endif; ?>
           
			</div>
		</div>
	</div>
</section>
<?php $this->load->view('frontend/footer'); ?>