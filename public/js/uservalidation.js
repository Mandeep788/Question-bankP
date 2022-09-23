$(document).ready(function () {
    $('#userEditForm').validate({
        
        rules: {
            name: "required",
            phone_number: {required:true,
                minlength:10},

            },
            phone_number:{
                required :true,
                digits:true,
                minlength:10,maxlength:10
            },
            experience: {
                required: true,
                digits: true

            },
            designation: {
                required: true,

            },
            last_company: {
                required: true,
            },
            address: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Please enter your name",
            },
            phone_number:{
                required :"Please enter your Mobile Number",
                digits:"Mobile Number must be in digits",
                minlength:"Mobile Number must be  10 digits",
                maxlength:"Mobile Number must be  10 digits"
            },
            experience:{
                required: "Please enter your experience",
            },
            designation:{
                required: "Please enter your designation",
            },
            last_company:{
                required: "Please enter your last company",
            },
            address:{
                required: "Please enter your address",
            }

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
        submitHandler:function()
        {
            swal({
                title: 'Success!',
                text: 'Profile updated Successfully.',
                icon:'success',
                timer: 1000
            });

        }

});
});