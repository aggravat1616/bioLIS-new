<?php
session_start();

echo '<html>';
echo '<head>';

echo '</head>';
echo '<body>';


//echo '<pre>';
//print_r($GLOBALS);
//echo '</pre>';

include 'common.php';


if(!login_varify())
{
exit();
}

echo '<h2 align=center>'.$_POST['date'].': '.$_POST['Header'].'</h2>';	
from_to_report_print_file($_POST['from_sample_id'],$_POST['to_sample_id']);


//////////////////////////////////////////////////////////////////////////////////////////////


function from_to_report_print_file($from_sample_id,$to_sample_id)
{
	for ( $counter = $from_sample_id; $counter <= $to_sample_id; $counter ++) 
	{
		if(print_sample_file($counter))
		{
		//print_examinations($counter);
		}

	}
	
}


///////////////////////////////////////////////////////////////////////////////////////////////

function print_sample_file($sample_id)
{
$link=start_nchsls();
$sql_sample_data='select * from sample where sample_id='.$sample_id;
$sql_examination_data='select * from examination where sample_id=\''.$sample_id.'\' order by id';

if(mysql_num_rows($result_sample_data=mysql_query($sql_sample_data,$link))>0)
{
echo '
<table>';
	$sample_array=mysql_fetch_assoc($result_sample_data);

		echo '

		<b>'.$sample_array['sample_id'].'</b>__<b>'.$sample_array['patient_name'].'</b>__'.$sample_array['patient_id'].'_<i><b>'.$sample_array['clinician'].'_'.$sample_array['unit'].'</b>_Ward: '.$sample_array['location'].'</i>_///_
		
										';
			
		if(mysql_num_rows($result_examination_data=mysql_query($sql_examination_data,$link))>0)
		{
							
			while($examination_array=mysql_fetch_assoc($result_examination_data))
			{
				if($examination_array['id']<1000)
				{
					echo '
							'.$examination_array['name_of_examination'].'_'.$examination_array['result'].',
					
					';		
				}
			}
			

			}	
		print_examinations_tt_file($sample_id);

		$r= 'select sign from sample_verification where sample_id=\''.$sample_id.'\'';
		$r1= mysql_query($r,$link);
		$r2= mysql_fetch_assoc($r1);
		//print_r($r2);

		$z= 'SELECT login_name, status FROM `signature_authority` WHERE sign=\''.$r2['sign'].'\' ';		
		$z1= mysql_query($z,$link);
		$z2= mysql_fetch_assoc($z1);
		//print_r($z2);

		echo ' VFB: '.$z2['login_name'].' ('.$z2['status'].')';
			
		return TRUE;

}
else
{
	return FALSE;
echo '</table>';
}

}


//////////////////////////////////////////////////////////////////////////////////////////////


function print_examinations_tt_file($sample_id)
{
$link=start_nchsls();

$sql_tt='select sample_receipt_time from sample where sample_id=\''.$sample_id.'\'';
$sql='select id,name_of_examination,details,result,unit,referance_range from examination where sample_id=\''.$sample_id.'\' order by id';

//echo $sql_tt;
$result_tt=mysql_query($sql_tt,$link);
$sample_r_t=mysql_fetch_assoc($result_tt);
$sample_receipt_time=$sample_r_t['sample_receipt_time'];

if(mysql_num_rows($result=mysql_query($sql,$link))>0)
{
echo '_///_RT:'.$sample_r_t['sample_receipt_time'].'_TAT:';
	//$rcount=0;
	//  $tr='<tr>';
	
while($ar=mysql_fetch_assoc($result))
{
	if($ar['id']<1000)
	{
		//$ex=explode('|',$ar['details']);
		//$tt=get_time_difference($sample_receipt_time, $ex[0]);
		//$tt_in_hours=ceil($tt['days']*24+$tt['hours']+($tt['minutes']/60));
		////echo '<tr><td>'.$ar['name_of_examination'].'</td><td>'.$sample_receipt_time.'</td><td>'.$ex[0].'</td><td>'.$tt['days'].':'.$tt['hours'].':'.$tt['minutes'].'</td></tr>';
		//echo '<tr><td>'.$ar['name_of_examination'].'</td><td>'.$sample_receipt_time.'</td><td>'.$ex[0].'</td><td>'.$tt_in_hours.'</td><td>'.$ex[1].'</td></tr>';
		echo ''.find_turnaround_time($sample_id,$ar['id']).'/';
	}
}

}
}	

///////////////////////////////////////////////////////////////////////////////////////////////

?>
