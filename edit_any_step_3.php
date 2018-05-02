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


function primary_key_array($table_name)
{
	$link=start_nchsls();
	//echo 'tnnn:'.$table_name;
	$sql_show_create='desc `'.$table_name.'`';
	//echo 'qqqqqqq:'.$sql_show;
	if(!$result_show_create=mysql_query($sql_show_create,$link))
	{
		echo 'show create::'.mysql_error();
        	return FALSE;
    	}

	while($array_show_create=mysql_fetch_assoc($result_show_create))
	{
		if($array_show_create['Key']=='PRI')
			{
			$primary_key_array[]=$array_show_create['Field'];	
			}

	}


		//echo '<pre>';
		//print_r($primary_key_array);
		//echo '</pre>';

	return $primary_key_array;
}



function update_all_raw($raw_array)
{

if(!isset($raw_array['submit']) ){return -1;}
if(isset($raw_array['submit']) && $raw_array['submit']!='update'){return -1;}


$link=start_nchsls();
$primary_key=primary_key_array($raw_array['table_name']);

	$sql_select='select * from `'.$raw_array['table_name'].'`';
//echo $sql_select;
	if(!$result_select=mysql_query($sql_select,$link))
	{
	        echo mysql_error();
	        return FALSE;
	}

while($array_select=mysql_fetch_assoc($result_select))
{

	$update_sql='update '.$raw_array['table_name'].' set ';

	foreach ($array_select as $key=>$value)
	{
	$update_sql=$update_sql.' `'.$key.'`=\''.$raw_array[$key.'_'.$array_select[$primary_key[0]]].'\' , ';
	}
	
	$update_sql=substr($update_sql,0,-2);
	$update_sql=$update_sql.' where `'.$primary_key[0].'`=\''.$array_select[$primary_key[0]].'\'';
	//echo '1111:'.$update_sql.'<br>';




if(! mysql_query($update_sql,$link))
    {
        echo mysql_error();

    }
}
}

if(!login_varify())
{
exit();
}
$link=start_nchsls();

update_all_raw($_POST);
$table_name=$_POST['table_name'];
//echo 'ggggg['.$table_name.']gggg';
$primary_key=primary_key_array($table_name);
$sql_all='select * from `'.$table_name.'`';
//echo $sql_all;
$result_all=mysql_query($sql_all,$link);

echo mysql_error();
echo '<table>';
echo '<form method=post action=edit_any_step_3.php>';
echo '<input type=hidden name=table_name value=\''.$table_name.'\'>';

while ($array_all=mysql_fetch_assoc($result_all))
{
	echo '<tr>';
	foreach($array_all as $key=>$value)
	{
			
		if($key==$primary_key[0])
		{
			echo '<td>';
			echo '<input type=text readonly name=\''.$key.'_'.$array_all[$primary_key[0]].'\' value=\''.$value.'\'>';
			echo '</td>';		
		}
		else
		{
			echo '<td>';
			echo '<input type=text name=\''.$key.'_'.$array_all[$primary_key[0]].'\' value=\''.$value.'\'>';
			echo '</td>';		
		}
			
	}
	echo '</tr>';
}
echo '<input type=submit name=submit value=update>';
echo '</form>';
echo '</table>';
main_menu();
?>
