<?php
require '../../models/core.php';
require '../../lang/ar.php';
?>
<html class="no-js" lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, text/html" />        
        <link rel="stylesheet" href="../../style/css/foundation.css"/>
        <link rel="stylesheet" href="../../style/css/custom.css"/>
        <script type="text/javascript" src="../js/vendor/modernizr.js"></script>        
    </head>
    <body>
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
        
        <script type="text/javascript" src="../js/jquery/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="../js/jquery/jquery-ui-1.10.4.custom.min.js"></script>
        <script type="text/javascript" src="../js/foundation/foundation.js"></script>
        <script type="text/javascript" src="../js/foundation/foundation.topbar.js"></script>
        <script type="text/javascript" src="../js/custom/logout_script.js"></script>
        <script>
            $(document).foundation();
        </script>
    </body>
    

