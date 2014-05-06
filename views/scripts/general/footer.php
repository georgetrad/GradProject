<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
?>
<footer>
    <div class="medium-9 large-9 columns show-for-medium-up">
        &nbsp;
    </div>
    <div class="medium-2 large-2 columns show-for-medium-up">
        <div data-reveal-id="myModal" data-reveal style="cursor: pointer">
            <img class="text-right" src="style/img/digitech_logo_footer.png" alt="digitech Logo" style="float: left; width:100px ; height: 25px; margin-top: 20px" >        
        </div>
    </div>
    <div class="medium-1 large-1 columns show-for-medium-up">
        &nbsp;
    </div>
    
</footer>

<div id="myModal" class="reveal-modal medium text-center" data-reveal>
    <h3><?= DEVELOPED_BY?></h3>
    <img src="style/img/digitech.png" style="width: 600; height: 157">
    <h3><?=GEORGE.' - '.MOHAMMAD?></h3>    
  <a class="close-reveal-modal">&#215;</a>
</div>

<script type="text/javascript" src="views/js/jquery/jquery-1.10.2.js"></script>
<script type="text/javascript" src="views/js/jquery/jquery-ui-1.10.4.custom.min.js"></script>                
<script type="text/javascript" src="views/js/foundation/foundation.js"></script>
<script type="text/javascript" src="views/js/foundation/foundation.topbar.js"></script>        
<script type="text/javascript" src="views/js/foundation/foundation.reveal.js"></script>
<script type="text/javascript" src="views/js/jTable/jquery.jtable.min.js"></script>
<script type="text/javascript" src="views/js/jTable/jquery.jtable.ar.js"></script>

<?php
if(!loggedIn()){
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/login_script.php';
}
else if(loggedIn() && $_SESSION['userLevel'] == -1){
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/all_students_script.php';
}
else if(loggedIn() && $_SESSION['userLevel'] == 0){
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/all_students_script.php';
}
?>
<script>
    $(document).foundation();
    $(function() {   
        $('.fileLink').click(function(){
            var opts = {
                lines: 13, // The number of lines to draw
                length: 20, // The length of each line
                width: 10, // The line thickness
                radius: 30, // The radius of the inner circle
                corners: 1, // Corner roundness (0..1)
                rotate: 0, // The rotation offset
                direction: 1, // 1: clockwise, -1: counterclockwise
                color: '#000', // #rgb or #rrggbb or array of colors
                speed: 1, // Rounds per second
                trail: 60, // Afterglow percentage
                shadow: false, // Whether to render a shadow
                hwaccel: false, // Whether to use hardware acceleration
                className: 'spinner', // The CSS class to assign to the spinner
                zIndex: 2e9, // The z-index (defaults to 2000000000)
                top: '50%', // Top position relative to parent
                left: '50%' // Left position relative to parent
            };

            var target = document.getElementById('spin');
            var spinner = new Spinner(opts).spin(target);
            $.post( "models/functions/importGeneralFile.php", { file:$(this).text()},function( data ) {
                $( ".result" ).html( data );
                spinner.stop(target);
            });            
        });
    });
</script>
