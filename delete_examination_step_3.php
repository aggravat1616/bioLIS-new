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

///////////////////////////////////////////////


function find_time_since_sign($sample_id)
{
$link=start_nchsls();

$x_tt='select sign_time_last from sample_verification where sample_id=\''.$_POST['sample_id'].'\'';
//echo $x_tt;
$sign_tt=mysql_query($x_tt,$link);
$sample_sign_t=mysql_fetch_assoc($sign_tt);
$sample_sign_time=$sample_sign_t['sign_time_last'];

$current_time=strftime('%d-%m-%Y, %H:%M');

$tt=get_time_difference($sample_sign_time, $current_time);

return $tt_in_hours=ceil($tt['days']*24+$tt['hours']+($tt['minutes']/60));

}


$tm_diff=find_time_since_sign($sample_id);
//echo $tm_diff;

////////////////////////////////////////////////



$link=start_nchsls();
$r='select sign from sample_verification where sample_id=\''.$_POST['sample_id'].'\'';
$r1=mysql_query($r,$link);
$r2=mysql_fetch_assoc($r1);
//print_r($r2);

$sql = 'SELECT sign FROM `signature_authority` WHERE `login_name`=\''.$_SESSION['login'].'\'';
$sql1= mysql_query($sql,$link);
$sql2= mysql_fetch_assoc($sql1);
//print_r($sql2);


if($r2['sign']=='Verification_pending')
	{
	delete_examination($_POST);
	edit_sample($_POST['sample_id'],' ','disabled');
	select_delete_examination($_POST['sample_id'],'delete_examination_step_3.php',' ');
	}	

else if($r2['sign']==$sql2['sign'])
	{

	if($tm_diff < 3)	// set desired time in hours here, by which an examination can be deleted by the signing person
		{
		delete_examination($_POST);
		edit_sample($_POST['sample_id'],' ','disabled');
		select_delete_examination($_POST['sample_id'],'delete_examination_step_3.php',' ');
		}
	else
		{
		echo '<tr><td><font color=red>Not allowed. Sample has been verified by you '.$tm_diff.' hours before.</font></td></tr>';
		}
	}

else
	{
	echo '<tr><td><font color=red>Not allowed. Sample has been verified by '.$r2['sign'].'.</font></td></tr>';
	}


main_menu();
?>
