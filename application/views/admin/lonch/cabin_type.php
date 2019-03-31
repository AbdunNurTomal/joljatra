<?php $this->load->view('admin/inc/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('admin/inc/sidebar'); ?>
  <?php $total_message_count = $this->user_model->new_message_count(); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Lonch Destinations</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Lonch Destinations</li>
      </ol>
    </section>
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
       
      <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Destination List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-sm-12">
                <form action="<?php  echo site_url('admin/lonch/cabin_type/'); if(isset($cabin_type_id)){echo $cabin_type_id;}?>" method="post">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="col-sm-3" style="padding:0px 5px">
                                <label for="title">Cabin Type</label>
                                <input type="text"  id="title" class="form-control" name="title" placeholder="Cabin Type Name" value="<?php if(isset($cabin_type)){echo $cabin_type->title;}else{echo $this->input->post('title');} ?>" required>
                            </div>
                            <div class="col-sm-3" style="padding:0px 5px">
                                <label for="price">Cabin Type Price</label>
                                <input type="number"  id="price" class="form-control" name="price" placeholder="Cabin Type Price" value="<?php if(isset($cabin_type)){echo $cabin_type->price;}else{echo $this->input->post('price');} ?>" required>
                            </div>
                            <div class="col-sm-3" style="padding:0px 5px">
                                <label for="add_destination"> Submit</label>
                                <input name="submit_cabin_type" value="Add Cabin Type" class="btn btn-success" style="width:100%" type="submit">
                            </div>

                        </div>
                    </div>
                <?php echo form_close(); ?>
                  <table class="table table-bordered">
                <tbody><tr>
                  <th>Destination</th>
                  <th>Action</th>
                </tr>
                <?php if($cabin_types): foreach($cabin_types as $cabin_type): ?>
                <tr>
                  
                  <td><?php echo $cabin_type->title; ?></td>
                  <td><?php echo $cabin_type->price; ?></td>
                  
                  <td>
                    <div class="btn-group">
                        <a href="<?php echo site_url('admin/lonch/cabin_type/'.$cabin_type->id); ?>" class="btn btn-success"><i class="fa fa-pencil-square-o"></i></a>
                        <a href="<?php echo site_url('admin/lonch/delete_cabin_type/'.$cabin_type->id); ?>" class="btn btn-danger" onclick="return confirm('Are you shure...? You really want delete this cabin type');"><i class="fa fa-trash"></i></a>
                    </div>
                  </td>
                </tr>
                <?php endforeach; endif; ?>
                
              </tbody>
              </table>
              <?php if(isset($links)){echo $links;} ?>
              </div>
            </div>
          </div>
        </div>
       
       
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
 <?php $this->load->view('admin/inc/footer'); ?>