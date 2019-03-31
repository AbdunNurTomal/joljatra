<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> জলযাত্রা | Print Lonch Booking</title>
    <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <link rel='stylesheet' href='<?php echo site_url('assets/frontend/css/glyp-icon.css'); ?>' />
        <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/frontend/'); ?>css/bootstrap-datepicker.min.css" media="all" />
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="<?php echo site_url('assets/frontend/font-awesome/css/font-awesome.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo site_url('assets/frontend/css/main.css'); ?>">
        <link rel="stylesheet" href="<?php echo site_url('assets/frontend/css/responsive.css'); ?>">
        <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
			   
	
			 <?php if($booking and $booking_list_single):
                $cabins=null;
                     $floor = $this->lonch_model->get_floor($booking_list_single->floor_id);
                        if($floor){
                            $cabins = $floor->cabin; 
                           $floor_price=$floor->cabin_price;
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

                                    // submited cabins
                                    if($submit_cabins){
                                        if(in_array($i, $submit_cabins)){$checked='cabin_select_print';}else{$checked=null;}
                                    }
                                    $counter++;
                                    if($counter==1){echo '<tr>';}

                                    echo '<td class="'.$checked.'">'.$i.$seet_title.'</td>';

                                    if($counter==6){echo ' </tr>'; $counter=0;}

                                }
                                $cabin_extra = $cabins%6;
                                if($cabin_extra!=0){ echo ' </tr>';}
                            }
                        ?>
			       
			        </tbody>
			    </table>
			</div>
           <?php endif; ?>
			   
			   
			</div>
        </div>
    </div>
    <script>
    window.print();
    </script>
</body>
</html>