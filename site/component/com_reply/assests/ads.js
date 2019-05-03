//---------------------------------------country----------------------------//

function Getcity(city)

{

$.ajax({

url:"itf_ajax/city.php",

data:"city="+city,

success:function(itfmsg){$("#citydiv").html(itfmsg);

}

});

}

//---------------------------------------------------------------------//

function Getcategory(val)

{

$.ajax({

url:"itf_ajax/cat.php",

data:"val="+val,

success:function(itfmsg){$("#subcatdiv").html(itfmsg);

}

});

}

//---------------------------------------------------------------------//

function Getmanager(manager)

{

$.ajax({

url:"itf_ajax/manager.php",

data:"manager="+manager,

success:function(itfmsg){$("#entmanagerdiv").html(itfmsg);

}

});

}


$(document).ready(function(){
	$('#itffrminput').validate({
        rules: {
			title: "required",
			seller_iam:"required",
			price: "required",
			seller_email:{required:true,email:true,
			},
			describe_unique:"required",
			seller_phnumber:"required",	
			state_id:"required",
			seller_location:"required",
			seller_address:"required",
		    post_code:"required",
			 country_id:"required",
			 seller_location:"required",
	 },
		messages: {
			title: "",
			price: "",
			seller_iam:"",
			seller_email:"",
			describe_unique: "",
			seller_phnumber:"",
			state_id:"",
			seller_location:"",
			seller_address:"",
			post_code:"",
			country_id:"",
			 seller_location:"",
		},

		errorPlacement: function(error, element) {

			error.appendTo( element.parent() );

		},

		/*success: function(cat_id) {

			"#"+cat_id.html("&nbsp;").addClass("correct");

		}*/

    });



});







function refreshCaptcha()

{

	var img = document.images['captchaimg'];

	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;

}







  



  function CheckPackage(val){



	if(val == true){

		document.getElementById("membershipid").checked = true;

		document.getElementById("paytype1").checked = true;

	}else{

		document.getElementById("membershipid").checked = false;

		document.getElementById("paytype1").checked = false;

	}	

}





