<?php
require '../../../models/core.php';
if (loggedIn() && $_SESSION['userType'] == 'U'){
    echo 'You are logged in as a teacher';
}
else{
    echo 'You do not have access to this page.';
}