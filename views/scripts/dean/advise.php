<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
if(!loggedIn() || (loggedIn() && $_SESSION['userLevel'] == 0)){
    header('Location: ../../../index.php');
}
$title = ADVISE;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/dean/top_bar.php';
?>
<div class="row">
    <h4 class="title text-center"><?=$title;?></h4>
</div>
<div class="row">    
    <div class="medium-1 large-1 columns show-for-medium-up">
        &nbsp;
    </div>
    <form>        
        <div class="small-4 medium-2 large-2 columns show-for-medium-up">
            <input type="search" id="search_text" placeholder="<?=COLLEGE_ID?>" style="text-align: center"/>
        </div> 
        <div class="medium-1 large-1 columns show-for-medium-up">
            <input type="button" class="tiny button" id="search_button" value="<?=SEARCH?>">            
        </div> 
        <div class="medium-6 large-2 columns show-for-medium-up">
            <div id="wrong" data-alert class="alert-box alert" style="font-size: 12px; font-family: DroidKufi-Regular; visibility: hidden ">
                <span id="invalid_login"><?=ADVISE_SEARCH_ERROR?></span>
                <a href="#" class="close"></a>
            </div>            
        </div>
        <div class="medium-2 large-4 columns show-for-medium-up">
        </div>
    </form>
</div>
<div id="contents" class="row" style="visibility: hidden; padding-bottom: 100px; ">
    <div class="medium-1 large-1 columns">
        &nbsp;  
    </div>
    <div class="medium-10 large-10 columns">
        <dl class="accordion" data-accordion>
            <dd>
                <a href="#panel1"><?=PERSONAL_INFO?></a>
                <div id="panel1" class="content active">
                    <div class="row">
                        <div class="medium-8 large-4 columns">
                            <div class="stu_title label"><?=COLLEGE_ID?></div> <div id="stu_id" class="secondary label stu_data "></div>
                        </div>
                        <div class="medium-4 large-4 columns">
                            <div class="stu_title label"><?=ADDRESS?></div> <div id="address" class="stu_data secondary label"></div>
                        </div>
                        <div class="medium-4 large-4 columns"></div>
                    </div>
                    <div class="row">
                        <div class="medium-4 large-4 columns">
                            <div class="stu_title label"><?=NAME?></div> <div id="name" class="stu_data secondary label"></div>
                        </div>
                        <div class="medium-4 large-4 columns">
                            <div class="stu_title label"><?=PHONE_NUM?></div> <div id="phone" class="stu_data secondary label"></div>
                        </div>
                        <div class="medium-4 large-4 columns"></div>
                    </div>
                    <div class="row">
                        <div class="medium-4 large-4 columns">
                            <div class="stu_title label"><?=GENDER?></div> <div id="gender" class="stu_data secondary label"></div>
                        </div>
                        <div class="medium-4 large-4 columns">
                            <div class="stu_title label"><?=EMAIL?></div> <div id="email" class="stu_data secondary label"></div>
                        </div>
                        <div class="medium-4 large-4 columns"></div>
                    </div>
                    <div class="row">
                        <div class="medium-4 large-4 columns">
                            <div class="stu_title label"><?=BIRTH_DATE?></div> <div id="birth_date" class="stu_data secondary label"></div>
                        </div>                      
                    </div>
                    <div class="row">
                        <div class="medium-4 large-4 columns">
                            <div class="stu_title label"><?=NATIONAL_ID?></div> <div id="national_id" class="stu_data secondary label"></div>
                        </div>                      
                    </div>
                </div>
            </dd>
            <dd>
                <a href="#panel2"><?=ACADEMIC_INFO?></a>
                <div id="panel2" class="content">
                    <div class="row">
                        <div class="medium-8 large-4 columns">
                            <div class="stu_title label"><?=DEP?></div> <div id="dep_name" class="stu_data secondary label"></div>                                
                        </div>
                        <div class="medium-8 large-4 columns">
                            <div class="stu_title label"><?=COMPLETED_HRS?></div> <div id="com_hrs" class="stu_data secondary label"></div>                                
                        </div>
                        <div class="medium-4 large-4 columns"></div>
                    </div>
                    <div class="row">
                        <div class="medium-8 large-4 columns">
                            <div class="stu_title label"><?=DEP_HRS?></div> <div id="dep_hrs" class="stu_data secondary label"></div>                                
                        </div>
                        <div class="medium-8 large-4 columns">
                            <div class="stu_title label"><?=FAILED_CRS_NUM?></div> <div id="failed_crs" class="stu_data secondary label"></div>                                
                        </div>
                        <div class="medium-4 large-4 columns"></div>
                    </div>
                    <div class="row">
                        <div class="medium-8 large-4 columns">
                            <div class="stu_title label"><?=REG_DATE?></div> <div id="reg_date" class="stu_data secondary label"></div>                                
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="medium-8 large-4 columns">
                            <div class="stu_title label"><?=LEVEL?></div> <div id="level" class="stu_data secondary label"></div>                                
                        </div>                        
                        <div class="medium-4 large-4 columns"></div>
                    </div>
                    <div class="row">
                        <div class="medium-8 large-4 columns">
                            <div class="stu_title label"><?=GPA?></div> <div id="gpa" class="stu_data secondary label"></div>                                
                        </div>                        
                        <div class="medium-4 large-4 columns"></div>
                    </div>
                </div>
            </dd>
            <dd>
                <a href="#panel3"><?=STUDENT_GRADE?></a>
                <div id="panel3" class="content">
                    <div class="row">
                        <div class="medium-3 large-3 columns">&nbsp;</div>
                        <div id="table" class="medium-6 large-6 columns show-for-medium-up"></div>
                        <div class="medium-3 large-3 columns">&nbsp;</div>
                    </div>                        
                </div>
            </dd>
            <dd>
                <a href="#panel4"><?=SUGGESTED_COURSES?></a>
                <div id="panel4" class="content">
                    <div class="row">
                        <div class="medium-2 large-2 columns" data-reveal-id="crs_modal" data-reveal>
                            <a class="tiny button"><?=CRS_TREE?></a>
                        </div>
                        <div id="jTable" class="medium-8 large-8 columns show-for-medium-up"></div>
                        <div class="medium-2 large-2 columns">                                                        
                        </div>
                    </div>
                </div>
            </dd>
        </dl>
    </div>
    <div class="medium-1 large-1 columns">
        &nbsp;  
    </div>
</div>

<div id="crs_modal" class="reveal-modal text-center" data-reveal>    
    <img src="style/img/crs_tree.jpg" >     
  <a class="close-reveal-modal">&#215;</a>
</div>
<?php
    include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/advise_script.php';
?>