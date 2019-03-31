<?php $this->load->view('admin/inc/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('admin/inc/sidebar'); ?>
  <?php $total_message_count = $this->user_model->new_message_count(); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Messages</li>
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
                <h3 class="box-title">Messages <span class="badge bg-red"><?php echo $total_message_count; ?></span> </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Message</th>
                  <th style="width: 40px">Status</th>
                  <th style="min-width: 133px;">Action</th>
                </tr>
                <?php if($messages): foreach($messages as $message): ?>
                <tr>
                  <td><?php echo $message->name; ?></td>
                  <td><?php echo $message->phone; ?></td>
                  <td><?php echo $message->email; ?></td>
                  <td><?php echo $message->message; ?></td>
                  <td>
                  <?php if($message->status=='new'){echo ' <span class="badge bg-red">New</span>';}else{echo ' <span class="badge bg-gray">Old</span>';} ?>
                  </td>
                  <td>
                    <div class="btn-group">
                        <a href="mailto:<?php echo $message->email; ?>" class="btn btn-success"><i class="fa fa-share"></i></a>
                        <a href="<?php echo site_url('admin/message/view/'.$message->id); ?>" class="btn btn-success"><i class="fa fa-pencil-square-o"></i></a>
                        <a href="<?php echo site_url('admin/message/delete/'.$message->id); ?>" class="btn btn-danger" onclick="return confirm('Are you shure...? You really want delete this message');"><i class="fa fa-trash"></i></a>
                    </div>
                  </td>
                </tr>
                <?php endforeach; endif; ?>
                
              </tbody></table>
            </div>
          </div>
        </div>
       
       
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
 <?php $this->load->view('admin/inc/footer'); ?>