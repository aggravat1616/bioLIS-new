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
make_sample_wise_worklist_get_id('write first and last sample_id to generate worklist','make_sample_wise_worklist_step_2.php');

	
main_menu();
?>
