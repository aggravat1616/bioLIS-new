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

update_result($_POST);
if(isset($_POST['sample_id']))
{
edit_sample($_POST['sample_id'],' ','disabled');
input_result($_POST['sample_id'],'edit_request_step_5.php' ,'disabled');
}
else
{
	echo '<br>no $_POST[sample id] obtained';
}
main_menu();
?>
