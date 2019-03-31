<?php $this->load->view('admin/inc/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('admin/inc/sidebar'); ?>
  <?php $total_message_count = $this->user_model->new_message_count(); ?>


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

 <div class="row">

		
          <div class="col-md-6 col-sm-6 col-xs-12">
             <div class="box box-primary">
                <div class="box-header">
                  <h2>Add a new account</h2>
          
                  <div class="clearfix"></div>
                </div>
                <div class="box-body">

                  <!-- start form for validation -->
                  <?php echo form_open("admin/account/add_account");  ?>
						  <fieldset>
							<div class="form-group">
                                <label>Date:</label>

                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input  name="date"  placeholder="Set date" class="form-control pull-right" id="datepicker" type="text" required>
                                </div>
                                <!-- /.input group -->
                              </div>
						  </fieldset>
						
                        <label for="heard">Choose a account type:</label>
                        <select id="add_account_type" name="account_type" class="form-control" required>
                          <option class="account_type" value="">Choose type</option>
                          <option class="account_type" value="income">Income</option>
                          <option class="account_type" value="expenditure">Expenditure</option>
                        </select>
						
						<label for="heard">Choose a category:</label>
                        <select name="account_category" class="form-control account_cat_option" required>
                          <option value="">Choose Category</option>
                        </select>

                        <label for="message">Account:</label>
						<div class="input-group">
                            <span class="input-group-addon"><?php echo $this->config->item('currency_symbol'); ?></span>
                            <input class="form-control" name="account" type="number" min="0" required>
                            <span class="input-group-addon">.00</span>
                          </div>
                        <label for="message">Parpose:</label>
						<input class="form-control" name="parpose" type="text" required>
						
                        <label for="message">Voucher Number:</label>
						<input class="form-control" name="voucher" type="text" required>
						
                        <label for="message">Comment:</label>
						<textarea id="message" required="required" class="form-control" name="comment" placeholder="Type something"></textarea>
                        <br>
						<input  class="btn btn-success" name="add-account" type="submit" value="Add Account" />
				  <?php echo form_close();  ?>
                  <!-- end form for validations -->

                </div>
              </div>
            </div>

			
			<!--edit category form appeyer-->
          <div class="col-md-6 col-sm-6 col-xs-12" style="display:none;display:<?php if($ac_id){echo'block';} ?>">
             <div class="box box-primary">
                <div class="box-header">
                  <h2>Edit the account</h2>
             
                  <div class="clearfix"></div>
                </div>
                <div class="box-body">

                  <!-- start form for validation -->
				  <?php $id=0; if($ac_id){
					 $id=$ac_id;
					  $ac_property=$this->basic_model->get_accouts_property($id);
					 ?>
                  <?php echo form_open("admin/account/edit_account/".$id);  ?>
						  <fieldset>
			
							<div class="form-group">
                                <label>Date:</label>

                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input  name="date"  placeholder="Set date" class="form-control pull-right" id="datepicker_edit" value="<?php echo $ac_property['month'].'/'.$ac_property['day'].'/'.$ac_property['year']; ?>" type="text" required>
                                </div>
                                <!-- /.input group -->
                              </div>
						  </fieldset>
						
                        <label for="heard">Choose a account type:</label>
                        <select id="edit_account_type"  name="account_type" class="form-control" required>
                          <option class="account_type" value="">Choose type</option>
                          <option class="account_type" value="income" <?php if($ac_property['type']=='income'){echo 'selected';} ?>>Income</option>
                          <option class="account_type" value="expenditure" <?php if($ac_property['type']=='expenditure'){echo 'selected';} ?>>Expenditure</option>
                        </select>
						
						<label for="heard">Choose a category:</label>
                        <select name="account_category" class="form-control edit_account_cat_option" required>
                          <option value="<?php echo $ac_property['texconomy_id'];?>"><?php $cat_property=$this->basic_model->category_property($ac_property['texconomy_id']); echo $cat_property['cat_name'];?></option>
                        </select>

                        <label for="message">Account:</label>
						
						<div class="input-group">
                            <span class="input-group-addon"><?php echo $this->config->item('currency_symbol'); ?></span>
                            <input class="form-control" name="account" type="number" min="0" value="<?php echo $ac_property['account'];?>" required>
                            <span class="input-group-addon">.00</span>
                          </div>
                        <label for="message">Parpose:</label>
						<input class="form-control" name="parpose" type="text" value="<?php echo $ac_property['parpose'];?>" required>
						
                        <label for="message">Voucher Number:</label>
						<input class="form-control" name="voucher" type="text" value="<?php echo $ac_property['voucher'];?>" required>
						
                        <label for="message">Comment:</label>
						<textarea id="message" required="required" class="form-control" name="comment" placeholder="Type something"><?php echo $ac_property['comment'];?></textarea>
                        <br>
						<input  class="btn btn-success" name="edit-account" type="submit" value="Edit Account" />
						
						<?php } ?>
                 
				  <?php echo form_close();  ?>
                  <!-- end form for validations -->

                </div>
              </div>
            </div>
			
			
			
			
			
			
		  
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="box box-primary">
                <div class="box-header">
                  <h2>Recent Add account</h2>
                
                  <div class="clearfix"></div>
                </div>
                <div class="box-body">
                  <table id="tableexample1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Account</th>
                        <th>Account Type</th>
                        <th>Account Category</th>
                        <th>Parpose</th>
                        <th>Voucher Number</th>
                        <th>Comment</th>
                        <th>Action</th>
                      </tr>
                    </thead>


                    <tbody>
					<?php foreach($this->basic_model->recent_account_list() as $recent_account){ 
					
					$category_name=$this->basic_model->category_property($recent_account->texconomy_id);
					?>
                      <tr>
                        <td><?php echo $recent_account->day.'/'.$recent_account->month.'/'.$recent_account->year; ?></td>
                        <td><i class="fa fa-gbp"> </i> <?php echo $recent_account->account; ?></td>
                        <td><?php echo $recent_account->type; ?></td>
                        <td><?php echo $category_name['cat_name']; ?></td>
						<td><?php echo $recent_account->parpose; ?></td>
						<td><?php echo $recent_account->voucher; ?></td>
                        <td><?php echo $recent_account->comment; ?></td>
                        <td>
							<a class="btn btn-default btn-xs" href="<?php echo base_url().'admin/account/add_account/'.$recent_account->id; ?>"><i class="fa fa-edit"> </i> Edit</a>
							<a style="" href="" class="btn btn-danger btn-xs" data-href="<?php echo base_url().'admin/account/delete_account/'.$recent_account->id; ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa-times fa"> </i> Delete</a>
						</td>
                      </tr>
					<?php } ?>
                    </tbody>
                    <tfoot></tfoot>
                  </table>
                </div>
              </div>
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


	
	
	


