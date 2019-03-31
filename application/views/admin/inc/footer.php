 <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      
    </div>
    <strong>Copyright &copy; 2018-2018</strong> All rights
    reserved.
    <input type="hidden" name="" value="<?php echo site_url(); ?>" id="base_url">
  </footer>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo site_url('assets/admin/'); ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAiT5UVxju-wuqnYyOU3GheIQjZbuDuGRg&sensor=false" async="" defer="defer" type="text/javascript"></script>
<script>
   $(document).ready(function(){
       
		$('.user_type').on('change', function(){
           var user_type = $('.user_type').val();
            if(user_type=='manager'){
                $('.display_for_manager').css('display', 'block');
                $(".owner_id").prop('required',true);
                $(".lonch_id").prop('required',true);
            }else{
                $('.display_for_manager').css('display', 'none');
                $(".owner_id").prop('required',false);
                $(".lonch_id").prop('required',false);
            }
		});
       
		$('.owner_id').on('change', function(){
           var owner_id = $('.owner_id').val();
            if(owner_id!=''){
                $.ajax({
                    url: '<?php echo site_url('admin/lonch/lonch_list_by_owner/'); ?>'+owner_id,
                    success: function(result){
                        $('.lonch_id').html(result);
                    }
                });
                
               $('.display_for_manager').css('display', 'block');
            }else{
                $('.lonch_id').html('<option value="">Select lonch....</option>');
            }
		});
	   
		//var rowCount = $('#myTable tr').length;
		//console.log(rowCount);
		//if(rowCount >= 5 ) {
		//	 $('#scroll').slimScroll({
		//			height: '200px',
		//			width: '80px'
		//			
		//		});
		//}
		
   });
</script>

