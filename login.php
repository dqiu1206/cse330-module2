<?php

session_start();
$username=(string)$_POST['username']; //get the username from homepage
if(checkUser($username)&&strlen($username)!=0){ //checks if username is valid


$_SESSION['username']=$username; //store username into session
//creates button to view user files
echo "
    <form action=list.php method='GET'>
		<input type='submit' value='View Files'>
    </form>";
}
//allows you to go back to homepage if username is invalid
else{
	echo "Invalid Username";
	echo "
       <form action='homepage.html' method='GET'> 
           <input type='submit' value='Go Back'>
       </form>";
}


function checkUser($usernames){ 
  $users=fopen("/projects/users.txt","r"); //opens the text file
  while(!feof($users)){ //runs until text file ends
    $user=fgets($users); //get the next line of the text file
      if(trim($user)==$usernames){ //returns true if the username submitted is in users.txt
      return true;
    }
  }
  fclose($users); //closes the file
  return false;
}
?>

