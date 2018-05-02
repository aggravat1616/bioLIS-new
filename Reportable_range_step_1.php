<?php
$link=mysql_connect('127.0.0.1','root','lipoprotein');

$xx=mysql_select_db('biochemistry',$link);

session_start();
include 'common.php';






function rr($sample_id,$linkkk)
{
	
	$sql_sample_examination='select 
						sample.sample_id,examination.code,examination.result,
						sample.sample_type,sample.clinician,sample.unit su,sample.location,
						examination.unit eu, Reportable_range.operator, Reportable_range.value
					from 
						sample,examination,Reportable_range 
					where 
						sample.sample_id=\''.$sample_id.'\' 
						and
						sample.sample_id=examination.sample_id
						and
						examination.code=Reportable_range.code
						and
						examination.sample_type=Reportable_range.sample_type'
					;
	if(!$result_sample_examination=mysql_query($sql_sample_examination,$linkkk)){echo mysql_error();}
	while ($array_sample_examination=mysql_fetch_assoc($result_sample_examination))
	{
		if(check_Reportable_range($array_sample_examination['value'],$array_sample_examination['operator'],$array_sample_examination['result'])=='out_of_reportable_range')
		{
		make_form5($array_sample_examination,'out_of_reportable_range');
		}
	}
}



function check_Reportable_range($c_value,$c_operator,$result)
{
if($result!='0' && (float)$result==0)
	{
		return FALSE;
	}

if ($c_operator=='less_than')
	{
	if((float)$result<$c_value)
		{
				return 'out_of_reportable_range';
		}	
	}
if ($c_operator=='more_than')
	{
	if((float)$result>$c_value)
		{
			return 'out_of_reportable_range';
		}	
	}


return 'within_reportable_range';
}



function make_form5($array_sample_examination,$av_report)
{
echo '<form method=post action=Reportable_range_step_1.php  target="_blank">';
echo '<table border=1>';
echo '<tr><td>';
echo 'sample_id:<input readonly type=text name=sample_id value=\''.$array_sample_examination['sample_id'].'\'>';
echo '</td>';
echo '<td>';
	echo $av_report;
echo '</td>';
echo '<td>';
	echo $array_sample_examination['code'];
echo '</td>';
echo '<td>';
	echo 'result:'.$array_sample_examination['result'].'['.$array_sample_examination['eu'].']';
echo '</td>';
echo '<td>';
	echo $array_sample_examination['sample_type'];
echo '</td>';
echo '<td>';
	echo 'Location:'.$array_sample_examination['location'];
echo '</td>';
echo '<td>';
	echo '<input type=submit value=take_action name=\'take_action\'>';
echo '</td>';
echo '<td>';
	echo out_of_reportable_range_comment($array_sample_examination['sample_id']);
echo '</td>

</tr>';

echo '</form>';

}


function out_of_reportable_range_comment($sample_id)
{
	
	$sql='select	result
					from 
						examination
					where 
						sample_id=\''.$sample_id.'\' 
						and
						id=1007';
	if($result=mysql_query($sql)){echo mysql_error();}
	$array_c=mysql_fetch_assoc($result);
	return $array_c['result'];
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
		rr($i,$link);
	}
	echo '</table>';
}


main_menu();


























?>





