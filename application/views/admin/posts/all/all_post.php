<?php $this->load->view('admin/components/header'); ?>
      <!-- page content -->
      <div class="right_col" role="main">

      	<div class="page-title">
            <div class="title_left">
                <h3>
                  <i class="fa fa-user"></i> <?php echo $type; ?>s
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
                <?php $form_attr=array('name'=>'myform', 'id'=>'myform'); echo form_open('admin/posts/delete_all/'.$post_type, $form_attr); ?>
                 <div class="btn-group">
                    <a href="<?php echo base_url(); ?>admin/posts/add_new/<?php echo $post_type; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Add New <?php echo $type; ?></a>
                     <input type="submit" onclick="return confirm('Do you sure to delete This ?');return false;" value="Delete <?php echo $type; ?>s" class="btn btn-danger btn-sm">
                 </div>
                <div class="btn-group">
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-sm"><?php echo $type; ?> status</button>
                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        </button>
                    <ul class="dropdown-menu" role="menu">
                       <?php foreach($post_status as $status){
                            echo '<li><a href="'.base_url().'admin/posts/type/'.$post_type.'/'.$status.'">'.$status.' <span class="badge badge-danger">'.$this->post_model->get_post_count($post_type, $status).'</span></a></li>';
                        } ?>
                    </ul>
                    </div>
                 </div>
                  <table class="table table-striped responsive-utilities jambo_table bulk_action">
                    <thead>
                      <tr class="headings">
                        <th>
                         <input type="checkbox" onClick="toggle(this)">
                        </th>
                        <th style="display: table-cell;" class="column-title">Title</th>
                        <th style="display: table-cell;" class="column-title">Excerpt</th>
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
                            <td class="a-center ">
                              <input name="all_check[]" value="<?php echo $post->id; ?>" type="checkbox">
                            </td>
                            <td class=" " valign="middle"><?php echo $post->post_title; ?></td>
                            <td class=" "><?php echo $post->post_excerpt; ?></td>
                            <td class=" "><?php echo $this->user_model->user_name($post->post_author); ?></td>
                            <td class=" "><?php echo $post->post_date; ?></td>
                            <td class="last action-divition" style="min-width: 120px;"><a href="<?php echo base_url().'admin/posts/edit/'.$post->id.'/'.$post_type; ?>"><i class="fa fa-edit"></i> Edit</a>
                            <a class="delete-confirm-btn" href="<?php echo base_url().'admin/posts/delete/'.$post->id.'/'.$post_type; ?>" onclick="return confirm('Are you shure to delete this post');"><i class="fa fa-trash"></i> Delete</a>
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
         
    
<script type="text/javascript">
function submitform()
{
  document.myform.submit();
}
</script>

<?php $this->load->view('admin/components/footer'); ?>