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
                    <a><?=HOME?></a>                    
                </li>
                <li class="divider"></li>                                
                <li class="has-dropdown">
                    <a><?=STUDENTS?></a>
                    <ul class="dropdown">                                
                        <li><a><?=MY_STUDENTS?></a></li>                        
                    </ul>
                </li>
                <li class="divider"></li>
                <li class="has-dropdown">
                    <a><?=IMPORT?></a>
                    <ul class="dropdown">                        
                        <li><a><?=COURSE_FILE?></a></li>
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