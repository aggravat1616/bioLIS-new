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

echo '<table border=3 style="border-collapse:collapse;  margin-top:20px; margin-bottom:20px" bgcolor=lightgrey>
	<tr><td height=30><h2>Fill the details in desired serach field(s), check the <font color=green><u><i>tick-box</u></i></font> of the respective field and press <font color=green><u><i>serach sample</u></i></font> button located at top left.</h2></td></tr>
	<tr><td><h2>To search the report by date enter date in <i><u>sample_receipt_time</i></u> in <i><u>DD-MM-YYYY</i></u> format e.g. today, '.strftime('%d-%m-%Y').'.</h2></td></tr>
</table>';

search_sample('search_sample_step_2_doctor.php');

echo '

<table border=0 style="border-collapse:collapse;  margin-top:20px; margin-bottom:20px" bgcolor=lightpink>
	<tr><td height=30><b><i><u>Note:</i></u></b>The search query finds first 20 matching reports, so it is advisable to use combination of serch fields to get quickly to the desired report.</td></tr>
	<tr><td> e.g. <b><i>"patient_name: Mahesh + clinician: Medicine + Unit: X"</b></i> will lead you to all the reports of the said patient since his admission or even the reports of all patients named "Mahesh" admitted in Medicine X unit. Wherereas <b><i>"patient_name: Mahesh + clinician: Medicine + Unit: X + sample_receipt_time: '.strftime('%d-%m-%Y').'"</i></b> or <b><i>"patient_name: Mahesh + patient_id: 179566 + sample_receipt_time: '.strftime('%d-%m-%Y').'"</i></b> will provide more specific results.</td></tr>
</table>
';


echo '
<html>
<p align=right><FONT COLOR="#004586"><FONT SIZE=4><b>This page has been visited 
<script language="Javascript" src="http://10.218.56.164/counter/graphcount.php?page=search_sample_step_1_doctor"><!--
//--></script>
 times
</b></font></font></p>
';


?>
