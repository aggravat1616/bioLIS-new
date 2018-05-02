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

	echo '<table  border=1>	
		<caption>Search reports awaiting verification between two sample ID</caption><form method=post action=\'verify_report_signatory_step_2.php\'>';
	
	echo '<tr>';
	echo '<td>from sample_id</td>';
	echo '<td><input type=text name=from_sample_id value=\''.strftime('%y%m%d').'\' style=\'font-size:150%\' size=9></td>';	
	echo '</tr>';
	
	echo '<tr>';
	echo '<td>to sample_id</td>';
	echo '<td><input type=text name=to_sample_id value=\''.strftime('%y%m%d').'\' style=\'font-size:150%\' size=9></td>';	
	echo '</tr>';

	echo '<tr><td><input type=submit value=OK name=submit></td></tr>';
	echo '</form></table>';


if(isset($_POST['submit']) && isset($_POST['from_sample_id']) && isset($_POST['to_sample_id']))
{
	$link=start_nchsls();
	$sql = 'SELECT * FROM `sample_verification` WHERE sample_id between \''.$_POST['from_sample_id'].'\' and \''.$_POST['to_sample_id'].'\' AND `sign` = \'Verification_pending\' ';
	$result=mysql_query($sql,$link);
	
	if(mysql_num_rows($result=mysql_query($sql,$link))>0)
	{

		echo '<h3>The following reports between sample_id '.$_POST['from_sample_id'].' and '.$_POST['to_sample_id'].' await verification:</h3>';
		echo '<table border=1><tr><td align=center><b>Sample_id</b></td><td align=center><b>Verifying technician</b></td></tr>';
	
		while($post_array=mysql_fetch_assoc($result))
		{
				
			echo '<tr><td>'.$post_array['sample_id'].'</td><td>'.$post_array['technician'].'</td></tr>';

		}

	}

	else
	{
		echo '<h3>No reports awaiting for signatory verification between sample_id '.$_POST['from_sample_id'].' and '.$_POST['to_sample_id'].'.</h3>';
	}

	echo '</table>';
}

main_menu();


?>
