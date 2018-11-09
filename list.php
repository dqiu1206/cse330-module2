<!DOCTYPE html>  
<html>      
  <head>
    <link rel="stylesheet" type="text/css" href="filesharing.css"> <!--link to CSS page-->
    <title>Files</title>
  </head>
  <body class="list">  
    <h1 class="h1list" >Uploaded Files</h1>

<?php
//Main page after logging in that displays each file to either view or delete. Also allows user to delete user, logout, and upload
session_start();


$username=$_SESSION['username'];
//returns true if user is in users.txt file
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

if(checkUser($username)==true&&strlen($username)!=0){ //checks if username exists and is not a blank

  $resource = opendir("/home/david.qiu/$username"); //open user directory

  while (($file = readdir($resource)) !== FALSE) { //reads every file in directory
    if ($file != '.' && $file != "..") {
        //inserts view and delete button for each file
          echo "$file
      
            <form action='view.php' method='GET'>
              <input type='submit' value='View'>
              <input type='hidden' name='view' value=$file>
            </form>
            
            <form action='delete.php' method='POST'>
              <input type='submit' value='Delete'>
              <input type='hidden' name='delete' value=$file>
            </form>";
        
    }
} 
  //creates an upload button, delete user button and logout button
  echo "
    <form class='upload' action='upload.php' method='POST' enctype='multipart/form-data'>
      Select file to upload:
      <input type='file' name='uploadedfile' id='uploadedfile_input'>
      <input type='submit' value='Upload'>
    </form>

  <div class='listdiv'>
     <form class='deleteAccount' action='deleteUser.php' method='POST'>
      <input type='submit' value='Delete User'/>
    </form>

    <form class ='logout' action='logout.php' method='POST'>
     <input type='submit' value='Log Out'/>
    </form>
  </div>";

}
else{
  echo "invalid user"; //prints if user is not in users.txt
}
?>
  </body>
</html>