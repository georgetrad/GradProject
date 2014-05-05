<?php

?>
<div class="contain-to-grid sticky">
    <nav class="top-bar" data-topbar>                
        <section class="top-bar-section">
            <!-- Right Navigation Section -->
            <ul class="right">                
                <li class="active has-dropdown">
                    <a><?=WELCOME.' '.$_SESSION['username']?></a>
                    <ul class="dropdown">                                
                        <li><a href="models/functions/log_out.php"><?=LOGOUT?></a></li>
                    </ul>
                </li>
                <li>
                    <a href="views/scripts/dean/home.php"><?=HOME?></a>                    
                </li>
                <li class="divider"></li>
                <li class="has-dropdown">
                    <a><?=SEMESTERS?></a>
                    <ul class="dropdown">                                
                        <li><a><?=PREV_SEMESTERS?></a></li>
                        <li><a><?=NEW_SEMESTER?></a></li>
                    </ul>
                </li>
                <li class="divider"></li>
                <li class="has-dropdown">
                    <a><?=COURSES?></a>
                    <ul class="dropdown">                                
                        <li><a><?=SUGGEST_COURSES?></a></li>
                        <li><a><?=ALL_COURSES?></a></li>
                    </ul>
                </li>
                <li class="divider"></li>
                <li class="has-dropdown">
                    <a><?=TEACHERS?></a>
                    <ul class="dropdown">                                
                        <li><a><?=ASSIGN_STUDENTS?></a></li>                        
                    </ul>
                </li>
                <li class="divider"></li>
                <li class="has-dropdown">
                    <a><?=STUDENTS?></a>
                    <ul class="dropdown">                                
                        <li><a href="views/scripts/dean/all_students.php"><?=ALL_STUDENTS?></a></li>                        
                    </ul>
                </li>
                <li class="divider"></li>
                <li class="has-dropdown">
                    <a><?=IMPORT?></a>
                    <ul class="dropdown">                                
                        <li><a href="views/scripts/dean/upload.php"><?=UPLOAD_FILE?></a></li>
                        <li><a href="views/scripts/dean/import.php"><?=IMPORT_GENERAL_FILE?></a></li>
                    </ul>
                </li>
                <li class="divider"></li>
                <li>
                    <a><?=DB?></a>                    
                </li>
                <li class="divider"></li>
                <li>
                    <a><?=SETTINGS?></a>                    
                </li>
            </ul>               
        </section>
    </nav>
</div>
    

