<?php
@session_start();

if($_REQUEST['captchaVal'] == $_SESSION['captcha_field'] && $_REQUEST['captchaVal'] != '') {

    unset($_SESSION['captcha_field']);
    echo 'yes';
} 
else 
{
    echo 'fail';
}
?>