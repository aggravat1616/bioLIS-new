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
$sql = "SELECT name_of_examination,count(name_of_examination) FROM `sample`,examination WHERE `sample_receipt_time` like \"%13-02-2012%\" and sample.sample_id=examination.sample_id group by name_of_examination";
$result=mysql_query($sql,$link);
echo '<table border=1>'; 

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
}
echo '</table>';


main_menu();
?>
