<?php
//This file enables new users to create an account.

//Some of this code is from the PHP wiki.

$username=(string) $_POST['username'];

// Checks if the entered username is in the users.txt file
// Returns true if username exists, false otherwise
function checkUser($usernames){
  $users=fopen("/projects/users.txt","r");
  while(!feof($users)){
    $user=fgets($users);
      if(trim($user)==$usernames){
      return true;
    }
  }
  fclose($users);
  return false;
}

//Adds username to users.txt file
function addUser($usernames){
	$users=fopen("/projects/users.txt","a");
	fwrite($users,"\n $usernames \n");
	fclose($users);
}

// If username exists, error message is displayed.
// If username does not exist, a new directory is created
if(!checkUser($username)){
		
		mkdir("/home/david.qiu/$username", 0777); //makes folder of user
		chmod("/home/david.qiu/$username", 0777); //sets permissions to 777
		addUser($username);
		echo "User created successfully!";
		//creates button to go back to homepage
		echo "
			<form action='homepage.html' method='GET'> 
				<input type='submit' value='Go Back'>
			</form>";	
} 
else if(strlen($username)==0){ 
	echo "No username inputted";
}
else {
		echo "User already exists";
		echo "
			<form action='homepage.html' method='GET'>
				<input type='submit' value='Go Back'>
			</form>";
}
?>