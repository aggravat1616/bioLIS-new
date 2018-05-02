<?php
session_start();
include "common.php";

if(!login_varify())
{
exit();
}

second_menu();

echo '<h1>Directory Structure</h1>';
echo '<html><P STYLE="margin-bottom: 0cm"><IMG SRC="CCLSSGH/Document_tree.jpg"></P></html>';
echo '<h1>Directory List</h1>';

$grand_array=array();

function list_dir($dir,$exclude_dir)
{
	global $grand_array;
	$array_dir=scandir($dir);
	foreach($array_dir as $key=>$value)
		{
	
			if(is_dir($dir.'/'.$value) && $value!='.' && $value!='..' && !in_array($dir.'/'.$value,$exclude_dir))
			{
				//echo $dir.'/'.$value.'<br>';
				$grand_array[]=$dir.'/'.$value;
				list_dir($dir.'/'.$value,$exclude_dir);				
			}		
		}



			{
				echo '<table><td style=\'font-size:100%\'><tr>'.$dir.'</tr></table>';
			}


}

$base_dir='/var/www/CCLSSGH';
$exclude_dir=array($base_dir.'/admin');
list_dir($base_dir,$exclude_dir);

//echo '<pre>';
//print_r($grand_array);
//echo '</pre>';


?>
