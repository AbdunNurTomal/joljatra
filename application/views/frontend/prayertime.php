	<?php $this->load->view('frontend/header'); ?>
	<section id="message_section" class="video_top_content">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 text-center">
					<h1 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">  <i class="fa fa-calendar"></i> <?=$this->lang->line('body_item_prayertime')?>  <span style="color:yellow"> </span></h1>
					
				</div>
			</div>
		</div>
	</section>
	<section id="" class="displa_error_messge">
	    <div class="container">
	        <div class="row" id="message_section">
                <!--Display the confirmation message -->
                <?php if($this->session->userdata('success_msg') or $this->session->userdata('error_msg')): ?>
                <div class="col-sm-12 message_display_class" style="padding-top:50px">
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
	    </div>
	</section>
	<section class="service_section notcie_section">
		<div class="container">
			<dov class="row">
			    <div class="notice_row col-sm-4 offset-sm-4">
                       <center>
                           <iframe class="embed-responsive-item"  width="275"  height="450" src="https://www.islamicity.org/PrayerTimes/embeded.php?lat=23.810332&long=90.41251809999994&elev=16.00752830505371&address=Dhaka, Bangladesh&method=MWL&methodAsr=Standard&show_ampm=0&city=Dhaka" frameborder="0" scrolling="no"></iframe>
                       </center>
                    
			    </div>
			</dov>
		</div>
	</section>
	<?php $this->load->view('frontend/footer'); ?>