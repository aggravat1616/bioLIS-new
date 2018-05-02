<?php
session_start();

echo '<html>';
echo '<head>';

echo '</head>';
echo '<body>';


//echo '<pre>Problems:';
//print_r($GLOBALS);
//echo '</pre>';

include 'common.php';


if(!login_varify())
{
exit();
}

main_menu();
//echo '<h2 style="page-break-before: always;"></h2>';	
//from_to_report_print($_POST['from_sample_id'],$_POST['to_sample_id']);
from_to_report_problem_print($_POST['from_sample_id'],$_POST['to_sample_id']);

?>
