<footer class="footer text-center py-3"> Copyright @ 
    <a href="https://www.questionbank.com/"> questionbank.com. </a> All Rights Reserved.
</footer>
</div>
 </div>
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/78719d0dd0.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('/js/logout.js') }}"></script>
<script>
    $(document).ready(function(){
        
        $(".framework_content").attr('style', 'display: none');
        $('#white_box').click(function(){
            $(".tech_content").attr('style', 'display: none');
            $(".framework_content").removeAttr('style', 'display: none');
        });

        $("#back_btn").click(function(){
            $(".framework_content").attr('style', 'display: none');
            $(".tech_content").removeAttr('style', 'display: none');
        });

        $(".ques_ans_content").attr('style', 'display: none');
        $("#white_boxx").click(function(){
            $(".tech_content").attr('style', 'display: none');
            $(".framework_content").attr('style', 'display: none');
            $(".ques_ans_content").removeAttr('style', 'display: none');
        });

        $("#back_btnn").click(function(){
            $(".ques_ans_content").attr('style', 'display: none');
            $(".framework_content").removeAttr('style', 'display: none');
        });





    });
</script>
</body>
</html>