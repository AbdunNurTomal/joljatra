<?php $this->load->view('admin/inc/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('admin/inc/sidebar'); ?>
  <?php $total_message_count = $this->user_model->new_message_count(); ?>
<?php
	$month=date('m', time());
	$year=date('Y', time());
	$month_name ='';
if($this->input->post('account_search')){
	$month = $this->input->post('month');
	$year = $this->input->post('year');
}
if($month==1){$month_name='January';}
if($month==2){$month_name='February';}
if($month==3){$month_name='March';}
if($month==4){$month_name='April';}
if($month==5){$month_name='May';}
if($month==6){$month_name='June';}
if($month==7){$month_name='July';}
if($month==8){$month_name='August';}
if($month==9){$month_name='September';}
if($month==10){$month_name='October';}
if($month==11){$month_name='November';}
if($month==12){$month_name='December';}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

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

<!-- top tiles -->
        <div class="row tile_count">
			<div class="col-sm-12">
				<div class="col-md-4">
			<h3>The account of <?php echo $month_name.' '.$year; ?></h3>
				</div>
				<?php echo form_open('admin/account/account_observation'); ?>
				<div class="col-md-2">
					<div class="input-group">
						  <input class="form-control" name="month" type="number" placeholder="Month" min="1" max="12" value="<?php if($this->input->post('month')){echo $this->input->post('month');}else{ echo date('m', time());} ?>">
					</div>
				</div>
				<div class="col-md-2">
					<div class="input-group">
						  <input class="form-control" name="year" type="number" placeholder="Year" min="1"  value="<?php if($this->input->post('year')){echo $this->input->post('year');}else{ echo date('Y', time());} ?>">
					</div>
				</div>
				<div class="col-md-2">
					<input type="submit" name="account_search"  class="btn btn-primary" value="Search" />
				</div>
				<?php echo form_close(); ?>
				<br />
              </div>
        </div>
        <!-- /top tiles -->
        <br />

        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="box box-primary">
                <div class="box-header">
                  <h2>This month income<span style="color:red">&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $this->basic_model->get_report_full_month('income', $month, $year); ?></span></h2>
            
                  <div class="clearfix"></div>
                </div>
                <div style="display: block;" class="box-body">

                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Parpose</th>
                        <th>Voucher</th>
                        <th>Comment</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php echo $this->basic_model->get_this_month_account_report('income', $month, $year); ?>
                    </tbody>
                  </table>

                </div>
              </div>
            </div>

          <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="box box-primary">
                <div class="box-header">
                  <h2>This month expenditure<span style="color:red">&nbsp;&nbsp;&nbsp; &nbsp;<?php echo $this->basic_model->get_report_full_month('expenditure', $month, $year); ?></span></h2>
           
                  <div class="clearfix"></div>
                </div>
                <div style="display: block;" class="box-body">

                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Parpose</th>
                        <th>Voucher</th>
                        <th>Comment</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php echo $this->basic_model->get_this_month_account_report('expenditure', $month, $year); ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
			
			<div class="col-md-12">
				<a href="<?php echo base_url().'admin/account/pdf/'.$month.'/'.$year; ?>" class="btn btn-success"> <i class="fa fa-download"> </i> Download Report In PDF</a>
			</div>
        </div>

      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h3>The account category should be deleted</h3>
					</div>
					<div class="modal-body">
						Are you shure....? you really want to delete that..?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<a class="btn btn-danger btn-ok">Delete</a>
					</div>
				</div>
			</div>
		</div>
 <?php $this->load->view('admin/inc/footer'); ?>


	
	
	


