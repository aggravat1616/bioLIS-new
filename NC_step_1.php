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
display_table(17,'');

second_menu();
?>
