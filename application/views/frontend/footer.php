<footer class="footer_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 copy_right_text">
                <p><?php if($this->user_model->get_setting_data('footer_copyright_text')){echo $this->user_model->get_setting_data('footer_copyright_text');} ?></p>
            </div>
            <div class="col-sm-6 copy_right_text">
                <ul class="footer_social_menu">
                    <li><a target="_blank" href="<?php if($this->user_model->get_setting_data('footer_facebook_link')){echo $this->user_model->get_setting_data('footer_facebook_link');} ?>"><i class="fa fa-facebook"></i></a></li>
                    <li><a target="_blank" href="<?php if($this->user_model->get_setting_data('footer_twitter_link')){echo $this->user_model->get_setting_data('footer_twitter_link');} ?>"><i class="fa fa-twitter"></i></a></li>
                    <li><a target="_blank" href="<?php if($this->user_model->get_setting_data('footer_linkedin_link')){echo $this->user_model->get_setting_data('footer_linkedin_link');} ?>"><i class="fa fa-linkedin"></i></a></li>
                    <li><a target="_blank" href="<?php if($this->user_model->get_setting_data('footer_youtube_link')){echo $this->user_model->get_setting_data('footer_youtube_link');} ?>"><i class="fa fa-youtube"></i></a></li>
                    <li><a target="_blank" href="<?php if($this->user_model->get_setting_data('footer_google_plus_link')){echo $this->user_model->get_setting_data('footer_google_plus_link');} ?>"><i class="fa fa-google-plus"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer> 
           
<?php $this->load->view('frontend/login_sign_up_model.php'); ?> 
</div> 
</div>

<div class="overlay"></div>

<!-- jQuery CDN -->
<script  src="https://code.jquery.com/jquery-3.3.1.min.js"  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- jQuery Custom Scroller CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="<?php echo site_url('assets/frontend/'); ?>js/bootstrap-datepicker.min.js" ></script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAiT5UVxju-wuqnYyOU3GheIQjZbuDuGRg&sensor=false" async="" defer="defer" type="text/javascript"></script>

<script type="text/javascript">
	$('form').attr('autocomplete', 'off');
	/*$('#checkindate').datepicker({ startDate: '-0d'});
	$('#checkoutdate').datepicker({ startDate: '-0d'});*/
	$('#journy_date').datepicker({ startDate: '-0d', autoclose: true});
</script>
<script type="text/javascript">
	$(document).ready(function () {		
		$("#sidebar").mCustomScrollbar({
			theme: "minimal"
		});

		$('#dismiss, #menu_overlay').on('click', function () {
			$('#sidebar').removeClass('active');
			$('#menu_overlay').removeClass('active');
		});

		$('#sidebarCollapse').on('click', function () {
			$('#sidebar').addClass('active');					
			$('#menu_overlay').addClass('active');
			$('.collapse.in').toggleClass('in');
			$('a[aria-expanded=true]').attr('aria-expanded', 'false');
		});
	});
