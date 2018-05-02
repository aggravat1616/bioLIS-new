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

$link=start_inventory();

echo '<h1>Fill data to be inserted</h1>';
insert_raw($_POST['query_id'],$_POST);
get_data($_POST['query_id'],'ied_i_step_3.php');
display_table($_POST['query_id'],'ied_i_step_3.php');
second_menu();
?>
