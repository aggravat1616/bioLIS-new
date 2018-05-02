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

edit_sample($_POST['sample_id'],' ','disabled');
input_result($_POST['sample_id'],' ' ,'disabled');

echo '<form method=post action=delete_entire_request_step_3.php>';
echo '<input type=hidden name=sample_id value=\''.$_POST['sample_id'].'\'>';
echo '<input type=submit value=delete_entirely name=delete_entirely>';	
echo '</form>';

main_menu();
?>