</script>
<script type="text/javascript">$('.carousel').carousel(); </script>
<script type="text/javascript">
// login submition form
$(document).ready(function(){
    $("#submit_login_form").submit(function(event) {
        event.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        $('.login_action').html('<i class="fa fa-spinner fa-spin"> </i>  লগইন চেষ্টা');
        $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(), // serializes the form's elements.
               success: function(data)
               {
                var status = JSON.parse(data);  // show response from the php script.
                if(status.login_status==true){
                    $('.login_alert_box').html('<div class="alert alert-dismissible alert-success "><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> Login success.</div>');
                    setTimeout(function() {  location.reload(); }, 1000);
                    
                }else{
                   $('.login_alert_box').html('<div class="alert alert-dismissible alert-danger "><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> Your username and password doesnot match.</div>'); 
                }
               $('.login_action').html('<i class="fa fa-sign-in"> </i>   লগইন ');
               }
             });

         // avoid to execute the actual submit of the form.
    });
    
    // logoout action
    $(".log_out_btn").on('click', function(event) {
        event.preventDefault();

        var form = $(this);
        var url = $('#site_url').val();
        $('#logout_model').modal('show');
        
        $('.logout_alert_box').html('<h3><i class="fa fa-spinner fa-spin"> </i> লগ আউট  চেষ্টা</h3>');
        $.ajax({
               type: "GET",
               url: url+'logout/logout_ajax',
               data: form.serialize(), // serializes the form's elements.
               success: function(data)
               {
                var status = JSON.parse(data);  // show response from the php script.
                if(status.login_status==true){
                    $('.logout_alert_box').html('<div class="alert alert-dismissible alert-success "><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> Logout success.</div>');
                    setTimeout(function() {  location.reload(); }, 1000);
                    
                }else{
                   $('.logout_alert_box').html('<div class="alert alert-dismissible alert-danger "><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> Something Wrong Please try again</div>'); 
                }
               
               }
             });

         // avoid to execute the actual submit of the form.
    });
    
    // forget password open model
    $(".forget_password_btn").on('click', function(event) {
        event.preventDefault();
        var form = $(this);
        var url = $('#site_url').val();
        $('#log_in_model').modal('hide');
        $('#forget_password_model').modal('show');
        
    });
    
    // submit reset email by ajax
    $("#submit_reset_email").submit(function(event) {
        event.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        $('.reset_action').html('<i class="fa fa-spinner fa-spin"> </i> রিসেট চেষ্টা');
        $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(), // serializes the form's elements.
               success: function(data)
               {
                var status = JSON.parse(data);  // show response from the php script.
                   
                if(status.reset_email==true){
                    $('.reset_email_alert').html('<div class="alert alert-dismissible alert-success "><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> SMS sending... Please wait 5 seconds </div>');
                    $('.reset_phone_number').html(status.phone_number);
                    setTimeout(function() { 
                         $('#forget_password_model').modal('hide');
                        $('#reset_code_model').modal('show');
                    }, 5000);
                    
                }else{
                   $('.reset_email_alert').html('<div class="alert alert-dismissible alert-danger "><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> '+status.reset_error+'. </div>'); 
                    $('.reset_action').html('<i class="fa fa-refresh"> </i>   রিসেট ');
                }
               
               }
             });

         // avoid to execute the actual submit of the form.
    });
    
    // submit reset email by ajax
    $("#submit_reset_code").submit(function(event) {
        event.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        $('.reset_code_action').html('<i class="fa fa-spinner fa-spin"> </i> রিসেট  কোড');
        $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(), // serializes the form's elements.
               success: function(data)
               {
                var status = JSON.parse(data);  // show response from the php script.
                   
                if(status.reset_code==true){
                    $('#reset_code_model').modal('hide');
                    $('#reset_new_password_model').modal('show');
                    
                }else{
                   $('.reset_code_alert').html('<div class="alert alert-dismissible alert-danger "><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> '+status.reset_error+'. </div>'); 
                    $('.reset_code_action').html('<i class="fa fa-refresh"> </i>   রিসেট  কোড');
                }
               
               }
             });

         // avoid to execute the actual submit of the form.
    });
    
    // submit reset email by ajax
    $("#submit_reset_new_password").submit(function(event) {
        event.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        $('.reset_password_action').html('<i class="fa fa-spinner fa-spin"> </i> রিসেট চেষ্টা');
        $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(), // serializes the form's elements.
               success: function(data)
               {
                var status = JSON.parse(data);  // show response from the php script.
                   
                if(status.reset_new_pass==true){
                    $('.login_alert_box').html('<div class="alert alert-dismissible alert-success "><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> '+status.reset_error+'. </div>'); 
                    
                    $('#reset_new_password_model').modal('hide');
                    $('#log_in_model').modal('show');
                    
                }else{
                   $('.reset_password_allert').html('<div class="alert alert-dismissible alert-danger "><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> '+status.reset_error+'. </div>'); 
                    $('.reset_password_action').html('<i class="fa fa-refresh"> </i>  রিসেট  পাসওয়ার্ড  ');
                }
               
               }
             });

         // avoid to execute the actual submit of the form.
    });
    
    // back to login
    $(".back_to_login").on('click', function(event) {
        event.preventDefault();

        $('#log_in_model').modal('show');
        $('#forget_password_model').modal('hide');
        
    });
    
    //check username validation
    $('.user_name_input').on('keyup change',  function(){
            var site_url = $('#site_url').val();
            var formData = new FormData();
            var user_name = $('.user_name_input').val();
            formData.append('user_name', user_name);
        
            $.ajax({
            url: site_url+'signup/user_name_validation',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data){
                if(data[0]==null){
                    $('.user_name_input').addClass('form-control-success');
                    $('.user_name_input').removeClass('form-control-danger');
                    $('.user_name_box').removeClass('has-danger');
                    $('.user_name_box').addClass('has-success');
                 }else{
                    $('.user_name_input').addClass('form-control-danger');
                    $('.user_name_input').removeClass('form-control-success');
                    $('.user_name_box').removeClass('has-success');
                    $('.user_name_box').addClass('has-danger');
                 }
                
            },

        });
            
    });
    
    //check user email validation
    $('.user_email_input').keyup(function(){
            var site_url = $('#site_url').val();
            var formData = new FormData();
            var user_email = $('.user_email_input').val();
            formData.append('user_email', user_email);
        
            $.ajax({
            url: site_url+'signup/user_email_validation',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data){
                console.log(data);
                if(data[0]==null){
                    $('.user_email_input').addClass('form-control-success');
                    $('.user_email_input').removeClass('form-control-danger');
                    $('.user_email_box').removeClass('has-danger');
                    $('.user_email_box').addClass('has-success');
                 }else{
                    $('.user_email_input').addClass('form-control-danger');
                    $('.user_email_input').removeClass('form-control-success');
                    $('.user_email_box').removeClass('has-success');
                    $('.user_email_box').addClass('has-danger');
                 }
                
            },

        });
            
    });
    
    // submit sign up form by ajax
    $("#submit_sign_up_form").submit(function(event) {
        event.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        $('.sign_up_action_btn').html('<i class="fa fa-spinner fa-spin"> </i> সাইন আপ চেষ্টা');
        $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(), // serializes the form's elements.
               success: function(data)
               {
                var status = JSON.parse(data);  // show response from the php script.
                if(status.sign_up_success==true){
                    $('.sign_up_alert_box').html('<div class="alert alert-dismissible alert-success "><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> Sign up success </div>');
                    setTimeout(function() { 
                        $('#sign_up_model').modal('hide');
                        $('#log_in_model').modal('show');
                    }, 1000);
                    
                }else{
                   $('.sign_up_alert_box').html('<div class="alert alert-dismissible alert-danger "><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> Something wrong please try again.</div>'); 
                }
               $('.sign_up_action_btn').html('<i class="fa fa-user-plus"> </i>   সাইন আপ ');
               }
             });

         // avoid to execute the actual submit of the form.
    });
});
</script>
</body>
</html>
