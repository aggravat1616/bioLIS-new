<?php
session_start();

//echo '<pre>';
//print_r($GLOBALS);
//echo '</pre>';

include 'common.php';

if(!login_varify())
{
exit();
}
$link=start_nchsls();

date_default_timezone_set('Asia/Kolkata');
$default_five=strftime('5%y%m%');
$default_eight=strftime('8%y%m%');


echo '<form method=post action=draw_text_lj_xl.php>';
	echo '<table border=1 cellpadding="0"><th><h1>LJ Chart for Erba XL-640</h1></th>';
	echo '<tr>';
		echo '<td>';
		echo '<table border=1><tr>';
		echo '<tr><td colspan=2><h5>Give QC data for left side display</h5></td></tr>';
		echo '<tr><td>qc_id:</td><td><input type=text name=qc_id value=\''.$default_five.'\'></td></tr>';
		echo '<tr><td>repeat:</td> <td><input type=text name=rpt value=\'%\'></td></tr>';
		echo '<tr><td>Select examination code</td><td>';
		make_array_with_persantage('select distinct ex_code from qc_target_xl', 'ex_code','ex_code');
		echo '</td></tr></table>';
		echo '</td>';

		echo '<td>';
		echo '<table border=1><tr>';
		echo '<tr><td colspan=2><h5>Give QC data for right side display</h5></td></tr>';
		echo '<tr><td>qc_id:</td><td><input type=text name=qc_id_2  value=\''.$default_eight.'\'></td></tr>';
		echo '<tr><td>repeat:</td> <td><input type=text name=rpt_2 value=\'%\'></td></tr>';
		echo '<tr><td>Select examination code</td><td>';
		make_array_with_persantage('select distinct ex_code from qc_target_xl', 'ex_code','ex_code_2');
		echo '</td></tr></table>';
		echo '</td>';
		echo '<td>';
		echo '<pre>
Help Example:
	to see LJ chart for Albumin QC-5 and QC-8 of March 2011 enter following
						(Left)		(Right)
		qc_id:				51103%		81103%
		repeat:				%		%
		select examination code:	ALB		ALB
	and click OK
			</pre>';
		echo '</td>';
		
	echo '</tr>';
	echo '<tr>';
		echo '<td colspan=4><input type=submit value=OK name=submit></td>';
	echo '</tr>';
	echo '</table>';
	
echo '</form>';
///////////////////////////////////////////////////////////

echo '<table border=1 cellpadding="0">';
echo '<tr valign=top>';
echo '<td>';

if (isset($_POST['qc_id'],$_POST['rpt'],$_POST['ex_code']))
{
echo '<table border=0  cellspacing=0 cellpadding="0" valign=top> <th colspan=12>Erba XL-640 Internal QC qc_id='.$_POST['qc_id'].' repeat='.$_POST['rpt'].' ex_code='.$_POST['ex_code'].'</th>';
echo '<tr><td><tt>
|-4_______|-3_______|-2_______|-1_______|0_______1|________2|________3|________4|
</tt></td></tr>
';
draw_qc_x_xl($_POST['qc_id'],$_POST['rpt'],$_POST['ex_code']);
echo '</table>';
}

echo '</td><td>';

if (isset($_POST['qc_id_2'],$_POST['rpt_2'],$_POST['ex_code_2']))
{
echo '<table border=0 cellspacing=0 cellpadding="0"> <th colspan=12>Erba XL-640 Internal QC qc_id='.$_POST['qc_id_2'].' repeat='.$_POST['rpt_2'].' ex_code='.$_POST['ex_code_2'].'</th>';
echo '<tr><td><tt>
|-4_______|-3_______|-2_______|-1_______|0_______1|________2|________3|________4|
</tt></td></tr>
';
draw_qc_x_xl($_POST['qc_id_2'],$_POST['rpt_2'],$_POST['ex_code_2']);
echo '</table>';
}

echo '</td></tr>';
echo '</table>';

echo '<h2 style="page-break-before: always;"></h2>';	
main_menu();

?>
