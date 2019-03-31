<?php $this->load->view('admin/inc/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('admin/inc/sidebar'); ?>

<div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> <i class="fa fa-file-text"></i> <?php echo $type; ?>s <a href="<?php echo site_url('admin/posts/add_new/'.$type); ?>" class="btn btn-success">Add new <?php echo $type; ?></a></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
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

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-file-text"></i> <?php echo $type; ?>s </h3>

        </div>
        <div class="box-body">
          <table class="table table-bordered">
                <thead>
                  <tr class="headings">
                    <th style="display: table-cell;" class="column-title">Title(Bangla)</th>
					<th style="display: table-cell;" class="column-title">Title(English)</th>
                    <th style="display: table-cell;" class="column-title">Excerpt(Bangla)</th>
					<th style="display: table-cell;" class="column-title">Excerpt(English)</th>
                    <th style="display: table-cell;" class="column-title">Author</th>
                    <th style="display: table-cell;" class="column-title">Date</th>
                    <th style="display: table-cell;" class="column-title no-link last"><span class="nobr">Action</span>
                    </th>
                    <th style="display: none;" class="bulk-actions" colspan="7">
                      <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt">1 Records Selected</span> ) <i class="fa fa-chevron-down"></i></a>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php if($post_data):
                    $this->load->model('user_model');
                     foreach($post_data as $post) :
                    ?>
                    <tr class="even pointer">
                        <td class=" " valign="middle"><?php echo $post->post_title; ?></td>
						 <td class=" " valign="middle"><?php echo $post->post_title_eng; ?></td>
                        <td class=" "><?php echo $post->post_excerpt; ?></td>
						<td class=" "><?php echo $post->post_excerpt_eng; ?></td>
                        <td class=" "><?php echo $this->user_model->user_name($post->post_author); ?></td>
                        <td class=" "><?php echo $post->post_date; ?></td>
                        <td class="last action-divition" style="min-width: 120px;"><a href="<?php echo base_url().'admin/posts/edit/'.$post->id.'/'.$post_type; ?>"><i class="fa fa-edit"></i> Edit</a>
                        <a class="delete-confirm-btn" href="<?php echo base_url().'admin/posts/delete/'.$post->id.'/'.$post_type; ?>" onclick="return confirm('Are you shure to delete this post');"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                  </tr>
                  <?php endforeach; endif; ?>
                </tbody>
              </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
         <?php echo $links; ?>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
 <?php $this->load->view('admin/inc/footer'); ?>