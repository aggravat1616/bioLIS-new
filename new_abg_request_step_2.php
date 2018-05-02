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

//////////////////////////////////////////////

// set desired least allowable ABG_id for the day as $x1 and maximum allowable sample_id for the day as $x2 below.
$x1=strftime('%y%m%d5000');
$x2=strftime('%y%m%d5100');


/////////////for dividing & formatting sample_id in two parts
	$number=$_POST['sample_id'];
	list($s_id_date,$s_id_id) = str_split($number,6);

//////////////////////////////////////////////


if($_POST['submit']=='Proceed')
{
	//echo $_POST['sample_id'];

	if(insert_sample($_POST['sample_id']))
	{
		insert_sample_verification($_POST['sample_id']);
		update_abg_sample($_POST['sample_id']);
		insert_single_examination($_POST['sample_id'],'101');
		insert_single_examination($_POST['sample_id'],'102');
		insert_single_examination($_POST['sample_id'],'103');
		insert_single_examination($_POST['sample_id'],'104');
		insert_single_examination($_POST['sample_id'],'105');
		//insert_single_examination($_POST['sample_id'],'106');
		insert_single_examination($_POST['sample_id'],'107');
		insert_single_examination($_POST['sample_id'],'108');
		insert_single_examination($_POST['sample_id'],'109');
		insert_single_examination($_POST['sample_id'],'110');
		insert_single_examination($_POST['sample_id'],'111');
		//insert_single_examination($_POST['sample_id'],'112');
		insert_single_examination($_POST['sample_id'],'113');
		insert_single_examination($_POST['sample_id'],'114');
		insert_single_examination($_POST['sample_id'],'115');
		insert_single_examination($_POST['sample_id'],'116');
		edit_sample($_POST['sample_id'],'edit_request_step_3.php',' ');
	}
}


else if($_POST['sample_id'] < $x1 || $_POST['sample_id'] > $x2)
{
	echo '<h3><font color=red>Entered ABG id "<font color=black>'.$s_id_date.'</font><font color=green><u>'.$s_id_id.'</u></font><font color=red>" out of allowable range for the date.</font></font></h3>';

	echo '<h3><form method=post action=new_abg_request_step_2.php>';
	echo '<input type=hidden name=sample_id value=\''.$_POST['sample_id'].'\'>';
	echo 'Please recheck... Otherwise... <input type=submit value=Proceed name=submit style=\'font-size:110%\'>';	
	echo '</form></h3>';
	
}


else
{

	if(insert_sample($_POST['sample_id']))
	{
		insert_sample_verification($_POST['sample_id']);
		update_abg_sample($_POST['sample_id']);
		insert_single_examination($_POST['sample_id'],'101');
		insert_single_examination($_POST['sample_id'],'102');
		insert_single_examination($_POST['sample_id'],'103');
		insert_single_examination($_POST['sample_id'],'104');
		insert_single_examination($_POST['sample_id'],'105');
		//insert_single_examination($_POST['sample_id'],'106');
		insert_single_examination($_POST['sample_id'],'107');
		insert_single_examination($_POST['sample_id'],'108');
		insert_single_examination($_POST['sample_id'],'109');
		insert_single_examination($_POST['sample_id'],'110');
		insert_single_examination($_POST['sample_id'],'111');
		//insert_single_examination($_POST['sample_id'],'112');
		insert_single_examination($_POST['sample_id'],'113');
		insert_single_examination($_POST['sample_id'],'114');
		insert_single_examination($_POST['sample_id'],'115');
		insert_single_examination($_POST['sample_id'],'116');
		edit_sample($_POST['sample_id'],'edit_request_step_3.php',' ');
	}

}


////////////////////////////////////////// used functions -->

function insert_sample_verification($sample_id)
{
$link=start_nchsls();
if(! mysql_query('insert into sample_verification (sample_id) value (\''.$_POST['sample_id'].'\')',$link))
    {

        echo mysql_error();
        return FALSE;
    }
	return TRUE;
}

////////////////////////////////////////////

function update_abg_sample($sample_id)
{
$link=start_nchsls();

$csql='select * from sample where sample_id=\''.$sample_id.'\'';
$cresult=mysql_query($csql,$link);
$ar=mysql_fetch_assoc($cresult);
//echo '<pre>';
//print_r($ar);
//echo '</pre>';

$sql='update sample set ';


	foreach ($ar as $key => $value)
	{
		if($key=='sample_id')
		{
		$sql=$sql.' '.$key.'=\''.$sample_id.'\' , ';
		}
		
		else if($key=='sample_type')
		{
			$sql=$sql.' '.$key.'=\''.'Blood(Arterial)'.'\' , ';
		}
		
		else if($key=='preservative')
		{
			$sql=$sql.' '.$key.'=\''.'Heparin'.'\' , ';
		}
		else
		{
		$sql=$sql.' '.$key.'=\''.$value.'\' , ';	
		}
	}

$sql=substr($sql,0,-2);
$sql=$sql.' where sample_id= \''.$sample_id.'\'';
//echo $sql;

if(!mysql_query($sql,$link)){echo mysql_error();}


}

/////////////////////////////////////////////


main_menu();


include 'notice.html';

?>
