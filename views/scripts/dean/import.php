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

echo '<br><br>Import page:<br><br>';

foreach ($files1 as $data){;
    $q = explode('.', $data);
    if (!($data == '..'||$data == '.'))
        echo '<span>Click to import: <a class="fileLink" data-file="q">'.$data.'</a></span><br>';    
}
?>
<div class="result"></div>
<div id="spin"></div>


<?php
    include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
 ?>