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
update_raw($_POST);
echo '<h1>Edit-update /re-edit-update/select raw to update </h1>';
edit_data($_POST,'ied_step_3.php');
display_table($_POST['query_id'],'ied_step_3.php');

second_menu();
?>
