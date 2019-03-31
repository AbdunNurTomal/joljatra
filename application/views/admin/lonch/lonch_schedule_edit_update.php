

                <!-- Modal -->
                <div class="modal fade" id="add_schedule" tabindex="-1" role="dialog" aria-labelledby="add_schedule_label">
                  <div class="modal-dialog" role="document">
                   <?php echo form_open('admin/lonch/add_lonch_schedule/'.$lonch->id, array('id'=>'save_schedule_form')); ?>
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="add_schedule_label"><i class="fa fa-plus"> </i> Add a Schedule</h4>
                      </div>
                      <div class="modal-body" style="overflow: hidden;">
                          <div class="col-sm-6">
                              <div class="form-group row">
                                    <label for="from_destinaton" class="col-sm-12 col-form-label">From</label>
                                    <div class="col-sm-12">
                                       <select name="from_destination" id="from_destinaton" class="form-control" required>
                                           <option value="">Select..</option>
                                           <?php if($destinations){foreach($destinations as $destination){
                                            echo '<option value="'.$destination->name.'">'.$destination->name.'</option>';
                                            }} ?>
                                       </select>
                                    </div>
                                </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group row">
                                    <label for="to_destination" class="col-sm-12 col-form-label">To</label>
                                    <div class="col-sm-12">
                                       <select name="to_destination" id="to_destination" class="form-control" required>
                                           <option value="">Select..</option>
                                           <?php if($destinations){foreach($destinations as $destination){
                                            echo '<option value="'.$destination->name.'">'.$destination->name.'</option>';
                                            }} ?>
                                       </select>
                                    </div>
                                </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group row">
                                    <label for="schedule_day" class="col-sm-12 col-form-label">Schedule Day</label>
                                    <div class="col-sm-12">
                                       <select name="schedule_day" id="schedule_day" class="form-control" required>
                                           <option value="">Select..</option>
                                           <?php if($this->config->item('days')){foreach($this->config->item('days') as $day){
                                            echo '<option value="'.$day.'">'.$day.'</option>';
                                            }} ?>
                                       </select>
                                    </div>
                                </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group row">
                                    <label for="date_picker" class="col-sm-12 col-form-label">Schedule Time</label>
						<!--<div id="report_send_time"></div>-->
                                    <div class="col-sm-12">
                                       <input type="text" name="schedule_time" id="schedule_time" class="form-control" placeholder="6:30 AM" >
                                    </div>
                                </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="save_schedule" id="save_schedule" class="btn btn-primary save_schedule"> Save Schedule</button>
                      </div>
                    </div>
                    <?php echo form_close(); ?>
                  </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="edit_schedule_model" tabindex="-1" role="dialog" aria-labelledby="edit_schedule_label">
                  <div class="modal-dialog" role="document">
                   <?php echo form_open('#', array('id'=>'edit_schedule_form', 'class'=>'save_edited_schedule')); ?>
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="edit_schedule_label"><i class="fa fa-edit"> </i> Edit Schedule</h4>
                      </div>
                      <div class="modal-body" style="overflow: hidden;">
                          <div class="col-sm-6">
                              <div class="form-group row">
                                    <label for="from_destinaton" class="col-sm-12 col-form-label">From</label>
                                    <div class="col-sm-12">
                                       <select name="from_destination" id="from_destinaton" class="form-control edit_from_destinaton" required>
                                           <option value="">Select..</option>
                                           <?php if($destinations){foreach($destinations as $destination){
                                            echo '<option value="'.$destination->name.'">'.$destination->name.'</option>';
                                            }} ?>
                                       </select>
                                    </div>
                                </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group row">
                                    <label for="to_destination" class="col-sm-12 col-form-label">To</label>
                                    <div class="col-sm-12">
                                       <select name="to_destination" id="to_destination" class="form-control edit_to_destinaton" required>
                                           <option value="">Select..</option>
                                           <?php if($destinations){foreach($destinations as $destination){
                                            echo '<option value="'.$destination->name.'">'.$destination->name.'</option>';
                                            }} ?>
                                       </select>
                                    </div>
                                </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group row">
                                    <label for="schedule_day" class="col-sm-12 col-form-label">Schedule Day</label>
                                    <div class="col-sm-12">
                                       <select name="schedule_day" id="schedule_day" class="form-control edit_schedule_day" required>
                                           <option value="">Select..</option>
                                           <?php if($this->config->item('days')){foreach($this->config->item('days') as $day){
                                            echo '<option value="'.$day.'">'.$day.'</option>';
                                            }} ?>
                                       </select>
                                    </div>
                                </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group row">
                                    <label for="date_picker" class="col-sm-12 col-form-label">Schedule Time</label>
                                    <div class="col-sm-12">
                                       <input type="text" name="schedule_time" id="schedule_time" class="form-control edit_schedule_time" placeholder="6:30 AM" >
                                    </div>
                                </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="edit_schedule" id="edit_schedule_button" class="btn btn-primary edit_schedule_button"> Edit Schedule</button>
                      </div>
                    </div>
                    <?php echo form_close(); ?>
                  </div>
                </div>
