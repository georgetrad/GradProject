<script>
    $(function() {   
        $('#search_button').click(function(){
            var number = $('#search_text').val();
            $.post( "models/functions/studentGradeFunction.php", { number:number},function( data ) {
                $( ".result" ).html( data );
            });
        });
    });
</script>