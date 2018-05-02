<?php
$link=mysql_connect('127.0.0.1','root','lipoprotein');
/*
if($link==FALSE)
{
echo'fail to connect<br>';
}
else
{
echo'success<br>';
}
*/
$xx=mysql_select_db('biochemistry',$link);
/*
if($xx==FALSE)
{
echo'fail to connect<br>';
}
else
{
echo'success database<br>';
}

*/
include 'common.php';
/*
echo '<pre>';
$result=mysql_query('select * from complain_box',$link);



while($ar=mysql_fetch_assoc($result))
{
print_r($ar);
}

echo'<pre>';

$r=mysql_query("insert into complain_box values('k')",$link);
print_r($r);
echo mysql_error();


echo '<form method=post action=complain_step_1.php>
Your complain:<br>
<textarea name=complain cols=40 rows=6></textarea><br>

<input type=submit value=submit>

</form>
';
*/



// $_POST['from']
//$_POST['to']

function make_form1($result,$av_report)
{
echo '<form method=post action=av_step_2.php  target="_blank">';
echo '<table border=1>';
echo '<tr><td>';
echo 'sample_id:<input readonly type=text name=sample_id value=\''.$result['sample_id'].'\'>';
echo '</td>';
echo '<td>';
	echo $av_report;
echo '</td>';
echo '<td>';
	echo $result['code'];
echo '</td>';
echo '<td>';
	echo 'result:'.$result['result'];
echo '</td>';
echo '<td>';
	echo ('UREA');
echo '</td>';
echo '<td>';
	echo ('NOT DONE');
echo '</td>';
echo '<td>';
	echo 'Location:'.$result['location'];
echo '</td>';
echo '<td>';
	echo '<input type=submit value=Delta_check name=\'Delta_check\'>';
echo '</td></tr>';
echo '</table>';
echo '</form>';

}




/*
function av_GLC($sample_id,$linkkk)
{
$rtrn=array();

	global $av_error_code_to_text;
	
	$sql_sample_examination='select 
					sample.sample_id,examination.code,examination.result,sample.sample_type,sample.clinician,sample.unit su,sample.location, examination.unit eu
				from sample,examination where sample.sample_id=83 and sample.sample_id=examination.sample_id';
	if(!$result_sample_examination=mysql_query($sql_sample_examination,$linkkk)){echo mysql_error();}
	while ($array_sample_examination=mysql_fetch_assoc($result_sample_examination))
	{
		//echo '<pre>';print_r($array_sample_examination);echo '</pre>';
		if($array_sample_examination['code']=='GLC')
		{
			
			if	(
					($array_sample_examination['result']>300 || $array_sample_examination['result']<55)
					&&
					($array_sample_examination['sample_type']=='Blood(Serum,Plasma)')
				)
				{
					make_form($array_sample_examination,'Critical Alert-very high');
					$rtrn[]='CRTH';
				}
			if	(
					($array_sample_examination['result']<55)
					&&
					($array_sample_examination['sample_type']=='CSF')
				)
				{
					make_form($array_sample_examination,'Critical Alert-very low');
					$rtrn[]='CRTL';
				}
		}
	}
return $rtrn;
}
av_GLC(83,$link);

*/

