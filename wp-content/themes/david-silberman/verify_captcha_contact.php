<?php
@session_start();
if($_REQUEST['captchaValside'] == $_SESSION['captcha_field_contact'] && $_REQUEST['captchaValside'] != '') {

    unset($_SESSION['captcha_field_contact']);
    echo 'yes';
} 
else 
{
    echo 'fail';
}
?>