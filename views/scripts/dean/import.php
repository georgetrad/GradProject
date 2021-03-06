<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/db_connect.php';
if(!loggedIn() || (loggedIn() && $_SESSION['userLevel'] != -1)){
    header('Location: ../../../index.php');
}
$title = IMPORT_FILES;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/dean/top_bar.php';

$dir = $_SERVER['DOCUMENT_ROOT'].'/GradProject/uploads/';
$filesList = scandir($dir);
?>

<div class="row">
    <h4 class="title text-center"><?=$title;?></h4>
</div>
<div class="row">
    <div class="medium-12 large-12 columns">
        <dl class="tabs" data-tab>
            <dd class="active"><a class="tab" id="all_courses" href="#panel2-1"><?=IMP_STU?></a></dd>
            <dd><a class="tab" id="sugg" href="#panel2-2"><?=IMP_COURSES?><span id="counter"></span></a></dd>
            <dd><a class="tab" href="#panel2-3"><?=IMP_CLASSES?></a></dd>
            <dd><a class="tab" href="#panel2-4"><?=IMP_FIN_GRADE?></a></dd>
            <dd><a class="tab" href="#panel2-5"><?=IMP_COURSE_FILE?></a></dd>
            <!--<dd><a class="tab" href="#panel2-6"><?=IMP_STUDENT_FILE?></a></dd>-->
            <dd><a class="tab" href="#panel2-7"><?=IMP_CLASS_GRADES_FILE?></a></dd>
            <dd><a class="tab" href="#panel2-8"><?=IMP_STUDENT_STATUS?></a></dd>
        </dl>
    </div>        
</div>

