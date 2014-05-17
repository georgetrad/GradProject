<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/db_connect.php';
if(!loggedIn() || (loggedIn() && $_SESSION['userLevel'] == 0)){
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
    <div class="medium-6 large-6 columns">
        <dl class="tabs" data-tab>
            <dd class="active"><a id="all_courses" href="#panel2-1"><?=IMP_STU?></a></dd>
            <dd><a id="sugg" href="#panel2-2"><?=IMP_COURSES?><span id="counter"></span></a></dd>
            <dd><a href="#panel2-3"><?=IMP_CLASSES?></a></dd>
            <dd><a href="#panel2-4"><?=IMP_FIN_GRADE?></a></dd>
            <dd><a href="#panel2-5"><?=IMP_COURSE_FILE?></a></dd>
        </dl>
    </div>
        <div class="row" id="spin">
            <div class="result">&nbsp;</div>
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
                <input type="button" class="tiny button" id="importButton" name="importButton" value="<?=IMPORT?>">
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
                <input type="button" class="tiny button" id="importButton" name="importButton" value="<?=IMPORT?>">
            </div>
        </div>
    </div>    
    <!-- Tab 3 -->
    <div class="content" id="panel2-3">      
        <div class="row">   
            <form id="studentImportForm">
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
                    <?php
                        // select options
                        echo '<select>';
                        $strSQL = "SELECT * FROM semester";
                        $rs = mysql_query($strSQL);
                        echo "<option>".PICK_SEMESTER."</option>";
                        while($row = mysql_fetch_array($rs)) {
                            $strName = $row['name'];
                            echo "<option value = '" . $row['id'] ."'> ". $strName . "</option>";
                        }
                        echo '</select>';
                    ?>
                </div>
                <div class="medium-6 large-6 columns show-for-medium-up">                    
                </div>
            </form>
        </div>        
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="medium-2 large-2 columns show-for-medium-up">
                <input type="button" class="tiny button" id="importButton" name="importButton" value="<?=IMPORT?>">
            </div>
        </div>     
    </div>
    <!-- Tab 4 -->
    <div class="content" id="panel2-4">        
        <div class="row">           
            <div class="medium-3 large-3 columns show-for-medium-up">                
                <span><?=SEMESRER?></span><br><br>
                <?php
                    // select options
                    echo '<select>';
                    $strSQL = "SELECT * FROM semester";
                    $rs = mysql_query($strSQL);
                    echo "<option>".PICK_SEMESTER."</option>";
                    while($row = mysql_fetch_array($rs)) {
                        $strName = $row['name'];
                        echo "<option value = '" . $row['id'] ."'> ". $strName . "</option>";
                    }
                    echo '</select>';
                ?>
            </div>           
        </div>        
        <div class="row">
            <div class="medium-6 large-6 columns text-right">
                <table>
                    <tr>
                        <th><?=DELETE?></th>
                        <th><?=FILENAME?></th>
                    </tr>
                    <?php
                    foreach ($files1 as $data){
                        $q = explode('.', $data);
                        if (!($data == '..'||$data == '.')){                            
                            echo '<tr>';
                            echo '<td><input type="checkbox" name="file"></td>';
                            echo '<td><a class="fileLink_grd">'.$data.'</a></td>';
                            echo '</tr>';
                        }                        
                    }
                ?>
                </table>                
            </div>
        </div>
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="medium-2 large-2 columns">
                <input type="button" class="delete tiny button" value="<?=DELETE?>">
            </div>
        </div> 
    </div>
    <!-- Tab 5 -->
    <div class="content" id="panel2-5">        
        <div class="row">           
            <div class="medium-3 large-3 columns show-for-medium-up">                
                <span><?=SEMESRER?></span><br><br>
                <?php
                    // select options
                    echo '<select>';
                    $strSQL = "SELECT * FROM semester";
                    $rs = mysql_query($strSQL);
                    echo "<option>".PICK_SEMESTER."</option>";
                    while($row = mysql_fetch_array($rs)) {
                        $strName = $row['name'];
                        echo "<option value = '" . $row['id'] ."'> ". $strName . "</option>";
                    }
                    echo '</select>';
                ?>
            </div>           
        </div>        
        <div class="row">
            <div class="medium-6 large-6 columns text-right">
                <table>
                    <tr>
                        <th><?=DELETE?></th>
                        <th><?=FILENAME?></th>
                    </tr>
                    <?php
                    foreach ($files1 as $data){
                        $q = explode('.', $data);
                        if (!($data == '..'||$data == '.')){                            
                            echo '<tr>';
                            echo '<td><input type="checkbox" name="file"></td>';
                            echo '<td><a class="fileLink_courses">'.$data.'</a></td>';
                            echo '</tr>';
                        }                        
                    }
                ?>
                </table>                
            </div>
        </div>
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="medium-2 large-2 columns">
                <input type="button" class="delete tiny button" value="<?=DELETE?>">
            </div>
        </div> 
    </div>
</div>
<?php 
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/import_script.php';
