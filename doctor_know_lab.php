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

main_menu();

echo'	<table align=center border=1 bgcolor=lightyellow style="border-collapse:collapse;  margin-top:20px"><th style=\'font-size:150%\'><a href=statistics_doctor.php>Click here to view Laboratory Statistics</a></th></table>';
echo'<tr><h2></h2></tr>';


////////Laboratory scope for display--> start

$link=start_nchsls();
$sql=$sql = "SELECT `id`,`name_of_examination`,`code`,`referance_range`,`unit`,`sample_type`,`preservative`,`method_of_analysis`,`critical_low`,`critical_high` from `scope` where `id` < 1000 LIMIT 0, 200 ";
$counter=-1;
$result=mysql_query($sql,$link);
echo '<table border=1>'; 
echo '<tr><th bgcolor=lightblue colspan="10"><h2>Clinical Chemistry Laboratory: Test Scope</h2></th></tr>'; 
echo '<tr bgcolor=lightgreen><td align=center><b>Id</b></td><td align=center><b>Name of examination</b></td><td align=center><b>Code</b></td><td align=center><b>Reference range</b></td><td align=center><b>Unit</b></td><td align=center><b>Sample type</b></td><td align=center><b>Preservative</b></td><td align=center><b>Method of analysis</b></td><td align=center><b>Critical low</b></td><td align=center><b>Critical high</b></td></tr>'; 
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
echo '<h2 style="page-break-before: always;"></h2>';

////////////////Laboratory scope for display--> end

include 'Doctor/doctor_know_lab.html';

?>

