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



// Table of scope wise test statistics starts

echo '<table align=center border=1 style="border-collapse:collapse;">';
echo '<tr><th colspan=35 bgcolor=lightblue style=\'font-size:110%\'>CLINICAL CHEMISTRY SECTION</th></tr>';
echo '<tr><th colspan=35 bgcolor=lightblue style=\'font-size:110%\'>LABORATORY SERVICES, S.S.G. HOSPITAL and MEDICAL COLLEGE, BARODA</th></tr>';
echo '<tr><th colspan=35 bgcolor=lightgreen style=\'font-size:110%\'>Test statistics for the month of '.$month_name.' 20'.$yy.'</th></tr>';

echo '<tr bgcolor=gold>';
echo '<th>Test parameter</th><th>Number of tests done</th>';
echo '</tr>';

$sql= 'SELECT `name_of_examination` from `scope` where `id` < 102 group by `name_of_examination` order by `id`';
$result=mysql_query($sql,$link);

$counter=-1;
$counterxx=0;

while ($ar=mysql_fetch_assoc($result))
{

//echo '<pre>';
//print_r($ar);
//echo '</pre>';

	foreach ($ar as $key => $value)   //for every parameter in scope
	{

		echo '<tr>';

		if ($counter<0){$td='<td bgcolor=lightyellow>';}else{$td='<td bgcolor=lightgray>';}
		if ($counter<0){$tdt='<td bgcolor=lightyellow align=center>';}else{$tdt='<td bgcolor=lightgray align=center>';}
		
		if ($ar['name_of_examination']=='pO2')
		{
			echo ''.$td.'ABG (Arterial Blood Gas Analysis)</td>';
		}
		
		else 
		{
			echo 	$td.$ar['name_of_examination'].'</td>';
		}

		
		// for total monthly tests of a particular parameter
		$q1= 'SELECT count(name_of_examination) FROM `examination` WHERE `name_of_examination`=\''.$ar['name_of_examination'].'\' and `sample_id` between \''.$yymm.'010001\' and \''.$yymm.'318000\'';
		$q2=mysql_query($q1,$link);
		$q3=mysql_fetch_assoc($q2);
		//print_r($q3);	

		echo $tdt.'<b>'.$q3['count(name_of_examination)'].'</b></td>';

		echo '</tr>';

		$counter=$counter*(-1);
		$counterxx=$counterxx + 1;

	}

}

// for total monthly tests (total of all parameters)
$r1= 'SELECT count(name_of_examination) FROM `examination` WHERE `id` < 102 and `sample_id` between \''.$yymm.'010001\' and \''.$yymm.'318000\' ';
$r2=mysql_query($r1,$link);
$r3=mysql_fetch_assoc($r2);

echo '<tr><td align=right colspan=35 bgcolour=gold><b>Monthly test total = '.$r3['count(name_of_examination)'].'</b></td></tr>';

echo '</table>';




// Table of samples received <---> tests done starts

echo '<h2 style="page-break-before: always;"></h2>';

echo '<table align=center border=1 style="border-collapse:collapse;">';
echo '<tr><th colspan=35 bgcolor=lightblue style=\'font-size:110%\'>CLINICAL CHEMISTRY SECTION</th></tr>';
echo '<tr><th colspan=35 bgcolor=lightblue style=\'font-size:110%\'>LABORATORY SERVICES, S.S.G. HOSPITAL and MEDICAL COLLEGE, BARODA</th></tr>';
echo '<tr><th colspan=10 bgcolor=lightgreen style=\'font-size:110%\'>Date wise statistics for the month of '.$month_name.' 20'.$yy.'</th></tr>';
echo '<tr align=center bgcolor=gold>
	<th>Date</th>
	<th>Day</th>
	<th>Samples received</th>
	<th>Tests performed</th>
	</tr>';

	for ( $dd=01; $dd<=$entered_month_days ; $dd ++) 
	{
		//echo $yymm.$dd;

		// to get day of week from date
		$jd=cal_to_jd(CAL_GREGORIAN,date("$mm"),date("$dd"),date("$yy"));
		$day=(jddayofweek($jd,1));

		//////// to convert 1 to 9 dates to 01 to 09
		$dd=str_pad((int) $dd,2,"0",STR_PAD_LEFT);

		// for samples received
		$a1= 'SELECT count(sample_id) FROM `sample` WHERE `sample_id` between \''.$yymm.$dd.'0001\' and \''.$yymm.$dd.'8000\'';
		$a2=mysql_query($a1,$link);
		$a3=mysql_fetch_assoc($a2);
		//print_r($a3);

		// for tests done
		$p1= 'SELECT count(name_of_examination) FROM `examination` WHERE `sample_id` between \''.$yymm.$dd.'0001\' and \''.$yymm.$dd.'8000\'';
		$p2=mysql_query($p1,$link);
		$p3=mysql_fetch_assoc($p2);
		//print_r($p3);

		echo '<tr>';

		if ($odd = $dd%2){$td='<td bgcolor=lightyellow align=center>';}else{$td='<td bgcolor=lightgray align=center>';}
		
		echo 	$td.$dd.'/'.$mm.'/'.$yy.'</td>';
		echo 	$td.$day.'</td>';
		echo 	$td.$a3['count(sample_id)'].'</td>';
		echo	$td.$p3['count(name_of_examination)'].'</td>';
		
		echo '</tr>';

	}


// for monthly total samples
$z1= 'SELECT count(sample_id) FROM `sample` WHERE `sample_id` between \''.$yymm.'010001\' and \''.$yymm.$entered_month_days.'8000\'';
//echo $z1;
$z2=mysql_query($z1,$link);
$z3=mysql_fetch_assoc($z2);
//print_r($z3);

// for monthly total tests
$y1= 'SELECT count(name_of_examination) FROM `examination` WHERE `id` < 102 and `sample_id` between \''.$yymm.'010001\' and \''.$yymm.$entered_month_days.'8000\'';
//echo $y1;
$y2=mysql_query($y1,$link);
$y3=mysql_fetch_assoc($y2);
//print_r($y3);

echo '<tr bgcolor=gold>';

echo '<th colspan=2>Total</th><th>'.$z3['count(sample_id)'].'</th><th>'.$y3['count(name_of_examination)'].'</th>';

echo '</tr>';


echo '</table>';



?>
