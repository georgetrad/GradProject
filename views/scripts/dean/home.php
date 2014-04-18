<?php
include '../../../models/core.php';

if (loggedin() && $_SESSION['userType'] == 'A'){
    echo 'You are logged in as a dean';
}
else{
    echo 'You do not have access to this page.';
}