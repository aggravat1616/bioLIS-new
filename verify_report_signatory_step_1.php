<?php
session_start();

echo '<html>';
echo '<head>';
echo '<title>Clinical Chemistry, LSB</title>';

// set time since inactivity to auto-logout in seconds below in content="600; --> 600 seconds i.e. 10 minutes
echo '<meta http-equiv="refresh" content="600;url=http://10.218.56.164/logout.php" />';

echo '<link rel="stylesheet" type="text/css" href="print.css" media="print" />';
echo '</head>';
echo '<body>';


//echo '<pre>';
//print_r($GLOBALS);
//echo '</pre>';

include 'common.php';
include 'delta_display.php';
include 'ABG_report.php';


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
		if($_POST['submit']=='Verify_&_Print')
		{
			$sample_id=$_POST['sample_id'];
		}
		
}

else
{
	$sample_id=strftime("%y%m%d");
}


echo '<table>';
echo '<tr>';
echo '<td valign=top>';



echo '<table id="exclude1">';
echo '<th colspan=6 align=center style=\'font-size:130%\'><font color=green>Verify report [Signatory]</font></th>';
echo '<form method=post action=\'verify_report_signatory_step_1.php\'>';
echo '<td><input type=hidden name=sample_id value=\''.$sample_id.'\'></td>';	
echo '<tr>';
echo '<td><input type=submit value=Go_to name=submit style="font-size:110%; margin-right:10px">';
echo '<input type=submit value=Previous name=submit style="font-size:110%; margin-right:10px">';
echo '<input type=submit value=Next name=submit style="font-size:110%; margin-right:10px">';
echo '<input type=submit value=Mark_as_verified name=submit style="font-size:110%; margin-right:10px">';
echo '<input type=submit value=Verify_&_Print name=submit style="font-size:110%; margin-right:10px"></td>';
echo '</tr>';
echo '<tr>';
echo '<td><input type=text name=sample_id value=\''.$sample_id.'\' style=\'font-size:150%\' size=9></td>';
echo '<tr>';
echo '<td><a href=verify_report_signatory_step_2.php style="margin-right:20px"><b><font color=blue>Search reports pending for verification by signatory</a>';
echo '<a href=verify_report_signatory_step_3.php><font color=blue>Search interim reports</font></b></a></td>';
echo '</tr>';
echo '</form>';
echo '</table>';


if(isset($_POST['submit']) && isset($_POST['sample_id']))
{

		$link=start_nchsls();
		$sql = 'SELECT sign, grade FROM `signature_authority` WHERE `login_name`=\''.$_SESSION['login'].'\'';
		$sql1= mysql_query($sql,$link);
		$sql2= mysql_fetch_assoc($sql1);
		//print_r($sql2);

		$r= 'select sign, technician, sign_time from sample_verification where sample_id=\''.$sample_id.'\'';
		$r1= mysql_query($r,$link);
		$r2= mysql_fetch_assoc($r1);
		//print_r($r2);

		$z= 'SELECT grade FROM `signature_authority` WHERE sign=\''.$r2['sign'].'\' ';		
		$z1= mysql_query($z,$link);
		$z2= mysql_fetch_assoc($z1);
		//print_r($z2);


	if($_POST['submit']=='Mark_as_verified')
	{

		if ($sql2['grade']<1)
		{	
			echo '<font color=red>Not allowed. This user is not authorised to use this function.</font>';
		}

		else
		{

			if($r2['technician']=='Verification_pending')
			{
				echo '<font color=red>Not allowed. Technician verification is pending.</font>';
			}
			
			else
			{
				if($r2['sign']=='Verification_pending')
				{
					if(! mysql_query('update sample_verification set sign=\''.$sql2['sign'].'\', sign_first=\''.$sql2['sign'].'\', sign_time=\''.strftime('%d-%m-%Y, %H:%M').'\', sign_time_last=\''.strftime('%d-%m-%Y, %H:%M').'\' where sample_id=\''.$sample_id.'\'',$link))
    					{
       		 				echo mysql_error();
    					}
					
				}	
				else if($sql2['grade']>$z2['grade'])
				{
					if(! mysql_query('update sample_verification set sign=\''.$sql2['sign'].'\', sign_time_last=\''.strftime('%d-%m-%Y, %H:%M').'\' where sample_id=\''.$sample_id.'\'',$link))
    					{
       		 				echo mysql_error();
    					}
				}	
				else 
				{
					echo '<font color=red>Not allowed. Already verified by equilevel/higher signatory.</font>';
				}

			}
		}
	}

// simultaneous verification & print starts ------------->
////look into 'LIS admin manual' for setting up the browser

	if($_POST['submit']=='Verify_&_Print')
	{

		if ($sql2['grade']<1)
		{	
			echo '<font color=red>Not allowed. This user is not authorised to use this function.</font>';
		}

		else
		{	

			if($r2['technician']=='Verification_pending')
			{
				echo '<font color=red>Not allowed. Technician verification is pending.</font>';
			}
			
			else
			{
				if($r2['sign']=='Verification_pending')
				{
					if(! mysql_query('update sample_verification set sign=\''.$sql2['sign'].'\', sign_first=\''.$sql2['sign'].'\', sign_time=\''.strftime('%d-%m-%Y, %H:%M').'\', sign_time_last=\''.strftime('%d-%m-%Y, %H:%M').'\' where sample_id=\''.$sample_id.'\'',$link))
    					{
       		 				echo mysql_error();
    					}

					echo '<script LANGUAGE="javascript">window.print();</script>';

				}	
				else if($sql2['grade']>$z2['grade'])
				{
					if(! mysql_query('update sample_verification set sign=\''.$sql2['sign'].'\', sign_time_last=\''.strftime('%d-%m-%Y, %H:%M').'\' where sample_id=\''.$sample_id.'\'',$link))
    					{
       		 				echo mysql_error();
    					}

					echo '<script LANGUAGE="javascript">window.print();</script>';
				}	
				else 
				{
					echo '<font color=red>Not allowed. Already verified by equilevel/higher signatory.</font>';
				}

			}
		}
	}

// <------ simultaneous verification & print ends

}



