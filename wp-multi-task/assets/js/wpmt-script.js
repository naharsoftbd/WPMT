jQuery(document).ready(function($){
        
    // Perform AJAX login/register on form submit
	$('form#login-form, form#register').on('submit', function (e) {
                   
        if (!$('form#login-form, form#register').valid()) return false;
        
        $('p.status', this).show().text(ajax_auth_object.loadingmessage);
        
		action = 'process_login';
		var userreg = $('form#login-form').serialize();
                 //alert(action);  
		if ($(this).attr('id') == 'register') {
			action = 'userregistration';
			var userreg = $('form#register').serialize();
		}
		ctrl = jQuery(this);
	$.ajax({
            type: 'POST',
            dataType: 'html',
            url: ajax_auth_object.ajaxurl,
			data: {
				'action': action,
				userreg
		},
            success: function (data) {
                 
				$('p.status').text(data);
				
					document.location.href = jQuery(ctrl).attr ('id') == 'register' ? ajax_auth_object.register_redirect : ajax_auth_object.redirecturl;
                
            }
        });
        e.preventDefault();
    });
    $('.change_passwd').click(function(){
        action = 'auth_change_password';
        var confirm_password = $('#confirm_password').val();
        var password = $('#password').val();
        var old_passord = $('#old_password').val();
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: ajax_auth_object.ajaxurl,
			data: {
				'action': action,
                'old_password': old_passord,
				'confirm_password': confirm_password,
				'password': password,
				},
            success: function (data) {
                 alert(data);
                 document.location.href = ajax_auth_object.redirecturl_login;
            },
            error: function(errorThrown){
             alert('Wrong Old Password');
    } 
      
    });
    
    });
	
    $('#new-password-form').validate({
            rules : {
                password : {
                    minlength : 5
                },
                confirm_password : {
                    minlength : 5,
                    equalTo : "#password"
                }
            } 
        });
		
    $(document).ajaxStart(function(){
        $("p.status").css("display", "block");
    });

    $(document).ajaxComplete(function(){
        $("p.status").css("display", "none");
    });
    
 
	 $('#dob-date').datepicker({
        dateFormat: "mm/dd/yy",
        changeYear: true,
        changeMonth: true,
        yearRange: "-100:+0",
      });
	  
	  
	         
	  
	$(document).ajaxStart(function(){
        $("#wait").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $("#wait").css("display", "none");
    });
	
	$('.form-control').change(function(){
		if($(this).val()){
			$(this).addClass('visited');
		}
		
	});
	
   $('.gender-label').click(function(){
	   $('.gender-label').removeClass('active');
	   $(this).addClass('active');
   });	   
});