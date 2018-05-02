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


$link=start_nchsls();
$r='select sign from sample_verification where sample_id=\''.$_POST['sample_id'].'\'';
$r1=mysql_query($r,$link);
$r2=mysql_fetch_assoc($r1);
//print_r($r2);

if($r2['sign']=='Verification_pending')
	{
	delete_request($_POST['sample_id']);
	delete_request_verification($_POST['sample_id']);
	}	
	else	{echo '<tr><td><font color=red>Not allowed. Sample has been verified by '.$r2['sign'].'.</font></td></tr>';}


main_menu();


function delete_request_verification($sample_id)
{
$link=start_nchsls();
$ex='delete from sample_verification where sample_id=\''.$sample_id.'\'';
if(!mysql_query($ex,$link)){echo mysql_error();}
else
	{
	echo '<h3>Success. Now sample_id='.$sample_id.' is not present in verification database.</h3>';
	}
}


?>
