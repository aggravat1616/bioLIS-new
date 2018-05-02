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
//make_sample_wise_worklist_get_id('write first and last sample_id of report','from_to_report_step_2.php');


	echo '<table  border=1>	
		<caption>Print report summary between two sample ID for file</caption><form method=post action=\'from_to_report_for_file_step_2.php\'>';
	
	echo '<tr>';
	echo '<td>Date</td>';
	echo '<td><input type=text name=date value=\''.strftime('%d-%m-%Y').'\' style=\'font-size:150%\' size=9></td>';	
	echo '</tr>';
	
	echo '<tr><td>Header</td><td>';
	make_array('select * from report_summary_header', 'header','Header');
	echo '</td></tr>';

	echo '<tr>';
	echo '<td>From sample_id</td>';
	echo '<td><input type=text name=from_sample_id value=\''.strftime('%y%m%d').'\' style=\'font-size:150%\' size=9></td>';	
	echo '</tr>';
	
	echo '<tr>';
	echo '<td>To sample_id</td>';
	echo '<td><input type=text name=to_sample_id value=\''.strftime('%y%m%d').'\' style=\'font-size:150%\' size=9></td>';	
	echo '</tr>';
	
	echo '<tr><td><input type=submit value=OK name=submit></td></tr>';
	echo '</form></table>';

	
second_menu();
?>
