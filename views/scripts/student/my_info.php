<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
if(!loggedIn() || (loggedIn() && $_SESSION['userLevel'] != 1)){
    header('Location: ../../../index.php');
}
$title = MY_INFO;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/databaseClass.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/student/top_bar.php';
?>
<div class="row">
    <h4 class="title text-center"><?=$title;?></h4>
</div>

<div id="contents" class="row" style="display: none; padding-bottom: 100px; ">
    <div class="medium-1 large-1 columns">
        &nbsp;  
    </div>
    <div class="medium-10 large-10 columns">
        <dl class="accordion" data-accordion>
            <dd>
                <a href="#panel1"><?=PERSONAL_INFO?></a>
                <div id="panel1" class="content active">
                    <div class="row">
                        <div class="medium-6 large-6 columns">
                            <div class="stu_title label"><?=COLLEGE_ID?></div> <div id="stu_id" class="secondary label stu_data "></div>
                        </div>
                        <div class="medium-6 large-6 columns">
                            <div class="stu_title label"><?=ADDRESS?></div> <div id="address" class="stu_data secondary label"></div>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="medium-6 large-6 columns PrintArea area0">
                            <div class="stu_title label"><?=NAME?></div> <div class="name stu_data secondary label"></div>
                        </div>
                        <div class="medium-6 large-6 columns">
                            <div class="stu_title label"><?=PHONE_NUM?></div> <div id="phone" class="stu_data secondary label"></div>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="medium-6 large-6 columns">
                            <div class="stu_title label"><?=GENDER?></div> <div id="gender" class="stu_data secondary label"></div>
                        </div>
                        <div class="medium-6 large-6 columns">
                            <div class="stu_title label"><?=EMAIL?></div> <div id="email" class="stu_data secondary label"></div>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="medium-6 large-6 columns">
                            <div class="stu_title label"><?=BIRTH_DATE?></div> <div id="birth_date" class="stu_data secondary label"></div>
                        </div>                      
                    </div>
                    <div class="row">
                        <div class="medium-6 large-6 columns">
                            <div class="stu_title label"><?=NATIONAL_ID?></div> <div id="national_id" class="stu_data secondary label"></div>
                        </div>                      
                    </div>
                </div>
            </dd>
            <dd>
                <a href="#panel2"><?=ACADEMIC_INFO?></a>
                <div id="panel2" class="content">
                    <div class="row">
                        <div class="medium-6 large-6 columns">
                            <div class="stu_title label"><?=DEP?></div> <div id="dep_name" class="stu_data secondary label"></div>                                
                        </div>
                        <div class="medium-6 large-6 columns">
                            <div class="stu_title label"><?=COMPLETED_HRS?></div> <div id="com_hrs" class="stu_data secondary label"></div>                                
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="medium-6 large-6 columns">
                            <div class="stu_title label"><?=DEP_HRS?></div> <div id="dep_hrs" class="stu_data secondary label"></div>                                
                        </div>
                        <div class="medium-6 large-6 columns">
                            <div class="stu_title label"><?=FAILED_CRS_NUM?></div> <div id="failed_crs" class="stu_data secondary label"></div>                                
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="medium-6 large-6 columns">
                            <div class="stu_title label"><?=REG_DATE?></div> <div id="reg_date" class="stu_data secondary label"></div>                                
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="medium-6 large-6 columns">
                            <div class="stu_title label"><?=LEVEL?></div> <div id="level" class="stu_data secondary label"></div>                                
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="medium-6 large-6 columns">
                            <div class="stu_title label"><?=GPA?></div> <div id="gpa" class="stu_data secondary label"></div>                                
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
<?php
    include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/my_info_script.php';    
?>