<?php
session_start();


include 'common.php';

if(!login_varify())
{
exit();
}



//////////////////////////

$yymm=$_POST['YYMM_selected'];
list($yy,$mm) = str_split($yymm,2);
//echo $yymm;
//echo $yy;
//echo $mm;

// to find name of entered month
$month_name = date( 'F', mktime(0, 0, 0, $mm, 1) );
//echo $month_name;

///////////////////////////




function get_qc_data($yymm,$qc_id,$eqip_id)
{
$link=start_nchsls();
$QC_5=$yymm*10000 + $qc_id*100000000;
$QC_5_last=$QC_5+9999;

/*
//Only 3SD values included
$sql_qc='select ex_code,avg(100*result/target),STDDEV_SAMP(100*result/target) as cv ,avg(100*result/target)-100 as bias
from qc 
where qc_id>=\''.$QC_5.'\' and  qc_id<=\''.$QC_5_last.'\' 
and abs( (result-target)/(sd) )<3
group by ex_code order by ex_code';
*/

//Only 3SD values included
$sql_qc='select ex_code,format(STDDEV_SAMP(100*result/target),1) as `CV%` ,format(abs(avg(100*result/target)-100),1) as `BIAS%`
from '.$eqip_id.' 
where qc_id>=\''.$QC_5.'\' and  qc_id<=\''.$QC_5_last.'\' 
and abs( (result-target)/(sd) )<3
group by ex_code order by ex_code';

//echo $sql_qc;

if(!$result_qc=mysql_query($sql_qc,$link)){echo mysql_error();}
	echo '<table align=center border=1 style="border-collapse:collapse;" width=200><tr><th colspan=3 bgcolor=lightyellow>QC-'.$qc_id.' Source-'.$eqip_id.'</th></tr>';
	//echo '<tr><td>ex_code</td><td>CV%</td><td>BIAS%</td></tr>';
	
	echo '<tr bgcolor=lightgrey><td align=center>ex_code</td><td align=center>CV%</td></tr>';
	while($array_qc=mysql_fetch_assoc($result_qc))
	{
	//echo '<tr><td>'.$array_qc['ex_code'].'</td><td>'.$array_qc['CV%'].'</td><td>'.$array_qc['BIAS%'].'</td></tr>';
	echo '<tr><td>'.$array_qc['ex_code'].'</td><td align=center>'.$array_qc['CV%'].'</td></tr>';
	//echo '<pre>';
	//print_r($array_qc);
	//echo '</pre>';
	}
	echo '</table>';
}




echo '<table>';
echo '<form method=post action=get_monthly_qc_data.php>';
echo '<tr><td>Write YYMM</td></tr>';
echo '<tr><td><input type=text name=YYMM_selected style=\'font-size:150%\' size=3>';
echo '<input type=submit value=OK name=submit></td></tr>';
echo '</form>';
echo '</table>';

echo '<h2 style="page-break-before: always;"></h2>';	



if (isset($_POST['YYMM_selected']))
{

echo '<table align=center border=1 style="border-collapse:collapse">
<tr bgcolor=lightgrey><th colspan=10>Clinical Chemistry Section, Medical College & S.S.G. Hospital, Baroda</th></tr>
<tr bgcolor=lightyellow><th colspan=10 style=\'font-size:140%\'>IQC % CV for the month of '.$month_name.' 20'.$yy.'</th></tr>
<tr bgcolor=lightgrey><th width=200>Miura-300 & ISE Electrolyte Analyzer Normal</th><th width=200>Miura-300 & ISE Electrolyte Analyzer Abnormal</th><th width=200>EC 5 Plus V2 & ISE Electrolyte Analyzer Normal</th><th width=200>EC 5 Plus V2 & ISE Electrolyte Analyzer Abnormal</th></tr>';
echo '<tr><td valign=top>';
get_qc_data($_POST['YYMM_selected'],5,'qc');
echo '</td>';

echo '<td valign=top>';
get_qc_data($_POST['YYMM_selected'],8,'qc');
echo '</td>';

echo '<td valign=top>';
get_qc_data($_POST['YYMM_selected'],5,'qc_other');
echo '</td>';

echo '<td valign=top>';
get_qc_data($_POST['YYMM_selected'],8,'qc_other');
echo '</td></tr>';
echo '</table>';
}


echo '<h2 style="page-break-before: always;"></h2>';	



second_menu();
//echo '<pre>';
//print_r($GLOBALS);
//echo '</pre>';
?>
