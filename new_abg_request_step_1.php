<?php
session_start();

echo '<html>';
echo '<head>';
echo '<title>Clinical Chemistry, LSB</title>';

echo '<SCRIPT LANGUAGE="javascript">'; 
echo 'function testForEnter() ';
echo '{    ';
echo '	if (event.keyCode == 13) ';
echo '	{        ';
echo '		event.cancelBubble = true;';
echo '		event.returnValue = false;';
echo '         }';
echo '} ';
echo '</SCRIPT> ';

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

read_sample_id('NEW ABG REQUEST: Please write next ABG id in the box and click OK','new_abg_request_step_2.php');

	
main_menu();


?>
