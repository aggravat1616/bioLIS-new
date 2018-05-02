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

////////////////////////////////////////

// set desired least allowable sample_id for the day as $x1 and maximum allowable sample_id for the day as $x2 below.
$x1=strftime('%y%m%d0000');
$x2=strftime('%y%m%d7999');


/////////////for dividing & formatting sample_id in two parts
$number=$_POST['sample_id'];
list($s_id_date,$s_id_id) = str_split($number,6); 


//////////////////////////////////////

if($_POST['submit']=='Proceed')
{
	//echo $_POST['sample_id'];

	if(insert_sample($_POST['sample_id']))
	{
		insert_sample_verification($sample_id);
		edit_sample($_POST['sample_id'],'edit_request_step_3.php',' ');
	}
}


else if($_POST['sample_id'] < $x1 || $_POST['sample_id'] > $x2)
{
	echo '<h3><font color=red>Entered sample_id "<font color=black>'.$s_id_date.'</font><font color=green><u>'.$s_id_id.'</u></font><font color=red>" out of allowable range for the date.</font></font></h3>';

	echo '<h3><form method=post action=new_request_step_2.php>';
	echo '<input type=hidden name=sample_id value=\''.$_POST['sample_id'].'\'>';
	echo 'Please recheck... Otherwise... <input type=submit value=Proceed name=submit style=\'font-size:110%\'>';	
	echo '</form></h3>';
	
}


else
{

	if(insert_sample($_POST['sample_id']))
	{
		insert_sample_verification($_POST['sample_id']);
		edit_sample($_POST['sample_id'],'edit_request_step_3.php',' ');
	}

}


//////////////////////////////////////

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


//////////////////////////////////////


main_menu();


include 'notice.html';

?>
