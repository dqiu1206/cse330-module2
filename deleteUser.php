<?php
//Deletes user from text file and removes directory of the user from server

session_start();
$username=$_SESSION['username']; //get username from session
deleteFilesDir($username); //call deleteFilesDir function, which deletes the directory and all the files of the user
deleteText($username); //deletes the name inside user.txt file

echo "
   <form action='logout.php' method='GET'> 
     <input type='submit' value='Back to Homepage'/>
   </form>";
//Lets you go back to homepage

//Source: https://stackoverflow.com/questions/11267086/php-unlink-all-files-within-a-directory-and-then-deleting-that-directory
function deleteFilesDir($usernames){
  $files=glob("/home/david.qiu/$usernames/*"); //searches for everyfile in the user directory
  foreach($files as $file){
  	unlink($file); //deletes file in folder
  }
  rmdir("/home/david.qiu/$usernames"); //after deleting every file, delete the directory
  
}
function deleteText($usernames){
		    
        $userArray=file("/projects/users.txt",FILE_IGNORE_NEW_LINES); //creates array of all the usernames in user.txt
      	 $id=0;
      	//iterates through array of names to get the index of the username
      	for($i=0;$i<count($userArray);$i++){ 
      		if(trim($userArray[$i])==$usernames){
      			$id = $i;
      		}
      	}
      	
      	
      	unset($userArray[$id]); //deletes the user from the array

      	//Source: https://stackoverflow.com/questions/29035911/how-to-amend-or-delete-a-line-of-a-text-file-in-php
      	file_put_contents("/projects/users.txt",implode(PHP_EOL,$userArray));  //copies and overwrites users.txt with new array
      
		
}
?>