<div class="tabs-content medium-10 large-12 columns">
    <!-- Tab 1 -->
    <div class="content active" id="panel2-1">        
        <div class="row">   
            <form id="studentImportForm">
                <div class="medium-3 large-3 columns show-for-medium-up">                
                    <span><?=FILENAME?></span><br><br>
                    <select id="selectFile" name="selectFile">
                        <?php       
                        foreach ($filesList as $data){
                            $q = explode('.', $data);
                            if (!($data == '..'||$data == '.')){
                                echo '<option value="'.$data.'">'.$data.'</option>';    
                            }
                        }?>
                    </select>
                </div>
            </form>
        </div>        
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="medium-2 large-2 columns show-for-medium-up">
                <input type="button" class="tiny button" id="studentImportButton" name="studentImportButton" value="<?=IMPORT?>">
            </div>
        </div>     
    </div>
    <!-- Tab 2 -->
    <div class="content" id="panel2-2">        
        <div class="row">   
            <form id="courseImportForm">
                <div class="medium-3 large-3 columns show-for-medium-up">                
                    <span><?=FILENAME?></span><br><br>
                    <select id="selectFile" name="selectFile">
                        <?php       
                        foreach ($filesList as $data){
                            $q = explode('.', $data);
                            if (!($data == '..'||$data == '.')){
                                echo '<option value="'.$data.'">'.$data.'</option>';    
                            }
                        }?>
                    </select>
                </div>
            </form>
        </div>        
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="medium-2 large-2 columns show-for-medium-up">
                <input type="button" class="tiny button" id="courseImportButton" name="courseImportButton" value="<?=IMPORT?>">
            </div>
        </div>
    </div>    
    <!-- Tab 3 -->
    <div class="content" id="panel2-3">      
        <div class="row">   
            <form id="classImportForm">
                <div class="medium-2 large-2 columns show-for-medium-up">                
                    <span><?=FILENAME?></span><br><br>
                    <select id="selectFile" name="selectFile">
                        <?php       
                        foreach ($filesList as $data){
                            $q = explode('.', $data);
                            if (!($data == '..'||$data == '.')){
                                echo '<option value="'.$data.'">'.$data.'</option>';    
                            }
                        }?>
                    </select>
                </div>        
                <div class="medium-2 large-2 columns show-for-medium-up">                
                    <span><?=SEMESRER?></span><br><br>                    
                    <select id="selectSemester" name="selectSemester">
                        <?php
                            $strSQL = "SELECT * FROM semester";
                            $rs = mysql_query($strSQL);
                            echo "<option>".PICK_SEMESTER."</option>";
                            while($row = mysql_fetch_array($rs)) {
                                $strName = $row['name'];
                                echo "<option value = '" . $row['id'] ."'> ". $strName . "</option>";
                            }
                            echo '</select>';
                        ?>
                    </select>
                </div>
                <div class="medium-6 large-6 columns show-for-medium-up">                    
                </div>
            </form>
        </div>        
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="medium-2 large-2 columns show-for-medium-up">
                <input type="button" class="tiny button" id="classImportButton" name="classImportButton" value="<?=IMPORT?>">
            </div>
        </div>     
    </div>
    <!-- Tab 4 -->
    <div class="content" id="panel2-4">        
        <div class="row">   
            <form id="gradeImportForm">
                <div class="medium-3 large-3 columns show-for-medium-up">                
                    <span><?=IMP_FIN_GRADE?></span><br><br>
                    <select id="selectFile" name="selectFile">
                        <?php       
                        foreach ($filesList as $data){
                            $q = explode('.', $data);
                            if (!($data == '..'||$data == '.')){
                                echo '<option value="'.$data.'">'.$data.'</option>';    
                            }
                        }?>
                    </select>
                </div>
            </form>
        </div>        
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="medium-2 large-2 columns show-for-medium-up">
                <input type="button" class="tiny button" id="gradeImportButton" name="gradeImportButton" value="<?=IMPORT?>">
            </div>
        </div>
    </div> 
    <!-- Tab 5 -->
    <div class="content" id="panel2-5">        
        <div class="row">   
            <form id="courseFileImportForm">
                <div class="medium-3 large-3 columns show-for-medium-up">                
                    <span><?=IMP_COURSE_FILE?></span><br><br>
                    <select id="selectFile" name="selectFile">
                        <?php       
                        foreach ($filesList as $data){
                            $q = explode('.', $data);
                            if (!($data == '..'||$data == '.')){
                                echo '<option value="'.$data.'">'.$data.'</option>';    
                            }
                        }?>
                    </select>
                </div>
            </form>
        </div>        
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="medium-2 large-2 columns show-for-medium-up">
                <input type="button" class="tiny button" id="courseFileImportButton" name="courseFileImportButton" value="<?=IMPORT?>">
            </div>
        </div>
    </div> 
    <!-- Tab 6 -->
    <div class="content" id="panel2-6">        
        <div class="row">   
            <form id="studnetFileImportForm">
                <div class="medium-3 large-3 columns show-for-medium-up">                
                    <span><?=IMP_STUDENT_FILE?></span><br><br>
                    <select id="selectFile" name="selectFile">
                        <?php       
                        foreach ($filesList as $data){
                            $q = explode('.', $data);
                            if (!($data == '..'||$data == '.')){
                                echo '<option value="'.$data.'">'.$data.'</option>';    
                            }
                        }?>
                    </select>
                    <select id="selectMajor" name="selectMajor">
                        <option value="0">---</option>
                        <option value="1">ICT</option>
                        <option value="2">ARC</option>                
                    </select>
                </div>
            </form>
        </div>        
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="medium-2 large-2 columns show-for-medium-up">
                <input type="button" class="tiny button" id="studentFileImportButton" name="studentFileImportButton" value="<?=IMPORT?>">
            </div>
        </div>
    </div> 
    <!-- Tab 7 -->
    <div class="content" id="panel2-7">        
        <div class="row">   
            <form id="classGradesForm">
                <div class="medium-3 large-3 columns show-for-medium-up">                
                    <span><?=IMP_CLASS_GRADES_FILE?></span><br><br>
                    <select id="selectFile" name="selectFile">
                        <?php       
                        foreach ($filesList as $data){
                            $q = explode('.', $data);
                            if (!($data == '..'||$data == '.')){
                                echo '<option value="'.$data.'">'.$data.'</option>';    
                            }
                        }?>
                    </select>
                    <select id="selectMajor" name="selectMajor">
                        <option value="0">---</option>
                        <option value="1">ICT</option>
                        <option value="2">ARC</option>                
                    </select>
                </div>
            </form>
        </div>        
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="medium-2 large-2 columns show-for-medium-up">
                <input type="button" class="tiny button" id="classGradesFileImportButton" name="classGradesFileImportButton" value="<?=IMPORT?>">
            </div>
        </div>
    </div>
    <!-- Tab 8 -->
    <div class="content" id="panel2-8">   
        
        <form id="studentStatusForm">
            <div class="row">
                <div class="medium-2 large-2 columns show-for-medium-up">                
                    <span><?=IMP_CLASS_GRADES_FILE?></span><br><br>
                    <select id="selectFile" name="selectFile">
                        <?php       
                        foreach ($filesList as $data){
                            $q = explode('.', $data);
                            if (!($data == '..'||$data == '.')){
                                echo '<option value="'.$data.'">'.$data.'</option>';    
                            }
                        }?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="medium-2 large-2 columns show-for-medium-up">                
                    <input type="button" class="tiny button" id="importStudentStatus" name="importStudentStatus" value="<?=IMPORT?>">
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="row" >
    <div id="spin"></div>    
</div>
<div class="row">
    <div class="medium-4 large-4 columns">
        &nbsp;
    </div>
    <div class="medium-4 large-4 columns">
        <div data-alert class="result alert-box info" style="display:none; font-size: 20px; font-family: 'DroidKufi-Regular'; text-align: center">
            <?=INSERT_SUCCESS?>
            <a href="#" class="close">&times;</a>
        </div>
        
        <div data-alert class="result2 alert-box alert" style="display:none; font-size: 20px; font-family: 'DroidKufi-Regular'; text-align: center">
            <?=INSERT_NOT_SUCCESS?>
            <a href="#" class="close">&times;</a>
        </div>
    </div>
    <div class="medium-4 large-4 columns">
        &nbsp;
    </div>
</div>
<?php 
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/import_script.php';
