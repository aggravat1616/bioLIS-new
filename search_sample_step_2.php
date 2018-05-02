<?php
session_start();

echo '<html>';
echo '<head>';

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
main_menu();
echo '<h2 style="page-break-before: always;"></h2>';	
run_search_query($_POST);
?>
