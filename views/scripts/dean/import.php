<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
if(!loggedIn() || (loggedIn() && $_SESSION['userLevel'] == 0)){
    header('Location: ../../../index.php');
}
$title = HOME;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/dean/top_bar.php';

$dir = $_SERVER['DOCUMENT_ROOT'].'/GradProject/uploads/';

$files1 = scandir($dir);
?>
<div class="row">
    &nbsp;    
</div>
<div class="row">
    <div class="medium-2 large-2 columns show-for-medium-up">
        &nbsp;  
    </div>
    <div class="medium-8 large-8 columns show-for-medium-up">
<?php 
    echo '<br><br> الملفات التاليه محمله على المخدم وجاهزه للإستيراد الى قاعدة البيانات:<br><br>';

    foreach ($files1 as $data){
        $q = explode('.', $data);
        if (!($data == '..'||$data == '.'))
            echo '<span>إضغط للإستيراد:  </span><a class="fileLink">'.$data.'</a><br>';    
    }
?>
        <div class="result"></div>
        <div id="spin"></div>  
    </div>  
    <div class="medium-2 large-2 columns show-for-medium-up">
        &nbsp;  
    </div>
</div>



<?php
    include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
    include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/import_page_script.php';
 ?>