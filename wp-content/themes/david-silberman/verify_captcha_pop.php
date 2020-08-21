<?php
@session_start();
if($_REQUEST['captchaValpop'] == $_SESSION['captcha_field_pop'] && $_REQUEST['captchaValpop'] != '') {

    unset($_SESSION['captcha_field_pop']);
    echo 'yes';
} 
else 
{
    echo 'fail';
}
?>