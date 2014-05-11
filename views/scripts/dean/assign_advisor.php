<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
if(!loggedIn() || (loggedIn() && $_SESSION['userLevel'] == 0)){
    header('Location: ../../../index.php');
}
$title = TEACHERS;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/dean/top_bar.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/selectFunction.php';
?>
<div class="row">
    <h4 class="title text-center"><?=$title;?></h4>  
</div>

<!-- Filtering Area -->
<div class="row">    
    <div class="medium-2 large-3 columns show-for-medium-up">
        &nbsp;
    </div>    
    <form>       
        <div class="medium-3 large-2 columns show-for-medium-up">            
            <?php
                // select options
                echo '<select>';
                    $query = "SELECT id, first_name, last_name FROM teacher";
                    $result = mysql_query($query);
                    while($row = mysql_fetch_array($result)) {
                        $firstName = $row['first_name'];
                        $lastName = $row['last_name'];
                        echo '<option value = '.$row['id'].'>'.$firstName.' '.$lastName.'</option>';
                    }
                echo '</select>';
            ?>            
        </div>
        <div class="medium-2 large-1 columns">
            <input type="submit" class="tiny button" value='<?=SAVE?>'>
        </div>
        <div class="medium-5 large-6 columns">            
        </div>
    </form>       
</div>

<div class="row">
    <div class="medium-2 large-3 columns show-for-medium-up">
        &nbsp;
    </div>    
    <div id="jTable" class="medium-8 large-6 columns show-for-medium-up"><!--Table--></div>
    <div class="medium-2 large-3 columns show-for-medium-up"></div>
</div>
<?php 
    include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/assign_advisor_script.php';
?>
