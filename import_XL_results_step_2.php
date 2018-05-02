<?php
session_start();



//echo '<pre>';
//print_r($GLOBALS);
//echo '</pre>';

include 'common.php';



if(!login_varify())
{
exit();
}

main_menu();

//07/06/2011 09:41:27 XL
//2011-07-06 12:23:51 ideal
$link=start_nchsls();
echo '<H1>Importing Results from Erba XL-640</H1>';
$counter=0;
$uploaddir = '/';
$uploadfile = $uploaddir . basename($_FILES['import_file']['name']);

		if($handle = fopen($_FILES['import_file']['tmp_name'], "r"))
		{
			while (($data = fgetcsv($handle,0,chr(9))) !== FALSE) 
			{
				if(isset($data[2]) && isset($data[5]) && isset($data[4]))
				{
					if(ctype_digit($data[2]) && is_numeric($data[5]) && $data[5]>0)
					{
						//$sql='update examination set result=\''.$data[5].' \' where sample_id=\''.$data[2].'\' and code=\''.$data[4].'\'';
  //$sql='update examination set result=\''.$data[5].'\' , details=\''.$data[8].'|Erba-XL-640\' where sample_id=\''.$data[2].'\' and code=\''.$data[4].'\'';
	$sql='update examination set result=\''.$data[5].'\' , details=concat(str_to_date(\''.$data[8].'\',\'%m/%d/%Y %H:%i:%S\'),\'|Erba-XL-640\') where sample_id=\''.$data[2].'\' and code=\''.$data[4].'\'';
	// miura $sql='update examination set result=\''.$data[6].'\' , details=concat(str_to_date(\''.$data[10].'\',\'%Y/%m/%d_%H_%i_%S\'),\'|Miura-300\') where sample_id=\''.$data[2].'\' and code=\''.$data[4].'\'';
						
						
						echo '<br>'.$sql;
						if(!mysql_query($sql,$link)){echo mysql_error();}
						else
						{
							echo '<br>['.mysql_affected_rows($link).']->'.$data[2].'->'.$data[4].'->'.$data[5];
							$counter=$counter+mysql_affected_rows($link);
						}
					}
					else
					{
						echo '<br>'.$data[2].' is not digits or '.$data[5].' is not-numeric/negative';
					}
				}
			//			echo '<pre>';
						//print_r($data);
			//			echo '</pre>';
    		}
			fclose($handle);
			echo '<h1>Updated data='.$counter.'</h1>';
		}
		else
		{
			echo 'can not fopen';
		}	


?>
