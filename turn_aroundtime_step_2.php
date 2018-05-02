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

print_examination_wise_turnaround_time($_POST['from_sample_id'],$_POST['to_sample_id'],$_POST['selected_examination']);
echo '<h2 style="page-break-before: always;"></h2>';	
second_menu();
?>
