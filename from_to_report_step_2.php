<?php
session_start();

echo '<html>';
echo '<head>';
echo '<title>Clinical Chemistry, LSB</title>';
echo '<link rel="stylesheet" type="text/css" href="print.css" media="print" />';
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

echo '<div id="exclude1">';

main_menu();
echo '<h2 style="page-break-before: always;"></h2>';

echo '</div>';

echo '<div id="report">';
	
from_to_report_print($_POST['from_sample_id'],$_POST['to_sample_id']);

echo '</div>';

?>
