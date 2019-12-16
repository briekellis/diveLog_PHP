<?php
session_start();
//connect to database
include 'connect.php';

//time to update tables, so check for required fields
	if (($_POST['f_name'] == "") || ($_POST['l_name'] == "")) {
		header("Location: changeEntry.php");
		exit;
	}
	//connect to database
	doDB();
	//create clean versions of input strings
	$master_id=$_SESSION["id"];
	$safe_f_name = mysqli_real_escape_string($mysqli, $_POST['f_name']);
	$safe_l_name = mysqli_real_escape_string($mysqli, $_POST['l_name']);
	$safe_address = mysqli_real_escape_string($mysqli, $_POST['address']);
	$safe_city = mysqli_real_escape_string($mysqli, $_POST['city']);
	$safe_state = mysqli_real_escape_string($mysqli, $_POST['state']);
	$safe_zipcode = mysqli_real_escape_string($mysqli, $_POST['zipcode']);
	//$safe_buddy = mysqli_real_escape_string($mysqli, $_POST['dive_buddy']);
	$safe_buddy = mysqli_real_escape_string($mysqli, $_POST['dive_buddy']);
	$safe_contact = mysqli_real_escape_string($mysqli, $_POST['contact_number']);
	$safe_email = mysqli_real_escape_string($mysqli, $_POST['email']);
	$safe_note = mysqli_real_escape_string($mysqli, $_POST['note']);
	
	//update master_name table
	$add_master_sql = "UPDATE diver_name SET date_added=now(),date_modified=now(),f_name='".$safe_f_name."',l_name='". $safe_l_name."' WHERE id='".$master_id."'";
	$add_master_res = mysqli_query($mysqli, $add_master_sql) or die(mysqli_error($mysqli));

	if ($_SESSION["lake_name"]=="true"){
		//update address table
		$add_address_sql = "UPDATE lake SET master_id='".$master_id."', date_added=now(), date_modified=now(), address='". $safe_address ."', city='". $safe_city ."', state='".$safe_state."', zipcode= '".$safe_zipcode."' WHERE id='".$master_id."'";
		$add_address_res = mysqli_query($mysqli, $add_address_sql) or die(mysqli_error($mysqli));
		}
	 else if (($_POST['address']) || ($_POST['city']) || ($_POST['state']) || ($_POST['zipcode'])) {
		//add new record to table
		$add_address_sql = "INSERT INTO lake (master_id, date_added, date_modified, address, city, state, zipcode)  VALUES ('".$master_id."',now(), now(), '".$safe_address."', '".$safe_city."','".$safe_state."' , '".$safe_zipcode."')";
		$add_address_res = mysqli_query($mysqli, $add_address_sql) or die(mysqli_error($mysqli));
	}

	if ($_SESSION["dive_buddy"]=="true"){
		//update dive buddy table
		$add_tel_sql = "UPDATE dive_buddy SET date_added=now(),date_modified=now(), buddy_name='".$safe_buddy."' WHERE master_id='".$master_id."'";
		$add_tel_res = mysqli_query($mysqli, $add_tel_sql) or die(mysqli_error($mysqli));
	   } else if ($_POST['dive_buddy']){
	   // add new record to dive buddy table
		$add_tel_sql = "INSERT INTO dive_buddy (master_id, date_added, date_modified,
		                buddy_name)  VALUES ('".$master_id."', now(), now(),
		                '".$safe_buddy."')";
		$add_tel_res = mysqli_query($mysqli, $add_tel_sql) or die(mysqli_error($mysqli));
	   }


	if ($_SESSION["contact_number"]=="true"){
		//update contact table
		$add_fax_sql = "UPDATE charter SET master_id='".$master_id."', date_added=now(),date_modified=now(),contact_number='".$safe_contact."' WHERE master_id='".$master_id."'";
		$add_fax_res = mysqli_query($mysqli, $add_fax_sql) or die(mysqli_error($mysqli));
	  } else if ($_POST['contact_number']) {
	  // add new record to contact table
		$add_fax_sql = "INSERT INTO charter (master_id, date_added, date_modified, contact_number)  VALUES ('".$master_id."', now(), now(),'".$safe_contact."')";
		$add_fax_res = mysqli_query($mysqli, $add_fax_sql) or die(mysqli_error($mysqli));
	  }

	if ($_SESSION["email"]=="true"){
		//update email table
		$add_email_sql = "UPDATE email SET master_id='".$master_id."', date_added=now(),date_modified=now(),email='".$safe_email."', type='".$_POST['email_type']."' WHERE master_id='".$master_id."'";
		$add_email_res = mysqli_query($mysqli, $add_email_sql) or die(mysqli_error($mysqli));
	}else if ($_POST['email']) {
	// add new record to email table
		$add_email_sql = "INSERT INTO email (master_id, date_added, date_modified,
		                  email, type)  VALUES ('".$master_id."', now(), now(),
		                  '".$safe_email."', '".$_POST['email_type']."')";
		$add_email_res = mysqli_query($mysqli, $add_email_sql) or die(mysqli_error($mysqli));
	}
	

	if ($_SESSION["notes"]=="true"){
 		//update notes table
		$add_notes_sql = "UPDATE personal_notes SET master_id='".$master_id."', date_added=now(),date_modified=now(),note='".$safe_note."' WHERE master_id='".$master_id."'";
		$add_notes_res = mysqli_query($mysqli, $add_notes_sql) or die(mysqli_error($mysqli));
	} else 	if ($_POST['note']) {
	  // add new record to notes table
		$add_notes_sql = "INSERT INTO personal_notes (master_id, date_added, date_modified,
		                  note)  VALUES ('".$master_id."', now(), now(), '".$safe_note."')";
		$add_notes_res = mysqli_query($mysqli, $add_notes_sql) or die(mysqli_error($mysqli));
	}

	mysqli_close($mysqli);
	$display_block = "<p>Your entry has been changed...Would you like to return to the <a href='addressBookMenu.html'>main menu</a>?...<a href='changeEntry.php'>Change another record?</a></p>";

?>
<!DOCTYPE html>
<html>
<head>
<title>Address Update</title>
<link href="greens.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php echo $display_block; ?>
</body>
</html>