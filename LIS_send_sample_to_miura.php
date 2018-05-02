<?php
session_start();

echo '<html>';
echo '<head>';

echo '</head>';
echo '<body>';


//echo '<pre>';
//print_r($GLOBALS);
//echo '</pre>';

include 'LIS_common.php';


if(!login_varify())
{
exit();
}


if(isset($_POST['submit']) && isset($_POST['sample_id']))
{
		if($_POST['submit']=='next')
		{
			$sample_id=$_POST['sample_id']+1;
		}
		if($_POST['submit']=='prev')
		{
			$sample_id=$_POST['sample_id']-1;
		}
		if($_POST['submit']=='go_to')
		{
			$sample_id=$_POST['sample_id'];
		}
		if($_POST['submit']=='send_to_miura')
		{
			$sample_id=$_POST['sample_id'];
			//send_whole_sample_to_LIS($sample_id);
		}
}

else
{
	$sample_id=strftime("%y%m%d");
}
echo '<table border=1>';
echo '<tr>';
echo '<td>';
echo '<table border=1>';
echo '<th colspan=4><font color=green>Send Sample to miura worklist</font></th>';
echo '<form method=post action=\'LIS_send_sample_to_miura.php\'>';
echo '<td><input type=hidden name=sample_id value=\''.$sample_id.'\'></td>';	
echo '<tr>';
echo '<td><input type=submit value=go_to name=submit ></td>';
echo '<td><input type=submit value=prev name=submit ></td>';
echo '<td><input type=submit value=next name=submit ></td>';
echo '<td><input type=submit value=send_to_miura name=submit ></td></tr>';
echo '<tr><td colspan=4><input type=text name=sample_id value=\''.$sample_id.'\'  style=\'font-size:150%\' size=9></td></tr>';	
echo '</form>';
echo '</table>';
echo '</td>';
echo '</tr>';

echo '<tr>';
echo '<td valign=top>';
make_sample_wise_worklist_print_single($sample_id);
echo '</td>';
echo '<td>';
//send_whole_sample_to_LIS($sample_id);

if(isset($_POST['submit']) && isset($_POST['sample_id']))
{
		if($_POST['submit']=='send_to_miura')
		{
			//$sample_id=$_POST['sample_id'];
			send_whole_sample_to_LIS($sample_id);
		}
}
echo '</td>';
echo '</tr>';
echo '</table>';
echo '<tr>';
echo '</tr></table>';
main_menu();
?>
