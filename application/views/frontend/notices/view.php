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
			        <table class="table table-bordered notice_details ">
                   
			            <tbody>
                       <?php if($notice){ ?>
                        <tr>
                            <th style="font-weight: normal;font-size: 25px;color: #007f68;"> <i class="fa fa-file-text "></i> <?php if($this->session->userdata('site_lang')=='bd'){ echo $notice->post_title; }else if($this->session->userdata('site_lang')=='en'){ echo $notice->post_title_eng; } ?>
                            <p style="font-size: 15px;margin-bottom:0px"><?php echo $notice->post_date; ?></p>
                              </th>
                            
        
                            
                            <th class="align-middle" style=""> <center> <a href="" class="btn btn-primary btn-lg"><i class="fa fa-print"></i></a></center> </th>
                        </tr>
                        <tr>
                            <td colspan="2"> <?php if($this->session->userdata('site_lang')=='bd'){ echo $notice->post_content; }else if($this->session->userdata('site_lang')=='en'){ echo $notice->post_content_eng; } ?> </td>
                            
                        </tr>
                        <?php } ?>
			              
			            </tbody>
			        </table>
			        
			        
			       
			    </div>
			</dov>
		</div>
	</section>
	<?php $this->load->view('frontend/footer'); ?>