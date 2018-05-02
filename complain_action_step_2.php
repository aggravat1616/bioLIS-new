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


print_feedback($_POST['feedback_id']);



function print_feedback($feedback_id)
{
$link=start_inventory();
$sql_feedback_data='select * from feedback_complain where feedback_id like \''.$feedback_id.'\' order by feedback_id';
//echo $sql_feedback_data;
$result_feedback_data=mysql_query($sql_feedback_data,$link);

if(!$result_feedback_data){echo mysql_error(); exit();}

while($feedback_array=mysql_fetch_assoc($result_feedback_data))
{


echo '
<table>
<tr><td style=\'font-size:150%\'><b>Feedback ID:</b></td><td style=\'font-size:150%\'>'.$feedback_array['feedback_id'].'</td></tr>
</table>

<table border=1 style="border-collapse:collapse;  margin-top:10px; margin-bottom:10px">
<tr>
<td>Name: <b><font color=green>'.$feedback_array['name'].'</font></b></td>
<td>Designation: <b><font color=green>'.$feedback_array['designation'].'</font></b></td>
<td>Department: <b><font color=green>'.$feedback_array['department'].'</font></b></td>
<td>e-mail: <b><font color=green>'.$feedback_array['e_mail'].'</font></b></td>
</tr>
</table>

<table border=0 style="border-collapse:collapse;">
<tr>
	<td valign=top>
		<table border=1 style="border-collapse:collapse">
		<tr><td>Quality (perceived accuracy) of test results</td><td><b><font color=red>'.$feedback_array['quality_results'].'</font></b></td></tr>
		<tr><td>Quality test reports</td><td><b><font color=red>'.$feedback_array['quality_reports'].'</font></b></td></tr>
		<tr><td>Delivery test reports</td><td><b><font color=red>'.$feedback_array['delivery_reports'].'</font></b></td></tr>
		<tr><td>Attitude of laboratory employees</td><td><b><font color=red>'.$feedback_array['attitude'].'</font></b></td></tr>
		<tr><td>Promptness of laboratory response</td><td><b><font color=red>'.$feedback_array['response_promptness'].'</font></b></td></tr>
		<tr><td>Response on urgent test</td><td><b><font color=red>'.$feedback_array['response_urgent'].'</font></b></td></tr>
		</table>
	</td>

	<td valign=top>
		<table>
		<tr><td>
			<table><tr><td><b>Feedback-complain: </b>'.$feedback_array['feedback_complain'].'</td></tr></table>
		</td></tr>
		<tr><td>
			<table><tr><td><b>Action taken: </b>'.$feedback_array['action'].'</td></tr></table>
		</td></tr>
		</table>
	</td>
</tr>
</table>
<br>
';
									
echo '</form>';				

}

}


second_menu();
?>
