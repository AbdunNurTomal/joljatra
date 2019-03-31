

                <!-- Modal -->
                <div class="modal fade " id="cabin_plan" tabindex="-1" role="dialog" aria-labelledby="cabin_plan_label">
                  <div class="modal-dialog modal-lg" style="width:90%" role="document">
                   <?php echo form_open('admin/lonch/save_cabin_plan/', array('id'=>'save_cabin_plan')); ?>
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="cabin_plan_label"><i class="fa fa-plus"> </i>  Cabin Plan</h4>
                      </div>
                      <div class="modal-body" style="overflow: hidden;">
                        
                         <div class="cabin_plan_alert_box">
                             
                         </div>
                          <div class="cabin_plan_fields">
                              
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="save_schedule" id="save_schedule" class="btn btn-primary save_schedule"> Save Cabin Plan</button>
                      </div>
                    </div>
                    <?php echo form_close(); ?>
                  </div>
                </div>