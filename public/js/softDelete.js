// $(document).ready(function(){
//     $('.toggle-class').change(function(e) {
//         e.preventDefault();
//         var status = $(this).prop('checked') == true ? 1 : 0; 
//         var id = $(this).data('id'); 
        
//         $.ajax({
//             type: "GET",
//             dataType: "json",
//             url: '/viewBlocks/destroy/{id}',
//             data: {'status': status, 'user_id': id},
//             success: function(data){
//             console.log(data.success)
//             }
//         });    
//     });
// })