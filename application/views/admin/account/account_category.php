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
                  <h3>The account category list</h3>
                  <div class="clearfix"></div>
                </div>
                <div style="display: block;" class="box-body">

                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Category name</th>
                        <th>Category Type</th>
						<th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
					
					<?php foreach($this->basic_model->the_account_category_list() as $category){ ?>
                      <tr>
                        <th scope="row"><?php echo $category->name; ?></th>
                        <td><?php echo $category->category_for; ?></td>
                        <td>
							<a class="btn btn-default btn-xs" href="<?php echo base_url().'admin/account/account_category/'.$category->id; ?>"><i class="fa fa-edit"> </i> Edit</a>
							<a style="" href="#" class="btn btn-danger btn-xs" data-href="<?php echo base_url().'admin/account/delete_account_category/'.$category->id; ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa-times fa"> </i> Delete</a>
						</td>
                      </tr>
					 <?php } ?> 
                    </tbody>
                  </table>

                </div>
              </div>
            </div>

          <div class="col-md-6 col-sm-6 col-xs-12" style="display:block;display:<?php if($cat_id){echo'none';} ?>">
             <div class="box box-primary">
                <div class="box-header">
                  <h2>Add a new categpry</h2>

                  <div class="clearfix"></div>
                </div>
                <div class="box-body">

                  <!-- start form for validation -->
                  <?php echo form_open("admin/account/add_account_category");  ?>
                        <label for="heard">Choose a category type:</label>
                        <select name="account_category" class="form-control" required>
                          <option value="">Choose type</option>
                          <option value="income">Income</option>
                          <option value="expenditure">Expenditure</option>
                        </select>

                        <label for="message">Category name:</label>
						<input class="form-control" name="category_name" type="text" required>
                        <br>
						<input  class="btn btn-success" name="add-category" type="submit" value="Add Category" />
                  
				  <?php echo form_close();  ?>
                  <!-- end form for validations -->

                </div>
              </div>
            </div>

			
			<!--edit category form appeyer-->
          <div class="col-md-6 col-sm-6 col-xs-12" style="display:none;display:<?php if($cat_id){echo'block';} ?>">
             <div class="box box-primary">
                <div class="box-header">
                  <h2>Edit the category</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="box-body">

                  <!-- start form for validation -->
				  <?php 
				  $id=0;
				  if($cat_id){
					  $cat_property=$this->basic_model->category_property($cat_id);
					  $id=$cat_id;
					 ?>
                  <?php echo form_open("admin/account/edit_account_category/".$id);  ?>
                        <label for="heard">Choose a category type:</label>
                        <select name="account_category" class="form-control" required>
                          <option value="">Choose type</option>
                          <option value="income" <?php if($cat_property['cat_type']=='income'){echo'selected';} ?>>Income</option>
                          <option value="expenditure" <?php if($cat_property['cat_type']=='expenditure'){echo'selected';} ?>>Expenditure</option>
                        </select>

                        <label for="message">Category name:</label>
						<input class="form-control" name="category_name" type="text" value="<?php echo $cat_property['cat_name']; ?>" required>
                        <br>
						<input  class="btn btn-success" name="add-category" type="submit" value="Edit Category" />
						
						<?php } ?>
                  
				  <?php echo form_close();  ?>
                  <!-- end form for validations -->

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
 

	
	
	


