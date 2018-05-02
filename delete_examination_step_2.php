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
select_delete_examination($_POST['sample_id'],'delete_examination_step_3.php',' ');

main_menu();
?>