$a= 'select sample_type from sample where sample_id=\''.$sample_id.'\'';
$a1= mysql_query($a,$link);
$a2= mysql_fetch_assoc($a1);
//print_r($a2);

	if(mysql_num_rows($a1=mysql_query($a,$link))<1)
	{
		echo '<h3 id="exclude1">No such sample.</h3>';
	}

echo '<table width="750" id="report"><tr><td>';		// printed portion starts (report included in print)

	if ($a2['sample_type']=='Blood(Arterial)')
	{
	print_ABG($sample_id);
	}
	else
	{
	print_sample($sample_id);
	}

echo '</td></tr></table>';				// printed portion ends

	// Signatory details starts

	$b= 'select * from sample_verification where sample_id=\''.$sample_id.'\'';
	$b1= mysql_query($b,$link);
	$b2= mysql_fetch_assoc($b1);
	//print_r($b2);

	if(mysql_num_rows($b1=mysql_query($b,$link))>0)
	{
	echo '<table border=1 style="border-collapse:collapse; margin-top:20px; font-size:15" id="exclude1">';
	echo '<th colspan=2 bgcolor=lightgreen>Signatory details for sample_id '.$sample_id.'</th>';
	echo '<tr><td>First signatory: '.$b2['sign_first'].'</td><td>Sign time: '.$b2['sign_time'].'</td></tr>';
	echo '<tr><td>Last signatory: '.$b2['sign'].'</td><td>Sign time: '.$b2['sign_time_last'].'</td></tr>';
	echo '</table>';
	}

	// Signatory details ends


echo '<td valign=top>';


	if(!$all_details=get_all_details_of_a_sample_display($sample_id)){echo mysql_error();}
	//echo '<pre>';
	//print_r($all_details);
	//echo '</pre>';
	//echo $all_details[0]['patient_id'];

	if(mysql_num_rows($a1=mysql_query($a,$link))>0)
	{
		echo '<table border=1 style="border-collapse:collapse; margin-top:25px; font-size:14" id="exclude1">';
		echo'<tr><th colspan=10 bgcolor=lightgreen style=\'font-size:120%\'>DELTA REPORT of patient_id "'.$all_details[0]['patient_id'].'"</th></tr>';
		echo '<th>Sr.</th><th>Sample ID</th><th>Sample receipt time</th><th>Name</th><th>Details</th><th>Result</th>';

	}


	foreach ($all_details  as $key=>$value)
	{
		echo '<tr><td colspan=6><font color=brown><b>'.$value['name_of_examination'].'</b></font></td></tr>';
		
		print_r(get_chronology_of_an_examination_display($value['name_of_examination'],$value['sample_id']));
		
	}

	if(mysql_num_rows($a1=mysql_query($a,$link))>0)
	{
	echo '<tr><td colspan=6>NR= Not requested; ND= Not done</td></tr>';
	echo '</table>';
	}

echo '</td>';
echo '</tr>';
echo '</table>';

echo '<div id="exclude1">';	// menu excluded from printing

main_menu();

echo '</div>';

?>
