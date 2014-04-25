<?php
include_once './header.php';;
if (loggedIn() && $_SESSION['userLevel'] == 0){    
}
?>
<html class="no-js" lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, text/html" />        
        <base href="http://localhost/GradProject/" />
        <link rel="stylesheet" href="style/css/foundation.css"/>
        <link rel="stylesheet" href="style/css/custom.css"/>
        <script type="text/javascript" src="views/js/vendor/modernizr.js"></script>        
    </head>
    <body>
        <?php include_once './header.php';?>
        <?php include_once '../footer.php';?>
        
        <script type="text/javascript" src="views/js/jquery/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="views/js/jquery/jquery-ui-1.10.4.custom.min.js"></script>
        <script type="text/javascript" src="views/js/foundation/foundation.js"></script>
        <script type="text/javascript" src="views/js/foundation/foundation.topbar.js"></script>        
        <script type="text/javascript" src="views/js/foundation/foundation.reveal.js"></script>
        <script>
            $(document).foundation();
        </script>
    </body>