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
/*
function make_form($result,$av_report)
{
echo '<form method=post action=autoverify_step_2.php  target="_blank">';
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
	echo '<input type=submit value=take_action name=\'take_action\'>';
echo '</td></tr>';
echo '</table>';
echo '</form>';

}

//////////////make form 2

function make_form2($result,$tt,$av_report)
{
echo '<form method=post action=autoverify_step_2.php  target="_blank">';
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
	echo '<input type=submit value=take_action name=\'take_action\'>';
echo '</td></tr>';
echo '</table>';
echo '</form>';

}




function av($sample_id,$linkkk)
{
	$sql=mysql_query("select sample.sample_id,sample.patient_id,examination.code,examination.result,sample.sample_type,sample.clinician,sample.unit su,sample.location, examination.unit eu,examination.id
				from sample,examination where sample.sample_id='.$sample_id.' and sample.sample_id=examination.sample_id",$linkkk);

	$result=mysql_fetch_assoc($sql);
	
		if(($result['code']=='CR')&&$result['result']>2)
			{	
				$ss=mysql_query("SELECT result,examination.details FROM sample, examination WHERE sample.sample_id ='.$sample_id.' AND sample.sample_id = examination.sample_id
						AND examination.id =4 AND patient_id=sample.patient_id",$linkkk);
				$tt=mysql_fetch_assoc($ss);
				///print_r($tt);
				if($tt==FALSE)
				{
					make_form($result,'Result Autoverify');
					
				}
				elseif(($tt==TRUE)&&($ss['result']<100))
				{
					make_form2($result,$tt,'Result Mismatch,Manual INTERPRETATION Require');

				
				}
			}
		
		

}				
*/


/*
if(isset($_POST['sample_id']))
{
edit_sample($_POST['sample_id'],'edit_request_step_3.php',' ');
}
else
{
	echo '<table border=1>';
	for ($i=$_POST['from_sample_id'];$i<$_POST['to_sample_id'];$i++)
	{
		av($i,$link);
	}
	echo '</table>';
}



*/




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


function Delta_check($sample_id,$linkkk)
{

$aa="SELECT result, sample.sample_id, examination.details,code
FROM sample, examination
WHERE sample.sample_id = examination.sample_id
AND patient_id
IN (

SELECT patient_id
FROM sample
WHERE sample.sample_id ='.$sample_id.')

AND code = 'CR'
GROUP BY details";

if(!$qq=mysql_query($aa,$linkkk)){echo mysql_error();}
while($zz=mysql_fetch_assoc($qq))
{make_form3($zz);}
}


if($_POST['sample_id']==TRUE)
{Delta_check($_POST['sample_id'],$link);}



function make_form3($zz)
{
echo '<form method=post action=av_step_3.php >';
echo '<table border=1>';
echo '<tr>';
echo '<td>';
	echo 'Delta check';
echo '</td>';
echo '<td>';
	echo 'CODE:'.$zz['code'];
echo '</td>';
echo '<td>';
	echo 'result:'.$zz['result'];
echo '</td>';
echo '<td>';
	echo 'sample_id:'.$zz['sample_id'];
echo '</td>';
echo '<td>';
	echo 'detail:'.$zz['details'];
echo '</td>';
echo '</tr>';
echo '</table>';

echo '</form>';

}






echo '<form method=post action=av_step_3.php>


<input type=submit value=take_action name=\'take_action\'>

</form>
';

?>





