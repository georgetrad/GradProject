<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
if(!loggedIn() || (loggedIn() && $_SESSION['userLevel'] == 0)){
    header('Location: ../../../index.php');
}
$title = SUGGEST_COURSES;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/dean/top_bar.php';
?>
<div class="row">
    <h4 class="title text-center"><?=$title;?></h4>
</div>

<div class="row">
    <div class="medium-12 large-12 columns">
        <dl class="tabs" data-tab>
            <dd class="active"><a id="all_courses" href="#panel2-1"><?=COURSES?></a></dd>
            <dd><a id="sugg" href="#panel2-2"><?=SUGGESTED_COURSES?><span id="counter"></span></a></dd>
            <dd><a href="#panel2-3"><?=AFFECTED_STU?></a></dd>  
        </dl>
    </div>
</div>
<div class="row">
    &nbsp;
</div>
<!-- Tab 1 -->
<div class="tabs-content">
    <div class="content active" id="panel2-1">
        <!-- Filtering Area -->
        <div id="filter" class="row">    
            <form>
                <div class="medium-2 large-2 columns show-for-medium-up">
                    <select id="search_id">                    
                        <option value="0"><?=COURSE_CODE?></option>
                        <option value="1"><?=COURSE_NAME.' ('.ARABIC.')'?></option>
                        <option value="2"><?=COURSE_NAME.' ('.ENGLISH.')'?></option>
                        <option value="3"><?=COURSE_TYPE?></option>
                        <option value="4"><?=LEVEL?></option>
                        <option value="5"><?=CREDITS?></option>
                        <option value="6"><?=FEES?></option>
                    </select>
                </div> 
                <div class="medium-2 large-2 columns show-for-medium-up">
                    <input type="search" id="search_text" style="text-align: center"/>
                </div> 
                <div class="medium-1 large-1 columns show-for-medium-up">
                    <input type="submit" class="tiny button" id="search_button" value="<?=SEARCH?>">
                </div> 
                <div class="medium-4 large-7 columns show-for-medium-up text-left">                    
                    <input type="button" class="tiny button" value="<?=NEVER_ADDED?>" style="background-color: #2ba6cb ;cursor: auto">
                    <input type="button" class="tiny button" value="<?=ADDED?>" style="background-color: #ff0000; cursor: auto">
                    <input type="button" class="tiny button" value="<?=REMOVED?>" style="background-color: green; cursor: auto">
                </div>
            </form>       
        </div>    
        <div class="row medium-3 large-3 columns show-for-medium-up"></div>        
        <div id="all_courses_Table" class="medium-12 large-12 columns show-for-medium-up"></div> <!--Table-->
    </div>
    
    <!-- Tab 2 -->
    <div class="content" id="panel2-2">            
        <div class="row medium-3 large-3 columns show-for-medium-up"></div>        
        <div id="sugg_courses_Table" class="medium-12 large-12 columns show-for-medium-up"></div> <!--Table-->
    </div>
    
    <!-- Tab 3 -->
    <div class="content" id="panel2-3">      
        جدول الطلاب
    </div>
</div>

<a href="#top" id="toTop"></a>

<?php 
    include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/all_courses_script.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/sugg_courses_script.php';
?>
