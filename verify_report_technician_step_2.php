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

if(isset($_POST['submit']) && isset($_POST['sample_id']))
{
		if($_POST['submit']=='Next')
		{
			$sample_id=$_POST['sample_id']+1;
		}
		if($_POST['submit']=='Go_to')
		{
			$sample_id=$_POST['sample_id'];
		}
		if($_POST['submit']=='Previous')
		{
			$sample_id=$_POST['sample_id']-1;
		}
		if($_POST['submit']=='Mark_as_verified')
		{
			$sample_id=$_POST['sample_id'];
		}
		
}

else
{
	$sample_id=strftime("%y%m%d");
}

echo '<table>';
echo '<th colspan=10 align=center style=\'font-size:130%\'><font color=green>Verify report [Technician]</font></th>';
echo '<form method=post action=\'verify_report_technician_step_2.php\'>';
echo '<td><input type=hidden name=sample_id value=\''.$sample_id.'\'></td>';	
echo '<tr>';
echo '<td><input type=submit value=Go_to name=submit style=\'font-size:110%\'></td>';
echo '<td><input type=submit value=Previous name=submit style=\'font-size:110%\'></td>';
echo '<td><input type=submit value=Next name=submit style=\'font-size:110%\'></td>';
echo '<td><input type=submit value=Mark_as_verified name=submit style=\'font-size:110%\'></td>';
echo '<td style=\'font-size:110%\'>You are: </td>';
echo '<td><input type=text  readonly  value=\''.$_POST['Technician'].'\' name=Technician style=\'font-size:110%\'></td>';
echo '</tr>';
echo '<tr><td colspan=3><input type=text name=sample_id value=\''.$sample_id.'\'  style=\'font-size:150%\' size=9></td></tr>';	
echo '</form>';
echo '</table>';


if(isset($_POST['submit']) && isset($_POST['sample_id']))
{
		if($_POST['submit']=='Mark_as_verified')
		{
		$link=start_nchsls();
		$r='select technician from sample_verification where sample_id=\''.$sample_id.'\'';
		$r1=mysql_query($r,$link);
		$r2=mysql_fetch_assoc($r1);
		//print_r($r2);

		if($r2['technician']=='Verification_pending')
			{
		
			if(! mysql_query('update sample_verification set technician=\''.$_POST['Technician'].'\' where sample_id=\''.$sample_id.'\'',$link))
    				{

       		 		echo mysql_error();
       		
    				}	
			}	else	{echo '<font color=red>Not allowed. Already verified by '.$r2['technician'].'.</font>';}
		}
}

echo '<h2 style="page-break-before: always;"></h2>';

print_sample($sample_id);

echo '<h2 style="page-break-before: always;"></h2>';


main_menu();
?>
