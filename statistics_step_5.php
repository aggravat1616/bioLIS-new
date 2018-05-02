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

if($mm < 1 || $mm > 12 || $yymm < 1101 || $yymm > 9912)
{
echo '<h3>Incorrect "yymm" entry.</h3>';
echo '<h3>You entered year = '.$yy.' and month = '.$mm.' !!!</h3>';
exit();
}

$current_yymm=strftime('%y%m');
//echo $current_yymm;

if($yymm > $current_yymm)
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


// total monthly samples verified
$r1= 'SELECT count(sample_id) FROM `sample_verification` WHERE `sample_id` like \''.$yymm.'%\' and `sign` != \'Verification_pending\'';
$r2=mysql_query($r1,$link);
$r3=mysql_fetch_assoc($r2);


echo '<table border=1 style="border-collapse:collapse;">';
echo '<tr><th colspan=35 bgcolor=lightblue style=\'font-size:110%\'>CLINICAL CHEMISTRY SECTION, LABORATORY SERVICES, S.S.G. HOSPITAL and MEDICAL COLLEGE, BARODA</th></tr>';
echo '<tr><th colspan=35 bgcolor=lightgreen style=\'font-size:110%\'>Signatory statistics for the month of '.$month_name.' 20'.$yy.'</th></tr>';

echo '<tr>';

echo '<td><b>Signatory||Date-></b></td>';


for ( $dd=01; $dd<=$entered_month_days ; $dd ++) 
	{
	echo '	<td align=center><b>'.$dd.'</b></td>';
	}

echo '<td><b>Total</b></td><td align=center><b>%</b></td>';

echo '</tr>';


$sql= 'SELECT sign FROM `signature_authority` WHERE `sign` != \'Verification_pending\' AND `grade` > 0  order by `grade` DESC';
$result=mysql_query($sql,$link);

$counter=-1;

while ($ar=mysql_fetch_assoc($result))
{

//echo '<pre>';
//print_r($ar);
//echo '</pre>';

	foreach ($ar as $key => $value)   //for every signatory
	{

		// for total monthly verifications by a particular signatory
		$q1= 'SELECT count(sample_id) FROM `sample_verification` WHERE `sign`=\''.$ar['sign'].'\' and `sample_id` between \''.$yymm.'010000\' and \''.$yymm.'318000\' ';
		$q2=mysql_query($q1,$link);
		$q3=mysql_fetch_assoc($q2);
		//print_r($q3);	

		if ($q3['count(sample_id)'] > 0)
		{

			echo '<tr>';

			// for background colour
			if ($counter<0){$td='<td bgcolor=lightyellow>';}else{$td='<td bgcolor=lightgray>';}
			if ($counter<0){$tdt='<td bgcolor=lightyellow align=center>';}else{$tdt='<td bgcolor=lightgray align=center>';}
		
			echo 	$td.$ar['sign'].'</td>';

			for ( $dd=01; $dd<=$entered_month_days ; $dd ++) 	// for every day of the entered month
			{

				//////// to convert 1 to 9 dates to 01 to 09
				$dd=str_pad((int) $dd,2,"0",STR_PAD_LEFT);

				$p1= 'SELECT count(sample_id) FROM `sample_verification` WHERE `sign`=\''.$ar['sign'].'\' and `sample_id` between \''.$yymm.$dd.'0001\' and \''.$yymm.$dd.'8000\' ';
				$p2=mysql_query($p1,$link);
				$p3=mysql_fetch_assoc($p2);
				//print_r($p3);
			
				echo 	$tdt.$p3['count(sample_id)'].'</td>';

			}


			// expressed as % of total verified samples
			$percent=$q3['count(sample_id)']*100/$r3['count(sample_id)'];
			$percent= number_format($percent, 1, '.', '');				// to convet 44.134222 % to 44.1 %


			echo $tdt.'<b>'.$q3['count(sample_id)'].'</b></td>';
			echo $tdt.'<font color=blue><b>'.$percent.'</b></font></td>';

			echo '</tr>';

			$counter=$counter*(-1);
		}
	}

}


echo '<tr><td align=right colspan=35><b>Total monthly verified samples = '.$r3['count(sample_id)'].'</b></td></tr>';

echo '</table>';


//////////////////////////// count interim reports
$x1= 'SELECT count(sample_id) FROM sample_verification WHERE `sample_id` like \''.$yymm.'%\' and `sign` like \'%Interim%\'';
//echo $x1;
$x2= mysql_query($x1,$link);
$x3=mysql_fetch_assoc($x2);
//print_r($x3);

