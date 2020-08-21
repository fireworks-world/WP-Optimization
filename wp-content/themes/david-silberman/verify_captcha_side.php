<?php
@session_start();
if($_REQUEST['captchaValcontact'] == $_SESSION['captcha_hid_side'] && $_REQUEST['captchaValcontact'] != '') {

    unset($_SESSION['captcha_hid_side']);
    echo 'yes';
} 
else 
{
    echo 'fail';
}
?>