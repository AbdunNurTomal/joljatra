<?php $this->load->view('admin/inc/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('admin/inc/sidebar'); ?>
<?php $total_message_count = $this->user_model->new_message_count(); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lonch groups <a href="<?php echo site_url('admin/lonch/add_new_group'); ?>" class="btn btn-success">Add new group</a>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Lonch Group List</li>
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
    <style>
		.add-scroll {
		  overflow-y: scroll;
		  height: 100px;
		}

		#results tr td {
		}
	</style>
      <!-- Small boxes (Stat box) -->
      <div class="row">
       
      <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Users list</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-sm-12">
                <table class="table table-bordered" cellspacing="0" width="100%">
                <thead bgcolor="#90EE90">
					<tr>
						<th>Picture</th>
						<th>Title(Bangla)</th>
						<th>Title(English)</th>
						<th>Description(Bangla)</th>
						<th>Description(English)</th>
						<th>Owner</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if($lonch_groups): foreach($lonch_groups as $group): ?>
						<tr>
							<td style="max-width:100px"><a href="<?php echo site_url('admin/lonch/edit_group/'.$group->id); ?>"><img src="<?php echo site_url('uploads/lonch-group/'.$group->group_picture); ?>" alt="" class="img-responsive" style="width:80px"></a></td>
							<td><a href="<?php echo site_url('admin/lonch/edit_group/'.$group->id); ?>"><?php echo $group->group_name; ?></a></td>
							<td><a href="<?php echo site_url('admin/lonch/edit_group/'.$group->id); ?>"><?php echo $group->group_name_eng; ?></a></td>
							<td><?php echo $group->group_description; ?></td>
							<td><?php echo $group->group_description_eng; ?></td>
							
							<td><?php 
							$user = $this->user_model->get_user($group->owner_id);
							if($user){
							echo $user->first_name.' '.$user->last_name;
							}else{echo 'No owner found';}
							?></td>

							<td>
							<div class="btn-group">
							<a href="<?php echo site_url('admin/lonch/edit_group/'.$group->id); ?>" class="btn btn-success"><i class="fa fa-pencil-square-o"></i></a>
							<a href="<?php echo site_url('admin/lonch/delete_group/'.$group->id); ?>" class="btn btn-danger" onclick="return confirm('Are you shure...? You really want delete this user');"><i class="fa fa-trash"></i></a>
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