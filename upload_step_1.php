<?php
session_start();
include "common.php";

if(!login_varify())
{
exit();
}
if($_SESSION['login']!='root')
{
echo 'This user is not authorized to use this menu'; 
exit();
}

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
}

$base_dir=$_SERVER['DOCUMENT_ROOT'];
$exclude_dir=array($base_dir.'/admin',$base_dir.'/counter');
list_dir($base_dir,$exclude_dir);

//echo '<pre>';
//print_r($grand_array);
//echo '</pre>';

echo '<html>';
echo '<body>';
echo '<form action=\'upload_step_2.php\' method=post enctype=\'multipart/form-data\'>';
echo '<table>';
echo '<tr>';

	echo '<td>Give File name to upload</td>';
	echo '<td><input type=file name=file></td>';
echo '</tr>';
echo '<tr>';
	echo '<td>Select location for storage at server</td>';
	echo '<td>';
		make_select_from_array($grand_array,'storage_path');
	echo '</td>';
echo '</tr>';
echo '<tr>';
	echo '<td><input type="submit" name="submit" value="Submit"></td>';
echo '<tr></form></table>';
second_menu();
echo '</body></html> ';
?>
