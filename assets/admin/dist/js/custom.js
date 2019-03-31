  var base_url=$('#base_url').val();

  //This system for add and edit post youtube video id to convert iframe-------------------------------------------------------------------------
   window.onload = display_youtube_video();
    function display_youtube_video(){
        var add_page_youtube_video_id = document.getElementById('add_page_youtube_video_id');  
        var display_youtube_video = document.getElementById('display_youtube_video');
        
        if(add_page_youtube_video_id!= null){
           if(add_page_youtube_video_id.value){
                display_youtube_video.innerHTML = '<iframe src="https://www.youtube.com/embed/'+add_page_youtube_video_id.value+'?feature=oembed" allowfullscreen="" width="500" height="281" frameborder="0"></iframe>';
            }else{
                display_youtube_video.innerHTML=' <p>Please input a youtube video ID</p> ';
            }
        }
    }
	
	//end here-------------------------------------------------------------------------
	
	
	
	//check box toggol  select all-------------------------------------------------------------------------
	function toggle(source) {
      checkboxes = document.getElementsByName('all_check[]');
      for(var i=0, n=checkboxes.length;i<n;i++) {
        checkboxes[i].checked = source.checked;
      }
    }
	//end here-----------------------------------------------------------------------------------------
	
	
	//Thik box function -----------------------------------------------------------------------------------------
	$(document).on("click", ".thikboxImage", function(){
		$('.thikboxImage').removeClass('thikboxImageActive');
		$(this).addClass('thikboxImageActive');
		var attachId = $(this).attr('value');
		$('#attachmentId').val(attachId);
	});
	
	
	
	$('document').ready(function(){
		$('.CloseThikBox').on('click', function(){
			$('.thikBoxArea').fadeToggle(200);
		});
		
		/*remove featured image*/
		$('#removeFeaturedImage').on("click", function(e){
			e.preventDefault();
			$('.DashboardFImageContent img').hide();
			$('#pageAttachmentId').val('');
			$(this).hide();
		});
		
		$('.setItemThikbox').on("click", function(e){
			e.preventDefault();
			var fival = $('#attachmentId').val();
			if(fival){
				pageImageLoad(fival);
				$('.DashboardFImageContent img').show();
				$('#removeFeaturedImage').show();
				$('#pageAttachmentId').val(fival);
				$('.thikBoxArea').fadeToggle(200);
			}else{
				alert('Please select an image from here');
			}
		});
		
	});
	
	$('document').ready(function(){
		$( "#setFeaturedImage" ).on( "click", function(event){
		  event.preventDefault();
		  $('.thikBoxArea').fadeToggle(200);
		});
		
	});
	
	/*This function thik box content*/
	window.onload = thikBoxContent();
	function thikBoxContent(get_url=null){
		var main_url = base_url+'/admin/attachment/thikbox/';
		if(get_url!=null){
			main_url = get_url;
		}
		$('document').ready(function(){
			$('.thikBoxContent').html('<img src="'+base_url+'/assets/admin/images/loading2.gif" class="img-responsive" />'); 
			$.ajax({
				url: main_url,
				success: function(result){
					$('.thikBoxContent').html(result);
				}
			});
		});
	}
	
	$(document).on("click", ".thikbox-magination li a", function(e){
		e.preventDefault();
		var new_url = $(this).attr('href');
		$('.thikBoxContent').html('<img src="'+base_url+'/assets/admin/images/loading2.gif" class="img-responsive" />'); 
		$.ajax({
			url: new_url,
			success: function(result){
				$('.thikBoxContent').html(result);
			}
		});
	});
	
	$(document).on("click", ".thikbox-magination .active a", function(e){
		e.preventDefault();
		var new_url = base_url+'/admin/attachment/thikbox/';
		$('.thikBoxContent').html('<img src="'+base_url+'/assets/admin/images/loading2.gif" class="img-responsive" />'); 
		$.ajax({
			url: new_url,
			success: function(result){
				$('.thikBoxContent').html(result);
			}
		});
	});
	
	
	$(document).on("click", "#setFeaturedImage", function(e){
		e.preventDefault();
		var new_url = base_url+'/admin/attachment/thikbox/';
		$('.thikBoxContent').html('<img src="'+base_url+'/assets/admin/images/loading2.gif" class="img-responsive" />'); 
		$.ajax({
			url: new_url,
			success: function(result){
				$('.thikBoxContent').html(result);
			}
		});
	});
	
/*This function of change the featured image*/
	function pageImageLoad(value){
		var new_url = base_url+'/admin/attachment/get_thumb/'+value+'/featured-thumb';
		$.ajax({
			url: new_url,
			success: function(result){
				console.log(result);
				$('.DashboardFImageContent img').attr('src', result);
			}
		});
	}
	
	/*Onload display featured image*/
	window.onload = set_feature_imge_on_load();
	function set_feature_imge_on_load(){
		$('document').ready(function(){
			var featured = $('#pageAttachmentId').val();
			if(featured){
				pageImageLoad(featured);
			}else{
				$('.DashboardFImageContent img').hide();
				$('#removeFeaturedImage').hide();
			}
		});
	}
	
	
	
/*Featured image upload with ajax*/

	$(function(){
		var inputFile = $('input[name=uploadImage]');
		var uploadUri = $('#upload_form').attr('action');
		var progressBar = $('#progress_bar');
		
		$('#upload_btn').on('click', function(event){
			
			var fileUploaded = inputFile[0].files[0];
			if(fileUploaded != 'undefined'){
				$('#progress_bar').addClass('active');
				var formData = new FormData();
				formData.append('uploadImage', fileUploaded);
				$.ajax({
					url: uploadUri,
					type: 'post',
					data: formData,
					processData: false,
					contentType: false,
					success: function(data){
						listFileFromServer();
					},
					xhr: function(){
						var xhr = new XMLHttpRequest();
						xhr.upload.addEventListener("progress", function(event){
							if(event.lengthComputable){
								var parcentComplete = Math.round((event.loaded / event.total) * 100);
								$('.thik_box_file_upload .progress').show();
								//console.log(parcentComplete);
								progressBar.css({width: parcentComplete + '%'});
								progressBar.text(parcentComplete + '% complete');
								if(parcentComplete>=100){
									$('#progress_bar').removeClass('active');
									$('.thikBoxContent').html('<img src="'+base_url+'/assets/admin/images/loading2.gif" class="img-responsive" />'); 
								}
							}
						}, false);
						
						return xhr;
					}
				});
			}
		});
		
		/*This function forload images*/
		function listFileFromServer(get_url=null){
			var main_url = base_url+'/admin/attachment/thikbox/';
			if(get_url!=null){
				main_url = get_url;
			}
			$('.thikBoxContent').html('<img src="'+base_url+'/assets/admin/images/loading2.gif" class="img-responsive" />'); 
			$.ajax({
				url: main_url,
				success: function(result){
					$('.thikBoxContent').html(result);
				}
			});
		}
	});
		
	//ck editor implementation-------------------------------------------------------------------------
	CKEDITOR.replace( 'post_content' );
	CKEDITOR.replace( 'post_content_eng' );
	//end here-----------------------------------------------------------------------------------------
	