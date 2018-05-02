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

main_menu();

//read_sample_id('Please write sample_id for report in the box and click ok','single_report_step_2.php');
	echo '	<table style="border-collapse:collapse;  margin-top:20px">
		<th colspan=4><h2>Write 10 digit Sample ID in the box and press "OK" to view or print report</h2></th>
		</table>';
	echo '<table  border=1><form method=post   action=\'single_report_step_2_doctor.php\'>';
	echo '<tr>';
	echo '<td>sample_id</td>';
	echo '<td><input type=text name=sample_id style=\'font-size:150%\' size=9></td>';	
	echo '</tr>';
	
	echo '<tr><td><input type=submit value=OK name=submit></td></tr>';
	echo '</form></table>';


echo '	<table style="border-collapse:collapse;  margin-top:100px">
	<th colspan=4><h2><font color=green>sample_id numbering convention followed at the laboartory: </font>YYMMDDxxxx</h2></th>
	<tr><td>e.g. today,</td></tr>
	</table>
	<table border=1>
	<tr><td width=210 height=40>Indoor patient samples</td><td><b>'.strftime('%y%m%d').'<font color=green>0001</font></b> onwards</td></tr>
	<tr><td width=210 height=40>Urgent samples</td><td><b>'.strftime('%y%m%d').'<font color=green>1001</font></b> onwards</td></tr>
	<tr><td width=210 height=40>OPD samples</td><td><b>'.strftime('%y%m%d').'<font color=green>2001</font></b> onwards</td></tr>
	<tr><td width=210 height=40>Lipid profile samples</td><td><b>'.strftime('%y%m%d').'<font color=green>3001</font></b> onwards</td></tr>
	<tr><td width=210 height=40>Thyroid profile samples</td><td><b>'.strftime('%y%m%d').'<font color=green>4001</font></b> onwards</td></tr>
	<tr><td width=210 height=40>ABG samples</td><td><b>'.strftime('%y%m%d').'<font color=green>5001</font></b> onwards</td></tr>
    <tr><td width=210 height=40>ART samples</td><td><b>'.strftime('%y%m%d').'<font color=green>6001</font></b> onwards</td></tr>
    <tr><td width=210 height=40>Camp & other samples</td><td><b>'.strftime('%y%m%d').'<font color=green>7001</font></b> onwards</td></tr>
	</table>';

?>

