
     <?php $this->load->view('admin/components/header'); ?>
      <!-- page content -->
      <div class="right_col" role="main">

         
      	<div class="page-title">
            <div class="title_left">
                <h3>
                  <i class="fa fa-paperclip"></i> Attachments
                </h3>
            </div>
          </div>
          
          
          <div class="row">
          	<style type="text/css">
             #datatable_length, #datatable_info{display:none;} 
            </style>
          	<div class="col-md-12 col-sm-12 col-xs-12">
            
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
             
             
             
              <div class="x_panel">
                <div class="x_content">
                <?php $form_attr=array('name'=>'myform', 'id'=>'myform'); echo form_open('admin/attachment/delete_all', $form_attr); ?>
                <?php $this->load->model('attachment_model'); ?>
                 <div class="btn-group">
                    <a href="<?php echo base_url(); ?>admin/attachment/add_new/" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Add New Attachment</a>
                     <input type="submit" onclick="return confirm('Do you sure to delete This ?');return false;" value="Delete Attachments" class="btn btn-danger btn-sm">
                 </div>
                  <table class="table table-striped responsive-utilities jambo_table bulk_action">
                    <thead>
                      <tr class="headings">
                        <th>
                         <input type="checkbox" onClick="toggle(this)">
                        </th>
                        <th style="display: table-cell;" class="column-title">Medial</th>
                        <th style="display: table-cell;" class="column-title">Title</th>
                        <th style="display: table-cell;" class="column-title">Caption</th>
                        <th style="display: table-cell;" class="column-title">Extention</th>
                        <th style="display: table-cell;" class="column-title no-link last"><span class="nobr">Action</span>
                        </th>
                        <th style="display: none;" class="bulk-actions" colspan="7">
                          <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt">1 Records Selected</span> ) <i class="fa fa-chevron-down"></i></a>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if($attachments):
                         foreach($attachments as $attachment) :
                        ?>
                        <tr class="even pointer">
                            <td class="a-center ">
                              <input name="all_check[]" value="<?php echo $attachment->id; ?>" type="checkbox">
                            </td>
                            <td class=" " valign="middle"><img src="<?php echo base_url().'/'.$this->attachment_model->thumbnail_src($attachment->id, 'small-size-thumbnails'); ?>" alt="" style="width:60px"></td>
                            <td class=" "><?php echo $attachment->attachment_title; ?></td>
                            <td class=" "><?php echo $attachment->attachment_caption; ?></td>
                            <td class=" "><?php echo $attachment->attachment_format; ?></td>
                            <td class="last action-divition" style="min-width: 120px;"><a href="<?php echo base_url().'admin/attachment/edit/'.$attachment->id; ?>"><i class="fa fa-edit"></i> Edit</a>
                            <a data-toggle="modal" class="delete-confirm-btn" onclick="return confirm('Are shure to delete this attachment');" href="<?php echo base_url().'admin/attachment/delete/'.$attachment->id; ?>"><i class="fa fa-trash"></i> Delete</a>
                            </td>
                      </tr>
                      <?php endforeach; endif; ?>
                    </tbody>
                  </table>
                    <?php echo form_close(); ?>
                  <?php echo $links; ?>
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
    
<script type="text/javascript">
function submitform()
{
  document.myform.submit();
}
</script>

<?php $this->load->view('admin/components/footer'); ?>