$(document).ready(function () {
    $('#userEditForm').validate({
        
        rules: {
            name: "required",
            phone_number: {required:true,
                minlength:10},

            gender: "required",
            address: "required",
            last_company: "required",
            current_company: "required",
            designation: "required",
            experience: "required",
            userTechnology: {required:true,
                    minlength:1},
        },

messages: {
            name:"Please enter your name.",
            phone_number:"Please enter your mobile number.",
            minlength:"Mobile number must be 10 char long.",
            gender:"Select Your Gender",
            address:"Please enter your address",
            last_company:"Enter Your last company name",
            current_company:"Enter your current company name",
            designation:"Enter your designation",
            experience:"Enter your experience",
            userTechnology:"Enter your technology",
        },

        submitHandler:function(form)
        {
    
            swal.fire({
                title: "Good job!",
                text: "Record is Updated!",
                icon: "success",
                button: "Aww yiss!",
              });
     
            form.submit();
        }

});
});