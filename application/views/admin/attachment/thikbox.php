                        <?php foreach($attachments as $attachment): ?>
                        <div class="col-md-2 col-sm-2 col-lg-2 col-xs-12 customtimgbox-padding">
                             <div class="thikboxImage" value="<?php echo $attachment->id; ?>">
                                 <img src="<?php echo base_url().$this->attachment_model->thumbnail_src($attachment->id, 'dashboard-thumb'); ?>" alt="" class="img-responsive ">
                             </div>
                         </div>
                         <?php endforeach; ?>
                         <div class="col-md-12">
                             <?php echo $links ?>
                         </div>