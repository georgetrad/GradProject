<?php
include_once './header.php';;
if (loggedIn() && $_SESSION['userLevel'] == -1){
        
}
?>
<html class="no-js" lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, text/html" />        
        <base href="http://localhost/GradProject/" />
        <link rel="stylesheet" href="style/css/foundation.css"/>  
        <link rel="stylesheet" href="style/jTable/themes/metro/darkgray/jtable.css"  type="text/css" />
        <link rel="stylesheet" href="style/jTable/themes/basic/jtable_basic.css"/>
        <link rel="stylesheet" href="style/jTable/themes/jqueryui/jtable_jqueryui.min.css"/>
        <link rel="stylesheet" href="style/jTable/themes/metro/jtable_metro_base.css"/>
        <link rel="stylesheet" href="style/jTable/themes/jMetro/css/jquery-ui.css"/>
        <link rel="stylesheet" href="style/css/custom.css"/>      
        <script type="text/javascript" src="views/js/vendor/modernizr.js"></script>
    </head>
    <body>
        <?php include_once './header.php';?>
        
        <div id="search_div" class="row" style="display: none">
            <div class="medium-1 large-1 columns show-for-medium-up">
                <br>
                <span><?=SEARCH_TYPE?></span>
                <form>                        
                    <select id="search_id">                    
                        <option value="0">الرقم الجامعي</option>
                        <option value="1">الاسم</option>
                        <option value="2">اسم الأب</option>
                        <option value="3">النسبة</option>                    
                    </select>
                    <input type="search" id="search_text" style="text-align: center"/>
                    <input type="submit" class="tiny button" id="search_button" value="ابحث">
                </form>
            </div>                       
        </div>
        
        <div id="jTable" class="row medium-6 large-6 columns show-for-medium-up">
        </div>
        
        
        <script type="text/javascript" src="views/js/jquery/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="views/js/jquery/jquery-ui-1.10.4.custom.min.js"></script>
        <script type="text/javascript" src="views/js/foundation/foundation.js"></script>
        <script type="text/javascript" src="views/js/foundation/foundation.topbar.js"></script>        
        <script type="text/javascript" src="views/js/foundation/foundation.reveal.js"></script>
        <script type="text/javascript" src="views/js/jTable/jquery.jtable.min.js"></script>
        <script type="text/javascript" src="views/js/jTable/jquery.jtable.ar.js"></script>
        <script type="text/javascript" src="views/js/custom/jTable.js"></script>
        <script>
            $(document).foundation();
        </script>
    </body>
    
    
                                    