<?php

ini_set("display_errors", "1");
error_reporting(E_ALL);

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

second_menu();

flush();
ob_flush();

echo '<h3>Screening for examinations exceeding TAT from sample_id '.$_POST['from_sample_id'].' to '.$_POST['to_sample_id'].' .... wait till finished.</h3>';

echo '<table border=1>';
echo '<tr><td>sample_id</td><td>Series</td><td>Examination</td><td>turnaround time(Hours)</td></tr>';


$link=start_nchsls();

for ( $sample_id = $_POST['from_sample_id']; $sample_id <= $_POST['to_sample_id']; $sample_id ++) 
{

	// STEP 1: Find TAT for each parameter of the selected sample

	$sql_tt='select sample_receipt_time from sample where sample_id=\''.$sample_id.'\'';
	$sql='select id,name_of_examination,details from examination where sample_id=\''.$sample_id.'\' order by id';

	$result_tt=mysql_query($sql_tt,$link);
	$sample_r_t=mysql_fetch_assoc($result_tt);
	$sample_receipt_time=$sample_r_t['sample_receipt_time'];

	$result=mysql_query($sql,$link);
	
	while($ar=mysql_fetch_assoc($result))
	{
		if($ar['id']<1000)
		{
			$ex=explode('|',$ar['details']);
			$tt=get_time_difference($sample_receipt_time, $ex[0]);
			$tt_in_hours=ceil($tt['days']*24+$tt['hours']+($tt['minutes']/60));
			//echo $tt_in_hours;

		// STEP 2: Display exceeding TAT based on series

			// to select sample series e.g. to select '2' from 1206072001 for OPD samples.
			$series=number_format(($sample_id%10000)/1000,0);	
			//echo $series;


			if($series==0)		// for indoor (routine) samples
			{
				if($tt_in_hours > 6)
				{
				echo '<tr><td>'.$sample_id.'</td><td>Indoor</td><td>'.$ar['name_of_examination'].'</td><td>'.$tt_in_hours.'</td></tr>';
				}
	
			}

			elseif($series==1)		// for URGENT samples
			{
				if($tt_in_hours > 3)
				{
				echo '<tr><td>'.$sample_id.'</td><td>Urgent</td><td>'.$ar['name_of_examination'].'</td><td>'.$tt_in_hours.'</td></tr>';
				}
	
			}

			elseif($series==2)		// for OPD samples
			{
				if($tt_in_hours > 6)
				{
				echo '<tr><td>'.$sample_id.'</td><td>OPD</td><td>'.$ar['name_of_examination'].'</td><td>'.$tt_in_hours.'</td></tr>';
				}
	
			}

			elseif($series==5)		// for ABG samples (target TAT is 30 min, set here is 1 hour)
			{
				if($tt_in_hours > 1)
				{
				echo '<tr><td>'.$sample_id.'</td><td>ABG</td><td>'.$ar['name_of_examination'].'</td><td>'.$tt_in_hours.'</td></tr>';
				}
	
			}



		}
	
	}

flush();
ob_flush();

}


echo '<h2><font color=green><b>Finished</b></font></h2>';
echo '</table>';



?>
