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

read_sample_id_copy('Please write sample_ids in the boxes and click ok','serum_to_fluoride_copy_step_2.php');
main_menu();
?>
