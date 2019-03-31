             <!-- Sitnup model -->
                <div class="modal fade" id="sign_up_model" tabindex="-1" role="dialog" aria-labelledby="sign_up_model_label">
                  <div class="modal-dialog" role="document">
                   <?php echo form_open('signup/try_sign_up_ajax/', array('id'=>'submit_sign_up_form')); ?>
                    <div class="modal-content">
                      <div class="modal-header">
                       
                        <h4 class="modal-title" id="sign_up_model_label"><span class="glyphicon glyphicon-user"></span> <?=$this->lang->line('right_menu_item_signup')?> </h4>
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body" style="overflow: hidden; padding-bottom:0px">
                         
                          <div class="col-sm-12">
                              <div class="form-group row">
                                    <div class="col-sm-12 sign_up_alert_box">
                                       
                                    </div>
                                </div>
                          </div>
                          
                        <div class="form-group row">
							<label for="first_name" class="col-sm-3 col-form-label"> <?=$this->lang->line('body_first_name')?>  </label>
							<div class="col-sm-9">
								<input class="form-control" id="first_name" placeholder="<?=$this->lang->line('body_first_name')?>" name="first_name" type="text" value="<?php echo $this->input->post('first_name'); ?>" required>
							</div>
						</div>
					
						<div class="form-group row">
							<label for="last_name" class="col-sm-3 col-form-label"><?=$this->lang->line('body_last_name')?></label>
							<div class="col-sm-9">
								<input class="form-control" id="last_name" placeholder="<?=$this->lang->line('body_last_name')?>" name="last_name" type="text" value="<?php echo $this->input->post('last_name'); ?>" required>
							</div>
						</div>
					
						<div class="form-group row">
							<label for="phone" class="col-sm-3 col-form-label"><?=$this->lang->line('body_phone_no')?></label>
							<div class="col-sm-9">
								<input class="form-control bfh-phone" data-format="+88 (ddd) ddd-dddd" id="phone" placeholder="017XXXXXXXX" name="phone" type="text" value="<?php echo $this->input->post('phone'); ?>" required>
							</div>
						</div>
					
						<div class="form-group user_name_box row">
							<label for="user_name" class="col-sm-3 col-form-label"><?=$this->lang->line('body_user_name')?> </label>
							<div class="col-sm-9">
								<input class="form-control user_name_input" id="user_name" placeholder="<?=$this->lang->line('body_user_name')?>" name="user_name" type="text" value="<?php echo $this->input->post('user_name'); ?>" required>
							</div>
						</div>
						
					
						<div class="form-group user_email_box row">
							<label for="email" class="col-sm-3 col-form-label"><?=$this->lang->line('body_email')?></label>
							<div class="col-sm-9">
								<input class="form-control user_email_input" id="email" placeholder="<?=$this->lang->line('body_email')?>" name="email" type="email" value="<?php echo $this->input->post('email'); ?>" required>
							</div>
						</div>
					
						<div class="form-group row">
							<label for="password" class="col-sm-3 col-form-label"><?=$this->lang->line('body_password')?></label>
							<div class="col-sm-9">
								<input class="form-control" id="password" placeholder="<?=$this->lang->line('body_password')?>" name="password" type="password" value="<?php echo $this->input->post('password'); ?>" required>
							</div>
						</div>
                          
                      </div>
                      <div class="modal-footer" >
                           <input type="hidden" name="sign_up_action" value="sign_up_action">
                        <button type="submit" name="sign_up_action_btn" id="sign_up_action_btn" class="btn btn-primary sign_up_action_btn"><i class="fa fa-user-plus"> </i> <?=$this->lang->line('right_menu_item_signup')?> </button>
                      </div>
                    </div>
                    <?php echo form_close(); ?>
                  </div>
                </div>  
                
                
                
                
                
                
                
                
                <!-- Login Model -->
                <div class="modal fade" id="log_in_model" tabindex="-1" role="dialog" aria-labelledby="log_in_model_label">
                  <div class="modal-dialog" role="document">
                   <?php echo form_open('login/try_login_ajax/', array('id'=>'submit_login_form')); ?>
                    <div class="modal-content">
                      <div class="modal-header">
                       
                        <h4 class="modal-title" id="log_in_model_label"><span class="glyphicon glyphicon-log-in"></span> <?=$this->lang->line('right_menu_item_login')?> </h4>
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body" style="overflow: hidden; padding-bottom:0px">
                          <div class="col-sm-12">
                              <div class="form-group row">
                                    <div class="col-sm-12">
                                       <input type="text" name="user_name" id="user_name" class="form-control user_name" placeholder="<?=$this->lang->line('body_type_user_name')?>" required>
                                    </div>
                                </div>
                          </div>
                          <div class="col-sm-12">
                              <div class="form-group row">
                                    <div class="col-sm-12">
                                       <input type="password" name="password" id="password" class="form-control password" placeholder="<?=$this->lang->line('body_password')?>" required>
                                       <input type="hidden" name="login_action" value="yes">
                                    </div>
                                </div>
                          </div>
                          <div class="col-sm-12">
                              <div class="form-group row">
                                    <div class="col-sm-12 login_alert_box">
                                       
                                    </div>
                                </div>
                          </div>
                          
                      </div>
                      <div class="modal-footer" >
                       
                        <a href="#" class="btn btn-link forget_password_btn">  <?=$this->lang->line('body_forget_password')?> </a>
                        
                        <button type="submit" name="login_action_button" id="login_action" class="btn btn-primary login_action"><i class="fa fa-sign-in"> </i>   <?=$this->lang->line('right_menu_item_login')?> </button>
                      </div>
                    </div>
                    <?php echo form_close(); ?>
                  </div>
                </div> 
                
                
                
                
                
                
                
                
                
                <!-- password reset first step Model -->
                <div class="modal fade" id="forget_password_model" tabindex="-1" role="dialog" aria-labelledby="forget_password_model_label">
                  <div class="modal-dialog" role="document">
                   <?php echo form_open('login/forget_password_email/', array('id'=>'submit_reset_email')); ?>
                    <div class="modal-content">
                      <div class="modal-header">
                       
                        <h4 class="modal-title" id="forget_password_model_label"> <i class="fa fa-refresh"> </i>  <?=$this->lang->line('body_password_reset')?>  </h4>
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body" style="overflow: hidden; padding-bottom:0px">
                          <div class="col-sm-12">
                              <div class="form-group row">
                                    <div class="col-sm-12">
                                       <input type="text" name="reset_email" id="reset_email" class="form-control reset_email" placeholder="<?=$this->lang->line('body_email')?>" required>
                                    </div>
                                </div>
                          </div>
                          <div class="col-sm-12">
                              <div class="form-group row">
                                    <div class="col-sm-12 reset_email_alert">
                                       
                                    </div>
                                </div>
                          </div>
                          
                      </div>
                      <div class="modal-footer" >
                       
                        <a href="#" class="btn btn-link back_to_login"> <i class="fa fa-sign-in"> </i>   <?=$this->lang->line('right_menu_item_login')?> </a>
                        
                        <button type="submit" name="reset_action" id="reset_action" class="btn btn-primary reset_action" ><i class="fa fa-refresh"> </i>   <?=$this->lang->line('body_reset')?> </button>
                      </div>
                    </div>
                    <?php echo form_close(); ?>
                  </div>
                </div> 
                
                
                
                
                
                
                <!-- password reset second  step reset code Model -->
                <div class="modal fade" id="reset_code_model" tabindex="-1" role="dialog" aria-labelledby="reset_code_model_label">
                  <div class="modal-dialog" role="document">
                   <?php echo form_open('login/submit_reset_code/', array('id'=>'submit_reset_code')); ?>
                    <div class="modal-content">
                      <div class="modal-header">
                       
                        <h4 class="modal-title" id="reset_code_model_label"> <i class="fa fa-refresh"> </i>   <?=$this->lang->line('body_password_reset_code')?>  </h4>
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body" style="overflow: hidden; padding-bottom:0px">
                          <div class="col-sm-12">
                              <div class="form-group row">
                                    <div class="col-sm-12">
                                       <input type="text" name="reset_code" id="reset_code" class="form-control reset_code" placeholder="<?=$this->lang->line('body_reset_code')?> " required>
                                    </div>
                                </div>
                          </div>
                          <div class="col-sm-12">
                             <p class=""> <i class="fa fa-envelope"> </i>  <span class="reset_phone_number"></span></p>
                          </div>
                          <div class="col-sm-12">
                              <div class="form-group row">
                                    <div class="col-sm-12 reset_code_alert">
                                       
                                    </div>
                                </div>
                          </div>
                          
                      </div>
                      <div class="modal-footer" >
                       
                        
                        <button type="submit" name="reset_code_action" id="reset_code_action" class="btn btn-primary reset_code_action" value="Reset Code"><i class="fa fa-refresh"> </i>   <?=$this->lang->line('body_reset_code')?> </button>
                      </div>
                    </div>
                    <?php echo form_close(); ?>
                  </div>
                </div> 
                
                
                
                
                <!-- reset New password -->
                <div class="modal fade" id="reset_new_password_model" tabindex="-1" role="dialog" aria-labelledby="reset_new_password_model_label">
                  <div class="modal-dialog" role="document">
                   <?php echo form_open('login/submit_reset_password/', array('id'=>'submit_reset_new_password')); ?>
                    <div class="modal-content">
                      <div class="modal-header">
                       
                        <h4 class="modal-title" id="reset_new_password_model_label"> <i class="fa fa-refresh"> </i>  <?=$this->lang->line('body_reset_code')?>  </h4>
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body" style="overflow: hidden; padding-bottom:0px">
                          <div class="col-sm-12">
                              <div class="form-group row">
                                    <div class="col-sm-12">
                                       <input type="password" name="reset_password" id="reset_password" class="form-control reset_password" placeholder=" <?=$this->lang->line('body_reset_password')?> " required>
                                    </div>
                                </div>
                          </div>
                          <div class="col-sm-12">
                              <div class="form-group row">
                                    <div class="col-sm-12">
                                       <input type="password" name="again_reset_password" id="again_reset_password" class="form-control again_reset_password" placeholder=" <?=$this->lang->line('body_again_reset_code')?>  " required>
                                    </div>
                                </div>
                          </div>
                          <div class="col-sm-12">
                              <div class="form-group row">
                                    <div class="col-sm-12 reset_password_allert">
                                       
                                    </div>
                                </div>
                          </div>
                          
                      </div>
                      <div class="modal-footer" >
                       
                        
                        <button type="submit" name="reset_password_action" id="reset_password_action" class="btn btn-primary reset_password_action" value="Reset password"><i class="fa fa-refresh"> </i>   <?=$this->lang->line('body_reset_password')?> </button>
                      </div>
                    </div>
                    <?php echo form_close(); ?>
                  </div>
                </div> 
                
                
                
                
                
                
                
                
                
                <!-- logout model -->
                <div class="modal fade" id="logout_model" tabindex="-1" role="dialog" aria-labelledby="logout_model_label">
                  <div class="modal-dialog" role="document">
                   <?php echo form_open('login/try_logout_ajax/', array('id'=>'log_out_form')); ?>
                    <div class="modal-content">
                      <div class="modal-header">
                       
                        <h4 class="modal-title" id="logout_model_label"><i class="fa fa-power-off "> </i>  <?=$this->lang->line('right_menu_item_logout')?> </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body" style="overflow: hidden; padding-bottom:0px">
                         
                          <div class="col-sm-12">
                              <div class="form-group row">
                                    <div class="col-sm-12 logout_alert_box">
                                      <h3>Logout processing</h3> 
                                    </div>
                                </div>
                          </div>
                          
                      </div>
                    </div>
                    <?php echo form_close(); ?>
                  </div>
                </div>