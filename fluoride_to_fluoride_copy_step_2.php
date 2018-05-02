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


if(insert_sample($_POST['paste_sample_id']))
{
copy_update_sample_F($_POST['copy_sample_id'],$_POST['paste_sample_id']);
//insert_single_examination($_POST['paste_sample_id'],'1');
edit_sample($_POST['paste_sample_id'],'edit_request_step_3.php',' ');
}
else
{
echo '<br>sample id already exist<br>';
}



main_menu();
?>
