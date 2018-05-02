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
echo '<h2 style="page-break-before: always;"></h2>';

if(print_sample_doctor($_POST['sample_id'],$_POST['Technician'],$_POST['Doctor']))
{
//print_examinations($_POST['sample_id']);
}




?>
