<?php
session_start();


include 'common.php';

if(!login_varify())
{
exit();
}


//echo '<pre>';
//print_r($GLOBALS);
//echo '</pre>';

$link=start_nchsls();
$sql='SELECT 
qt.ex_code as Miura300,
qt.target as five_target_Miura ,
qt.sd as five_sd_Miura, 
qtt.target as eight_target_Miura,
qtt.sd as eight_sd_Miura,

qtx.ex_code as other,
qtx.target as five_target_other,
qtx.sd as five_sd_other,
qttx.target as eight_target_other,
qttx.sd  as eight_sd_other

FROM `qc_target` qt ,qc_target_other qtx,`qc_target` qtt,qc_target_other qttx
where 
qt.ex_code=qtx.ex_code and 
qtt.ex_code=qttx.ex_code and 
qt.ex_code=qtt.ex_code and 
qtx.ex_code=qttx.ex_code and 

qt.qc_type=qtx.qc_type and
qtt.qc_type=qttx.qc_type and
qt.qc_type<>qtt.qc_type and 
qt.qc_type=5';
$counter=-1;
$result=mysql_query($sql,$link);
echo '<table border=1>'; 
echo '<tr><th bgcolor=lightblue colspan="5">Miura-300 & Electrolyte Analyzer</th><th  bgcolor=lightgreen colspan="5">EC 5 Plus V2 & Electrolyte Analyzer</th></tr>'; 
echo '<tr><th rowspan=2>Examination</th><td colspan="2">Normal(5)</td><td colspan="2">Abnormal(8)</td><th rowspan=2>Examination</th><td colspan="2">Normal(5)</td><td colspan="2">Abnormal(8)</td></tr>'; 
echo '<tr><td>Target</td><td>SD</td><td>Target</td><td>SD</td><td>Target</td><td>SD</td><td>Target</td><td>SD</td></tr>'; 
while ($ops=mysql_fetch_assoc($result))
{
//echo '<pre>';
//print_r($ops);
//echo '</pre>';

echo '<tr>';
foreach ($ops as $key=>$value)
	{
	if ($counter<0){$td='<td bgcolor=lightyellow>';}else{$td='<td bgcolor=lightgray>';}
	echo $td.$value.'</td>';
	}
echo '</tr>';
$counter=$counter*(-1);
}
echo '</table>';


main_menu();
?>
