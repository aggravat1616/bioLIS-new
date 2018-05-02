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


include 'inventory_common.php';

if(!login_varify())
{
exit();
}

//read_feedback_id('Write feedback-complain ID to view and take action','complain_action_step_2.php');
	echo '<table  border=1><caption>Write feedback-complain ID to view and take action</caption><form method=post action=\'complain_action_step_2.php\'>';
	echo '<tr>';
	echo '<td>feedback_id</td>';
	echo '<td><input type=text name=feedback_id ></td>';	
	echo '</tr>';
	
	echo '<tr><td><input type=submit value=OK name=submit></td></tr>';
	echo '</form></table>';


//print_feedback($_POST['feedback_id']);


second_menu();
?>
