<?php
	
	if(isset($_POST['Name']) && $_POST['Name'] != "" && isset($_POST['Surname']) && $_POST['Surname'] != "" && isset($_POST['Password']) && $_POST['Password'] != "" && isset($_POST['Username']) && $_POST['Username'] != "" && isset($_POST['Address']) && $_POST['Address'] != "" && isset($_POST['Tel_Phone']) && $_POST['Tel_Phone'] != "" && isset($_POST['Tel_Office']) && $_POST['Tel_Office'] != "" && isset($_POST['Email_Address']) && $_POST['Email_Address'] != ""){
		$name = $_POST['Name'];
		$surname = $_POST['Surname'];
		$username = $_POST['Username'];
		$email = $_POST['Email_Address'];
		$password = $_POST['Password'];
		$address = $_POST['Address'];
		$tel_office = $_POST['Tel_office'];
		$tel_phone = $_POST['Tel_phone'];
		
		$to = $email;
		$subject = "Confirm registration";
	    $txt = 
		  "Hi ".$username."! Thanks for the registration!".
		  "click the link below to confirm your registration".
		  "<a href='samtinfo.ch/gestaff/email_verification.php'>click here</a>"
		  ;
		$headers =  'MIME-Version: 1.0' . "\r\n"; 
		$headers .= 'From: WebMaster <webmaster@affitamenti.ch>' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
		mail($to,$subject,$txt, $headers);
		
		header("Location: thankyou.htm");
	}
	else{
		header("Location: error.htm");
	}
	
?>

