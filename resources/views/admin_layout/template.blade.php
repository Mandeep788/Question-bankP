<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('/css/adminpanel.css') }}">

    <title>Admin Panel</title>
</head>
<body>
    <div class="body">
@include('admin_layout.sidebar')

@yield('main-content')

</div>
</div>
<footer class="footer text-center py-3"> Copyright @
    <a href="https://www.questionbank.com/"> questionbank.com. </a> All Rights Reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/78719d0dd0.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // $(document).ready(function(){

    //     $(".framework_content").attr('style', 'display: none');
    //     $(document).on("click",'#white_box',function(){

    //         $(".tech_content").attr('style', 'display: none');
    //         $(".framework_content").removeAttr('style', 'display: none');
    //     });

    //     $("#back_btn").click(function(){
    //         $(".framework_content").attr('style', 'display: none');
    //         $(".tech_content").removeAttr('style', 'display: none');
    //     });

    //     $(".ques_ans_content").attr('style', 'display: none');
    //     $("#white_boxx").click(function(){
    //         $(".tech_content").attr('style', 'display: none');
    //         $(".framework_content").attr('style', 'display: none');
    //         $(".ques_ans_content").removeAttr('style', 'display: none');
    //     });

    //     $("#back_btnn").click(function(){
    //         $(".ques_ans_content").attr('style', 'display: none');
    //         $(".framework_content").removeAttr('style', 'display: none');
    //     });
    //     // $('.add_tech_content').attr('style', 'display: none');
    //     // $('#add_tech').click(function () {
    //     // $('.tech_content').attr('style', 'display: none');
    //     // $('.add_tech_content').removeAttr('style', 'display: none');
    //     // });
    // });

</script>
@yield('script')
</body>
</html>

