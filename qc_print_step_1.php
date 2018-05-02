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

echo '<h1>Write QC ID to print LJ</h1>';

echo '<table border=1>';
echo '<tr>';
echo '<td valign=top >';
echo '<table>	
		<caption><b>Miura-300 & Electrolyte Analyzer</b></caption><form method=post action="qc_print_step_2.php" target="_blank">';
	echo '<tr>';
		echo '<td>qc_id [Format=XYYMM%] </td>';
		echo '<td><input type=text name=qc_id style=\'font-size:150%\' size=5> e.g. 5'.strftime('%y%m%').'</td>';	
	echo '</tr>';
	echo '<tr>';	
		echo '<td>ex_code</td>';
		echo '<td>';
		make_array("select distinct ex_code from qc_target", "ex_code","ex_code");
		echo '</td>';
	echo '</tr>';
	echo '<tr><td><input type=submit value=OK name=submit ></td></tr>';
	echo '</form></table>';

echo '</td>';
echo '<td valign=top>';

echo '<table>	
		<caption><b>EC 5 Plus V2 & Electrolyte Analyzer</b></caption><form method=post action="qc_print_step_2_other.php" target="_blank">';
	echo '<tr>';
		echo '<td>qc_id [Format=XYYMM%] </td>';
		echo '<td><input type=text name=qc_id style=\'font-size:150%\' size=5> e.g. 5'.strftime('%y%m%').'</td>';	
	echo '</tr>';
	echo '<tr>';	
		echo '<td>ex_code</td>';
		echo '<td>';
		make_array("select distinct ex_code from qc_target", "ex_code","ex_code");
		echo '</td>';
	echo '</tr>';
	echo '<tr><td><input type=submit value=OK name=submit></td></tr>';
	echo '</form></table>';

echo '</td>';
echo '</tr>';
echo '</table>';

second_menu();
?>
