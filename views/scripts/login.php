<?php
    include '../../lang/ar.php';
?>
<html class="no-js" lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, text/html" />        
        <title><?=LOGIN?></title>      
        <link rel="stylesheet" href="../../style/css/foundation.css"/>
        <link rel="stylesheet" href="../../style/css/custom.css"/>
        <script type="text/javascript" src="../js/vendor/modernizr.js"></script>        
    </head>
    <body>
        <div class="row large-12 columns">
            <br><br><br><br><br><br><br>
            <center>
                <img src="../../style/img/Ebla_logo.png" alt="EPU Logo">
                <br><br><br>
            </center>            
        </div>
        
        <div class="row">
            <div class="large-5 columns">
                &nbsp;
            </div>
            <div class="large-2 columns">
                <input type="text" id="username" placeholder="<?=USERNAME?>" style="font-size: 18px" required>
            </div>
            <div class="large-5 columns">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div class="large-5 columns">
                &nbsp;
            </div>
            <div class="large-2 columns">
                <input type="password" id="password" placeholder="<?=PASSWORD?>" style="font-size: 18px" required>
            </div>
            <div class="large-5 columns">
                &nbsp;
            </div>
        </div>            
        <div class="row">
            <div class="large-5 columns">
                &nbsp;
            </div>
            <div class="large-2 columns">
                <input type="button" id="login_button" class="tiny button" value="<?=LOGIN?>" style="margin-right: 75px; background-color: #07034a; font-size: 14px">
            </div>
            <div class="large-5 columns">
                &nbsp;
            </div>
        </div>        
        <footer>
            <img src="../../style/img/logo - Copy.png" alt="digitech Logo" style="float: left; width:200px ; height: 50px; margin-left: 200px; margin-top: 25px">
        </footer>
        <script type="text/javascript" src="../js/jquery/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="../js/jquery/jquery-ui-1.10.4.custom.min.js"></script>
        <script type="text/javascript" src="../js/custom/login_script.js"></script>
    </body>
</html>