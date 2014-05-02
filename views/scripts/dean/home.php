<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
$title = HOME;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/dean/top_bar.php';
?>

        
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