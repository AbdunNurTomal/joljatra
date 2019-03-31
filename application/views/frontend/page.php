	<?php $this->load->view('frontend/header'); ?>
	<section id="message_section" class="video_top_content">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 text-center">
					<h1 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;"><i class="fa fa-file-text "></i>  <?php if($this->session->userdata('site_lang')=='bd'){ echo $page_data->post_title; }else if($this->session->userdata('site_lang')=='en'){ echo $page_data->post_title_eng; } ?></h1>
					<p class="wow fadeInDown" style="color:#FFF"><?php if($this->session->userdata('site_lang')=='bd'){ echo $page_data->post_excerpt; }else if($this->session->userdata('site_lang')=='en'){ echo $page_data->post_excerpt_eng; } ?></p>
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
	<section class="service_section " style="min-height:300px">
		<div class="container">
			<dov class="row">
			    <div class="col-sm-12 margin-bottom-15 page_conent_desc" style="margin:50px 0px; color:#242323">
					<?php if($this->session->userdata('site_lang')=='bd'){ echo $page_data->post_content; }else if($this->session->userdata('site_lang')=='en'){ echo $page_data->post_content_eng; } ?>
			    </div>
			</dov>
		</div>
	</section>
	<?php $this->load->view('frontend/footer'); ?>