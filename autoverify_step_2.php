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

include 'common.php';


if(!login_varify())
{
exit();
}



if(isset($_POST['sample_id']))
{
edit_sample($_POST['sample_id'],'edit_request_step_3.php',' ');
}

else
{
	echo '<table border=1>';
	for ($i=$_POST['from_sample_id'];$i<$_POST['to_sample_id'];$i++)
	{
		av($i);
	}
	echo '</table>';
}
main_menu();


?>
