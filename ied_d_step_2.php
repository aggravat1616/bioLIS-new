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

include 'inventory_common.php';



if(!login_varify())
{
exit();
}


echo '<h1>select record to be deleted</h1>';
display_table($_POST['query_id'],'ied_d_step_3.php');
second_menu();


?>
