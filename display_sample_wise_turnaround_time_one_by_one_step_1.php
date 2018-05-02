<?php
session_start();

echo '<html>';
echo '<head>';

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


if(isset($_POST['submit']) && isset($_POST['sample_id']))
{
		if($_POST['submit']=='next')
		{
			$sample_id=$_POST['sample_id']+1;
		}
		if($_POST['submit']=='prev')
		{
			$sample_id=$_POST['sample_id']-1;
		}
	
		if($_POST['submit']=='next10')
		{
			$sample_id=$_POST['sample_id']+10;
		}
		if($_POST['submit']=='prev10')
		{
			$sample_id=$_POST['sample_id']-10;
		}
		
		if($_POST['submit']=='next100')
		{
			$sample_id=$_POST['sample_id']+100;
		}
		if($_POST['submit']=='prev100')
		{
			$sample_id=$_POST['sample_id']-100;
		}
		
		
		
		if($_POST['submit']=='next1000')
		{
			$sample_id=$_POST['sample_id']+1000;
		}
		if($_POST['submit']=='prev1000')
		{
			$sample_id=$_POST['sample_id']-1000;
		}
		
		
		
		if($_POST['submit']=='next10000')
		{
			$sample_id=$_POST['sample_id']+10000;
		}
		if($_POST['submit']=='prev10000')
		{
			$sample_id=$_POST['sample_id']-10000;
		}
		
		
		
		if($_POST['submit']=='next100000')
		{
			$sample_id=$_POST['sample_id']+100000;
		}
		if($_POST['submit']=='prev100000')
		{
			$sample_id=$_POST['sample_id']-100000;
		}
		
		if($_POST['submit']=='OK')
		{
			$sample_id=$_POST['sample_id'];
		}
		
}

else
{
	$sample_id=strftime("%y%m%d");
}
	

echo '<form method=post name=\'display_sample_wise_worklist_one_by_one_step_1.php\'>';
echo '<td><input type=hidden name=sample_id value=\''.$sample_id.'\'></td>';	

//echo '<tr><td><input type=submit value=prev100000 name=submit ></td></tr>';
//echo '<tr><td><input type=submit value=prev10000 name=submit ></td></tr>';
//echo '<tr><td><input type=submit value=prev1000 name=submit ></td></tr>';
//echo '<tr><td><input type=submit value=prev100 name=submit ></td></tr>';
//echo '<tr><td><input type=submit value=prev10 name=submit ></td></tr>';
echo '<tr><td><input type=submit value=prev name=submit ></td></tr>';
echo '<tr><td><input type=submit value=next name=submit ></td></tr>';
//echo '<tr><td><input type=submit value=next10 name=submit ></td></tr>';
//echo '<tr><td><input type=submit value=next100 name=submit ></td></tr>';
//echo '<tr><td><input type=submit value=next1000 name=submit ></td></tr>';
//echo '<tr><td><input type=submit value=next10000 name=submit ></td></tr>';
//echo '<tr><td><input type=submit value=next100000 name=submit ></td></tr>';

echo '</form>';

echo '<form method=post name=\'display_sample_wise_worklist_one_by_one_step_1.php\'>';
echo '<td><input type=text name=sample_id value=\''.$sample_id.'\' style=\'font-size:150%\' size=9></td></td>';	
echo '<tr><td><input type=submit value=OK name=submit ></td></tr>';
echo '</table></form>';

print_examinations_tt($sample_id);



////////////////////////////////////////////////////////////////////////////////////////////////////////////
 

function find_turnaround_time_sample($sample_id)
{
$link=start_nchsls();

$sql_tt='select sample_receipt_time from sample where sample_id=\''.$sample_id.'\'';
//echo $sql_tt;

$result_tt=mysql_query($sql_tt,$link);
$sample_r_t=mysql_fetch_assoc($result_tt);
$sample_receipt_time=$sample_r_t['sample_receipt_time'];


$x_tt='select sign, sign_time from sample_verification where sample_id=\''.$sample_id.'\'';
$sign_tt=mysql_query($x_tt,$link);
$sample_sign_t=mysql_fetch_assoc($sign_tt);
//print_r($sample_sign_t);
$sample_sign_time=$sample_sign_t['sign_time'];

$tt=get_time_difference($sample_receipt_time, $sample_sign_time);
return $tt_in_hours=ceil($tt['days']*24+$tt['hours']+($tt['minutes']/60));

}


/*//////////////////////////////////////////////////////////////////////////////////////////////////////////////

$link=start_nchsls();
$r= 'select sign from sample_verification where sample_id=\''.$sample_id.'\'';
$r1= mysql_query($r,$link);
$r2= mysql_fetch_assoc($r1);
//print_r($r2);

$sql_sample_data='select * from sample where sample_id='.$sample_id;

if(mysql_num_rows($result_sample_data=mysql_query($sql_sample_data,$link))!=1)
	{
	echo '<b>No such sample.</b>';
	}
else if($r2['sign']=='Verification_pending')
	{
	echo '<table><tr><td><b>Sample TAT: </b></td><td><b>Signatory verification pending</b></td></tr></table>';	
	}
else
	{
	echo '<table><tr><td><b>Sample TAT: </b></td><td><b>'.find_turnaround_time_sample($sample_id).' hours</b></td></tr></table>';	
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////*/


second_menu();


///////////////////////////////////////////////////////////////////////////////////////////////////////////////

echo '<h3>Screen for TAT between two sample_id</h3>';
	echo '<table>	
		<caption>Preferably run on back-up server</caption><form method=post action=\'display_sample_wise_turnaround_time_one_by_one_step_2.php\'>';
	
	echo '<tr>';
	echo '<td>from sample_id</td>';
	echo '<td><input type=text name=from_sample_id value=\''.strftime('%y%m%d').'\' style=\'font-size:150%\' size=9></td>';	
	echo '</tr>';
	
	echo '<tr>';
	echo '<td>to sample_id</td>';
	echo '<td><input type=text name=to_sample_id value=\''.strftime('%y%m%d').'\' style=\'font-size:150%\' size=9></td>';	
	echo '</tr>';
	
	echo '<tr><td><input type=submit value=OK name=submit></td></tr>';
	echo '</form></table>';

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>
