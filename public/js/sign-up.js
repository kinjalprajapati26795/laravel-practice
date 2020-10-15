/*
* @Author: dell
* @Date:   2020-10-15 13:57:50
* @Last Modified by:   dell
* @Last Modified time: 2020-10-15 16:14:29
*/

var counter=1;

/* Submit Sign Up Form */
 $("#signUpForm").validate({
 	focusInvalid: false, // do not focus the last invalid input
    invalidHandler: function(form, validator) {

    if (!validator.numberOfInvalids())
        return;
    var errors = validator.numberOfInvalids();
    if (errors) {                    
        validator.errorList[0].element.focus();
    }
    $('html, body').animate({
        scrollTop: $(validator.errorList[0].element).offset().top-30
    }, 1000);
  },
    errorElement: 'span',
    errorClass: 'invalid-feedback', 
    ignore: [],
 	rules: {
                
	    "first_name": {
	        required: true,
	        normalizer: function (value) {
	            return $.trim(value);
	        },
	        maxlength: 40,
	        minlength: 3,
	    },
	    "last_name": {
	        required: true,
	        normalizer: function (value) {
	            return $.trim(value);
	        },
	        maxlength: 40,
	        minlength: 3,
	    },
	    "email": {
	        required: true,
	        email: true,
	    },
	    "phone": {
	        required: true,
	        maxlength: 10,
	       number:true
	    },
	    "password": {
	        required: true,
	       	minlength : 6,
	       	maxlength:10
	    },
	    "confirm_password": {
	        required: true,
	       equalTo : "#password"
	    },
	    "technologies[]": {
	        required: true,
	       
	    },
	},
	messages:{
            "confirm_password":{
                equalTo:"Confirm Password does not match with Password.",
            },
    },
  submitHandler: function(form) {
  	var dataString = new FormData($("#signUpForm")[0]);
    $('.submit').attr('disabled', true);
    $.ajax({
        type: "POST",
        url: $("#signUpForm").attr("action"),
        data: dataString,
        processData: false,
        contentType: false,
        cache: false,
        headers: {
           'X-Requested-With': 'XMLHttpRequest'
        },
        success: function (response) {
        	$('.submit').attr('disabled', false);
        	if(response.status==1)
        	{
        		$("#signUpForm")[0].reset();
        		alert(response.message);
        	}
        	else
        	{
        		alert(response.message);	
        	}
        	
        },
        error: function (data) {
        	$('.submit').attr('disabled', false);
        	var errorText='';
            var errors = data.responseJSON.errors;
            console.log(errors);
	        $.each(errors, function (key, value) {
	        	errorText+=value[0]+'\n';
	            
	        });
	        alert(errorText);
           
        }
    });
  }
 });

 /* End Submit Sign Up Form */

 /* Add More Technologies Input */

 $('#add_more_technologies').click(function(event) {
 	
 	if(counter<5)
    {
    	counter++;
		var appendHtml=`<div class="form-group hidden" id="addMoreTechnologiesDiv`+counter+`">
		<label for="name">Technologies:</label>
	    <input type="text" class="form-control" id="tech_`+counter+`" name="technologies[]">
	    <button type="button" class="cancel_technologies">Cancel</button> </div>`;
	    $(appendHtml).insertAfter('#technologiesDiv');
    }
    else
    {
    	alert("You can add maximum 5 technologies");
    }
 });

 /* End Add More Technologies Input */
$(document).on("click", ".cancel_technologies" , function() {
 	if(counter>1)
    {
    	$('#addMoreTechnologiesDiv'+counter).remove();
    	counter--;
    }
    

 });

