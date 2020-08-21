<?php
$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
$wp_load = $parse_uri[0].'wp-load.php';
require_once($wp_load);

include('mailsendclass.php');	


/*echo "<pre>";
print_r($_POST);
echo "</pre>";
*/


define('SITE_URL',get_option('siteurl').'/');


/*----- Getting Email id from DB --------*/

$result=mysql_query("SELECT email_to,email_cc,email_bcc FROM den_email");

while($row=mysql_fetch_array($result))
{
	$email_to=$row['email_to']; 
	$email_cc=$row['email_cc'];
	$email_bcc=$row['email_bcc'];
}

/*----- Getting Email id from DB --------*/

################################################################

if($_POST['cname']!='')//Home footer
{
$name=stripslashes($_POST['cname']);
$phone=stripslashes($_POST['cphone']);
$email=stripslashes($_POST['cemail']);
if(trim($_POST['ccomments']) == "Questions/Comments")
{
$comments = "";
}
else
{
$comments=stripslashes($_POST['ccomments']);
}

$email_fieldname='cemail';
$phone_fieldname='cphone';

$array=array(
		'cname'     => "Name",
		'cphone'     => "Phone",
		'cemail'     => "Email"
			
);


if(!empty($comments))
{
$array1 = array('ccomments'  => "Questions/Comments");
$array = array_merge($array, $array1);

}

$subject="Request Information - Dr. David M. Silberman";

}


if($_POST['pname']!='')// Popup form
{
$name=stripslashes($_POST['pname']);
$phone=stripslashes($_POST['pphone']);
$email=stripslashes($_POST['pemail']);
if(trim($_POST['pcomments']) == "Questions/Comments")
{
$comments = "";
}
else
{
$comments=stripslashes($_POST['pcomments']);
}

$email_fieldname='pemail';
$phone_fieldname='pphone';

$array=array(
		'pname'     => "Name",
		'pphone'     => "Phone",
		'pemail'     => "Email"
			
);


if(!empty($comments))
{
$array1 = array('pcomments'  => "Questions/Comments");
$array = array_merge($array, $array1);

}

	if($_POST['frmname']==1){
		$subject="Request Information - Dr. David M. Silberman";
	}
	else if($_POST['frmname']==2){
		$subject="Request Appointment - Dr. David M. Silberman";
	}



}



if($_POST['sname']!='')//Home Banner / Sidebar Form
{
$name=stripslashes($_POST['sname']);
$phone=stripslashes($_POST['sphone']);
$email=stripslashes($_POST['semail']);
if(trim($_POST['scomments']) == "Questions/Comments")
{
$comments = "";
}
else
{
$comments=stripslashes($_POST['scomments']);
}


$email_fieldname='semail';
$phone_fieldname='sphone';

$array=array(
		'sname'     => "Name",
		'sphone'     => "Phone",
		'semail'     => "Email"  
			
);

if(!empty($comments))
{
$array1 = array('scomments'  => "Questions/Comments");
$array = array_merge($array, $array1);

}

	
	$subject="Request Appointment - Dr. David M. Silberman";
	
}

if($_POST['contname']!='')//Contact Form
{
$name=stripslashes($_POST['contname']);
$lname=stripslashes($_POST['contlname']);
$phone=stripslashes($_POST['contphone']);
$email=stripslashes($_POST['contemail']);
$city=stripslashes($_POST['contcity']);
$state=stripslashes($_POST['contstate']);
$comments=stripslashes($_POST['contcomments']);

$email_fieldname='contemail';
$phone_fieldname='contphone';

$array=array(
		'contname'      => "Name",
		'contphone'     => "Phone",
		'contemail'     => "Email", 
		'contcity'      => "City", 
		'contstate'      => "State", 
		'contcomments'  => "Question/Comments", 
			
);


$subject="Contact Form - Dr. David M. Silberman";

}
/*if($_POST['mname']!='')
{
$name=stripslashes($_POST['mname']);
$phone=stripslashes($_POST['mphone']);
$email=stripslashes($_POST['memail']);
$amount=stripslashes($_POST['mamount']);
$certificate=stripslashes($_POST['mcertificate']);
$comments=stripslashes($_POST['mcomments']);

$email_fieldname='memail';
$phone_fieldname='mphone';

$array=array(
		'mname'      	=> "Name",
		'mphone'     	=> "Phone",
		'memail'     	=> "Email", 
		'mamount'     	=> "Amount", 
		'mcertificate'  => "Name on Gift Certificate", 
		'mcomments'  	=> "Questions/Comments", 
			
);


$subject="Gift Certificates - Dr. David M. Silberman";

}*/

