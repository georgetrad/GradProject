<?php
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
<script type="text/javascript" src="views/js/foundation/foundation.reveal.js"></script>
<script>
    $(document).foundation();
</script>