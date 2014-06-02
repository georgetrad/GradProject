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
                    <a href="views/scripts/teacher/home.php"><?=HOME?></a>                    
                </li>
                <li class="divider"></li>                
                <li>
                    <a href="views/scripts/teacher/all_teachers.php"><?=TEACHERS?></a>                    
                </li>
                <li class="divider"></li>
                <li class="has-dropdown">
                    <a><?=STUDENTS?></a>
                    <ul class="dropdown">                                
                        <li><a href="views/scripts/teacher/all_students.php"><?=ALL_STUDENTS?></a></li>                        
                    </ul>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="views/scripts/teacher/advise.php"><?=ADVISE?></a>                    
                </li>
                <li class="divider"></li>                
                <li>
                    <a><?=DB?></a>                    
                </li>
            </ul>               
        </section>
    </nav>
</div>
    

