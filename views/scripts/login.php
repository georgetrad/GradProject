<?php
include_once '../../models/core.php';
if(loggedIn()){
    if($_SESSION['userLevel'] == -1){
        header('Location: dean/home.php');
        exit();
    }
    else if($_SESSION['userLevel'] == 0){
        header('Location: teacher/home.php');
        exit();
    }
}
?>
<html class="no-js" lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, text/html" />        
        <title><?=LOGIN?></title>
        <base href="http://localhost/GradProject/" />
        <link rel="stylesheet" href="style/css/foundation.css"/>
        <link rel="stylesheet" href="style/css/custom.css"/>
        <script type="text/javascript" src="views/js/vendor/modernizr.js"></script>        
    </head>
    <body>
        <div class="row large-12 columns show-for-large-up text-center">            
            <br><br>
            <img src="style/img/Untitled-4.png" alt="logo">
            <br><br><br>
        </div>
        
        <div class="row large-12 columns show-for-large-up text-center">            
            <img src="style/img/Ebla_logo.png" alt="EPU Logo">
            <br><br><br>
        </div>
                
        <div class="row large-12 columns show-for-large-up">
            <div class="large-5 columns">
                &nbsp;
            </div>
            <div class="large-2 columns">
                <input type="text" id="username" placeholder="<?=USERNAME?>" style="font-size: 12px; font-family: DroidKufi-Regular" required>
            </div>
            <div class="large-5 columns">
                &nbsp;
            </div>
        </div>
        <div class="row large-12 columns show-for-large-up">
            <div class="large-5 columns">
                &nbsp;
            </div>
            <div class="large-2 columns">
                <input type="password" id="password" placeholder="<?=PASSWORD?>" style="font-size: 12px; font-family: DroidKufi-Regular" required>
            </div>
            <div class="large-5 columns">
                &nbsp;
            </div>
        </div>            
        <div class="row large-12 columns show-for-large-up">
            <div class="large-5 columns">
                &nbsp;
            </div>
            <div class="large-2 columns text-center">
                <input type="button" id="login_button" class="tiny button" value="<?=LOGIN?>" style="background-color: #07034a; font-size: 12px; font-family: DroidKufi-Regular">
            </div>
            <div class="large-5 columns">
                &nbsp;
            </div>
        </div>        
                
        <?php include './footer.php';?>        
        <script type="text/javascript" src="views/js/jquery/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="views/js/jquery/jquery-ui-1.10.4.custom.min.js"></script>                
        <script type="text/javascript" src="views/js/foundation/foundation.js"></script>
        <script type="text/javascript" src="views/js/foundation/foundation.reveal.js"></script>
        <script type="text/javascript" src="views/js/custom/login_script.js"></script>
        <script>
            $(document).foundation();
        </script>
    </body>
</html>