/////////////////////////// calculate final report number and percentages of interim & final reports
$total= $r3['count(sample_id)'];

$interim= $x3['count(sample_id)'];
$interim_perc= $interim * 100 / $total;
$interim_perc= number_format($interim_perc, 1, '.', '');

$final= $total - $interim;
$final_perc= $final * 100 / $total;
$final_perc= number_format($final_perc, 1, '.', '');

//////////////////////////// display the results

echo '<h3></h3>';
echo '<table border=1>';
echo '<tr bgcolor=silver><th>Final/interim</th><th>Count out of '.$total.'</th><th>Percentage</th></tr>';
echo '<tr bgcolor=wheat><td>Total final reports</td><td align=center>'.$final.'</td><td align=center>'.$final_perc.'</td></tr>';
echo '<tr bgcolor=wheat><td>Total interim reports</td><td align=center>'.$interim.'</td><td align=center>'.$interim_perc.'</td></tr>';
echo '</table>';
echo '<h3></h3>';


//////////////////////////////////////////// first signatory statistics /////////////////////////////////////////////////////////////

echo '<h2 style="page-break-before: always;"></h2>';

echo '<table border=1 style="border-collapse:collapse;">';
echo '<tr><th colspan=35 bgcolor=lightblue style=\'font-size:110%\'>CLINICAL CHEMISTRY SECTION, LABORATORY SERVICES, S.S.G. HOSPITAL and MEDICAL COLLEGE, BARODA</th></tr>';
echo '<tr><th colspan=35 bgcolor=lightgreen style=\'font-size:110%\'>First signatory statistics for the month of '.$month_name.' 20'.$yy.'</th></tr>';

echo '<tr>';

echo '<td><b>Signatory||Date-></b></td>';


for ( $dd=01; $dd<=$entered_month_days ; $dd ++) 
	{
	echo '	<td align=center><b>'.$dd.'</b></td>';
	}

echo '<td><b>Total</b></td><td align=center><b>%</b></td>';

echo '</tr>';


$sql= 'SELECT sign FROM `signature_authority` WHERE `sign` != \'Verification_pending\' AND `grade` > 0  order by `grade` DESC';
$result=mysql_query($sql,$link);

$counter=-1;

while ($ar=mysql_fetch_assoc($result))
{

//echo '<pre>';
//print_r($ar);
//echo '</pre>';

	foreach ($ar as $key => $value)   //for every signatory
	{

		// for total monthly verifications by a particular signatory
		$q1= 'SELECT count(sample_id) FROM `sample_verification` WHERE `sign_first`=\''.$ar['sign'].'\' and `sample_id` between \''.$yymm.'010001\' and \''.$yymm.'318000\' ';
		$q2=mysql_query($q1,$link);
		$q3=mysql_fetch_assoc($q2);
		//print_r($q3);

		if ($q3['count(sample_id)'] > 0)
		{

			echo '<tr>';

			// for background colour
			if ($counter<0){$td='<td bgcolor=lightyellow>';}else{$td='<td bgcolor=lightgray>';}
			if ($counter<0){$tdt='<td bgcolor=lightyellow align=center>';}else{$tdt='<td bgcolor=lightgray align=center>';}
		
			echo 	$td.$ar['sign'].'</td>';

			for ( $dd=01; $dd<=$entered_month_days ; $dd ++) 	// for every day of the entered month
			{

				//////// to convert 1 to 9 dates to 01 to 09
				$dd=str_pad((int) $dd,2,"0",STR_PAD_LEFT);

				$p1= 'SELECT count(sample_id) FROM `sample_verification` WHERE `sign_first`=\''.$ar['sign'].'\' and `sample_id` between \''.$yymm.$dd.'0000\' and \''.$yymm.$dd.'8000\' ';
				$p2=mysql_query($p1,$link);
				$p3=mysql_fetch_assoc($p2);
				//print_r($p3);
			
				echo 	$tdt.$p3['count(sample_id)'].'</td>';

			}


			// expressed as % of total verified samples
			$percent=$q3['count(sample_id)']*100/$r3['count(sample_id)'];
			$percent= number_format($percent, 1, '.', '');				// to convet 44.134222 % to 44.1 %


			echo $tdt.'<b>'.$q3['count(sample_id)'].'</b></td>';
			echo $tdt.'<font color=blue><b>'.$percent.'</b></font></td>';

			echo '</tr>';

			$counter=$counter*(-1);
		}
	}

}


echo '<tr><td align=right colspan=35><b>Total monthly verified samples = '.$r3['count(sample_id)'].'</b></td></tr>';

echo '</table>';


?>
