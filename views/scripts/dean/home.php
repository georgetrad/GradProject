<?php
include '../header.php';
if (loggedIn() && $_SESSION['userType'] == 'A'){
    echo 'You are logged in as a dean';
}
else{
    echo 'You do not have access to this page.';
}