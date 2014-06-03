<?php

?>
<div class="contain-to-grid sticky">
    <nav class="top-bar" data-topbar>                
        <section class="top-bar-section">
            <!-- Right Navigation Section -->
            <ul class="right">                
                <li class="active has-dropdown">
                    <a><?=WELCOME.' '.$_SESSION['name']?></a>
                    <ul class="dropdown">                                
                        <li><a href="models/functions/log_out.php"><?=LOGOUT?></a></li>
                    </ul>
                </li>
                <li>
                    <a href="views/scripts/dean/home.php"><?=HOME?></a>                    
                </li>
                <li class="divider"></li>
                <li>
                    <a href="views/scripts/dean/semester.php"><?=SEMESTERS?></a>                    
                </li>
                <li class="divider"></li>
                <li>
                    <a href="views/scripts/dean/all_courses.php"><?=SUGGEST_COURSES?></a>                    
                </li>
                <li class="divider"></li>
                <li>
                    <a href="views/scripts/dean/all_teachers.php"><?=TEACHERS?></a>                    
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
                    <a><?=ACADEMIC_ADVISING?></a>
                    <ul class="dropdown">                                
                        <li><a href="views/scripts/dean/advise.php"><?=ADVISE?></a></li>
                        <li><a href="views/scripts/dean/assign_advisor.php"><?=ASSIGN_STUDENTS?></a></li>                        
                    </ul>
                </li>
                <li class="divider"></li>
                <li class="has-dropdown">
                    <a><?=IMPORTING?></a>
                    <ul class="dropdown">                                
                        <li><a href="views/scripts/dean/upload.php"><?=UPLOAD_FILE?></a></li>
                        <li><a href="views/scripts/dean/import.php"><?=IMPORT_FILES?></a></li>
                        <li><a href="views/scripts/dean/update_data.php"><?=UPDATE_DATA?></a></li>
                    </ul>
                </li>                                
                <li class="divider"></li>
                <li class="has-dropdown">
                    <a><?=SETTINGS?></a>
                    <ul class="dropdown">
                        <li><a href="views/scripts/dean/grades_dist.php"><?=GRADES_DIST?></a></li>
                        <li><a href="views/scripts/dean/levels_dist.php"><?=HRS_CONST?></a></li>
                    </ul>
                </li>
                <li class="divider"></li>
                <li>
                    <a><?=DB?></a>                    
                </li>
            </ul>               
        </section>
    </nav>
</div>
    

