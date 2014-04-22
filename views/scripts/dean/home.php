<?php
include_once '../header.php';
if (loggedIn() && $_SESSION['userType'] == 'A'){
    echo 'You are logged in as a dean';
    include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/footer.php';
}
else{
    echo '<div data-alert class="alert-box warning" style="font-size: 20; background-color: red; text-align: center">
            '.ACCESS_DENIED.'
            <a href="#" class="close">&times;</a>
          </div>';        
}
?>