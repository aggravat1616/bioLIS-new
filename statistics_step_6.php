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

$yy=$_POST['yy'];
//echo $yy;


////////////////////////////////////////////////////////////////////////////////// check that the entered yy is proper

if (strlen($yy)>2)	// if more than 2 digit number is entered
{
	echo '<h3>Incorrect "yy" entry.</h3>';
	exit();
}

if($yy < 11)		// year before 2011
{
	echo '<h3>No record available.</h3>';
	exit();
}

$current_yy=strftime('%y');
//echo $current_yy;

if($yy > $current_yy)	// any future year
{
echo '<h3>You just entered year='.$yy.' !!!</h3>';
echo '<h3>The system is not aware of the future !</h3>';
exit();
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

echo '<table border=1 style="border-collapse:collapse;" align=center>';
echo '<tr><th colspan=25 bgcolor=lightblue style=\'font-size:120%\'>CLINICAL CHEMISTRY SECTION</th></tr>';
echo '<tr><th colspan=25 bgcolor=lightblue style=\'font-size:120%\'>LABORATORY SERVICES, S.S.G. HOSPITAL and MEDICAL COLLEGE, BARODA</th></tr>';
echo '<tr><th colspan=25 bgcolor=lightgreen style=\'font-size:120%\'>Annual statistics for the year of 20'.$yy.'</th></tr>';
echo '<tr bgcolor=gold><th><b>Month</b></th><th><b>Samples received</b></th><th><b>Tests performed</b></th></tr>';

$counter=-1;

for ( $mm=01; $mm<=12 ; $mm ++) 
	{
	//echo $mm;

	// to find name of month
	$month_name = date( 'F', mktime(0, 0, 0, $mm, 1) );
	//echo $month_name;

	//////// to convert 1 to 9 months to 01 to 09
	$mm=str_pad((int) $mm,2,"0",STR_PAD_LEFT);

	// for monthly sample total
	$s1= 'SELECT count(sample_id) FROM `sample` WHERE `sample_id` between \''.$yy.$mm.'010001\' and \''.$yy.$mm.'318000\'';
	//echo $z1;
	$s2=mysql_query($s1,$link);
	$s3=mysql_fetch_assoc($s2);
	//print_r($s3);

	// for monthly tests total
	$t1= 'SELECT count(name_of_examination) FROM `examination` WHERE `sample_id` between \''.$yy.$mm.'010001\' and \''.$yy.$mm.'318000\'';
	//echo $t1;
	$t2=mysql_query($t1,$link);
	$t3=mysql_fetch_assoc($t2);
	//print_r($t3);
	
	if ($counter<0){$td='<td bgcolor=lightyellow align=center>';}else{$td='<td bgcolor=lightgray align=center>';}

	echo '<tr>'.$td.$month_name.'</td>'.$td.$s3['count(sample_id)'].'</td>'.$td.$t3['count(name_of_examination)'].'</td></tr>';

	$counter=$counter*(-1);
	}

// for annual sample total
$ys1= 'SELECT count(sample_id) FROM `sample` WHERE `sample_id` between \''.$yy.'01010001\' and \''.$yy.'12318000\'';
//echo $ys1;
$ys2=mysql_query($ys1,$link);
$ys3=mysql_fetch_assoc($ys2);
//print_r($ys3);

// for annual test total
$yt1= 'SELECT count(name_of_examination) FROM `examination` WHERE `sample_id` between \''.$yy.'01010001\' and \''.$yy.'12318000\'';
//echo $yt1;
$yt2=mysql_query($yt1,$link);
$yt3=mysql_fetch_assoc($yt2);
//print_r($yt3);

echo '<tr bgcolor=gold align=center><td><b>Total</b></td><td><b>'.$ys3['count(sample_id)'].'</b></td><td><b>'.$yt3['count(name_of_examination)'].'</b></td></tr>';
echo '</table>';

?>