<script>
// this is the id of the form
    $("#save_floor_form").submit(function(event) {
        var form = $(this);
        var url = form.attr('action');
        $('#save_floor').html('<i class="fa fa-spinner fa-spin"> </i> Processing');
        $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(), // serializes the form's elements.
               success: function(data)
               {
                  location.reload();  // show response from the php script.
               }
             });

        event.preventDefault(); // avoid to execute the actual submit of the form.
    });
    
    $(".edit_floor").on('click', function(ev) {
		var floor_id = $(this).attr("floor-id");
		var schedule = $(this).attr("schedule-id");
        var floor_name = $(this).attr("floor-name");
        var cabin = $(this).attr("cabin-total");
		
        var target_url = $(this).attr("target-url");
		//console.log('target '+target_url);
		$('.edit_lonch_schedule').val(schedule);
        $('.floor_name').val(floor_name);
        $('.total_cabin').val(cabin);
        $('.save_edited_floor').attr('floor-action', target_url);
        
        ev.preventDefault();
    });
    
    $("#edit_floor_form").submit(function(event) {
        var form = $(this);
        var url = form.attr('floor-action');
		//console.log('URL '+url);
        $('.edit_floor_button').html('<i class="fa fa-spinner fa-spin"> </i> Processing');
        $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(), // serializes the form's elements.
               success: function(data){
					location.reload();  // show response from the php script.
               }
             });

        event.preventDefault(); // avoid to execute the actual submit of the form.
    });
    
    
    // save a schedule
    $("#save_schedule_form").submit(function(event) {
        var form = $(this);
        var url = form.attr('action');
        $('#save_schedule').html('<i class="fa fa-spinner fa-spin"> </i> Processing');
        $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(), // serializes the form's elements.
               success: function(msg)
               {
                  location.reload();  // show response from the php script.
               }
             });

        event.preventDefault(); // avoid to execute the actual submit of the form.
    });
    
    // edit schedule
    $(".edit_schedule").on('click', function(ev) {
        var from_destination = $(this).attr("schedule-from-destination");
        var to_destination = $(this).attr("schedule-to-destination");
        var schedule_day = $(this).attr("schedule-day");
        var schedule_time = $(this).attr("schedule-time");
       
        var target_url = $(this).attr("target-url");

        $('.edit_from_destinaton').val(from_destination); 
        $('.edit_from_destinaton').change();
		//schedule_from_destionation_data(from_destination); 
		
        $('.edit_to_destinaton').val(to_destination); 
        $('.edit_to_destinaton').change();
        $('.edit_schedule_day').val(schedule_day); 
        $('.edit_schedule_day').change();
        
        $('.edit_schedule_time').val(schedule_time);
        $('.save_edited_schedule').attr('action', target_url);
        
         ev.preventDefault();
    });
	
    $("#edit_schedule_form").submit(function(event) {
        var form = $(this);
        var url = form.attr('action');
        $('.edit_schedule_button').html('<i class="fa fa-spinner fa-spin"> </i> Processing');
        $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(), // serializes the form's elements.
               success: function(data){
                  location.reload();  // show response from the php script.
               }
             });

        event.preventDefault(); // avoid to execute the actual submit of the form.
    });
    
	// set floor plan
    $(".set_floor_plan").on('click', function() {
		var schedule_id = $(this).attr("schedule-id");
        var floor_id = $(this).attr("floor-id");
        var lonch_id = $(this).attr("lonch-id");
		var floor_cabin = $(this).attr("floor-cabin");
		var floor_name = $(this).attr("floor-name");
		
		var cabin_view = $(this).attr("cabin-view"); console.log(cabin_view);
			
        $('.cabin_plan_fields').html('<center><i class="fa fa-spinner fa-spin"> </i> Loading</center>');
         $.ajax({
            url: '<?php echo site_url('admin/lonch/get_cabin_plan/'); ?>'+lonch_id+'/'+floor_id+'/'+floor_cabin+'/'+schedule_id+'/'+floor_name+'/'+cabin_view,
            success: function(result){
                $('.cabin_plan_fields').html(result);
				if(cabin_view=="lonch"){
					var footer = '<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button><button type=\"submit\" name=\"save_schedule\" id=\"save_schedule\" class=\"btn btn-primary save_schedule\"> Save Cabin Plan</button>';
				}else if(cabin_view=="group"){
					var footer = '<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>';
				}
				$('.modal-footer').html(footer);
            }
        });	
    });
    
    $("#save_cabin_plan").submit(function(event) {
			event.preventDefault();
			var form = $(this);
			
			var url = form.attr('action');
			$('.cabin_plan_alert_box').html('<i class="fa fa-spinner fa-spin"> </i> Loading');
		
			$.ajax({
				   type: "POST",
				   url: url,
				   data: form.serialize(), // serializes the form's elements.
				   success: function(data)
				   {
					var status = JSON.parse(data);  // show response from the php script.
					console.log(status);
					if(status.sign_up_success==true){
						$('.cabin_plan_alert_box').html('<div class="alert alert-dismissible alert-success "><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> Sign up success </div>');
						setTimeout(function() { 
							//$('#cabin_plan').modal().hide();
							location.reload();
						}, 1000);

					}else{
					   $('.cabin_plan_alert_box').html('<div class="alert alert-dismissible alert-danger "><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> Something wrong please try again.</div>'); 
					}
				   
				   }
				 });
        });
	function calculateCommission(actual,sells,cabin) {
		var commission = $(sells).val() - $(actual).val();
		//console.log(commission);
		//if (!isNaN(commission)&&(commission>0)){
			$(cabin).val(commission);
		//}else{
		//	$(cabin).val('');
		//}
	}
    
</script>

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo site_url('assets/admin/'); ?>bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo site_url('assets/admin/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo site_url('assets/admin/'); ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $("#tableexample1").DataTable();

  });
</script>

