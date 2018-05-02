<?php
session_start();

echo '<html>';
echo '<head>';
echo '<title>Clinical Chemistry, LSB</title>';

echo '<SCRIPT LANGUAGE="javascript">'; 
echo 'function testForEnter() ';
echo '{    ';
echo '	if (event.keyCode == 13) ';
echo '	{        ';
echo '		event.cancelBubble = true;';
echo '		event.returnValue = false;';
echo '         }';
echo '} ';
echo '</SCRIPT> ';

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

read_sample_id('NEW SAMPLE REQUEST: Please write next sample_id in the box and click OK','new_request_step_2.php');

	
main_menu();

echo '	<table style="border-collapse:collapse;  margin-top:10px">
	<th colspan=4><h2><font color=green>sample_id numbering convention: </font>YYMMDDxxxx</h2></th>
	</table>
	<table border=1>
	<tr><td width=210 height=40>Indoor patient samples</td><td><b>'.strftime('%y%m%d').'<font color=green>0001</font></b> onwards</td></tr>
	<tr><td width=210 height=40>Urgent samples</td><td><b>'.strftime('%y%m%d').'<font color=green>1001</font></b> onwards</td></tr>
	<tr><td width=210 height=40>OPD samples</td><td><b>'.strftime('%y%m%d').'<font color=green>2001</font></b> onwards</td></tr>
	<tr><td width=210 height=40>Lipid profile samples</td><td><b>'.strftime('%y%m%d').'<font color=green>3001</font></b> onwards</td></tr>
	<tr><td width=210 height=40>Thyroid profile samples</td><td><b>'.strftime('%y%m%d').'<font color=green>4001</font></b> onwards</td></tr>
	<tr><td width=210 height=40>ABG samples</td><td><b>'.strftime('%y%m%d').'<font color=green>5001</font></b> onwards</td></tr>
    <tr><td width=210 height=40>ART samples</td><td><b>'.strftime('%y%m%d').'<font color=green>6001</font></b> onwards</td></tr>
    <tr><td width=210 height=40>Camp & Other Samples</td><td><b>'.strftime('%y%m%d').'<font color=green>7001</font></b> onwards</td></tr>
	</table>';

include 'notice.html';

?>
