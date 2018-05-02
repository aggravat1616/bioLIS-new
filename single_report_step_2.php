<?php

session_start();

echo '<html>';
echo '<head>';
echo '<title>Clinical Chemistry, LSB</title>';
echo '<link rel="stylesheet" type="text/css" href="print.css" media="print" />';
echo '</head>';
echo '<body>';


//echo '<pre>';
//print_r($GLOBALS);
//echo '</pre>';


include 'common.php';
include 'ABG_report.php';

if(!login_varify())
{
exit();
}

echo '<div id="report">';

$link=start_nchsls();
$a= 'select sample_type from sample where sample_id=\''.$_POST['sample_id'].'\'';
$a1= mysql_query($a,$link);
$a2= mysql_fetch_assoc($a1);
//print_r($a2);


if ($a2['sample_type']=='Blood(Arterial)')
{
print_ABG($_POST['sample_id']);
}
else
{
print_sample($_POST['sample_id']);
}

/*
if(print_sample($_POST['sample_id'],$_POST['Technician'],$_POST['Doctor']))
{
//print_examinations($_POST['sample_id']);
}
*/
echo '</div>';

echo '<div id="exclude1">';

echo '<h2 style="page-break-before: always;"></h2>';
main_menu();

echo '</div>';
?>
