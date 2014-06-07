<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
if(!loggedIn() || (loggedIn() && $_SESSION['userLevel'] == 0)){
    header('Location: ../../../index.php');
}
$title = ADVISE;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/databaseClass.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/dean/top_bar.php';
?>
<div class="row">
    <h4 class="title text-center"><?=$title;?></h4>
</div>
<div class="row">    
    <div class="medium-1 large-1 columns show-for-medium-up">
        &nbsp;
    </div>    
    <div class="small-4 medium-2 large-2 columns show-for-medium-up">
        <input type="search" id="search_text" placeholder="<?=COLLEGE_ID?>" style="text-align: center"/>
    </div> 
    <div class="medium-1 large-1 columns show-for-medium-up">
        <input type="button" class="tiny button" id="search_button" value="<?=SEARCH?>">        
    </div> 
    <div class="medium-6 large-2 columns show-for-medium-up">
        <div id="wrong" data-alert class="alert-box alert" style="font-size: 12px; font-family: DroidKufi-Regular; display: none ">
            <span id="invalid_login"><?=ADVISE_SEARCH_ERROR?></span>
            <a href="#" class="close"></a>
        </div>            
    </div>
    <div class="medium-2 large-4 columns show-for-medium-up">
        <div class="settingVals">
            <div style="display: inline" ><?=STR_PRINT?>:</div>
            <input style="display: inline"  type="checkbox" class="selPA" value="area1" checked /> <?=STUDENT_GRADE?>
            <input style="display: inline"  type="checkbox" class="selPA" value="area2" checked /> <?=AVAILABLE_CRS?>
            <div style="display: inline" class="printBtn"><img src="style/img/print-icon.png" height="25" /></div>
        </div>
    </div>    
</div>
<div id="contents" class="row" style="display: none; padding-bottom: 100px; ">
    <div class="medium-1 large-1 columns">
        &nbsp;  
    </div>
    <div class="medium-10 large-10 columns">
        <dl class="accordion" data-accordion>
            <dd>
                <a href="#panel1"><?=PERSONAL_INFO?><span class="name" style="margin-right: 35%"></span></a>
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
                            <div class="stu_title label"><?=NAME?></div> <div id="name" class="stu_data secondary label"></div>
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
            <dd>
                <a href="#panel3"><?=STUDENT_GRADE?></a>
                <div id="panel3" class="content PrintArea area1">
                    <div class="row">
                        <div class="medium-3 large-3 columns">&nbsp;</div>
                        <div id="table" class="medium-6 large-6 columns show-for-medium-up"></div>
                        <div class="medium-3 large-3 columns">&nbsp;</div>
                    </div>                        
                </div>
            </dd>
            <dd>
                <a href="#panel4"><?=AVAILABLE_CRS?></a>
                <div id="panel4" class="content">
                    <div class="row">
                        <div class="medium-1 large-1 columns" data-reveal-id="crs_modal" data-reveal>
                            <img src="style/img/crs_tree.jpg" alt="Classes Tree" style="height: 50px; width: 75px; cursor: pointer">
                        </div>
                        <div id="jTable" class="medium-11 large-11 columns show-for-medium-up"></div>
                        <div class="medium-1 large-1 columns">                                                        
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
    if (isset($_GET['studentId'])){
        $id = $_GET['studentId'];
            echo    "<script> 
                        $(document).ready(function () {
                            getStuData(".$id.");
                            $.post('models/functions/_global_ajax.php', {case:'getStuGrades', id:".$id."},function(data){
                                    $('#table').html(data);
                            });
                            $('#jTable').jtable('load', {
                                stuId:".$id."               
                            }); 
                        });   
                    </script>";
    }
?>
