	<?php $this->load->view('frontend/header'); ?>
	<section id="message_section" class="video_top_content">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 text-center">
					<h1 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;"> <i class="fa fa-file-text "></i> <?php if($this->session->userdata('site_lang')=='bd'){ echo 'নোটিশ বোর্ড'; }else if($this->session->userdata('site_lang')=='en'){ echo 'Notice Board'; } ?>  <span style="color:yellow"> </span></h1>
					
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
			    <div class="notice_row col-sm-12">
			        <table class="table table-bordered notice_table ">
			            <tbody>
                        <?php if($notices){foreach($notices as $notice){ ?>
			                <tr>
			                    <td class="align-middle"><i class="fa fa-edit"></i></td>
			                    <td class="align-middle"><a href="<?php echo site_url('notices/view/'.$notice->id); ?>"> <?php if($this->session->userdata('site_lang')=='bd'){ echo $notice->post_title; }else if($this->session->userdata('site_lang')=='en'){ echo $notice->post_title_eng; } ?> </a></td>
			                    <td class="align-middle">  <h1 class="notice_date">
			                    <?php $time = strtotime($notice->post_date); ?>
			                    <?php echo date('d', $time); ?> <span><?php echo date('M', $time); ?></span></h1></td>
			                </tr>
			                <?php }} ?>
			              
			            </tbody>
			        </table>
			        
			        <?php echo $links; ?>
			       
			    </div>
			</dov>
		</div>
	</section>
	<?php $this->load->view('frontend/footer'); ?>