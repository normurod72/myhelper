$(function(){
	
	var name_id = $('#name_field');
	var surname_id = $('#surname_id');
	var distance_id = $('#distance_id');
	var email_id = $('#email_id');
	var currentEmail = email_id.val();
	var number = $('#contactphone_id');
	var confirm_new_password = $('#confirm_password_field');
	var new_password= $('#new_password_field');
	var current_password = $('#current_password_field');
	var isCurrent = false;
	var isConfirmed = false;
	var address_input = $("#map_id").contents().find("#pac-input");

	
	name_id.focusout(function(){
		checkName(name_id.val());
	});
	surname_id.focusout(function(){
		checkSurname(surname_id.val());
	});
	distance_id.focusout(function(){
		checkDistance(distance_id.val());
	});
	email_id.focusout(function(){
		checkEmail(email_id.val(), currentEmail);
	});
	number.focusout(function(){
		checkNumber(number.val());
	});
	new_password.focusout(function(){
		validatePassword(new_password.val());
	});
	confirm_new_password.focusout(function(){
		isConfirmed = confirmPassword(new_password.val(), confirm_new_password.val());
	});
	current_password.focusout(function(){
		isCurrent = check_current_password(current_password.val());
	});
	
	address_input.focusout(function(){
		something();
	});
	
	$('#save_password').on('click',function(){
		var isValid =(isCurrent && isConfirmed);
		save_password(isValid, confirm_new_password.val());
	});
});

function something(){
	var lng_field = $('#lng_field');
	var lat_field = $('#lat_field');
	var valueOf = $("#map_id").contents().find("#pac-input").val();
			var geocoder =  new google.maps.Geocoder();
			console.log(geocoder);
   			geocoder.geocode( { 'address': valueOf}, function(results, status) {
		        if (status == google.maps.GeocoderStatus.OK) {
		          	lng = results[0].geometry.location.lng().toString();
		          	lat = results[0].geometry.location.lat().toString();
		         	lat_field.val(lat =="" ? "41.2994958" : lat);
		         	lng_field.val(lng =="" ? "69.24007340000003": lng);
		        }
		        else
		        {
		            alert("Something got wrong " + status);
		        }
			});
}

function updateUserAtributes(event){

	var valid = name_id.val() && surname_id.val() && email_id.val() && number.val();
	if(valid){
			something();
	}else{
		event.preventDefault();
		alert("Please try to fill all fields correctly");
	}
}

function save_password(isValid, new_pass){

	if(isValid){
		$.ajax({
			  method: "POST",
			  url: "update.php",
			  dataType: "json",
			  data: {update: new_pass}
			}).done(function( result ) {
			    if(result.update=="TRUE"){
					   alert("Password has been successfully changed"); 
			    }else{

				    alert("Ooops !!! Please try later")	

			    } 
			  }).fail(function(arg){
			  		console.log(arg);
			  });
	}else{

		alert("Please check your inputs")
	}
}

