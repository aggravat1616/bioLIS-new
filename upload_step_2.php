<?php
session_start();
include "common.php";
//echo '<pre>';
//print_r($GLOBALS);
//echo '</pre>';
if(!login_varify())
{
exit();
}
if($_SESSION['login']!='root')
{
echo 'This user is not authorized to use this menu'; 
exit();
}
//if ((($_FILES["file"]["type"] == "image/gif")
//|| ($_FILES["file"]["type"] == "image/jpeg")
//|| ($_FILES["file"]["type"] == "image/pjpeg"))
//&& ($_FILES["file"]["size"] < 20000))
//  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Error, Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Trying to upload file: " . $_FILES["file"]["name"] . "<br />";
    //echo "Type: " . $_FILES["file"]["type"] . "<br />";
	//    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists($_POST['storage_path'].'/'.$_FILES["file"]["name"]))
      {
	      echo $_FILES["file"]["name"] . " already exists.<h5>overwriting...</h5>";
      }
	if(!move_uploaded_file($_FILES["file"]["tmp_name"],$_POST['storage_path'].'/' .$_FILES["file"]["name"]))
	{
		echo '<h1>Failed upload.........</h1>';
	}
	else
	{
	      echo "<h2>Stored as: " .$_POST['storage_path'].'/' .$_FILES["file"]["name"].'</h2>';
	}
    }
// }
//else
//  {
//  echo "Invalid file";
//  }

second_menu();

?> 
