$(document).ready(function(){
	$('#frmregister').validate({
        rules: {
			message: "required",
			name:"required",
			email:{required:true,email:true,
			
			remote: {
				url: "itf_ajax/index.php?emailid=emailvalue",
				type: "post"
			}
			},			
            
			phone:"required",
			check:"required",
			
	 },
		messages: {
			message:"Please enter Message",
			name: "Please enter Name",
			email:"Please enter Valid email",
			phone:"Please enter Phone",
			check:"Please check Send me alerts ",
		},
		errorPlacement: function(error, element) {
			error.appendTo( element.parent() );
		},
		success: function(label) {
			label.html("&nbsp;").addClass("itfok");
		}
    });

});