function av2($sample_id,$linkkk)
{
	$sql=mysql_query("select sample.sample_id,examination.code,examination.result,sample.sample_type,sample.clinician,sample.unit su,sample.location, examination.unit eu,examination.id
				from sample,examination where sample.sample_id='.$sample_id.' and sample.sample_id=examination.sample_id",$linkkk);

	$result=mysql_fetch_assoc($sql);
	
		if(($result['code']=='CR')&&$result['result']>2)
			{	
				$ss=mysql_query("SELECT result FROM sample, examination WHERE sample.sample_id ='.$sample_id.' AND sample.sample_id = examination.sample_id
						AND examination.id =6",$linkkk);
				$tt=mysql_fetch_assoc($ss);
				///print_r($tt);
				if($tt==FALSE)
				{
					make_form1($result,'Result Autoverify');
					
				}
				elseif(($tt==TRUE)&&($ss['result']<100))
				{
					make_form2($result,$tt,'Result Mismatch,Manual INTERPRETATION Require');

				
				}
			}
		
		

}				




if(isset($_POST['sample_id']))
{
Delta_check($_POST['sample_id'],$link);
}
else
{
	echo '<table border=1>';
	for ($i=$_POST['from_sample_id'];$i<$_POST['to_sample_id'];$i++)
	{
		av2($i,$link);
	}
	echo '</table>';
}





function make_form2($result,$tt,$av_report)
{
echo '<form method=post action=av_step_2.php  target="_blank">';
echo '<table border=1>';
echo '<tr><td>';
echo 'sample_id:<input readonly type=text name=sample_id value=\''.$result['sample_id'].'\'>';
echo '</td>';
echo '<td>';
	echo 'creatinine result:'.$result['result'];
echo '</td>';
echo '<td>';
	echo 'Urea result:'.$tt['result'];
echo '</td>';
echo '<td>';
	echo $av_report;
echo '</td>';
echo '<td>';
	echo 'Location:'.$result['location'];
echo '</td>';
echo '<td>';
	echo '<input type=submit value=Delta_check name=\'Delta_check\'>';
echo '</td></tr>';
echo '</table>';
echo '</form>';

}




/*


function av($sample_id,$linkkk)
{
	$sql=mysql_query("select sample.sample_id,examination.code,examination.result,sample.sample_type,sample.clinician,sample.unit su,sample.location, examination.unit eu
				from sample,examination where sample.sample_id='.$sample_id.' and sample.sample_id=examination.sample_id",$linkkk);

	$result=mysql_fetch_assoc($sql);
	
		if(($result['code']=='CR')&&$result['result']>2)
			{	
				$ss=mysql_query("SELECT result FROM sample, examination WHERE sample.sample_id ='.$sample_id.' AND sample.sample_id = examination.sample_id
						AND examination.id =6",$linkkk);
				$tt=mysql_fetch_assoc($ss);
				///print_r($tt);
				if(($tt==TRUE)&&($ss['result']<30))
				{
				make_form2($result,$tt,'Result Mismatch,Manual INTERPRETATION Require');	
					
				}
				


				/////////else{echo('do urea');}
			
			}
		////////else{echo('fail');}
		

}				

av(32,$link);

*/







/*

$dd=mysql_query('SELECT sample.sample_id, examination.code=K, examination.result, sample.sample_type, sample.clinician, sample.unit su, sample.location, examination.unit eu
FROM sample, examination
WHERE sample.sample_id =77
AND sample.sample_id = examination.sample_id',$link);	

$tt=mysql_fetch_assoc($dd)
$cc=mysql_query(			
*/

/////////imp
/*
SELECT result
FROM sample, examination
WHERE sample.sample_id =77
AND sample.sample_id = examination.sample_id
AND examination.id =4
*/
/////////
/*
echo '<form method=post action=complain_step_1.php>
Your complain:<br>
<textarea name=complain cols=40 rows=6></textarea><br>

<input type=submit value=submit>';

*/

/*
$aa='select result,sample_id from sample,examination where sample.sample_id=examination.sample_id and patient_id in(select patient_id from sample where sample_id=909)';


$aa="SELECT result, sample.sample_id, examination.details
FROM sample, examination
WHERE sample.sample_id = examination.sample_id
AND patient_id
IN (

SELECT patient_id
FROM sample
WHERE sample.sample_id =909
)
AND code = 'CR'
GROUP BY details";

if(!$qq=mysql_query($aa,$link)){echo mysql_error();}
while($zz=mysql_fetch_assoc($qq))
{print_r($zz);}
*/

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
		if(check_Reportable_range($array_sample_examination['value'],$array_sample_examination['operator'],$array_sample_examination['result'])=='within_reportable_range')
		{
		av2($sample_id,$linkkk);
		}
		else
			{make_form5($array_sample_examination,'out_of_reportable_range');}
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





