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


$link=start_nchsls();

$sql='select `name_of_examination`,`id` from scope where `id` > 1000 order by id';

//echo $sql;
$result=mysql_query($sql,$link);

echo '<h3>Select range of sample_id and a parameter</h3>';
	
echo '<form method=post action=\'view_z_step_2.php\'>';
echo '<table>';

	echo '<tr>';
	echo '<td>from sample_id</td>';
	echo '<td><input type=text name=from_sample_id value=\''.strftime('%y%m%d').'\' style=\'font-size:150%\' size=9></td>';
	echo '</tr>';
	
	echo '<tr>';
	echo '<td>to sample_id</td>';
	echo '<td><input type=text name=to_sample_id value=\''.strftime('%y%m%d').'\' style=\'font-size:150%\' size=9></td>';	
	echo '</tr>';

	echo '<table border=1><tr>';

while($ar=mysql_fetch_assoc($result))
{
	
	foreach ($ar as $key => $value)   //for every row in scope where id > 1000
	{
			if($key=='id')
			{
				echo '<td><input type=radio name=selected_examination value=\''.$value.'\'>'.$value.'</td>';
			}
			else
			{
				echo '<td>'.$value.'</td>';
			}
	}
	echo '</tr>';	
}

	echo '</table>';

echo'<tr><td><input type=submit value=submit name=submit></td></tr>';
echo '</table>';
echo '</form>';

second_menu();
?>
