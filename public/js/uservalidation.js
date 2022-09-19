$(document).ready(function () {
    $('#userEditForm').validate({
        rules: {
            name: {
                required: true,

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
