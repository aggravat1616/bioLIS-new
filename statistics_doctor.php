<?php
session_start();

echo '<html>';
echo '<head>';
echo '<title>Clinical Chemistry, LSB</title>';

// set time since inactivity to auto-logout in seconds below in content="600; --> 600 seconds i.e. 10 minutes
//echo '<meta http-equiv="refresh" content="600;url=http://127.0.0.1/logout.php" />';

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

main_menu();

echo '<h3>View mothly summary</h3>';
echo '<table><form method=post action=\'statistics_step_7.php\'>';
echo '<tr>';
echo '<td>Write "yymm"</td>';
echo '<td><input type=text name=yymm style=\'font-size:150%\' size=3></td>';	
echo '<td><input type=submit value=OK name=submit></td></tr>';
echo '</form></table>';

/*
echo '<h3>Calculate mothly sample statistics</h3>';
echo '<table><form method=post action=\'statistics_step_2.php\'>';
echo '<tr>';
echo '<td>Write "yymm"</td>';
echo '<td><input type=text name=yymm style=\'font-size:150%\' size=3></td>';	
echo '<td><input type=submit value=OK name=submit></td></tr>';
echo '</form></table>';


echo '<h3>Calculate monthly test statistics</h3>';
echo '<table><form method=post action=\'statistics_step_4.php\'>';
echo '<tr>';
echo '<td>Write "yymm"</td>';
echo '<td><input type=text name=yymm style=\'font-size:150%\' size=3></td>';	
echo '<td><input type=submit value=OK name=submit></td></tr>';
echo '</form></table>';


echo '<h3>Calculate monthly detailed test statistics</h3>';
echo '<table><form method=post action=\'statistics_step_3.php\'>';
echo '<tr>';
echo '<td>Write "yymm"</td>';
echo '<td><input type=text name=yymm style=\'font-size:150%\' size=3></td>';	
echo '<td><input type=submit value=OK name=submit></td></tr>';
echo '</form></table>';


echo '<h3>Calculate signatory statistics & interim/final statistics</h3>';
echo '<table><form method=post action=\'statistics_step_5.php\'>';
echo '<tr>';
echo '<td>Write "yymm"</td>';
echo '<td><input type=text name=yymm style=\'font-size:150%\' size=3></td>';	
echo '<td><input type=submit value=OK name=submit></td></tr>';
echo '</form></table>';
*/

echo '<h3>View annual statistics</h3>';
echo '<table><form method=post action=\'statistics_step_6.php\'>';
echo '<tr>';
echo '<td>Write "yy"</td>';
echo '<td><input type=text name=yy style=\'font-size:150%\' size=1></td>';	
echo '<td><input type=submit value=OK name=submit></td></tr>';
echo '</form></table>';

?>
