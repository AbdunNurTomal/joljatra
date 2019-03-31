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
                <table class="table table-striped responsive-utilities jambo_table bulk_action">
                    <tbody>
                     <?php echo form_open_multipart('admin/attachment/upload'); ?>
                      <tr>
                          <td><input type="file" name="uploadImage" id=""></td>
                          <td><input class="btn btn-default" name="imageUpload" type="submit" value="Upload"></td>
                      </tr>
                      <?php echo form_close(); ?>
                    </tbody>
                  </table>
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
    