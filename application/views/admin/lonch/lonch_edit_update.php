
                <!-- Modal -->
                <div class="modal fade" id="add_floor" tabindex="-1" role="dialog" aria-labelledby="add_floor_label">
                  <div class="modal-dialog" role="document">
                   <?php echo form_open('admin/lonch/add_lonch_floor/'.$lonch->id, array('id'=>'save_floor_form')); ?>
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="add_floor_label"><i class="fa fa-plus"> </i> Add a floor</h4>
                      </div>
                      <div class="modal-body" style="overflow: hidden;">
							<div class="col-sm-4">
                              <div class="form-group row">
                                    <label for="lonch_schedule" class="col-sm-12 col-form-label">Lonch Schedule</label>
                                    <div class="col-sm-12">
										<select name="lonch_schedule" id="lonch_schedule" class="form-control" required>
										   <option value="">Select</option>
											<?php 
												if($lonch_schedules){
													foreach($lonch_schedules as $schedules){
														echo '<option value="'.$schedules->id.'">'.$schedules->from_destination.' | '.$schedules->to_destination.' | '.$schedules->time.'</option>';
													}
												}
											?>
									   </select>
									</div>
                                </div>
                          </div>
                          <div class="col-sm-4">
                              <div class="form-group row">
                                    <label for="floor_name" class="col-sm-12 col-form-label">Floor name</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" id="floor_name" placeholder="Floor name" name="floor_name" type="text" required>
                                    </div>
                                </div>
                          </div>
						  <!--
                          <div class="col-sm-4">
                              <div class="form-group row">
                                    <label for="cabin_price" class="col-sm-12 col-form-label">Cabin Price</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" id="cabin_price" placeholder="Cabin Price" name="cabin_price" type="number" required>
                                    </div>
                                </div>
                          </div>
						  <div class="col-sm-4">
                              <div class="form-group row">
                                    <label for="cabin_discount_price" class="col-sm-12 col-form-label">Discount Price</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" id="cabin_discount_price" placeholder="Discount Price" name="cabin_discount_price" type="number">
                                    </div>
                                </div>
                          </div>
						  -->
                          <div class="col-sm-4">
                              <div class="form-group row">
                                    <label for="total_cabin" class="col-sm-12 col-form-label">Total Cabin</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" id="total_cabin" placeholder="Total Cabin" name="total_cabin" type="number" required>
                                    </div>
                                </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="save_floor" id="save_floor" class="btn btn-primary save_floor"> Save Floor</button>
                      </div>
                    </div>
                    <?php echo form_close(); ?>
                  </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="edit_floor_model" tabindex="-1" role="dialog" aria-labelledby="edit_model_label">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                     <?php echo form_open('#', array('id'=>'save_edited_floor', 'class'=>'save_edited_floor')); ?>
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="edit_model_label"><i class="fa fa-edit"> </i> Edit a floor</h4>
                      </div>
                      <div class="modal-body" style="overflow: hidden;">
						<div class="col-sm-4">
                              <div class="form-group row">
                                   <label for="lonch_schedule" class="col-sm-12 col-form-label">Lonch Schedule</label>
                                    <div class="col-sm-12">
										<select name="edit_lonch_schedule" id="edit_lonch_schedule" class="form-control" required>
										   <option value="">Select</option>
											<?php 
												if($lonch_schedules){
													foreach($lonch_schedules as $schedules){
														echo '<option value="'.$schedules->id.'" '.$selected.'>'.$schedules->from_destination.' | '.$schedules->to_destination.' | '.$schedules->time.'</option>';
													}
												}
											?>
									   </select>
									</div>
                                </div>
                          </div>
                          <div class="col-sm-4">
                              <div class="form-group row">
                                    <label for="floor_name" class="col-sm-12 col-form-label">Floor name</label>
                                    <div class="col-sm-12">
                                        <input class="form-control floor_name" id="floor_name" placeholder="Floor name" name="floor_name" type="text" value="" required>
                                    </div>
                                </div>
                          </div>
						  <!--
                          <div class="col-sm-4">
                              <div class="form-group row">
                                    <label for="cabin_price" class="col-sm-12 col-form-label">Cabin Price</label>
                                    <div class="col-sm-12">
                                        <input class="form-control cabin_price" id="cabin_price" placeholder="Cabin Price" name="cabin_price" type="number" value="" required>
                                    </div>
                                </div>
                          </div>
						  <div class="col-sm-4">
                              <div class="form-group row">
                                    <label for="cabin_discount_price" class="col-sm-12 col-form-label">Discount Price</label>
                                    <div class="col-sm-12">
                                        <input class="form-control cabin_discount_price" id="cabin_discount_price" placeholder="Discount Price" name="cabin_discount_price" value="" type="number">
                                    </div>
                                </div>
                          </div>
						 -->
                          <div class="col-sm-4">
                              <div class="form-group row">
                                    <label for="total_cabin" class="col-sm-12 col-form-label">Total Cabin</label>
                                    <div class="col-sm-12">
                                        <input class="form-control total_cabin" id="total_cabin" placeholder="Total Cabin" name="total_cabin" type="number" required>
                                    </div>
                                </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="save_floor" id="save_floor" class="btn btn-primary save_floor"> Edit Floor</button>
                      </div>
                    <?php echo form_close(); ?>
                    </div>
                  </div>
                </div>