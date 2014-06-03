<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
if(!loggedIn() || (loggedIn() && $_SESSION['userLevel'] == 0)){
    header('Location: ../../../index.php');
}
$title = ASSIGN_STUDENTS;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/dean/top_bar.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/selectFunction.php';
?>
<div class="row">
    <h4 class="title text-center"><?=$title;?></h4>  
</div>
<div class="row">
    &nbsp;
</div>
<!-- Filtering Area -->
<div class="row">    
    <div class="medium-2 large-3 columns show-for-medium-up">
        &nbsp;
    </div>
    <div class="medium-2 large-1 columns show-for-medium-up">
            <select id="search_id">                    
                <option value="1"><?=NAME?></option>
                <option value="2"><?=MIDDLE_NAME?></option>
                <option value="3"><?=LAST_NAME?></option>
                <option value="4"><?=COLLEGE_ID?></option>                                   
            </select>
        </div> 
        <div class="medium-3 large-2 columns show-for-medium-up">
            <input type="search" id="search_text" style="text-align: center"/>
        </div> 
        <div class="medium-1 large-1 columns show-for-medium-up">
            <input type="button" class="tiny button" id="search_button" value="<?=SEARCH?>">
        </div>
    <form>       
        <div class="medium-3 large-1 columns show-for-medium-up">            
            <?php
                // select options
                echo '<select id="advisor_id">';
                    $query = "SELECT id, first_name, last_name FROM teacher WHERE active = 'A'";
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
            <input type="button" id="save" class="tiny button" value='<?=SAVE?>'>
            <span id="spinner" ></span>
        </div>        
        <div class="medium-3 large-3 columns">            
        </div>
    </form>       
</div>

<div class="row">
    <div class="medium-2 large-2 columns show-for-medium-up">
        &nbsp;        
    </div>    
    <div id="jTable" class="medium-8 large-8 columns show-for-medium-up"><!--Table--></div>
    <div class="medium-2 large-2 columns show-for-medium-up"></div>
</div>
<?php 
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/assign_advisor_script.php';
?>
