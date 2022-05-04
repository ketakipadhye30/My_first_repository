<?php
	
	require_once("../config.php");
	require_once(GLOBAL_INCLUDE_PATH."include/startup.php");
	require_once(GLOBAL_INCLUDE_PATH."include/email/sendEmail.php");
	date_default_timezone_set('Asia/Kolkata');
	$varref = $_SERVER['HTTP_REFERER'];
	//if (($varref == SITE_DOMAIN) ||($varref == 'www.'.SITE_DOMAIN))
	
	// check to see if verificaton code was correct
	// Testing Purpose 4 May 2022 ... Test By Ketaki
	// Testing Line 12 Now
	if (!empty($_POST))
		{
		//process form here
			$emailMsg =''; 
			foreach ($_POST as $key => $value) {
    			// Do something with $key and $value
				if (($key!='recipient')&&($key!='submit')&&($key!='compulsoryfields') &&($key!='redirect'))
				{
					$emailMsg .= "$key : $value <br/>";
				}
			}
		
		$to_email = $_POST['recipient'];
		if (isset($_POST['redirect']))
		{
			$redirectpage = ($_POST['redirect']!='')?$_POST['redirect']:'".DOMAIN_NAME."';
		}
		else
		{
			$redirectpage = '".DOMAIN_NAME."';
		}
		
		$html_message='';
		$to_name = 'site admin';
		$from_name = 'Feedback';
		$from_email = 'admin@'.DOMAIN_NAME;
		$html_message .= "FEEDBACK From ".DOMAIN_NAME."<br>";
		$html_message .= $emailMsg;
		$subject = (isset($_POST['subject'])?$_POST['subject']:"Email from ".DOMAIN_NAME."");
	
		$mailsent = sendmail ($from_name, $from_email, $to_name, $to_email, $subject, $text_message="", $html_message, $attachment="");
		
	//	$to_email1="rajivatre@gmail.com";
		
//		$mailsent = sendmail ($from_name, $from_email, $to_name, $to_email1, $subject, $text_message="", $html_message, $attachment="");
		
			//echo $mailsent;
			if ($mailsent==1)
				{
					if (!headers_sent($filename, $linenum)) {
    					Header("Location:$redirectpage");
    					exit;
						// You would most likely trigger an error here.
						} 
						else 
						{
	    					echo "Headers already sent in $filename on line $linenum\n" .
          "Cannot redirect, for now please click this <a " .
          "href=\"http://www.example.com\">link</a> instead\n";
    						exit;
						}
				}
				else
				{
					echo '1';	
					//Header("location:".DOC_ROOT."enquiry.php");
				}
		}
	else
	{
				echo '2';
				//Header("location:".DOC_ROOT."enquiry.php");
	}
		
?>
		