<?php
include '../header.php';
if (loggedIn() && $_SESSION['userType'] == 'U'){    
    echo 'You are logged in as a teacher';
    include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/footer.php';
}
else{
    echo '<div data-alert class="alert-box warning" style="font-size: 20; background-color: red; text-align: center">
            '.ACCESS_DENIED.'
            <a href="#" class="close">&times;</a>
          </div>';        
}