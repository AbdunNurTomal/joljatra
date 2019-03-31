<?php $this->load->view('admin/components/header'); ?>
     <?php  $this->load->model('post_model'); ?>
      <!-- page content -->
      <div class="right_col" role="main">

      	<div class="page-title">
            <div class="title_left">
                <h3>
                  <i class="fa fa-plus"></i> Category
                </h3>
            </div>
          </div>
          <div class="row">
          	<style type="text/css">
             #datatable_length, #datatable_info{display:none;} 
            </style>
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
          	<div class="col-md-6 col-xs-12">
         
              <div class="x_panel">
                <div class="x_content">
                
                   <?php echo form_open('admin/posts/add_category/'.$type, 'class="form-horizontal form-label-left"'); ?>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name<span class="required">*</span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12" name="name" placeholder="Categorty Name" required="required" type="text" value="<?php echo $this->input->post('name'); ?>" required>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Slug<span class="required">*</span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12" name="slug" placeholder="Categorty Slug" required="required" type="text" value="<?php echo $this->post_model->url_converter($this->input->post('slug')); ?>" required>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Keyword<span class="required"></span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                       <textarea name="keyword"  id="name" class="form-control col-md-7 col-xs-12" name="keyword" placeholder="Categorty keyword" value=""><?php echo $this->input->post('keyword'); ?></textarea>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Description<span class="required"></span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                       <textarea name="description"  id="name" class="form-control col-md-7 col-xs-12" name="description" placeholder="Categorty Description" value=""><?php echo $this->input->post('description'); ?></textarea>
                      </div>
                    </div>
                    
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-9 col-md-offset-3">
                        <input id="send" type="submit" name="save_category" value="Submit" class="btn btn-success"/>
                      </div>
                    </div>
                  <?php echo form_close(); ?>
                </div>
              </div>
            </div>
          	<div class="col-md-6 col-xs-12">
         
              <div class="x_panel">
                <div class="x_content">
                    <table class="table table-striped responsive-utilities jambo_table bulk_action">
                    <thead>
                      <tr class="headings">
                        <th>
                         <input type="checkbox" onClick="toggle(this)">
                        </th>
                        <th style="display: table-cell;" class="column-title">Name</th>
                        <th style="display: table-cell;" class="column-title">Slug</th>
                        <th style="display: table-cell;" class="column-title no-link last"><span class="nobr">Action</span>
                        </th>
                        <th style="display: none;" class="bulk-actions" colspan="7">
                          <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt">1 Records Selected</span> ) <i class="fa fa-chevron-down"></i></a>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php echo form_open('admin/posts/delete_all_category/'.$type); ?>
                      <?php if($categories): 
                         foreach($categories as $category) :
                        ?>
                        <tr class="even pointer">
                            <td class="a-center ">
                              <input name="all_check[]" value="<?php echo $category->id; ?>" type="checkbox">
                            </td>
                            <td class=" " valign="middle"><?php echo $category->category_name; ?></td>
                            <td class=" "><?php echo $category->category_slug; ?></td>
                            <td class="last action-divition" style="width: 120px;"><a href="<?php echo base_url().'/admin/posts/edit_category/'.$type.'/'.$category->id; ?>"><i class="fa fa-edit"></i> Edit</a>
                            <a data-toggle="modal" class="delete-confirm-btn" onclick="return confirm('Are your shure to delete this category');" href="<?php echo base_url().'/admin/posts/delete_single_category/'.$type.'/'.$category->id; ?>"><i class="fa fa-trash"></i> Delete</a>
                            </td>
                      </tr>
                      <?php endforeach; endif; ?>
                      <div class="btn-group">
                      <input type="submit" class="btn btn-danger btn-xs" value="Delete all selected category" onclick="return confirm('Do you sure to delete This ?');return false;">
                      </div>
                      <?php echo form_close(); ?>
                    </tbody>
                  </table>
                   
                </div>
              </div>
            </div>
         
          </div>
         
           
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-delete" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    ...
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a href="#" style="margin-bottom:5px" class="btn btn-danger btn-ok">Delete</a>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('admin/components/footer'); ?>