<?php
session_start();



//echo '<pre>';
//print_r($GLOBALS);
//echo '</pre>';

include 'common.php';


if(!login_varify())
{
exit();
}
echo '<H1>Import Results from Erba XL-640 file</H1>';
echo '<form method=post action=import_XL_results_step_2.php enctype="multipart/form-data">';
echo 'FileName:<input type=file name=import_file >';
echo '<br><input type=submit>';
echo '</form>';
	
main_menu();
?>