<!-- Sparkline -->
<script src="<?php echo site_url('assets/admin/'); ?>plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo site_url('assets/admin/'); ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo site_url('assets/admin/'); ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo site_url('assets/admin/'); ?>plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo site_url('assets/admin/'); ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo site_url('assets/admin/'); ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- timepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>  
<!-- Bootstrap WYSIHTML5 -->
<script>
        $('#checkindate').datepicker({});
		$('#checkoutdate').datepicker({});
		$('#birthday').datepicker({});
		$('#car_check_in').datepicker({});
		$('#model_checkindate').datepicker({});
		$('#model_checkoutdate').datepicker({});
		$('#from_date').datepicker({autoclose: true});
		$('#to_date').datepicker({autoclose: true});
        $('#journy_date').datepicker({ startDate: '-0d', autoclose: true});
		//$('#report_send_time').datetimepicker({
		//	format: 'LT',
		//	inline: true
		//});
</script>
<script src="<?php echo site_url('assets/admin/'); ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo site_url('assets/admin/'); ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo site_url('assets/admin/'); ?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo site_url('assets/admin/'); ?>dist/js/app.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo site_url('assets/admin/'); ?>dist/js/demo.js"></script>
<script src="<?php echo site_url('ckeditor/ckeditor.js'); ?>"></script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php if($this->user_model->get_setting_data_old('google_map_api_key')){echo $this->user_model->get_setting_data_old('google_map_api_key');} ?>&sensor=false"></script>
<script>
    $('#add_account_type').change(function(){
    var id= $(this).val();
    $.ajax({
            url: '<?php echo site_url('admin/account/account_category_by_type/'); ?>'+id,
            success: function(result){
                $('.account_cat_option').html(result);
            }
        });
	});
    $('#edit_account_type').change(function(){
    var id= $(this).val();
    $.ajax({
            url: '<?php echo site_url('admin/account/account_category_by_type/'); ?>'+id,
            success: function(result){
                $('.edit_account_cat_option').html(result);
            }
        });
	});
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
    $('#datepicker').datepicker();
    $('#datepicker_edit').datepicker();
	
	$('#fixed-table-body').slimScroll({ 
		width: '100%',
		height: '500px',
		size: '10px',
		position: 'right',
		color: '#ffcc00',
		alwaysVisible: true,
		distance: '20px',
		railVisible: true,
		railColor: '#222',
		railOpacity: 0.3,
		wheelStep: 10,
		allowPageScroll: false,
		disableFadeOut: false
	});
	/*~~~~~~~~~~~*/
	$('#group').on('change',function(){
		var group_id = $(this).val();
		if(group_id){
			$.ajax({
				type:"POST",
                cache:false,
				url:'<?php echo site_url('admin/lonch/lonch_list_by_group'); ?>',
				data: "group_id="+group_id,
				success:function(msg){
					$('#lonch').html(msg); 
					$('#schedule').html('<option value="">Select schedule....</option>');
					$('#floor').html('<option value="">Select floor....</option>'); 
				}
			}); 
		}
		//else{
		//	$('#lonch').html('<option value="">Select lonch....</option>'); 
		//	$('#schedule').html('<option value="">Select schedule....</option>');
		//	$('#floor').html('<option value="">Select floor....</option>'); 
		//}
	});
	$('#lonch').on('change',function(){
		var lonch_id = $(this).val();
		if(lonch_id){
			$.ajax({
				type:"POST",
                cache:false,
				url:'<?php echo site_url('admin/lonch/schedule_list_by_lonch/'); ?>',
				data: "lonch_id="+lonch_id,
				success:function(html){
					$('#schedule').html(html);
					$('#floor').html('<option value="">Select floor....</option>'); 
				}
			}); 
		}
	});
	$('#schedule').on('change',function(){
		var lonch_schedule = $(this).val();
		var lonch_id = $('#lonch').val();
		if(lonch_schedule){
			$.ajax({
				url:'<?php echo site_url('admin/lonch/floor_by_lonch_schedule/'); ?>'+lonch_id+'/'+lonch_schedule,
				success:function(html){
					$('#floor').html(html);
				}
			}); 
		}
	});
	$('.btn-sms-broadcast-to-all').on('click',function(){
		var sms_broadcast = $('#sms_broadcast').val();
		var type='all';
		alert(sms_broadcast);
		if(sms_broadcast!=''){
			$.ajax({
				type: "POST",
				url:'<?php echo site_url('admin/booking/broadcast_sms_send'); ?>',
				async: false,
				data: "message="+sms_broadcast+"&type="+type,
				success:function(msg){
					//alert(msg);
				}
			}); 
		}else{
			alert('You should write something...');
			$('#sms_broadcast').focus();
		}
	});
	$('.btn-sms-broadcast-to-passenger').on('click',function(){
		var sms_broadcast = $('#sms_broadcast').val();
		var type='passenger';
		alert(sms_broadcast);
		if(sms_broadcast!=''){
			$.ajax({
				type: "POST",
				url:'<?php echo site_url('admin/booking/broadcast_sms_send'); ?>',
				async: false,
				data: "message="+sms_broadcast+"&type="+type,
				success:function(msg){
					//alert('msg '+msg);
				}
			}); 
		}else{
			alert('You should write something...');
			$('#sms_broadcast').focus();
		}
	});
	$('.btn-sms-broadcast-to-owner').on('click',function(){
		var sms_broadcast = $('#sms_broadcast').val();
		var type='owner';
		alert(sms_broadcast);
		if(sms_broadcast!=''){
			$.ajax({
				type: "POST",
				url:'<?php echo site_url('admin/booking/broadcast_sms_send'); ?>',
				async: false,
				data: "message="+sms_broadcast+"&type="+type,
				success:function(msg){
					//alert('msg '+msg);
				}
			}); 
		}else{
			alert('You should write something...');
			$('#sms_broadcast').focus();
		}
	});
	$('.btn-save-map').on('click',function(){
		var name = $('#name').val();
		var info = $('#info').val();
		var latitude = $('#lat').val();
		var longitude = $('#long').val();
		
		if(name==''){ alert('Write Location name ...'); $('#name').focus();}
		if(info==''){ alert('Write Location information ...'); $('#info').focus();}
		if(latitude==''){ alert('Write Location latitude ...'); $('#lat').focus();}
		if(longitude==''){ alert('Write Location longitude ...'); $('#long').focus();}
		
		if((name!='')&&(info!='')&&(latitude!='')&&(longitude!='')){
			$.ajax({
				type: "POST",
				url:'<?php echo site_url('admin/settings/add_edit_terminal_map'); ?>',
				async: false,
				data: "name="+name+"&info="+info+"&latitude="+latitude+"&longitude="+longitude,
				success:function(msg){
					if(confirm('Your map updated'+msg)){
						//$('#map_canvas').load('terminal');
						//google.maps.event.addDomListener(window, 'load', initMap);
						location.reload();
					}
				}
			}); 
		}else{
			alert('You should write something...');
			$('#name').focus();
		}
	});
	$('.btn-remove-map').on('click',function(){
		var name = $('#name').val();
		var info = $('#info').val();
		var latitude = $('#lat').val();
		var longitude = $('#long').val();
		
		if(name==''){ alert('Write Location name ...'); $('#name').focus();}
		if(info==''){ alert('Write Location information ...'); $('#info').focus();}
		if(latitude==''){ alert('Write Location latitude ...'); $('#lat').focus();}
		if(longitude==''){ alert('Write Location longitude ...'); $('#long').focus();}
		
		if((name!='')&&(info!='')&&(latitude!='')&&(longitude!='')){
			$.ajax({
				type: "POST",
				url:'<?php echo site_url('admin/settings/delete_terminal_map'); ?>',
				async: false,
				data: "name="+name+"&info="+info+"&latitude="+latitude+"&longitude="+longitude,
				success:function(msg){
					if(confirm('Your map updated'+msg)){
						//$('#map_canvas').html();
						//google.maps.event.addDomListener(window, 'load', initMap);
						location.reload();
					}
				}
			}); 
		}else{
			alert('You should write something...');
			$('#name').focus();
		}
	});
	
</script>


<script src="<?php echo site_url('assets/admin/dist/js/custom.js'); ?>"></script>
</body>
</html>