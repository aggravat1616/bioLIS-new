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

read_sample_id('Please write sample_id in the box for deleting it entirely and click OK','delete_entire_request_step_2.php');

main_menu();
?>
