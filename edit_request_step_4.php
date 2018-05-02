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

insert_examination($_POST);
edit_sample($_POST['sample_id'],'edit_request_step_3.php','disabled');
input_result($_POST['sample_id'],'edit_request_step_5.php' ,' ');
main_menu();
select_profile($_POST['sample_id'],'edit_profile_step_1.php',' ');
select_examination_for_insert($_POST['sample_id'],'edit_request_step_4.php',' ');
//print_sample($_POST['sample_id']);
//print_examinations($_POST['sample_id']);

?>