if($_POST['apfname']!='')// Appointment Request
{
$fname=stripslashes($_POST['apfname']);
$lname=stripslashes($_POST['aplname']);
$name = $fname . ' ' . $lname;
$address=stripslashes($_POST['apaddress']);
$city=stripslashes($_POST['apcity']);
$state=stripslashes($_POST['apstate']);
$certificate=stripslashes($_POST['mcertificate']);
$zip=stripslashes($_POST['apzip']);
$phone=stripslashes($_POST['apphone']);
$email=stripslashes($_POST['apemail']);
$comments=stripslashes($_POST['apcomments']);
$zip=stripslashes($_POST['appatient']);
$bestday=stripslashes($_POST['apbestday']);
$reason=stripslashes($_POST['apreason']);
$appdate=stripslashes($_POST['apappointmentdate']);
$alternativedate=stripslashes($_POST['apalternativedate']);

$email_fieldname='apemail';
$phone_fieldname='apphone';

$array=array(
		'apfname'      	=> "First Name",
		'aplname'     	=> "Last Name",
		'apaddress'     => "Address", 
		'apcity'     	=> "City", 
		'apstate'  		=> "State", 
		'apzip'  		=> "Zip code", 
		'apphone'  		=> "Phone", 
		'apemail'  		=> "Email", 
		'apcomments'  	=> "Questions/Comments", 
		'appatient'  	=> "Select One", 
		'apbestday'  	=> "Best day and Time to call", 
		'apreason'  	=> "Reason for Appointment", 
		'apappointmentdate'  	=> "Please choose a date", 
		'apalternativedate'  	=> "Please select an alternative date", 
			
);


$subject="Appointment Request - Dr. David M. Silberman";

}
################################################################



$con_subject="Confirmation - Dr. David M. Silberman";

//Replacing the to, cc and bcc email address if @techwyseintl.com is found STARTS HERE
	$email=stripslashes($email);
	$email_string = strstr($email, "@techwyseintl.com"); //Checking whether email string contains @techwyseintl.com
	$to = ($email_string=="@techwyseintl.com")? stripslashes($email) : $email_to;
	$bcc_email = ($email_string=="@techwyseintl.com")? "" : $email_bcc;
	$cc_email = ($email_string=="@techwyseintl.com")? "" : $email_cc;
//Replacing the to, cc and bcc email address if @techwyseintl.com is found ENDS HERE
if($name!='')
{
 
$obj = new formTempclass();
$obj->name 		            = $name; // This is mantatory- Field name of name
$obj->email_fieldname 		= $email_fieldname; // This is mantatory- Field name of Email which send to user 
$obj->phone_fieldname 		= $phone_fieldname; // This is mantatory- Field name of Email which send to user 
$obj->postval_array	        = $array;

$obj->sitename 				= "Dr. David M. Silberman"; //Site Name
$obj->siteurl 				= SITE_URL;  // Site Url
$obj->mail_banner 			= SITE_URL."wp-content/themes/david-silberman/mails/images/mail-template.jpg"; // path of mail image 
$obj->rowbgcolor   			= "#fff"; // Bg color of each row
$obj->rowsubtitlebgcolor	= "#17aae9"; // Bg color of titles like persoonal Details
$obj->footerbgcolor			= "#000";
$obj->footer_txtcolor		= "#FFF";
$obj->bordercolor 			= "#000";

$obj->admin_mailto 			= $to;
$obj->admin_bcc_mail		= $bcc_email;
$obj->admin_cc_mail 		= $cc_email;
$obj->admin_subject 		= $subject;
$obj->con_subject			= $con_subject; // Confirmation mail Sublect
$obj->send_to_user          = true;
$obj->AdminmailSend(); 
//--- uncomment for view the tempahtes in browser

$body = $obj->UserTemplate($array);
$bodyadmin = $obj->adminTemplate($array);
/*echo $body;
echo "<br>";
echo $bodyadmin;exit;*/


//--- uncomment for view the tempahtes in browser
//--------------------------------------adluge code--------------------------------------
 	require_once("clientcenter-api-library.php"); 
	$lead = new clientcenter();
	$lead->client_code="c3040bf7f6fa63baa35ce1b0e500b3a6"; // Mandatory. Unique identification code.	 
	
	$lead->fname=$name; //post  Value of first name 
	
	//$lead->lname=$lname; //post  Value of last name  
	$lead->phone=$phone;//post Value of Phone Number 
	$lead->email=$email;//post  Value of Email addess  
	$lead->city=$city;
	$lead->state=$state;
	$lead->postalcode=$zip;
	
	if(isset($_POST['mname'])){
			if($amount!=''){
				$tot_comments .= " Amount : ".$amount."<br>";
			}
			if($certificate!=''){
				$tot_comments .= " Name on Gift Certificate : ".$certificate."<br>";
			}
			if($comments!=''){
				$tot_comments .= " Questions/Comments : ".$comments."<br>";
			}
	}
	else{

		$tot_comments = $comments;
	}
	
	
	
	$lead->comments=nl2br($tot_comments);//post Value of Comments 
	
	$lead->status=1; // No need to change this
	
	//No need to modify any of the below code
	$lead->useragent = $_SERVER['HTTP_USER_AGENT']; //browser properties
	$lead->remote_ip=$_SERVER['REMOTE_ADDR']; //ip address
	$lead->referrer=$_SERVER['HTTP_REFERER'];// page source
	$lead->contact_date=date("Y-m-d h:i:s");
	$lead->search_engine=$_COOKIE['adl_durl'];
	$lead->keyword=$_COOKIE['adl_key'];
	$lead->source=$_COOKIE['adl_camp'];
	$lead->randomnum=$_COOKIE['adl_rand'];
	$lead->adl_ref=$_COOKIE['adl_ref'];
		
	$lead->send_to_adluge=true; // Set to true If you are sending leads to adluge //default true
	$lead->send();
	//echo "thank-you";exit;
//--------------------------------------------------------------------------------------------------
	header("location:".SITE_URL."thank-you");
}
else
{
	header("location:".SITE_URL);
}
?>