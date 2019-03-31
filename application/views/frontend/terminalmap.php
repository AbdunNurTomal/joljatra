<?php $this->load->view('frontend/header'); ?>
<?php echo $map['js']; ?>
<section id="message_section" class="video_top_content">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h1 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;"> <i class="fa fa-map "></i> <?=$this->lang->line('body_item_terminal')?> <span style="color:yellow"> </span></h1>
				
			</div>
		</div>
	</div>
</section>
<section id="" class="displa_error_messge">
	<div class="container">
		<div class="row" id="message_section">
			<!--Display the confirmation message -->
			<?php if($this->session->userdata('success_msg') or $this->session->userdata('error_msg')): ?>
			<div class="col-sm-12 message_display_class" style="padding-top:50px">
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
	</div>
</section>
	
<section class="service_section notcie_section">
	<div class="container">
		<div class="row">
			<div class="notice_row col-sm-12">
				<?php echo $map['html']; ?>
				<!--<div class="embed-responsive embed-responsive-16by9">
					<iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d117788.2827773035!2d90.28376332314961!3d22.695367861275827!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x37553407fbece487%3A0x5d069b9599d4414a!2sBarisal!5e0!3m2!1sen!2sbd!4v1537160215558" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>-->
			</div>
		</div>
	</div>
</section>
	
<script type="text/javascript">
    function initMap() {
		var map;
		var markers;
		var bounds = new google.maps.LatLngBounds();
		var mapOptions = {
			mapTypeId: 'roadmap',
			//zoom: 8
		};
						
		// Display a map on the web page
		map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
		map.setTilt(50);
		//map.setZoom(7);
			
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
			<?php }unset($result);
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
	}
	
	// Load initialize function
	google.maps.event.addDomListener(window, 'load', initMap);
	
</script>
	
<?php $this->load->view('frontend/footer'); ?>