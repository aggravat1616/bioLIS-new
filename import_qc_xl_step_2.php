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


$link=start_nchsls();
echo '<h1>Importing IQC of Erba-XL-640</h1>';
$counter_insert=0;
$counter_update=0;
$uploaddir = '/';
$uploadfile = $uploaddir . basename($_FILES['import_file']['name']);
echo 'uploading from:'.$uploadfile.'<br>';

		if($handle = fopen($_FILES['import_file']['tmp_name'], "r"))
		{
			while (($data = fgetcsv($handle, 0, chr(9))) !== FALSE) 
			{
				//QYYMMDDHH
				//123456789
				//format((qc_id/10000000),0)
				if(isset($data[2]) && isset($data[9]) && isset($data[4]) && isset($data[5]))
				{ 
				if(   	
					(($data[2]>500000000 && $data[2]<599999999) 
						||
					($data[2]>800000000 && $data[2]<899999999))
						 && 
					is_numeric($data[5])
				  )	
				{
					$sql_qc_target = 'select * from qc_target_xl where ex_code=\''.$data[4].'\' and qc_type=format('.$data[2].'/100000000, 0)';
					//echo $sql_qc_target;
					$result_qc_target=mysql_query($sql_qc_target,$link);
					if(!$result_qc_target){echo 'error at following sql:'.$sql_qc_target.mysql_error();}
					$array_qc_target=mysql_fetch_assoc($result_qc_target);
					//qc_id,repeat,ex_code,result
					$sql='insert into qc_xl values(
					\''.$data[2].'\' ,				
					\''.$data[9].'\' ,				
					\''.$data[4].'\' ,
					\''.$data[5].'\' ,
					\''.$array_qc_target['target'].'\' ,
					\''.$array_qc_target['sd'].'\',
					\' \' 
					)';

							//echo '<br>'.$sql;
					if(!mysql_query($sql,$link))
					{
						echo '(insert)'.mysql_error().'<br>';
						$sql_update=	'update qc_xl set  
								result=	\''.$data[5].'\' where 		
								qc_id=	\''.$data[2].'\' and
								`repeat`=	\''.$data[9].'\' and
								ex_code=\''.$data[4].'\'';
						//echo '<br>'.$sql_update;
						if(!mysql_query($sql_update,$link))
						{
						echo '(update)'.mysql_error().'<br>';
						}
						else
						{
 echo '(update)['.mysql_affected_rows($link).']->'.$data[2].'->'.$data[9].'->'.$data[4].'->'.$data[5].'<br>';
 $counter_update=$counter_update+mysql_affected_rows($link);
						}

					}
					else
					{
						echo '(insert)['.mysql_affected_rows($link).']->'.$data[2].'->'.$data[9].'->'.$data[4].'->'.$data[5].'<br>';
						$counter_insert=$counter_insert+mysql_affected_rows($link);
					}
		
					//print_r($data);
				}
				else{echo '<br>'.$data[2].' is Non-QC/non-digit  or '.$data[5].' is non-numeric result';}
				}
    		}
			fclose($handle);
			echo '<h1>Updated data='.$counter_update.'</h1>';
			echo '<h1>Inserted data='.$counter_insert.'</h1>';
		}
		else
		{
			echo 'can not fopen';
		}	
?>
