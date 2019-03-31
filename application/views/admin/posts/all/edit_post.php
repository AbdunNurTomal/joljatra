<?php $this->load->view('admin/components/header'); ?>
     <?php  $this->load->model('post_model'); ?>
      <!-- page content -->
      <div class="right_col" role="main">

      	<div class="page-title">
            <div class="title_left">
                <h3>
                  <i class="fa fa-plus"></i> Edit <?php echo $type; ?>  <a href="<?php echo base_url(); ?>admin/posts/add_new/<?php echo $type; ?>" class="btn btn-default btn-sm"> Add New <?php echo $type; ?>  <i class="fa fa-plus"></i></a>
                </h3>
            </div>
          </div>
          <div class="row">
          	<style type="text/css">
             #datatable_length, #datatable_info{display:none;} 
            </style>
            <?php echo form_open('admin/posts/edit/'.$post_id.'/'.$type, 'class="form-horizontal form-label-left"'); ?>
            <?php foreach($post_data as $post): ?>
            <div class="col-md-12 col-sm12 col-xs-12">
                   <!--This is message box-->
                <?php if($this->session->userdata('action')): ?>
                <div class="x_panel <?php echo $this->session->userdata('action_class'); ?> ">
                    <div class="x_title">
                      <h2><?php echo $this->session->userdata('action_title'); ?></h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li style="float:right"><a style="cursor:pointer" class="close-link"><i class="fa fa-close"></i></a></li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                      <?php echo $this->session->userdata('action'); ?>

                    </div>
                  </div>
                 <?php endif; $this->session->unset_userdata(array('action', 'action_title', 'action_class')); ?>
                  <!--Message box end-->

             
            </div>
          	<div class="col-md-8 col-xs-12">
         
              <div class="x_panel">
                <div class="x_content post_type_box">
                   
                    <div class="item form-group">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input id="name" class="form-control col-md-12 col-xs-12" name="post_title" placeholder="Title"  type="text" value="<?php echo $post->post_title; ?>" style="color: #666666;font-weight: bold;font-size: 18px;" required>
                      </div>
                    </div>
                    <div class="item form-group">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                       <textarea name="post_content"  id="post_content" class="form-control col-md-7 col-xs-12" name="description" placeholder="Content" value=""><?php echo  $post->post_content; ?></textarea>
                      </div>
                    </div>
                    <div class="item form-group">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                       <textarea name="post_excerpt"  id="name" class="form-control col-md-12 col-xs-12" name="post_excerpt" placeholder="Excerpt" value=""><?php echo  $post->post_excerpt; ?></textarea>
                      </div>
                    </div>
                    
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="">
                        <input id="send" type="submit" name="save_post" value="Update" class="btn btn-success"/>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            
            
            <!--Right side var--->
          	<div class="col-md-4 col-xs-12">
         
              <div class="x_panel">
                <div class="x_content">
                   <h4 style="border-bottom:1px solid">Categories</h4>
                   <?php if($categories):  ?>
                   <div class="category_display">
                      <?php foreach($categories as $category) :
                       $post_category = explode(',', $post->post_category);
                        ?>
                       <p><label style="width:100%;cursor:pointer"><span><input name="post_category[]" value="<?php echo $category->id; ?>" type="checkbox" <?php if(in_array($category->id, $post_category)){echo 'checked';} ?> ></span> <?php echo $category->category_name; ?></label></p>
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
                       <input type="hidden" name="fetured_image_id" id="pageAttachmentId" onkeyup="pageImageLoad(this);" value="<?php echo $post->thumbnail; ?>">
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
                            <input id="add_page_youtube_video_id" class="form-control" name="youtube_video_id" placeholder="Youtube video ID"  type="text" value="<?php echo $post->post_youtube_video_id; ?>" onkeyup="display_youtube_video();">
                        </div>
                        <div id="display_youtube_video" class="embed-responsive embed-responsive-16by9">
                           
                        </div>
                   </div>
                </div>
              </div>
              
            </div>
                  <?php endforeach; ?>
                  <?php echo form_close(); ?>
          </div>
             
             
             
             
             
<!--
=============================================================================================================
                THIS IS THIK BOX            
=============================================================================================================            
-->
<?php $this->load->view('admin/attachment/thikbox_window'); ?>
<?php $this->load->view('admin/components/footer'); ?>