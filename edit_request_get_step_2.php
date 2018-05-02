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


function edit_sample_get($sample_id,$filename,$disabled)
{
$link=start_nchsls();
$sql='SHOW COLUMNS FROM sample';
$result=mysql_query($sql,$link);
$sql_sample_data='select * from sample where sample_id='.$sample_id;

if(mysql_num_rows($result_sample_data=mysql_query($sql_sample_data,$link))!=1){echo 'No such Sample';return FALSE;}
$sample_array=mysql_fetch_assoc($result_sample_data);

		
echo '<form method=get action=\''.$filename.'\'>';
echo '<table  border=1 bgcolor=lightyellow CELLPADDING=0 CELLSPACING=0>	
		<tr><td><input type=submit '.$disabled.' value=save_sample name=save_sample></td><th colspan=4>2. Sample Entry Form</th></tr>';
	  
	  $rcount=0;
	  $tr='<tr>';

while($ar=mysql_fetch_assoc($result))
{
	if($ar['Type']=='varchar(30)')
	{
		echo $tr.'<td>'.$ar['Field'].'</td><td>';
		mk_option($ar['Field'],$sample_array[$ar['Field']],$disabled);
		echo '</td>';
	}
	
	else if($ar['Type']=='bigint(12)')
	{	
	echo $tr.'<td>'.$ar['Field'].'</td><td><input type=text  readonly  value=\''.$sample_array[$ar['Field']].'\' name='.$ar['Field'].'></td>';
	}

	else
	{	
	echo $tr.'<td>'.$ar['Field'].'</td><td><input type=text  '.$disabled.' value=\''.$sample_array[$ar['Field']].'\' name='.$ar['Field'].'></td>';
	}
	
	$rcount++;
	if($rcount==4)
	{$tr='<tr>';$rcount=0;}
	else
	{$tr=' ';}

}
//echo '<tr><td><input type=submit '.$disabled.' value=save_sample name=save_sample></td></tr>';
echo '</form></table>';
return TRUE;
}


if(!login_varify())
{
exit();
}

edit_sample_get($_GET['sample_id'],'edit_request_get_step_3.php',' ');

main_menu();
?>
