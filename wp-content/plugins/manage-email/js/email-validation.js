 //jQuery.noConflict();
function SaveMails(arg1,arg2,arg3,url)
{//alert(arg3);

if(arg1.value=="" )
	{
			alert("Please fill in your Email Address.");
			arg1.focus();
			return false;
	}
	if(arg1.value!="" )
	{
			if(emailvalidation(arg1)==false)
							{
								alert("Sorry, you have entered an invalid Email Address.");
								arg1.select();
								arg1.focus();
								return false;
							}
	}

if(arg2.value!="" )
	{
			if(emailvalidation(arg2)==false)
							{
								alert("Sorry, you have entered an invalid Email Address.");
								arg2.select();
								arg2.focus();
								return false;
							}
	}
if(arg3.value!="" )
	{
			if(emailvalidation(arg3)==false)
							{
								alert("Sorry, you have entered an invalid Email Address.");
								arg3.select();
								arg3.focus();
								return false;
							}
	}

   $.post(url+"admin_mail_save.php", {EmailTo:arg1.value,EmailBcc:arg2.value,EmailCc:arg3.value},
		  function(data)
		   {
	//alert(data);
	 $('#admin_mail').html(data);
			 
			 });
}


function SendTestMail(arg1,arg2,arg3)
{
	if(arg1.value=="" )
	{
			alert("Please fill in your Email Address.");
			arg1.focus();
			return false;
	}
	if(arg1.value!="" )
	{
			if(emailvalidation(arg1)==false)
							{
								alert("Sorry, you have entered an invalid Email Address.");
								arg1.select();
								arg1.focus();
								return false;
							}
	}
	if(arg2.value=="" )
	{
			alert("Please fill in your Email Address.");
			arg1.focus();
			return false;
	}
	if(arg2.value!="" )
	{
			if(emailvalidation(arg1)==false)
							{
								alert("Sorry, you have entered an invalid Email Address.");
								arg1.select();
								arg1.focus();
								return false;
							}
	}
	if(arg1.value=="" )
	{
			alert("Please fill in your Email Address.");
			arg1.focus();
			return false;
	}
	if(arg1.value!="" )
	{
			if(emailvalidation(arg1)==false)
							{
								alert("Sorry, you have entered an invalid Email Address.");
								arg1.select();
								arg1.focus();
								return false;
							}
	}
	   $.post(arg3+"email_admin.php", {ARG:arg1.value,mailtype:arg2},
		  function(data)
		   {
	//alert(data);
	 $('#admin_mail').html(data);
			 
			 });
	return false;

}

 

 
//-----------------------------
function emptyvalidation(entered, alertbox)
{
	with (entered)
	{
		while (value.charAt(0) == ' ')
			value = value.substring(1);
		while (value.charAt(value.length - 1) == ' ')
			value = value.substring(0, value.length - 1);
		if (value==null || value=="")
		{
			if (alertbox!="") alert(alertbox);
			return false;
		}
		else return true;
	}
}

function emailvalidation(entered) 
 {	
   var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   var address = entered.value;
   if(reg.test(address) == false)
   {
	   return false;
   }
  }
