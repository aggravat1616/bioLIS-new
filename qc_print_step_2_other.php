<?php
session_start();

//echo '<pre>';
//print_r($GLOBALS);
//echo '</pre>';

include 'common.php';

if(!login_varify())
{
exit();
}

////////////////

list($qc_id)=str_split($_POST['qc_id'],5);		// remove %
//echo $qc_id;
list($qc_id_level)=str_split($qc_id,1);		// seperate QC level from yymm
//echo $qc_id_level;
$yy=number_format(($qc_id%10000)/100,0);	// to get year number
//echo $yy;
$mm=number_format(($qc_id%100)/1,0);		// to get month number
//echo $mm;
$month_name = date( 'F', mktime(0, 0, 0, $mm, 1) );	// to find name of entered month
//echo $month_name;

/////////////////

$link=start_nchsls();

$a1='select name_of_examination from `scope` where code=\''.$_POST['ex_code'].'\'';
//echo $a1;
$a2=mysql_query($a1,$link);
$a3=mysql_fetch_assoc($a2);

/////////////////
if ($qc_id_level==5)
	{$level='Normal';}
else if ($qc_id_level==8)
	{$level='Pathological';}


////////////////

echo '<table border=2 style="border-collapse:collapse" cellpadding="0">';
echo '<tr valign=top>';
echo '<td>';


if (isset($_POST['qc_id'],$_POST['ex_code']))
{
echo '<table border=1 bordercolor=silver style="border-collapse:collapse" cellspacing="0" cellpadding="2" valign=top>
<tr><th colspan=10>Clinical Chemistry Section, Medical College & S.S.G. Hospital, Baroda</th></tr>
<tr><th colspan=10 style=\'font-size:140%\'>LJ chart: Erba CHEM 5 Plus V2 / Electrolye Analyzer for the month of '.$month_name.' 20'.$yy.'</th></tr>
<tr><th colspan=10 style=\'font-size:120%\'>Name of examination: '.$a3['name_of_examination'].'&nbsp;&nbsp;&nbsp; Code: '.$_POST['ex_code'].' &nbsp;&nbsp;&nbsp; Level: '.$level.'</th></tr>';
echo '<tr CELLPADDING=50 CELLSPACING=50><th>Date</th><th>Hour</th><th>Result</th><th>xSD</th><th>Repeat</th><td style=\'font-size:70%\'><tt>
|-4_______|-3_______|-2_______|-1_______|0_______1|________2|________3|________4|
</tt></td><th>Comment</th><th>Target</th><th>SD</th></tr>
';
print_qc_x($_POST['qc_id'],$_POST['ex_code']);
echo '</table>';
}


echo '</td></tr>';
echo '</table>';

////////////////////////////////////////// modified functions from common.php


function print_qc_x($qc_id,$ex_code)
{
	$link=start_nchsls();
	
		$sql_qc = 
		'SELECT ex_code,`repeat`, qc_id,
		target,sd,result,format((result-target)/sd,1) as lj,comment 
		FROM 	`qc_other` 
		where  
		qc_id like \''.$qc_id.'\' and ex_code like \''.$ex_code.'\'
		order by qc_id, `repeat`
		';


	$result_qc=mysql_query($sql_qc,$link);
	echo mysql_error();
	while($array_qc=mysql_fetch_assoc($result_qc))
	{
		if($array_qc['result']!=NULL && is_numeric($array_qc['result']))
		{

		$xxxx=($array_qc['qc_id']%1000000);
		$date=number_format(($xxxx%10000)/100,0);
		
		$xxxxxx=($qc_id%10000);
		$hour=number_format(($xxxx%100)/1,0);

			echo '<tr>';
			echo '<td align=center>'.$date.'</td>';
			echo '<td align=center>'.$hour.'</td>';
			echo '<td align=center>'.$array_qc['result'].'</td>';
			echo '<td align=center>'.$array_qc['lj'].'</td>';
			echo '<td align=center>'.$array_qc['repeat'].'</td>';
			echo '<td table border=0 style=\'font-size:70%\'><tt>';
				echo make_qc_string_for_print($array_qc['lj']);
			echo '</tt></td>';
			echo '<td align=center>'.$array_qc['comment'].'</td>';
			echo '<td align=center>'.$array_qc['target'].'</td>';
			echo '<td align=center>'.$array_qc['sd'].'</td>';
			echo '</tr>';
		}
	}	


}



function make_qc_string_for_print($sd)
{
if($sd<0)					//-1.2
	{	
		$sd_final=max($sd,-4);		//-1.2
		$sd_final=40+10*$sd_final;	//40-12=28
	}
else if($sd>0)					//1.2
	{
		$sd_final=min($sd,4);		//1.2
		$sd_final=10*$sd_final+40;	//12+40=52
	}
else if($sd==0)
	{
	$sd_final=$sd;			//0
	$sd_final=40;			//40
	}
$str='';	

for ($i=0;$i<=80;$i++)
	{
	if($i==$sd_final)
		{
		$str=$str.'<font color=red>X</font>';
		}
	else if($i==40)
		{
		$str=$str.'<font>I</font>';
		}
	else if($i==50 || $i==30)
		{
		$str=$str.'<font color=green>|</font>';
		}
	else if($i==20 || $i==60)
		{
		$str=$str.'<font color=blue>|</font>';
		}
	else if($i==70 || $i==10)
		{
		$str=$str.'<font color=red>|</font>';
		}	
	else if($i%10)
		{
		$str=$str.'<font color=white>&nbsp;</font>';	// &nbsp; for white space
		}
	else 
		{
		$str=$str.'|';
		}

	

	}
	//	$str=$str.$sd;
	return $str;
}


?>
