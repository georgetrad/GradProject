<?php

?>
<div class="row large-12 columns show-for-medium-up text-center">    
    <img src="style/img/GeorgeLogo2.png" alt="logo" style="margin-top: 20px">
</div>

<div class="row large-12 columns show-for-medium-up text-center">            
    <img src="style/img/Ebla_logo.png" alt="EPU Logo"  style="margin-bottom: 25px">    
</div>

<div id="username_div" class="row large-12 columns show-for-medium-up">   
    <div class="medium-4 large-5 columns">
        &nbsp;
    </div>
    <div class="medium-4 large-2 columns">
        <input type="text" id="username" placeholder="<?=USERNAME?>" style="font-size: 12px; font-family: DroidKufi-Regular;">
    </div>
    <div class="medium-4 large-5 columns">
        &nbsp;
    </div>
</div>
<div class="row large-12 columns show-for-medium-up">
    <div class="medium-4 large-5 columns">
        &nbsp;
    </div>
    <div class="medium-4 large-2 columns">
        <input type="password" id="password" placeholder="<?=PASSWORD?>" style="font-size: 12px; font-family: DroidKufi-Regular">
    </div>
    <div class="medium-4 large-5 columns">
        &nbsp;
    </div>
</div>            
<div class="row large-12 columns show-for-medium-up">
    <div class="medium-4 large-5 columns">
        &nbsp;
    </div>
    <div class="medium-4 large-2 columns text-center">
        <input type="submit" id="login_button" class="tiny button" value="<?=LOGIN?>" style="background-color: #3e667b; font-size: 12px; font-family: DroidKufi-Regular">
    </div>
    <div class="medium-4 large-5 columns">
        &nbsp;
    </div>    
</div>
<div class="row">
    <div class="medium-4 large-5 columns">
        &nbsp;
    </div>
    <div class="medium-2 large-2 columns text-center">
        <span id="spinner"></span>
    </div>
    <div class="medium-4 large-5 columns">
        &nbsp;
    </div>
</div>

<div class="row">
    <div class="show-for-medium-up" style="padding-top: 5px">
        <div class="medium-4 large-5 columns">
            &nbsp;
        </div>
        <div class="medium-4 large-2 columns text-center">            
            <div id="wrong" data-alert class="alert-box alert" style="font-size: 12px; font-family: DroidKufi-Regular; display: none; ">
                <span id="invalid_login"><?=INVALID_LOGIN?></span>                
            </div>            
        </div>
        <div class="medium-4 large-5 columns">
            &nbsp;
        </div>
    </div> 
</div>