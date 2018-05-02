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

select_examination_for_worklist('make_examination_wise_worklist_step_2.php');
//make_sample_wise_worklist_get_id('write first and last sample_id of worklist','make_sample_wise_worklist_step_2.php');
//edit_sample($_POST['sample_id'],' ','disabled');
//select_delete_examination($_POST['sample_id'],'delete_examination_step_3.php',' ');

main_menu();
?>
