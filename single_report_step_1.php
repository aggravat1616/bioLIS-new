<?php
session_start();

echo '<html>';
echo '<head>';
echo '<title>Clinical Chemistry, LSB</title>';
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

//read_sample_id('Please write sample_id for report in the box and click ok','single_report_step_2.php');
	echo '<table  border=1><caption>Write Sample ID to print report </caption><form method=post   action=\'single_report_step_2.php\'>';
	echo '<tr>';
	echo '<td>sample_id</td>';
	echo '<td><input type=text name=sample_id value=\''.strftime('%y%m%d').'\' style=\'font-size:150%\' size=9></td>';	
	echo '</tr>';
		
	echo '<tr><td><input type=submit value=OK name=submit></td></tr>';
	echo '</form></table>';



main_menu();
?>
