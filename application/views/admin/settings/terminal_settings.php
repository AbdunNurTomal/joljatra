<?php $this->load->view('admin/inc/header'); ?>
<!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('admin/inc/sidebar'); ?>
<?php $total_message_count = $this->user_model->new_message_count(); ?>
<?php echo $map['js']; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>TERMINAL MAP SETTINGS</h1>
	</section>
	
	<!-- Main content -->
	<section class="content">
 
		<!--this is error or success message display message-->
		<div class="row" id="message_section">
			<!--Display the confirmation message -->
			<?php if($this->session->userdata('success_msg') or $this->session->userdata('error_msg')): ?>
			<div class="col-sm-12 message_display_class">
				<?php if($this->session->userdata('success_msg')): ?>
				<div class="alert alert-success alert-dismissable">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Success!</strong> <?php echo $this->session->userdata('success_msg'); ?>
				</div>
				<?php endif; ?>
				<?php if($this->session->userdata('error_msg')): ?>
				<div class="alert alert-danger alert-dismissable">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Faield!</strong> <?php echo $this->session->userdata('error_msg'); ?>
				</div>
				<?php endif; ?>
				<?php if(isset($validation_errors)): ?>
				<div class="alert alert-danger alert-dismissable">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Faield!</strong> <?php echo $validation_errors; ?>
				</div>
				<?php endif; ?>
				<?php  $sesattr = array('success_msg' => '', 'error_msg' => '' );
				$this->session->set_userdata($sesattr); ?>
			</div>
			<?php endif; ?>
		</div>
		<!--this is error or success message display message-->
 
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<?php echo form_open('admin/settings/map'); ?>
					<div class="box-body">
						<div class="form-group row">
							<div class="col-sm-6">
								Google API Key <input class="form-control" name="google_map_api_key" id="google_map_api_key" type="text" placeholder="google api key" value="<?php if($this->user_model->get_setting_data_old('google_map_api_key')){echo $this->user_model->get_setting_data_old('google_map_api_key');} ?>" required/>
							</div>
							<div class="col-sm-6">
								Google Account <input class="form-control" name="google_map_created_id" id="google_map_created_id" type="text" placeholder="google account" value="<?php if($this->user_model->get_setting_data_old('google_map_created_id')){echo $this->user_model->get_setting_data_old('google_map_created_id');} ?>" required/>
							</div>
						</div>
						<div class="form-group row" align="center">
							<input name="save_settings" value="Save Settings" class="btn btn-primary btn-reservation" type="submit">
						</div>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-9">
				<div class="box">
					<div class="box-header with-border"><h3 class="box-title">MAP</h3></div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="col-sm-12">
							<?php echo $map['html']; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="box">
					<div class="box-header with-border"><h3 class="box-title">SETTINGS</h3></div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="col-sm-12">
							<assaid class="customer_profile_info">
								<div class="form-group row">
									<label for="name" class="col-form-label">Name</label>
									<input class="form-control" name="name" id="name" type="text" placeholder="name" value="" />
								</div>
								<div class="form-group row">
									<label for="info" class="col-form-label">Information</label>
									<input class="form-control" name="info" id="info" placeholder="Information..." rows="3" value="" />
								</div>
								<div class="form-group row">
									<label for="lat" class="col-form-label">Latitude</label>
									<input class="form-control" name="lat" id="lat" type="text" placeholder="latitude" value="" />
								</div>
								
								<div class="form-group row">
									<label for="lon" class="col-form-label">Longitude</label>
									<input class="form-control" name="long" id="long" type="text" placeholder="longitude" value="longitude" />
								</div>
								
								<!--<div class="form-group row">
									<label for="details" class="col-form-label">Details</label>
									<textarea class="form-control" name="details" id="details" rows="3">Details...</textarea>
								</div>
								<input name="udid" id="udid" type="text" disabled/>
								<input name="report_id" id="report_id" type="text" disabled/>
								<input name="session_id" id="session_id" type="text" disabled/>
								<input name="condition" id="condition" type="text" disabled/>
								-->
								<hr class="featurette-divider">
								<div class="form-group row">
									<input value="Save" class="btn btn-primary btn-save-map" type="submit" />
									<input value="Remove" class="btn btn-primary btn-remove-map" type="submit" />
								</div>
							</assaid>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /.row (main row) -->

	</section>
<!-- /.content -->
</div>
	
<script type="text/javascript">
    function initMap() {
		var map;
		var markers;
		var bounds = new google.maps.LatLngBounds();
		var mapOptions = {
			mapTypeId: 'roadmap'
		};
						
		// Display a map on the web page
		map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
		map.setTilt(50);
		//Gajaria Launch Ghat 23.549727, 90.586071
		//Munshiganj Launch Terminal 23.571410, 90.530795
		var markers = [
			<?php 
			if(count($result) > 0){
				$data = array();
				for($i=0;$i<count($result);$i++){
					$data[]= '["'.$result[$i]['name'].'","'.$result[$i]['info'].'", '.$result[$i]['lat'].', '.$result[$i]['long'].']';
				}
				echo implode(',',$data);
				unset($data);
			}
			?>
		];
							
		// Info window content
		var infoWindowContent = [
			<?php 
			if(count($result) > 0){ 
				for($i=0;$i<count($result);$i++){ ?>
					['<div class="info_content">' + '<h3><?php echo $result[$i]['name']; ?></h3>' + '<p><?php echo $result[$i]['info']; ?></p>' + '</div>'],
			<?php }
			} ?>
		];
			
		// Add multiple markers to map
		var infoWindow = new google.maps.InfoWindow(), marker, i;
		
		// Place each marker on the map  
		for( i = 0; i < markers.length; i++ ) {
			console.log(markers);
			var position = new google.maps.LatLng(markers[i][2], markers[i][3]);
			bounds.extend(position);
			marker = new google.maps.Marker({
				position: position,
				map: map,
				title: markers[i][0]
			});
			
			// Add info window to marker    
			google.maps.event.addListener(marker, 'click', (function(marker, i) {
				return function() {
					$('#name').val(markers[i][0]);
					$('#info').val(markers[i][1]);
					$('#lat').val(markers[i][2]);
					$('#long').val(markers[i][3]);
					infoWindow.setContent(infoWindowContent[i][0]);
					infoWindow.open(map, marker);
				}
			})(marker, i));

			// Center the map to fit all markers on the screen
			map.fitBounds(bounds);
		}

		// Set zoom level
		var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
			this.setZoom(10);
			google.maps.event.removeListener(boundsListener);
		});
		google.maps.event.addListener(map, 'click', function(event) {
			marker = new google.maps.Marker({
				position: event.latLng,
				map: map
			});
			google.maps.event.addListener(marker, 'click', function() {
				var latlng = marker.getPosition();
				$('#name').val('');
				$('#info').val('');
				$('#lat').val(latlng.lat());
				$('#long').val(latlng.lng());
			});
		});
	}
	
	// Load initialize function
	google.maps.event.addDomListener(window, 'load', initMap);
	
</script>
<?php $this->load->view('admin/inc/footer'); ?>