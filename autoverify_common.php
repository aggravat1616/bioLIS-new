<?php



function critical_alert_comment($sample_id)
{
	$link=start_nchsls();
	$sql='select	result
					from 
						examination
					where 
						sample_id=\''.$sample_id.'\' 
						and
						id=1005';
	if($result=mysql_query($sql,$link)){echo mysql_error();}
	$array_c=mysql_fetch_assoc($result);
	return $array_c['result'];
}

function make_form($array_sample_examination,$av_report)
{
echo '<form method=post action=autoverify_step_2.php  target="_blank">';

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
	echo critical_alert_comment($array_sample_examination['sample_id']);
echo '</td>

</tr>';

echo '</form>';

}

function check_critical($c_value,$c_operator,$result)
{
if($result!='0' && (float)$result==0)
	{
		return FALSE;
	}

if ($c_operator=='less_than')
	{
	if((float)$result<$c_value)
		{
				return 'Critical';
		}	
	}
if ($c_operator=='more_than')
	{
	if((float)$result>$c_value)
		{
			return 'Critical';
		}	
	}


return 'Not_Critical';
}




function av($sample_id)
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
		make_form($array_sample_examination,'Critical');
		}
	}
}



function av_report_for_code($sample_id,$code)
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
						examination.sample_type=critical_alert.sample_type
						and
						examination.code=\''.$code.'\''
					;
					
	if(!$result_sample_examination=mysql_query($sql_sample_examination,$link)){echo mysql_error();}
	while ($array_sample_examination=mysql_fetch_assoc($result_sample_examination))
	{
		$crt=check_critical($array_sample_examination['value'],$array_sample_examination['operator'],$array_sample_examination['result']);
		if(check_critical($array_sample_examination['value'],$array_sample_examination['operator'],$array_sample_examination['result'])=='Critical')
		{
		return 'Critical';
		}
	}
	return '';
}


/*

function av_report_for_code($sample_id,$code)
{
	$link=start_nchsls();
	$sql_sample_examination='select 
						sample.sample_id,examination.code,examination.result,
						sample.sample_type,sample.clinician,sample.unit su,sample.location,
						examination.unit eu, critical_alert.operator, critical_alert.value,examination.code
					from 
						sample,examination,critical_alert 
					where 
						sample.sample_id=\''.$sample_id.'\' 
						and
						sample.sample_id=examination.sample_id
						and
						examination.code=critical_alert.code
						and
						examination.sample_type=critical_alert.sample_type
						and
						examination.code=\''.$code.'\''
					;
	if(!$result_sample_examination=mysql_query($sql_sample_examination,$link)){echo mysql_error();}
	while ($array_sample_examination=mysql_fetch_assoc($result_sample_examination))
	{
		echo 'x';
		if(check_critical($array_sample_examination['value'],$array_sample_examination['operator'],$array_sample_examination['result'])=='Critical')
		{
			return 'Critical';
		}
		else
		{
			return '';	
		}		
	}

}
*/






//   <----------------------------- CCLSSGH extra --------------------------->




function check_abnormal($c_value,$c_operator,$result)
{
if($result!='0' && (float)$result==0)
	{
		return FALSE;
	}

if ($c_operator=='less_than')
	{
	if((float)$result<$c_value)
		{
				return 'Low';
		}	
	}
if ($c_operator=='more_than')
	{
	if((float)$result>$c_value)
		{
			return 'High';
		}	
	}


return 'Not_abnormal';
}




function abnormal_report_for_code($sample_id,$code)
{
	$link=start_nchsls();
	$sql_sample_examination='select 
						sample.sample_id,examination.code,examination.result,
						sample.sample_type,sample.clinician,sample.unit su,sample.location,
						examination.unit eu, abnormal_alert.operator, abnormal_alert.value
					from 
						sample,examination,abnormal_alert 
					where 
						sample.sample_id=\''.$sample_id.'\' 
						and
						sample.sample_id=examination.sample_id
						and
						examination.code=abnormal_alert.code
						and
						examination.sample_type=abnormal_alert.sample_type
						and
						examination.code=\''.$code.'\''
					;
					
	if(!$result_sample_examination=mysql_query($sql_sample_examination,$link)){echo mysql_error();}
	while ($array_sample_examination=mysql_fetch_assoc($result_sample_examination))
	{
		$crt=check_abnormal($array_sample_examination['value'],$array_sample_examination['operator'],$array_sample_examination['result']);
		if(check_abnormal($array_sample_examination['value'],$array_sample_examination['operator'],$array_sample_examination['result'])=='Low')
		{
		return 'L';
		}
		if(check_abnormal($array_sample_examination['value'],$array_sample_examination['operator'],$array_sample_examination['result'])=='High')
		{
		return 'H';
		}
	}
	return '-';
}




?>
