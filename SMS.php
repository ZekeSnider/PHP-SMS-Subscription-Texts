<?php
	$hostname = "insert mysql server here";  	 	// mysql DB location
	$username = "insert mysql username here";  		// the mysql username
	$password = "insert mysql password here";		// the mysql password
	$database = "insert DB name here";				// the database's name
	$table    = "insert table name here";			// the table's name
	
	//establishing link
	$link = mysql_connect($hostname,$username,$password);
	mysql_select_db($database) or die("Unable to select database");


	//Gettting message
	//This implementation loads a random line from "random.txt" in the same directory as this script.
	//You can easily load something else by changing the $line declaration
	$f_contents = file("random.txt"); 
    $line = $f_contents[rand(0, count($f_contents) - 1)];
    
    //Setting up mail headers
    
    $from = "INSERT FROM HEADER EMAIL HERE"; 			//This email will appear as sender. You can spoof this to a domain you don't own (except on Verizon)	
    $reply_to = "INSERT REPLY TO HEADER EMAIL HERE";    //All replies will be sent to this email (except on Verizon)
    $mail_Subject='INSERT SUBJECT HERE'; 				//This will show as the subject line.
    $mail_Body= $line;
    
    
    $headers = 'From: '. $from . "\r\n" .
    'Reply-To: ' . $reply_to . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	

	//Attempting to query to the DB
	$query = 'SELECT * FROM ' . $table; 
	$result = mysql_query($query) or die(mysql_error());
	
	//loops through all entries in table
	while($row = mysql_fetch_array($result)){
	
		//I added the most common US carriers to this list.
		//To add more, refer to http://www.emailtextmessages.com	
		
		if ($row['Carrier']=="ATT")
		{
			$mail_To=$row['Number']."@txt.att.net";
		}
		else if ($row['Carrier']=="Verizon")
		{
			$mail_To=$row['Number']."@vzwpix.com";
		}
		else if ($row['Carrier']=="TMobile")
		{
			$mail_To=$row['Number']."@tmomail.net";
		}
		else if ($row['Carrier']=="Virgin")
		{
			$mail_To=$row['Number']."@vmobl.com";
		}
		else if ($row['Carrier']=="Sprint")
		{
			$mail_To=$row['Number']."@messaging.sprintpcs.com";
		}
		else if ($row['Carrier']=="Boost")
		{
			$mail_To=$row['Number']."@myboostmobile.com";
		}
		
		//In my experience, Verizon gateway doesn't support from address spoofing, it'll just block the messages.
		if ($row['Carrier']!="Verizon")
		{
			mail($mail_To, $mail_Subject, $line, $headers, '-f From: ' . $from . '\r\nReply-To: ' . $reply_to);
		}
		else
		{
			mail($mail_To, $mail_Subject, $line, $headers);
		}
		
	}
	
	print('mailed!');
?>