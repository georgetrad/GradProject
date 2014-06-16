<?php

?>
<div class="contain-to-grid sticky">
    <nav class="top-bar" data-topbar>                
        <section class="top-bar-section">
            <!-- Right Navigation Section -->
            <ul class="right">                
                <li class="active has-dropdown">
                    <a><?=$_SESSION['name']?></a>
                    <ul class="dropdown">                                
                        <li><a href="models/functions/log_out.php"><?=LOGOUT?></a></li>
                    </ul>
                </li>
                <li>
                    <a href="views/scripts/student/home.php"><?=HOME?></a>                    
                </li>
                <li class="divider"></li>
                <li>
                    <a href="views/scripts/student/my_grades.php"><?=MY_GRADES?></a>                    
                </li>
                <li class="divider"></li>
                <li>
                    <a href="views/scripts/student/ask_for_courses.php"><?=ASK_COURSES?></a>                    
                </li>                
            </ul>               
        </section>
    </nav>
</div>