<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
if(!loggedIn() || (loggedIn() && $_SESSION['userLevel'] == 0)){
    header('Location: ../../../index.php');
}
$title = ADVISE;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/dean/top_bar.php';
?>
<div class="row">
    <h4 class="title text-center"><?=$title;?></h4>
</div>
<div class="row">    
    <div class="medium-1 large-1 columns show-for-medium-up">
        &nbsp;
    </div>
    <form>        
        <div class="medium-2 large-2 columns show-for-medium-up">
            <input type="search" id="search_text" placeholder="<?=COLLEGE_ID?>" style="text-align: center"/>
        </div> 
        <div class="medium-1 large-1 columns show-for-medium-up">
            <input type="submit" class="tiny button" id="search_button" value="<?=SEARCH?>">
        </div> 
        <div class="medium-4 large-4 columns show-for-medium-up">
        </div>
    </form>
</div>
<div class="row">
    <div class="medium-1 large-1 columns">
        &nbsp;  
    </div>
    <div class="medium-10 large-10 columns">
        <dl class="accordion" data-accordion>
            <dd>
              <a href="#panel1"><?=PERSONAL_INFO?></a>
              <div id="panel1" class="content active">
                  <div class="row">
                      <div class="medium-8 large-4 columns">
                          <div class="stu_title label"><?=COLLEGE_ID?></div> <div class="stu_data secondary label">20910264</div>
                      </div>
                      <div class="medium-4 large-4 columns">
                          <div class="stu_title label"><?=ADDRESS?></div> <div class="stu_data secondary label">حلب - العزيزية</div>
                      </div>
                      <div class="medium-4 large-4 columns"></div>
                  </div>
                  <div class="row">
                      <div class="medium-4 large-4 columns">
                          <div class="stu_title label"><?=NAME?></div> <span class="stu_data secondary label">جورج جوزيف طراد</span>
                      </div>
                      <div class="medium-4 large-4 columns">
                          <div class="stu_title label"><?=PHONE_NUM?></div> <div class="stu_data secondary label">0947659360</div>
                      </div>
                      <div class="medium-4 large-4 columns"></div>
                  </div>
                  <div class="row">
                      <div class="medium-4 large-4 columns">
                          <div class="stu_title label"><?=GENDER?></div> <span class="stu_data secondary label">ذكر</span>
                      </div>
                      <div class="medium-4 large-4 columns">
                          <div class="stu_title label"><?=EMAIL?></div> <div class="stu_data secondary label">georgy.trad@gmail.com</div>
                      </div>
                      <div class="medium-4 large-4 columns"></div>
                  </div>
                  <div class="row">
                      <div class="medium-4 large-4 columns">
                          <div class="stu_title label"><?=BIRTH_DATE?></div> <span class="stu_data secondary label">03/08/1991</span>
                      </div>                      
                  </div>
                  <div class="row">
                      <div class="medium-4 large-4 columns">
                          <div class="stu_title label"><?=NATIONAL_ID?></div> <span class="stu_data secondary label">00005558877</span>
                      </div>                      
                  </div>
              </div>
            </dd>
            <dd>
              <a href="#panel2"><?=ACADEMIC_INFO?></a>
              <div id="panel2" class="content">
                Panel 2.
              </div>
            </dd>
            <dd>
              <a href="#panel3"><?=AVAILABLE_CRS?></a>
              <div id="panel3" class="content">
                Panel 3.
              </div>
            </dd>
        </dl>
    </div>
    <div class="medium-1 large-1 columns">
        &nbsp;  
    </div>
</div>

<div class="row">
    <!--<div id="jTable" class="medium-6 large-6 columns show-for-medium-up"></div>-->
</div>

<?php
    include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/advise_script.php';
?>