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
echo '<td><input type=text name=sample_id value=\''.$sample_id.'\' style=\'font-size:150%\' size=9></td>';	
echo '<tr><td><input type=submit value=OK name=submit ></td></tr>';
echo '</form>';

make_sample_wise_worklist_print_single($sample_id);

main_menu();
?>
