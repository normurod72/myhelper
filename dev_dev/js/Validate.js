$(function(){
	var name = $('#name');
	var surname = $('#surname');
	var distance = $('#distance');
	var email = $('#email');
	var confirmPassword = $('#confirmPassword');
	var password = $('#password');
	var con_number = $('#con_number');

	name.focusout(function(){
		checkName(name.val());
	});
	surname.focusout(function(){
		checkSurname(surname.val());
	});
	distance.focusout(function(){
		checkDistance(distance.val());
	});
	email.focusout(function(){
		checkEmail(email.val());
	});
	password.focusout(function(){
		validatePassword(password.val());
	});
	confirmPassword.focusout(function(){
		checkPassword(password.val(), confirmPassword.val());
	});
	con_number.focusout(function(){
		check_con_number(con_number.val());
	});
	
});

function validatePassword(value){
	var regex = new RegExp(/^(?=.*[a-z0-9])(?=.*[@#$%^&+=\s]).{1,}$/i);
	var field = $("#password");
	var div = $("#password_div");
	if(value){
		
	if(regex.test(value)){
			$('#password_div div p').remove();
			$("#password_div div span").remove();
			$("#password_div div").append('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
			div.removeClass("has-error");
			div.addClass("has-success");
	}else{
			$('#password_div div p').remove();
		    $('#password_div div').append('<p class = "alert alert-danger">Please consider password should contain\nat least one special character @ # $ % ^ & + = \nwith length at least 6\nNote: space also allowed</p>');
			$("#password_div div span").remove();
		    $("#password_div div").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			div.removeClass("has-success");
			div.addClass("has-error");
		}
	}else{
			$('#password_div div p').remove();
		    $('#password_div div').append('<p class = "alert alert-danger">Please fill this field</p>');
			$("#password_div div span").remove();
		    $("#password_div div").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			div.removeClass("has-success");
			div.addClass("has-error");
	}
}

function checkPassword(password, confirm){
	var div = $("#confirm_div");
	if(confirm && password){
		
		if(password == confirm){
			$('#confirm_div div p').remove();
			$("#confirm_div div span").remove();
			$("#confirm_div div").append('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
			div.removeClass("has-error");
			div.addClass("has-success");
	}else{
			$('#confirm_div div p').remove();
		    $('#confirm_div div').append('<p class = "alert alert-danger">Password has not matched</p>');
			$("#confirm_div div span").remove();
		    $("#confirm_div div").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			div.removeClass("has-success");
			div.addClass("has-error");
		}
	}else{
			$('#confirm_div div p').remove();
		    $('#confirm_div div').append('<p class = "alert alert-danger">Please fill this field</p>');
			$("#confirm_div div span").remove();
		    $("#confirm_div div").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			div.removeClass("has-success");
			div.addClass("has-error");
	}
}

function checkDistance(value){
	var regex = new RegExp(/[0-9]+$/);
	var field = $("#distance");
	var div = $("#distance_div");
	
	if(value){
		
	if(regex.test(value)){
			
			$('#distance_div div p').remove();
			$("#distance_div div span").remove();
			$("#distance_div div").append('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
			div.removeClass("has-error");
			div.addClass("has-success");
	}else{
			$('#distance_div div p').remove();
		    $('#distance_div div').append('<p class = "alert alert-danger">Distance should be numeric</p>');
			$("#distance_div div span").remove();
		    $("#distance_div div").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			div.removeClass("has-success");
			div.addClass("has-error");
		}
	}else{
			$('#distance_div div p').remove();
		    $("#distance_div div span").remove();
		    div.removeClass("has-success");
			div.removeClass("has-error");
		   
	}
}

function checkSurname(value){
	var regex = new RegExp(/^[a-zA-Z]+$/); 
	var field = $("#surname");
	var div = $("#surname_div");
	if(value){
		
	if(regex.test(value)){
			$('#surname_div div p').remove();
			$("#surname_div div span").remove();
			$("#surname_div div").append('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
			div.removeClass("has-error");
			div.addClass("has-success");
	}else{
			$('#surname_div div p').remove();
			$('#surname_div div').append('<p class = "alert alert-danger">Surname should contain only English letters</p>');
			$("#surname_div div span").remove();
		    $("#surname_div div").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			div.removeClass("has-success");
			div.addClass("has-error");
		}
	}else{
			$('#surname_div div p').remove();
		    $('#surname_div div').append('<p class = "alert alert-danger">Please fill this field</p>');
			$("#surname_div div span").remove();
		    $("#surname_div div").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			div.removeClass("has-success");
			div.addClass("has-error");
	}
}

function checkEmail(value){
	var regex = new RegExp(/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}/i);
	var field = $("#email");
	var div = $("#email_div");
	if(value){
		
	if(regex.test(value)){
			check_available_email();
		}else{
			$('#email_div div p').remove();
			$('#email_div div').append('<p class = "alert alert-danger">Email is not valid</p>')
			$("#email_div div span").remove();
		  	$("#email_div div").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			div.removeClass("has-success");
			div.addClass("has-error");
		}
	}else{
			$('#email_div div p').remove();
			$('#email_div div').append('<p class = "alert alert-danger">Please fill this field</p>');
			$("#email_div div span").remove();
		  	$("#email_div div").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			div.removeClass("has-success");
			div.addClass("has-error");
	}
}

function check_available_email(){  
        var div = $('#email_div');
        var checking = $('#email');  
  		$.ajax({
		  method: "POST",
		  url: "check_available_email.php",
		  dataType: "json",
		  data: { email: checking.val()}
		}).done(function( result ) {
		    
		    if(result.ok=="true"){
		    	  $('#email_div div p').remove();
                  $("#email_div div span").remove();
				  $("#email_div div").append('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
				  div.removeClass("has-error");
			      div.addClass("has-success");
                }else{
                  $('#email_div div p').remove();
                  $('#email_div div').append('<p class = "alert alert-danger">This email is already <b>registered</b></p>')
        		  $("#email_div div span").remove();
        		  $("#email_div div").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			      div.removeClass("has-success");
				  div.addClass("has-error");
                }  
		  }).fail(function(arg){
		  	console.log(arg);
		  });
} 

function check_con_number(value){
	
	var regex = new RegExp(/^[1-9]+$/); 
	var field = $("#con_number");
	var div =  $("#con_div");
	if(value){
			if(regex.test(value)){
				if(field.val().length == 9){
						$('#con_div div p').remove();
						$("#con_div div > span").remove();
						$("#con_div div > div").append('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
						div.removeClass("has-error");
						div.addClass("has-success");
						}
				 else
				   {
				  	$('#con_div div p').remove();
						$('#con_div>div').append('<p class = "alert alert-danger">Length should 9</p>');
						$("#con_div>div span").remove();
					    $("#con_div>div").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
						div.removeClass("has-success");
						div.addClass("has-error");
				   }
			 }
			else
			{
				$('#con_div div p').remove();
				$('#con_div>div').append('<p class = "alert alert-danger">Contant Number should be numeric</p>');
				$("#con_div>div span").remove();
			    $("#con_div>div").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
				div.removeClass("has-success");
				div.addClass("has-error");
			}
		}
	else{
			$('#con_div div p').remove();
			$("#con_div div div span").remove();
			$('#con_div>div').append('<p class = "alert alert-danger">Please fill the field</p>');
		    $("#con_div div div").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			div.removeClass("has-success");
			div.addClass("has-error");
		}
}

function checkName(value){
	var regex = new RegExp(/^[a-zA-Z]+$/); 
	var field = $("#name");
	var div = $('#name_div');
	if(value){
		if(regex.test(value)){
			$('#name_div div p').remove();
			$("#name_div div span").remove();
			$("#name_div div").append('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
			div.removeClass("has-error");
			div.addClass("has-success");
		}else{
			$('#name_div div p').remove();
			$('#name_div div').append('<p class = "alert alert-danger">Name should contain only English letters</p>');
			$("#name_div div span").remove();
		    $("#name_div div").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			div.removeClass("has-success");
			div.addClass("has-error");
		}
	}else{
		$('#name_div div p').remove();
		$('#name_div div').append('<p class = "alert alert-danger">Please fill this field</p>');
		$("#name_div div span").remove();
		$("#name_div div").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
		div.removeClass("has-success");
		div.addClass("has-error");
	}
}