<?php
//This file enables users to upload files to the server.

//The majority of this code is from the PHP wiki.

session_start();

// Get the filename and make sure it is valid
$filename = basename($_FILES['uploadedfile']['name']);
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo "Invalid filename";
	exit;
}

// Get the username and make sure it is valid
$username = $_SESSION['username'];
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}

//Stores the directory in a variable
$full_path = sprintf("/home/david.qiu/%s/%s", $username, $filename);

//Moves uploaded file into directory; user is notified whether or not their
//upload succeeded.
if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) ){
	echo "Upload Successful!";
	echo "
		<form action='list.php' method='GET'>
			<input type='submit' value='Go Back'>
			<input type='hidden' name='username' value=$username>
		</form>";
	exit;
}else{
	echo "Failed to upload file.";
	echo "
		<form action='list.php' method='GET'>
			<input type='submit' value='Go Back'>
			<input type='hidden' name='username' value=$username>
		</form>";
	exit;
}
?>