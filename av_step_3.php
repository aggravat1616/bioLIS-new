<?php

$link=mysql_connect('127.0.0.1','root','123');
/*
if($link==FALSE)
{
echo'fail to connect<br>';
}
else
{
echo'success<br>';
}
*/
$xx=mysql_select_db('biochemistry',$link);
/*
if($xx==FALSE)
{
echo'fail to connect<br>';
}
else
{
echo'success database<br>';
}

*/
session_start();
include 'common.php';
/*
echo '<pre>';
$result=mysql_query('select * from complain_box',$link);



while($ar=mysql_fetch_assoc($result))
{
print_r($ar);
}

echo'<pre>';

$r=mysql_query("insert into complain_box values('k')",$link);
print_r($r);
echo mysql_error();


echo '<form method=post action=complain_step_1.php>
Your complain:<br>
<textarea name=complain cols=40 rows=6></textarea><br>

<input type=submit value=submit>

</form>
';
*/



/*
make_sample_wise_worklist_get_id('<h1>write first and last sample_id of report to be autoverified for Critical Value reporting</h1>','av_step_1.php');

*/


/*
//$sample_id=$_POST['id1']

function av($sample_id,$linkkk)
{
	$sql=mysql_query('select * from sample where sample_id='.$sample_id.,$linkkk);

	$result=mysql_fetch_assoc($sql);
	print_r($result);
		if($result['code']=='CR')
			{
				if($result['result']>2)
					{echo('creatinine is HIGH');}
			}
}
	

*/



main_menu();




?>

