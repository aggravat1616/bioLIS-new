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

$xx=mysql_select_db('inventory');
/*
if($xx==FALSE)
{
echo'fail to connect<br>';
}
else
{
echo'success database<br>';
}

*/

$ip=$_SERVER['REMOTE_ADDR'];

$r=mysql_query("insert into feedback_complain (feedback_id,name,designation,department,e_mail,quality_results,quality_reports,delivery_reports,attitude,response_promptness,response_urgent,satisfaction_ccl,satisfaction_tccl,feedback_complain,ip) values ('$_POST[feedback_id]','$_POST[name]','$_POST[designation]','$_POST[department]','$_POST[e_mail]','$_POST[quality_results]','$_POST[quality_reports]','$_POST[delivery_reports]','$_POST[attitude]','$_POST[response_promptness]','$_POST[response_urgent]','$_POST[satisfaction_ccl]','$_POST[satisfaction_tccl]','$_POST[feedback_complain]','$ip')");
//print_r($r);
echo mysql_error();


if($r==TRUE)
{echo'<h2><font color=green><i>Feedback-complain posted successfully.</i></font></h2>';}




?>
