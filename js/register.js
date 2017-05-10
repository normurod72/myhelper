$(function(){

	var name = $('#name');
	var surname = $('#surname');
	var distance = $('#distance');
	var email = $('#email');
	var confirmPassword = $('#confirmPassword');
	var password = $('#password');
	var number = $('#con_number');
	var btnSave = $('#save');
	var selectionBox = $('#proff');
	var lng;
	var lat;
	btnSave.on("click",function(e){
		e.preventDefault();
		var validInput = name.val() && surname.val() && distance.val() && email.val() && confirmPassword.val() && password.val() && number.val() && selectionBox.val();
			if(validInput){
			//$(this).attr("disabled","disabled");
			var valueOf = $("#map").contents().find("#pac-input").val();
			var geocoder =  new google.maps.Geocoder();
			console.log(geocoder);
   			geocoder.geocode( { 'address': valueOf}, function(results, status) {
		        if (status == google.maps.GeocoderStatus.OK) {
		          	lng = results[0].geometry.location.lng();
		          	lat = results[0].geometry.location.lat();
		            alert("location : " + lat + " " +lng); 
		            $.ajax({
					method: "POST",
					url: "registration.php",
					dataType: "json",
					data: {
						name: name.val(),
						surname: surname.val(),
						password: password.val(),
						address: valueOf,
						latitude: results[0].geometry.location.lat(),
						longitute: results[0].geometry.location.lng(),
						number: number.val(),
						email: email.val(),
						professions: selectionBox.val(),
						distance: distance.val()
					}
				}).done(function(data){
					if(data.ok=="true"){	
						setTimeout(function(){
							alert("Congratulation !!! You have been successfully registrated");
							location.href = "user_dashboard.php";
						},2000);
					}else{
						alert("Sorry you can not register right now. Please try again or contact with admin");
					}
					
				}).fail(function(data){
					alert("come 3");
					console.log(data);
				});
		        }
		        else
		        {
		            alert("Something got wrong " + status);
		        }
			});
   			

		}   			
   	});
});