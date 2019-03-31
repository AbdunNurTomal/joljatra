	<?php $this->load->view('frontend/header'); ?>
	<section id="message_section" class="video_top_content">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 text-center">
					<h1 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;"><?=$this->lang->line('body_contact_with_us_1')?> <span style="color:yellow"><?=$this->lang->line('body_contact_with_us_2')?></span></h1>
					<p class="wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;"><?=$this->lang->line('body_contact_with_us_header')?></p>
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
	<section class="service_section contact_section">
		<div class="container">
			<div class="row">
			    <div class="col-sm-6 margin-bottom-15" style="margin:50px 0px">
					<div class="embed-responsive embed-responsive-16by9">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d233667.82239117572!2d90.27923723390371!3d23.780887456913696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka!5e0!3m2!1sen!2sbd!4v1533488601262" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
			    </div>
			    <div class="col-sm-6"  style="margin:50px 0px">
                    <form class="" autocomplete="off" method="post" action="<?php echo site_url('contact'); ?>">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <input name="name" type="text" class="form-control" id="exampleInputAmount" placeholder="<?=$this->lang->line('body_contact_name')?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                <input name="email" type="email" class="form-control" id="exampleInputAmount" placeholder="<?=$this->lang->line('body_contact_email')?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-volume-control-phone"></i></div>
                                <input name="mobile" type="text" class="form-control" id="exampleInputAmount" placeholder="<?=$this->lang->line('body_contact_phone')?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-edit"></i></div>
                                <textarea name="message" class="form-control" cols="30" rows="6" placeholder="<?=$this->lang->line('body_contact_messsage')?>" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input name="send_message" type="submit" value="<?=$this->lang->line('body_contact_submit')?>" class="btn btn-primary custom_button" style=";">
                            </div>
                        </div>
                    </form>
			    </div>
			</div>
		</div>
	</section>
	<?php $this->load->view('frontend/footer'); ?>