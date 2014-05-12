<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/db_connect.php';
if(!loggedIn() || (loggedIn() && $_SESSION['userLevel'] == 0)){
    header('Location: ../../../index.php');
}
$title = IMPORT_GENERAL_FILE;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/dean/top_bar.php';

$dir = $_SERVER['DOCUMENT_ROOT'].'/GradProject/uploads/';

$files1 = scandir($dir);
?>
<div class="row">
    <h4 class="title text-center"><?=$title;?></h4>
</div>
<div class="row">
    <div class="medium-2 large-2 columns show-for-medium-up">
        &nbsp;  
    </div>
    <div class="medium-8 large-8 columns show-for-medium-up">
        <?php 
        echo '<br><br> الملفات التالية محمله على المخدم وجاهزه للإستيراد الى قاعدة البيانات، إضغط للإستيراد<br><br>';
        /******************** ********************/
        echo '<br><br>إستيراد الطلاب<br><br>';        
        foreach ($files1 as $data){
            $q = explode('.', $data);
            if (!($data == '..'||$data == '.'))
                echo '<a class="fileLink_std">'.$data.'</a><br>';    
        }
        /******************** ********************/
        echo '<br><br>إستيراد المقررات<br><br>';
        foreach ($files1 as $data){
            $q = explode('.', $data);
            if (!($data == '..'||$data == '.'))
                echo '<a class="fileLink_crs">'.$data.'</a><br>';    
        }
        /******************** ********************/
        echo '<br><br>إستيراد العلامات النهائية<br><br>';
        foreach ($files1 as $data){
            $q = explode('.', $data);
            if (!($data == '..'||$data == '.'))
                echo '<a class="fileLink_grd">'.$data.'</a><br>';    
        }
        /******************** ********************/
        echo '<br><br>إستيراد الشعب<br><br>';
        foreach ($files1 as $data){
            $q = explode('.', $data);
            if (!($data == '..'||$data == '.'))
                echo '<a class="fileLink_cls">'.$data.'</a><br>';    
        }
        /******************** ********************/
        echo '<br><br>إستيراد ملف مقررات<br><br>';
        foreach ($files1 as $data){
            $q = explode('.', $data);
            if (!($data == '..'||$data == '.'))
                echo '<a class="fileLink_courses">'.$data.'</a><br>';    
        }
        ?>
    </div>  
    <div class="medium-2 large-2 columns show-for-medium-up">
        &nbsp;  
    </div>
</div>
<div class="row">
    <div class="medium-2 large-2 columns show-for-medium-up">
        &nbsp;  
    </div>
    <div class="medium-3 large-3 columns show-for-medium-up">
        <br>
        <span>الفصل الدراسي:  </span>
        <br><br>
        <?php
            // select options
            echo '<select id="semester">';
            $strSQL = "SELECT * FROM semester";
            $rs = mysql_query($strSQL);
            while($row = mysql_fetch_array($rs)) {
                $strName = $row['name'];
                echo "<option value = '" . $row['id'] ."'> ". $strName . "</option>";
            }
            echo '</select>';
        ?>
    </div>  
    <div class="medium-7 large-7 columns show-for-medium-up">
        &nbsp;  
    </div>    
</div>
<div class="row">
    <div class="medium-12 large-12 columns show-for-medium-up">
        <div id="spin"></div>
    </div>
</div>
<div class="row">
    <div class="medium-2 large-2 columns show-for-medium-up">
        &nbsp;  
    </div>
    <div class="medium-8 large-8 columns show-for-medium-up" style="padding: 2em;">
        <div class="result">&nbsp;</div>
    </div>  
    <div class="medium-2 large-2 columns show-for-medium-up">
        &nbsp;  
    </div>    
</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
