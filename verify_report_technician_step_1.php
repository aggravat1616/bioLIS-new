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


	echo '<table>
		<th colspan=10 align=center style=\'font-size:130%\'><font color=green>Verify report [Technician]</font></th>	
		<form method=post action=\'verify_report_technician_step_2.php\'>';
	
	echo '<tr><td style=\'font-size:110%\'>You are: </td>';
	echo '<td style=\'font-size:110%\'>';
	make_array('select * from signature_t', 'id','Technician');
	echo '</td>';
	echo '<td><input type=submit value=Proceed name=submit></td></tr>';
	echo '</form></table>';


main_menu();
?>
