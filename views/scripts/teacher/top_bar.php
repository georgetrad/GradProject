<?php

?>
<div class="contain-to-grid sticky">
    <nav class="top-bar" data-topbar>                
        <section class="top-bar-section">
            <!-- Right Navigation Section -->
            <ul class="right">                
                <li class="active has-dropdown">
                    <a style="padding-right: 25px"><?=$_SESSION['name']?></a>
                    <ul class="dropdown">                                
                        <li><a href="models/functions/log_out.php"><?=LOGOUT?></a></li>
                        <li><a href="views/scripts/teacher/change_password.php"><?=CHANGE_PASSWORD?></a></li>
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
                <li>
                    <a href="views/scripts/teacher/all_students.php"><?=MY_STUDENTS?></a>                    
                </li>                
                <li class="divider"></li>                
                <li>
                    <a><?=DB?></a>                    
                </li>
            </ul>               
        </section>
    </nav>
</div>