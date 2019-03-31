<?php $this->load->view('admin/inc/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('admin/inc/sidebar'); ?>

<div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> <i class="fa fa-plus"></i> New <?php echo $type; ?></h1>
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
          <h3 class="box-title"><i class="fa fa-plus"></i> page </h3>

        </div>
        <div class="box-body">
           <?php echo form_open('admin/posts/add_new/'.$type, 'class="form-horizontal form-label-left"'); ?>
            <div class="col-sm-8">
                <div class="item form-group">
                  <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:15px">
                    <input id="post_title" class="form-control col-md-12 col-xs-12" name="post_title" placeholder="Title in bangla"  type="text" value="<?php echo $this->input->post('post_title'); ?>" style="color: #666666;font-weight: bold;font-size: 18px;" required>
                  </div>
                </div>
				 <div class="item form-group">
                  <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:15px">
                    <input id="post_title_eng" class="form-control col-md-12 col-xs-12" name="post_title_eng" placeholder="Title in english"  type="text" value="<?php echo $this->input->post('post_title_eng'); ?>" style="color: #666666;font-weight: bold;font-size: 18px;" required>
                  </div>
                </div>
                <div class="item form-group">
                  <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:15px">
                   <textarea name="post_content"  id="post_content" class="form-control col-md-7 col-xs-12" name="description" placeholder="Content in bangla" value=""><?php echo $this->input->post('post_content'); ?></textarea>
                  </div>
                </div>
				 <div class="item form-group">
                  <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:15px">
                   <textarea name="post_content_eng"  id="post_content_eng" class="form-control col-md-7 col-xs-12" name="description" placeholder="Content in english" value=""><?php echo $this->input->post('post_content'); ?></textarea>
                  </div>
                </div>
                <div class="item form-group">
                  <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:15px">
                   <textarea name="post_excerpt" class="form-control col-md-12 col-xs-12" name="post_excerpt" placeholder="Excerpt" value=""><?php echo $this->input->post('post_excerpt'); ?></textarea>
                  </div>
                </div>
				<div class="item form-group">
                  <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:15px">
                   <textarea name="post_excerpt_eng" class="form-control col-md-12 col-xs-12" name="post_excerpt_eng" placeholder="Excerpt" value=""><?php echo $this->input->post('post_excerpt'); ?></textarea>
                  </div>
                </div>
                <br>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-sm-12" style="margin-bottom:15px">
                    <input id="send" type="submit" name="save_post" value="Publish" class="btn btn-success"/>
                  </div>
                </div>
            </div>
            <div class="col-sm-4">

              <div class="x_panel" style="display:none">
                <div class="x_content">
                   <h4 style="border-bottom:1px solid">Categories</h4>
                   <?php if($categories):  ?>
                   <div class="category_display">
                      <?php foreach($categories as $category) :
                        ?>
                       <p><label style="width:100%;cursor:pointer"><span><input name="post_category[]" value="<?php echo $category->id; ?>" type="checkbox"></span> <?php echo $category->category_name; ?></label></p>
                        <?php endforeach; ?>
                   </div>
                   <?php else: ?>
                   <div><p>There are no category</p></div>
                   <?php  endif; ?>
                </div>
              </div>
              
              <div class="x_panel">
                <div class="x_content">
                   <h4 style="border-bottom:1px solid">Set featured image</h4>
                   <div class="DashboardFImageContent">
                       <input type="hidden" name="fetured_image_id" id="pageAttachmentId" onkeyup="pageImageLoad(this);" value="">
                        <img src="" alt="" class="img-responsive">
                      <a href="#" onclick="void(0);" class="btn btn-link" id="removeFeaturedImage">Remove featured image</a>
                      <a href="#" class="btn btn-link" id="setFeaturedImage">Set featured image</a>
                   </div>
                </div>
              </div>
              
              <div class="x_panel">
                <div class="x_content">
                   <h4 style="border-bottom:1px solid">Youtube video ID</h4>
                   <div class="">
                        <div class="item form-group">
                            <input id="add_page_youtube_video_id" class="form-control" name="youtube_video_id" placeholder="Youtube video ID"  type="text" value="" onkeyup="display_youtube_video();">
                        </div>
                        <div id="display_youtube_video" class="embed-responsive embed-responsive-16by9">
                           
                        </div>
                   </div>
                </div>
              </div>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
         Some Another things
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
    <?php $this->load->view('admin/attachment/thikbox_window'); ?>
  </div>
 <?php $this->load->view('admin/inc/footer'); ?>