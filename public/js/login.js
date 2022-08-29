const inputs = document.querySelectorAll(".input");

function addcl(){
	let parent = this.parentNode.parentNode;
	parent.classList.add("focus");
}

function remcl(){
	let parent = this.parentNode.parentNode;
	if(this.value == ""){
		parent.classList.remove("focus");
	}
}


inputs.forEach(input => {
	input.addEventListener("focus", addcl);
	input.addEventListener("blur", remcl);
});

$(document).ready(function(){

	$("#login").click(function(e){

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
			}
		});
		e.preventDefault();
		var email=$("#email").val();
		var password=$("#password").val();
		$.ajax({
			type: "POST",
			url: "/login",
			data: {
				email:email,
				password:password
			},
			//dataType: "dataType",
			success: function (response) {
				console.log(response);
				var result =response;
				if (result=='admin') {

					//window.location="{{route('admin/dashboard')}}";
					window.location='/admin/dashboard';
					
				}
				if(result=="user"){
					window.location="/dashboard";

				}

	//error code area--------------------------------------------------------------------------
				var error=response.error;
				if(error==""){
				$('#invalid').append('<div class="alert alert-danger"style="margin-bottom:15px;">'+error+'</div');
				}
			},

			error:function(xhr){

				 $('#invalid').html('');
   					$.each(xhr.responseJSON.errors, function(key,value) {
     				$('#invalid').append('<div class="alert alert-danger"style="margin-bottom:15px;">'+value+'</div');
 				}); 
			}
		//end error area-------------------------------------------------------------------------
		});

	});

});

