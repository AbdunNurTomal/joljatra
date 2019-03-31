            <section class="thikBoxArea fix">
                 <div class="container">
                    <div class="row custom-margin thikBoxHeader">
                         <div class="col-md-2 col-sm-2 col-lg-2 col-xs-2 custom-padding">
                         </div>
                         <div class="col-md-10 col-sm-10 col-lg-10 col-xs-10 custom-padding">
                              <div class="CloseThikBox"><span class="btn btn-default btn-sm"><i class="fa fa-times"></i></span></div>
                              <div class="thik_box_file_upload">
                                 
                                  <?php echo form_open_multipart('admin/attachment/ajax_upload', array('id'=>'upload_form')); ?>
                                  
                                    <div class="progress">
                                        <div id="progress_bar" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                        40% Complete
                                        </div>
                                    </div>
                                  <span id="upload_btn" class="btn btn-default btn-sm" style="margin: 8px 8px;float:right">Upload</span>
                                  <input type="file" name="uploadImage"  style="margin: 8px 8px;float:right" id="">
                                  <?php echo form_close(); ?>
                              </div>
                         </div>
                    </div>
                    <div class="row custom-margin thikBoxContent">
                         
                    </div>
                     <div class="row custom-margin thikBoxFooter">
                        <div class="col-md-2 col-sm-2 col-lg-2 col-xs-2 custom-padding"></div>
                         <div class="col-md-10 col-sm-10 col-lg-10 col-xs-10 custom-padding">
                            <input type="hidden" name="" id="attachmentId" value="">
                             <div class="setItemThikbox"><span class="btn btn-primary btn-sm"> Set Featured Image </span></div>
                         </div>
                     </div>
                 </div>
             </section>