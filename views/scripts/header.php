<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';

if(!loggedIn()){
    echo 'You do not have access to this page.';
    exit();
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
        <div class="contain-to-grid sticky">
            <nav class="top-bar" data-topbar>
                <ul class="title-area">
                  <li class="name">
                    <h1><a href="#"><?=TITLE?></a></h1>
                  </li>
                  <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
                </ul>

                <section class="top-bar-section">
                    <!-- Right Navigation Section -->
                    <ul class="right">                
                      <li class="has-dropdown">
                        <a href="#"><?=$_SESSION['username'];?></a>
                        <ul class="dropdown">
                            <li><a href="#" id="logout_button"><?=LOGOUT?></a></li>
                        </ul>
                      </li>
                    </ul>               
                </section>
            </nav>
        </div>        
        
        <script type="text/javascript" src="views/js/jquery/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="views/js/jquery/jquery-ui-1.10.4.custom.min.js"></script>
        <script type="text/javascript" src="views/js/foundation/foundation.js"></script>
        <script type="text/javascript" src="views/js/foundation/foundation.topbar.js"></script>
        <script type="text/javascript" src="views/js/custom/logout_script"></script>
        <script>
            $(document).foundation();
        </script>
    </body>
    

