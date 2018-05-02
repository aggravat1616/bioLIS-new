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

function make_array_inventory($sql_str, $fld,$dfl)
{
//echo $sql_str;
$link=start_nchsls();

$result=mysql_query($sql_str,$link);
echo mysql_error(); 
while ($ops=mysql_fetch_assoc($result))
{
	$ar[]=$ops[$fld];
}
//echo $ar;
echo '<select  name='.$fld.'>';

		foreach ($ar as $key => $value)
		{
			if($value==$dfl)
			{
					echo '<option  selected > '.$value.' </option>';
			}
			else
			{
				echo '<option  > '.$value.' </option>';
			}
		}
	
		echo '</select>';

}


function list_tables()
{
$sql = 'show tables where Tables_in_biochemistry like \'record_%\'';

echo '<table border=1><th colspan=2>Select table to edit</th><form method=post action=\'edit_any_step_2.php\'>';
echo '<tr><td>';
make_array_inventory($sql,'Tables_in_biochemistry','');
echo '</td></tr>';

echo '<tr><td>';
echo '<input type=submit name=submit value=select_table>';
echo '</td></tr>';
echo '</form></table>';


}

if(!login_varify())
{
exit();
}
list_tables();
main_menu();
?>
