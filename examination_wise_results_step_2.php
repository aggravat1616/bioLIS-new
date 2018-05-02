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
enter_examination_wise_result($_POST['from_sample_id'],$_POST['to_sample_id'],$_POST['selected_examination'],'examination_wise_results_step_3.php');

main_menu();
?>
