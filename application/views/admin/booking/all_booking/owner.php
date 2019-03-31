<?php $this->load->view('admin/inc/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('admin/inc/sidebar'); ?>

<div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> <i class="fa fa-file-text"></i> All Booking </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
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
                <?php echo form_open('admin/booking/all_booking', array('method'=>'get')); ?>
                    <div class="row">
                      
                       <div class="col-sm-2">
                            <div class="form-group">
                              <label for="from_date">From Date</label>
                              <input type="text" name="from_date" id="from_date" class="form-control" placeholder="11/11/2018" data-date-format="dd/mm/yyyy" value="<?php if($this->input->get('from_date')){echo $this->input->get('from_date');}else{echo date('d/m/Y',time());} ?>">
                            </div>
                        </div>
                       <div class="col-sm-2">
                            <div class="form-group">
                              <label for="to_date">To Date</label>
                              <input type="text" name="to_date" id="to_date" class="form-control" placeholder="11/11/2018" data-date-format="dd/mm/yyyy" value="<?php if($this->input->get('to_date')){echo $this->input->get('to_date');}else{echo date('d/m/Y',time());} ?>">
                            </div>
                        </div>
                       <div class="col-sm-2">
                            <div class="form-group">
                              <label for="transaction_type">Order From</label>
                              <select name="transaction_type" id="transaction_type" class="form-control">
                                  <option value="" >Select</option>
                                  
                                  <option value="online" <?php if($this->input->get('transaction_type')=='online'){echo 'selected';} ?> >Online</option>
                                  
                                  <option value="offline" <?php if($this->input->get('transaction_type')=='offline'){echo 'selected';} ?> >Offline</option>
                                  
                              </select>
                              
                            </div>
                        </div>
                       <div class="col-sm-2">
                            <div class="form-group">
                              <label for="owner_id">Lonch Owner</label>
                              <select name="owner_id" id="owner_id" class="form-control owner_id">
                                    <option value="">Select owner....</option>
                                    <?php 
                                    $owner_list = $this->user_model->get_all_user('owner');
                                    if($owner_list){
                                        $selected=null;
                                        foreach($owner_list as $owner){
                                            if($this->input->get('owner_id')==$owner->id){$selected='selected';}else{$selected=null;}
                                        echo '<option value="'.$owner->id.'" '.$selected.'>'.$owner->first_name.' '.$owner->last_name.'</option>';
                                    }}
                                    ?>
                                </select>
                              
                            </div>
                        </div>
                       <div class="col-sm-2">
                            <div class="form-group">
                              <label for="lonch_id">Lonch</label>
                              <select name="lonch_id" id="lonch_id" class="form-control lonch_id">
                                    <option value="">Select lonch....</option>
                                    <?php 
                                        $owner_select=null;
                                        if($this->user_type=='owner'){
                                            $owner_select=$this->user_id;
                                        }elseif($this->input->get('owner_id')){
                                            
                                            $owner_select=$this->input->get('owner_id');
                                            
                                        }else{
                                            $owner_select=null;
                                        }
                                  
                                        $lonches = $this->lonch_model->get_all_lonch($owner_select);
                                        $lonch_select=null;
                                        if($lonches){
                                            
                                            foreach($lonches as $lonch){
                                                if($this->input->get('lonch_id')==$lonch->id){$lonch_select='selected';}else{$lonch_select=null;}
                                                echo '<option value="'.$lonch->id.'" '.$lonch_select.'>'.$lonch->lonch_name.'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                              
                            </div>
                        </div>
                       <div class="col-sm-2">
                            <div class="form-group">
                              <label for="order_id"> Order ID </label>
                              <input class="form-control" type="text" name="order_id" id="order_id" placeholder="Order Id" value="<?php echo $this->input->get('order_id'); ?>">
                            </div>
                        </div>
                       <div class="col-sm-2">
                            <div class="form-group">
                              <label for="passenger_phone"> Passenger Phone </label>
                              <input class="form-control" type="text" name="passenger_phone" id="passenger_phone" placeholder="Passenger Phone" value="<?php echo $this->input->get('passenger_phone'); ?>">
                            </div>
                        </div>
                       <div class="col-sm-2">
                            <div class="form-group">
                              <label  class="mobile_display_none" >     </label>
                              <input type="submit" name="search_booking" value="Search Booking" class="form-control btn btn-success search_cabin_btn" style="margin-top: 5px;">
                            </div>
                        </div>
                    </div>

                <?php echo form_close(); ?>
        </div>
        <div class="box-body">
        
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Destination</th>
                        <th>Journey Date</th>
                        <th>From</th>
                        <th>Total Cabin</th>
                        <th>Total Price</th>
                        <th>Passenger name</th>
                        <th>Passenger Phone</th>
                    </tr>
                </thead>
                <tbody>
                   <?php if($bookings){foreach($bookings as $booking){ ?>

                    <tr>
                        <td><?php echo $booking->id; ?></td>
                        <td><?php echo $booking->from_destination.'-'.$booking->to_destination; ?></td>
                        <td><?php echo $booking->journey_date; ?></td>
                        <td><?php echo $booking->transaction_type; ?></td>
                        <td><?php echo $booking->total_cabin; ?></td>
                        <td><?php echo $booking->total_price; ?></td>
                        <td><?php echo $booking->passenger_name; ?></td>
                        <td><?php echo $booking->passenger_phone; ?></td>
                    </tr>
                    <?php }}  ?>

                </tbody>
            </table>
        </div>
        
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