function check_current_password(password){
		var div = $('#current_pass_div');
		var res = false;
		if(password){
			$.ajax({
			  method: "POST",
			  url: "update.php",
			  async: false,
			  dataType: "json",
			  data: {current_pass: password}
			}).done(function( result ) {
			    if(result.password=="TRUE"){
				    $('#current_pass_div p').remove();
					$("#current_pass_div span").remove();
					$("#current_pass_div").append('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
					div.removeClass("has-error");
					div.addClass("has-success");
					res = true;
			    } else {
			    	$('#current_pass_div p').remove();
					$("#current_pass_div span").remove();
				    $('#current_pass_div').append('<p class = "alert alert-danger">Your current password has not matched</p>');
				    $("#current_pass_div").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
					div.removeClass("has-success");
					div.addClass("has-error");
					res = false;
			    }
				console.log(res);
			  }).fail(function(arg){
			  	console.log(arg);
			  	res = false;
			  });
			  console.log(res);
			return res;
		}
		else
		{
			$('#current_pass_div p').remove();
			$("#current_pass_div span").remove();
		    $('#current_pass_div').append('<p class = "alert alert-danger">Please fill the field first</p>');
		    $("#current_pass_div").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			div.removeClass("has-success");
			div.addClass("has-error");
			return false;
		}
}

function checkName(value){
	var regex = new RegExp(/^[a-zA-Z]+$/); 
	var field = $("#name_field");
	var div = $('#name_div_id_field');
	if(value){
		
		if(regex.test(value)){
			$('#name_div_id_field p').remove();
			$("#name_div_id_field span").remove();
			$("#name_div_id_field").append('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
			div.removeClass("has-error");
			div.addClass("has-success");
		}else{
			$('#name_div_id_field p').remove();
			$('#name_div_id_field').append('<p class = "alert alert-danger">Name should contain only English letters</p>');
			$("#name_div_id_field span").remove();
		    $("#name_div_id_field").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			div.removeClass("has-success");
			div.addClass("has-error");
		}
	}else{
		$('#name_div_id_field p').remove();
		$('#name_div_id_field').append('<p class = "alert alert-danger">Please fill this field</p>');
		$("#name_div_id_field span").remove();
		$("#name_div_id_field").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
		div.removeClass("has-success");
		div.addClass("has-error");
	}
}

function validatePassword(value){

		var regex = new RegExp(/^(?=.*[a-z0-9])(?=.*[@#$%^&+=\s]).{1,}$/i);
		
		var div = $("#new_pass_div");
		if(value){
				
			if(regex.test(value)){
					$('#new_pass_div p').remove();
					$("#new_pass_div span").remove();
					$("#new_pass_div").append('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
					div.removeClass("has-error");
					div.addClass("has-success");
					return true;
			}else{
					$('#new_pass_div p').remove();
					$("#new_pass_div span").remove();
				    $('#new_pass_div').append('<p class = "alert alert-danger">Please consider password should contain\nat least one special character @ # $ % ^ & + = \nwith length at least 6\nNote: space also allowed</p>');
				    $("#new_pass_div").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
					div.removeClass("has-success");
					div.addClass("has-error");
					return false;
				}
			}
		else
		{
				$('#new_pass_div p').remove();
			    $('#new_pass_div').append('<p class = "alert alert-danger">Please fill this field</p>');
				$("#new_pass_div span").remove();
			    $("#new_pass_div").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
				div.removeClass("has-success");
				div.addClass("has-error");
				return false;
		}
}
	
function confirmPassword(password, confirm){
	var div = $("#confirm_pass_div");
	if(confirm && password){
		
		if(password == confirm){
			$('#confirm_pass_div p').remove();
			$("#confirm_pass_div span").remove();
			$("#confirm_pass_div").append('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
			div.removeClass("has-error");
			div.addClass("has-success");
			return true;
		}else{
			$('#confirm_pass_div p').remove();
			$("#confirm_pass_div span").remove();
		    $('#confirm_pass_div').append('<p class = "alert alert-danger">Password has not matched</p>');
		    $("#confirm_pass_div").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			div.removeClass("has-success");
			div.addClass("has-error");
			return false;
		}
	}else{
			$('#confirm_pass_div p').remove();
		    $('#confirm_pass_div').append('<p class = "alert alert-danger">Please fill this field</p>');
			$("#confirm_pass_div span").remove();
		    $("#confirm_pass_div").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			div.removeClass("has-success");
			div.addClass("has-error");
			return false;
	}
}

function checkDistance(value){
	var regex = new RegExp(/[0-9]+$/);
	var field = $("#distance_id");
	var div = $("#distance_div_id");
	
	if(value){
		
	if(regex.test(value)){
			
			$('#distance_div_id p').remove();
			$("#distance_div_id span").remove();
			$("#distance_div_id").append('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
			div.removeClass("has-error");
			div.addClass("has-success");
	}else{
			$('#distance_div_id p').remove();
		    $('#distance_div_id').append('<p class = "alert alert-danger">Distance should be numeric</p>');
			$("#distance_div_id span").remove();
		    $("#distance_div_id").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			div.removeClass("has-success");
			div.addClass("has-error");
		}
	}else{
			$('#distance_div_id p').remove();
		    $("#distance_div_id span").remove();
		    div.removeClass("has-success");
			div.removeClass("has-error");
	
	}
}

function checkSurname(value){
	var regex = new RegExp(/^[a-zA-Z]+$/); 
	var div = $("#surname_div_id");
	if(value){
		
	if(regex.test(value)){
			$('#surname_div_id p').remove();
			$("#surname_div_id span").remove();
			$("#surname_div_id").append('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
			div.removeClass("has-error");
			div.addClass("has-success");
	}else{
			$('#surname_div_id p').remove();
			$('#surname_div_id').append('<p class = "alert alert-danger">Surname should contain only English letters</p>');
			$("#surname_div_id span").remove();
		    $("#surname_div_id").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			div.removeClass("has-success");
			div.addClass("has-error");
		}
	}else{
			$('#surname_div_id p').remove();
		    $('#surname_div_id').append('<p class = "alert alert-danger">Please fill this field</p>');
			$("#surname_div_id span").remove();
		    $("#surname_div_id").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			div.removeClass("has-success");
			div.addClass("has-error");
	}
}

function checkEmail(value, old){
	var regex = new RegExp(/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}/i);
	var div = $("#email_div_id");
	if(value){
		
	if(regex.test(value)){
			check_available_email(value,old);
		}else{
			$('#email_div_id p').remove();
			$('#email_div_id').append('<p class = "alert alert-danger">Email is not valid</p>')
			$("#email_div_id span").remove();
		  	$("#email_div_id").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			div.removeClass("has-success");
			div.addClass("has-error");
		}
	}else{
			$('#email_div_id p').remove();
			$('#email_div_id').append('<p class = "alert alert-danger">Please fill this field</p>');
			$("#email_div_id span").remove();
		  	$("#email_div_id").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			div.removeClass("has-success");
			div.addClass("has-error");
	}
}

function check_available_email(newEmail, oldEmail){  
        var div = $('#email_div_id');
        var checking = $('#email_id');
        if(newEmail != oldEmail){         
  		$.ajax({
		  method: "POST",
		  url: "check_available_email.php",
		  dataType: "json",
		  data: { email: checking.val()}
		}).done(function( result ) {
		    
		    if(result.ok=="true"){
		    	  $('#email_div_id p').remove();
                  $("#email_div_id span").remove();
				  $("#email_div_id").append('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
				  div.removeClass("has-error");
			      div.addClass("has-success");
                }else{
                  $('#email_div_id p').remove();
                  $('#email_div_id').append('<p class = "alert alert-danger">This email is already <b>registered</b></p>')
        		  $("#email_div_id span").remove();
        		  $("#email_div_id").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			      div.removeClass("has-success");
				  div.addClass("has-error");
                }  
		  }).fail(function(arg){
		  	console.log(arg);
		  });
		}else{
			 $('#email_div_id p').remove();
                  $("#email_div_id span").remove();
				  $("#email_div_id").append('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
				  div.removeClass("has-error");
			      div.addClass("has-success");
		}
} 

function checkNumber(value){
	//var regex = new RegExp(/^[+][998][1-9]{7}/i); //with +998
	var regex = new RegExp(/^[1-9]+$/); //without +998
	var field = $("#contactphone_id");
	var div =  $("#con_div_id");
	if(value){
			
			if(regex.test(value)){
				if(field.val().length == 9){
						$('#con_div_id p').remove();
						$("#con_div_id span").remove();
						$("#con_div_id").append('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
						div.removeClass("has-error");
						div.addClass("has-success");
						}
				 else
				   {
				  		$('#con_div_id p').remove();
				  		$("#con_div_id span").remove();
						$('#con_div_id ').append('<p class = "alert alert-danger">Length should 9</p>');
					    $("#con_div_id").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
						div.removeClass("has-success");
						div.addClass("has-error");
				   }
			 }
			else
			{
				$('#con_div_id p').remove();
				$("#con_div_id span").remove();
				$('#con_div_id').append('<p class = "alert alert-danger">Contant Number should be numeric</p>');
			    $("#con_div_id").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
				div.removeClass("has-success");
				div.addClass("has-error");
			}
		}
	else{
			$('#con_div_id p').remove();
			$("#con_div_id span").remove();
			$('#con_div_id').append('<p class = "alert alert-danger">Please fill the field</p>');
		    $("#con_div_id").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			div.removeClass("has-success");
			div.addClass("has-error");
		}
}


function iframe(){
  	$("#map_id").contents().find("#pac-input").val($('#hidden_address').val());
  
  	
}