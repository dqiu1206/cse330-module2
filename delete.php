<?php
//Delete the File after pressing the button
session_start();
$file=$_POST['delete']; //get the file to delete
$username = $_SESSION['username']; //get username
$deleteFile="/home/david.qiu/$username/$file"; //state the path to the file to delete
if(unlink($deleteFile)){ //delete the file
	echo "You have successfully deleted the file"; 
	//button to get back to original page
	echo "
      <form action='list.php' method='GET'> 
         <input type='submit' value='Go Back'>
         <input type='hidden' name='username' value=$username>
      </form>";
}
else{ //call if delete has failed
	echo "The delete has failed";
	echo "
      <form action='list.php' method='GET'>
          <input type='submit' value='Go Back'>
         <input type='hidden' name='username' value=$username>
      </form>";
}
?>