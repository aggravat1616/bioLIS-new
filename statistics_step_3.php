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

second_menu();

echo '<h2 style="page-break-before: always;"></h2>';

$link=start_nchsls();


$yymm=$_POST['yymm'];
list($yy,$mm) = str_split($yymm,2); 
//echo $yymm;
//echo $yy;
//echo $mm;


////////////////////////////////////////////////////////////////////////////////// check that the entered yydd are proper

if (strlen($yymm)>4)		// if more than 4 digit number is entered
{
	echo '<h3>Incorrect "yymm" entry.</h3>';
	exit();
}

if($mm < 1 || $mm > 12 || $yymm < 1101 || $yymm > 9912)
{
echo '<h3>Incorrect "yymm" entry.</h3>';
//echo '<h3>You entered year = '.$yy.' and month = '.$mm.' !!!</h3>';
exit();
}

$current_yymm=strftime('%y%m');
//echo $current_yymm;

if($yymm > $current_yymm)		// any future yymm
{
echo '<h3>You just entered year='.$yy.' and month='.$mm.' !!!</h3>';
echo '<h3>The system is not aware of the future !</h3>';
exit();
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// to find name of entered month
$month_name = date( 'F', mktime(0, 0, 0, $mm, 1) );
//echo $month_name;

// to calculate days of the entered month
$entered_month_days = cal_days_in_month(CAL_GREGORIAN, $mm, $yy);
//echo $entered_month_days;

echo '	<table>
	<tr><td>I = Indoor (Routine) samples</td></tr>
	<tr><td>U = Urgent samples</td></tr>
	<tr><td>OP = OPD samples</td></tr>
	<tr><td>Ot = Other samples (Lipid profile, Thyroid profile)</td></tr>
	<tr><td>A = ABG samples</td></tr>
	<tr><td>Ar = ART samples</td></tr>
<tr><td>C = Camp samples</td></tr>
    <tr><td>Tot = Total</td></tr>
	</table>';

echo '<table border=1 style="border-collapse:collapse;">';
echo '<tr><th colspan=25 bgcolor=lightblue style=\'font-size:120%\'>CLINICAL CHEMISTRY SECTION, LABORATORY SERVICES, S.S.G. HOSPITAL and MEDICAL COLLEGE, BARODA</th></tr>';
echo '<tr><th colspan=25 bgcolor=lightgreen style=\'font-size:120%\'>Test statistics for the month of '.$month_name.' 20'.$yy.'</th></tr>';
echo '<tr>
	<th rowspan=2 bgcolor=gold><b>ID</b></th>
	<th rowspan=2 bgcolor=gold><b>Parameter (Code)</b></th>
	<th rowspan=2 bgcolor=gold><b>Sample type</b></th>
	<th rowspan=2 bgcolor=gold><b>Preservative</b></th>
	<th rowspan=2 bgcolor=gold><b>Method of analysis</b></th>';


for ( $dd=01; $dd<=$entered_month_days ; $dd ++) 
	{
	echo '	<td colspan=8 align=center><font color=red><b>'.$dd.'/'.$mm.'/'.$yy.'</b></font></td>';
	}
echo '</tr>';
echo '<tr>';

for ( $dd=01; $dd<=$entered_month_days ; $dd ++)
	{ 
	echo '	<td align=center bgcolor=gold><b>I</b></td>
		<td align=center bgcolor=gold><b>U</b></td>
		<td align=center bgcolor=gold><b>OP</b></td>
		<td align=center bgcolor=gold><b>Ot</b></td>
		<td align=center bgcolor=gold><b>A</b></td>
        <td align=center bgcolor=gold><b>Ar</b></td>
<td align=center bgcolor=gold><b>C</b></td>
		<td align=center bgcolor=gold><b>Tot</b></td>';
	}

echo '</tr>';

$sql= 'SELECT `id` from `scope`';
$result=mysql_query($sql,$link);

$counter=-1;

while ($ar=mysql_fetch_assoc($result))
{

//echo '<pre>';
//print_r($ar);
//echo '</pre>';

	foreach ($ar as $key => $value)   //for every parameter in scope
	{

		$z1= 'SELECT `name_of_examination`,`code`,`sample_type`,`preservative`,`method_of_analysis` from `scope` where `id`=\''.$ar['id'].'\'';
		$z2=mysql_query($z1,$link);
		$z3=mysql_fetch_assoc($z2);

		echo '<tr>';

		if ($counter<0){$td='<td bgcolor=lightyellow>';}else{$td='<td bgcolor=lightgray>';}

		echo 	$td.$ar['id'].'</td>';
		echo 	$td.$z3['name_of_examination'].'('.$z3['code'].')</td>';
		echo	$td.$z3['sample_type'].'</td>';
		echo	$td.$z3['preservative'].'</td>';
		echo	$td.$z3['method_of_analysis'].'</td>';

		for ( $dd=01; $dd<=$entered_month_days ; $dd ++) 
		{

			//////// to convert 1 to 9 dates to 01 to 09
			$dd=str_pad((int) $dd,2,"0",STR_PAD_LEFT);

			// for routine indoor patient samples --> sample_id 0001 to 1000
			$p1= 'SELECT count(name_of_examination) FROM `examination` WHERE `id`=\''.$ar['id'].'\' and `sample_id` between \''.$yymm.$dd.'0001\' and \''.$yymm.$dd.'1000\'';
			$p2=mysql_query($p1,$link);
			$p3=mysql_fetch_assoc($p2);
			//print_r($p3);

			// for urgent samples --> sample_id 1001 to 2000
			$q1= 'SELECT count(name_of_examination) FROM `examination` WHERE `id`=\''.$ar['id'].'\' and `sample_id` between \''.$yymm.$dd.'1001\' and \''.$yymm.$dd.'2000\'';
			$q2=mysql_query($q1,$link);
			$q3=mysql_fetch_assoc($q2);
			//print_r($q3);

			// for OPD samples --> sample_id 2001 to 3000
			$r1= 'SELECT count(name_of_examination) FROM `examination` WHERE `id`=\''.$ar['id'].'\' and `sample_id` between \''.$yymm.$dd.'2001\' and \''.$yymm.$dd.'3000\'';
			$r2=mysql_query($r1,$link);
			$r3=mysql_fetch_assoc($r2);
			//print_r($r3);

			// for lipid profile & thyroid profile samples --> sample_id 3001 to 5000
			$s1= 'SELECT count(name_of_examination) FROM `examination` WHERE `id`=\''.$ar['id'].'\' and `sample_id` between \''.$yymm.$dd.'3001\' and \''.$yymm.$dd.'5000\'';
			$s2=mysql_query($s1,$link);
			$s3=mysql_fetch_assoc($s2);
			//print_r($s3);

			// for ABG samples --> sample_id 5001 to 6000
			$t1= 'SELECT count(name_of_examination) FROM `examination` WHERE `id`=\''.$ar['id'].'\' and `sample_id` between \''.$yymm.$dd.'5001\' and \''.$yymm.$dd.'6000\'';
			$t2=mysql_query($t1,$link);
			$t3=mysql_fetch_assoc($t2);
			//print_r($t3);

			// for ART samples --> sample_id 6001 to 7000
			$u1= 'SELECT count(name_of_examination) FROM `examination` WHERE `id`=\''.$ar['id'].'\' and `sample_id` between \''.$yymm.$dd.'6001\' and \''.$yymm.$dd.'7000\'';
			$u2=mysql_query($u1,$link);
			$u3=mysql_fetch_assoc($u2);
			//print_r($u3);
// for Camp samples --> sample_id 7001 to 8000
			$v1= 'SELECT count(name_of_examination) FROM `examination` WHERE `id`=\''.$ar['id'].'\' and `sample_id` between \''.$yymm.$dd.'7001\' and \''.$yymm.$dd.'8000\'';
			$v2=mysql_query($v1,$link);
			$v3=mysql_fetch_assoc($v2);
			//print_r($v3);


			$total= $p3['count(name_of_examination)'] + $q3['count(name_of_examination)'] + $r3['count(name_of_examination)'] + $s3['count(name_of_examination)'] + $t3['count(name_of_examination)']+ $u3['count(name_of_examination)']+ $v3['count(name_of_examination)'];

			echo 	$td.$p3['count(name_of_examination)'].'</td>';
			echo	$td.$q3['count(name_of_examination)'].'</td>';
			echo	$td.$r3['count(name_of_examination)'].'</td>';
			echo	$td.$s3['count(name_of_examination)'].'</td>';
			echo	$td.$t3['count(name_of_examination)'].'</td>';
            echo	$td.$u3['count(name_of_examination)'].'</td>';
echo	$td.$v3['count(name_of_examination)'].'</td>';
			echo	$td.'<font color=blue><b>'.$total.'</b></font></td>';

		}

		echo '</tr>';

		$counter=$counter*(-1);

	}
}

echo '</table>';

?>
