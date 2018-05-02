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

make_sample_wise_worklist_get_id('<h1>write first and last sample_id of report to be autoverified for Critical Value reporting</h1>','autoverify_step_2.php');

	
main_menu();
?>
