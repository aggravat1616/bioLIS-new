<?php
session_start();



//echo '<pre>';
//print_r($GLOBALS);
//echo '</pre>';

include 'common.php';

//STR_TO_DATE('01,5,2013','%d,%m,%Y')
//2011/07/06_11_46_51

if(!login_varify())
{
exit();
}

main_menu();


$link=start_nchsls();
echo '<H1>Importing Results from Miura-300 file</H1>';
$counter=0;
$uploaddir = '/';
$uploadfile = $uploaddir . basename($_FILES['import_file']['name']);

		if($handle = fopen($_FILES['import_file']['tmp_name'], "r"))
		{
			while (   ($data = fgetcsv($handle, 0, ';')) !== FALSE   )
			{
				if(isset($data[2]) && isset($data[6]) && isset($data[4]))
				{
					if(ctype_digit($data[2]) && is_numeric($data[6]) && $data[6]>0)
					{
						$r='select sign from sample_verification where sample_id=\''.$data[2].'\'';
						$r1=mysql_query($r,$link);
						$r2=mysql_fetch_assoc($r1);
						if($r2['sign']=='Verification_pending')
						{

							$sql='update examination set result=\''.$data[6].'\' , details=concat(str_to_date(\''.$data[10].'\',\'%Y/%m/%d_%H_%i_%S\'),\'|Miura-300\') where sample_id=\''.$data[2].'\' and code=\''.$data[4].'\'';
							//echo '<br>'.$sql;
							if(!mysql_query($sql,$link)){echo mysql_error();}
							else
							{
								echo '<br>['.mysql_affected_rows($link).']->'.$data[2].'->'.$data[4].'->'.$data[6];
								$counter=$counter+mysql_affected_rows($link);

							}
						}	else	{echo '<br>'.$data[2].'-><font color=red>Not allowed. Sample has been verified by '.$r2['sign'].'.</font></td></tr>';}
					
					}
					else
					{
						echo '<br>'.$data[2].' is not digits or '.$data[6].' is not-numeric/negative';
					}	
					//print_r($data);
				}
    			}
				fclose($handle);
				echo '<h1>Updated data='.$counter.'</h1>';
		}
		else
		{
			echo 'can not fopen';
		}	

?>
