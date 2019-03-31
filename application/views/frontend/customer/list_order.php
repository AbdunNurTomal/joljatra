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
				<?php  $sesattr = array('success_msg' => '', 'error_msg' => '' ); $this->session->set_userdata($sesattr); ?>
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
			<div class="col-sm-8">
				<table class="table table-bordered">
					<tbody>
						<tr><th colspan="7"><center>Completed</center></th></tr>
						<tr bgcolor="#90EE90">
							<th>Order ID</th>
							<th>Destination</th>
							<th>Journey Date</th>
							<th>Creation Date</th>
							<th>Total Cabin</th>
							<th>Total Price</th>
							<th>Print/view</th>
						</tr>
						<?php 
							if($list_order_completed){
								foreach($list_order_completed as $order){ 
									$from_destination='';
									if($this->session->userdata('site_lang')=='bd'){$from_destination=$order->from_destination;}else if($this->session->userdata('site_lang')=='en'){$from_destination=$this->lonch_model->get_from_destination_eng($order->from_destination);}
									if($this->session->userdata('site_lang')=='bd'){$to_destination=$order->to_destination;}else if($this->session->userdata('site_lang')=='en'){$to_destination=$this->lonch_model->get_from_destination_eng($order->to_destination);}
						?>
									<tr>
										<td><?php echo $order->id; ?></td>
										<td><?php echo $from_destination.' ~ '.$to_destination; ?></td>
										<td><?php echo $order->journey_date; ?></td>
										<td><?php echo $order->order_date; ?></td>
										<td><?php echo $order->total_cabin; ?></td>
										<td><?php echo $order->total_price; ?></td>
										<td>
											<a target="_blank" href="<?php echo site_url('customer/print_order/'.$order->id); ?>" class="btn btn-success btn-sm"> <i class="fa fa-print"></i> </a>
											<a target="_blank" href="<?php echo site_url('customer/thank_you/'.$order->id); ?>" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i> </a>
										</td>
									</tr>
						<?php 
								}
							} 
						?>
					</tbody>
				</table>
				<br/>
				<table class="table table-bordered">
					<tbody>
						<tr><th colspan="7"><center>Pending</center></th></tr>
						<tr bgcolor="#90EE90">
							<th>Order ID</th>
							<th>Destination</th>
							<th>Journey Date</th>
							<th>Creation Date</th>
							<th>Total Cabin</th>
							<th>Total Price</th>
							<th>Print/view</th>
						</tr>
						<?php 
							if($list_order_pending){
								foreach($list_order_pending as $order){ 
						?>
									<tr>
										<td><?php echo $order->id; ?></td>
										<td><?php echo $order->from_destination.' '.$order->to_destination; ?></td>
										<td><?php echo $order->journey_date; ?></td>
										<td><?php echo $order->order_date; ?></td>
										<td><?php echo $order->total_cabin; ?></td>
										<td><?php echo $order->total_price; ?></td>
										<td>
											<a target="_blank" href="<?php echo site_url('customer/print_order/'.$order->id); ?>" class="btn btn-success btn-sm"> <i class="fa fa-print"></i> </a>
											<a target="_blank" href="<?php echo site_url('customer/thank_you/'.$order->id); ?>" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i> </a>
										</td>
									</tr>
						<?php 
								}
							} 
						?>
					</tbody>
				</table>
			</div>
		</div>
		
	</div>
</section>
<?php $this->load->view('frontend/footer'); ?>