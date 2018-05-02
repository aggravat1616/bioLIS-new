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

//make_sample_wise_worklist_get_id('write first and last sample_id of worklist',$filename);
make_sample_wise_worklist_print($_POST['from_sample_id'],$_POST['to_sample_id']);
echo '<h2 style="page-break-before: always;"></h2>';	
main_menu();
?>
