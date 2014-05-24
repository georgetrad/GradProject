<script>
    $(function() {   
        $('#search_button').click(function(){
            var id = $('#search_text').val();
            $.post( "models/functions/_global_ajax.php", {case:'getStuGrades', id:id},function(data){
                    $('#table').html(data);
            });
        });
    });
</script>