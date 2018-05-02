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
//make_sample_wise_worklist_get_id('write first and last sample_id of report','from_to_report_step_2.php');


	echo '<table  border=1>	
		<caption>Print report between two sample ID</caption><form method=post action=\'from_to_report_step_2.php\'>';
	
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

	
main_menu();
?>
