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

echo '<h1>select table to delete record from</h1>';
all_query('ied_d_step_2.php');

second_menu();


?>
