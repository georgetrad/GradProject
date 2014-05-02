<?php
if(loggedIn()){
    if($_SESSION['userLevel'] == -1){
        header('Location: dean/home.php');
        exit();
    }
    else if($_SESSION['userLevel'] == 0){
        header('Location: teacher/home.php');
        exit();
    }
}
?>
<div class="row large-12 columns show-for-medium-up text-center">            
    <br><br>
    <img src="style/img/GeorgeLogo2.png" alt="logo">
    <br><br><br>
</div>

<div class="row large-12 columns show-for-medium-up text-center">            
    <img src="style/img/Ebla_logo.png" alt="EPU Logo">
    <br><br><br>
</div>

<div id="username_div" class="row large-12 columns show-for-medium-up">
   <!--<form>-->
    <div class="medium-5 large-5 columns">
        &nbsp;
    </div>
    <div class="medium-2 large-2 columns">
        <input type="text" id="username" placeholder="<?=USERNAME?>" style="font-size: 12px; font-family: DroidKufi-Regular;">
    </div>
    <div class="medium-5 large-5 columns">
        &nbsp;
    </div>
</div>
<div class="row large-12 columns show-for-medium-up">
    <div class="medium-5 large-5 columns">
        &nbsp;
    </div>
    <div class="medium-2 large-2 columns">
        <input type="password" id="password" placeholder="<?=PASSWORD?>" style="font-size: 12px; font-family: DroidKufi-Regular">
    </div>
    <div class="medium-5 large-5 columns">
        &nbsp;
    </div>
</div>            
<div class="row large-12 columns show-for-medium-up">
    <div class="medium-5 large-5 columns">
        &nbsp;
    </div>
    <div class="medium-2 large-2 columns text-center">
        <input type="submit" id="login_button" class="tiny button" value="<?=LOGIN?>" style="background-color: #3e667b; font-size: 12px; font-family: DroidKufi-Regular">
    </div>
    <div class="medium-5 large-5 columns">
        &nbsp;
    </div>
    <!--</form>-->
</div>
<div class="medium-5 large-5 columns">
    &nbsp;
</div>   
<div class="medium-2 large-2 columns show-for-medium-up">            
    <div id="wrong" data-alert class="alert-box warning" style="font-size: 12px; font-family: DroidKufi-Regular; display: none">
        <span id="invalid_login"><?=INVALID_LOGIN?></span>
        <a href="#" class="close"></a>
    </div>            
</div>
<div class="medium-5 large-5 columns">
    &nbsp;
</div>