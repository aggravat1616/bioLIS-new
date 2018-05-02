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

//echo $_POST['selected_examination'];

$link=start_nchsls();

$name='SELECT name_of_examination FROM scope WHERE `id`=\''.$_POST['selected_examination'].'\'';
$name_result=mysql_query($name,$link);
$name_array=mysql_fetch_assoc($name_result);
//echo $name_array['name_of_examination'];

$a='SELECT count(sample_id) FROM examination WHERE `id`=\''.$_POST['selected_examination'].'\' and `sample_id` between \''.$_POST['from_sample_id'].'\' and \''.$_POST['to_sample_id'].'\'';
//echo $a;
if(!$a1=mysql_query($a,$link)){echo mysql_error();}
$a2=mysql_fetch_assoc($a1);
//echo $a2['count(sample_id)'];


/////////////////////////////////////////////////////

if ($a2['count(sample_id)'] < 1)
{
	echo '<h3>0 (zero) results for '.$name_array['name_of_examination'].' from sample_id '.$_POST['from_sample_id'].' to '.$_POST['to_sample_id'].'</h3>';
}

else
{
	echo '<table border=1 style="border-collapse:collapse" CELLPADDING=2 CELLSPACING=0>';
	echo '<tr bgcolor=lightgrey><th colspan=10 style=\'font-size:130%\'>Summary of '.$name_array['name_of_examination'].' from sample_id '.$_POST['from_sample_id'].' to '.$_POST['to_sample_id'].'</th></tr>';
	echo '<tr bgcolor=lightyellow>';
	echo '
		<th>Sample_id</th>
		<th>Patient name</th>
		<th>MRD No.</th>
		<th>Clinican</th>
		<th>Unit</th>
		<th>Location</th>
		<th>Sample type</th>
		<th>Preservative</th>
	';

	if ($_POST['selected_examination']==1005)
	{
		echo '<th>Critical alert for</th>';
	}

	echo '<th>'.$name_array['name_of_examination'].'</th>';

	echo '</tr>';
	for ($sample_id=$_POST['from_sample_id'];$sample_id<$_POST['to_sample_id'];$sample_id++)
	{
		print_z($sample_id);
	}
	echo '</table>';

}

echo '<h2 style="page-break-before: always;"></h2>';

second_menu();


////////////////////////////////////////////////////////////


function print_z($sample_id)
{
	$link=start_nchsls();
	$sql='select 
						sample.sample_id,sample.patient_name,sample.patient_id,
						sample.sample_type,sample.preservative,sample.clinician,sample.unit,sample.location,
						examination.result
					from 
						sample,examination
					where 
						sample.sample_id=\''.$sample_id.'\' 
						and
						sample.sample_id=examination.sample_id
						and
						examination.id=\''.$_POST['selected_examination'].'\''
					;
	if(!$result=mysql_query($sql)){echo mysql_error();}
	while ($array=mysql_fetch_assoc($result))
	{
		echo '<tr>';

		echo '
			<td>'.$array['sample_id'].'</td>
			<td>'.$array['patient_name'].'</td>
			<td align=center>'.$array['patient_id'].'</td>
			<td align=center>'.$array['clinician'].'</td>
			<td align=center>'.$array['unit'].'</td>
			<td align=center>'.$array['location'].'</td>
			<td align=center>'.$array['sample_type'].'</td>
			<td align=center>'.$array['preservative'].'</td>
			';

		if ($_POST['selected_examination']==1005)
		{
			echo '<td>';
			av_for_z_display($sample_id);
			echo '</td>';
		}

		echo '<td>'.$array['result'].'</td>';
		echo '</tr>';
	}
}



///// modified function from autoverify.common.php

function av_for_z_display($sample_id)
{
	$link=start_nchsls();
	$sql_sample_examination='select 
						sample.sample_id,examination.code,examination.result,
						sample.sample_type,sample.clinician,sample.unit su,sample.location,
						examination.unit eu, critical_alert.operator, critical_alert.value
					from 
						sample,examination,critical_alert 
					where 
						sample.sample_id=\''.$sample_id.'\' 
						and
						sample.sample_id=examination.sample_id
						and
						examination.code=critical_alert.code
						and
						examination.sample_type=critical_alert.sample_type'
					;
	if(!$result_sample_examination=mysql_query($sql_sample_examination,$link)){echo mysql_error();}
	while ($array_sample_examination=mysql_fetch_assoc($result_sample_examination))
	{
		if(check_critical($array_sample_examination['value'],$array_sample_examination['operator'],$array_sample_examination['result'])=='Critical')
		{
			echo $array_sample_examination['code'];
			echo ':';
			echo ''.$array_sample_examination['result'].''.$array_sample_examination['eu'].' ';
		}
	}
}



?>
