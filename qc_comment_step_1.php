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

function comment_qc($qc_id,$rpt,$ex_code,$disabled)
{
	$link=start_nchsls();
	
		$sql_qc = 
		'SELECT 
		comment,
	reverse(SUBSTRING(\'111111111|222222222|333333333|4444444444\',1,-10*format((result-target)/sd,1)) ) 	Nsd, 
	SUBSTRING(\'111111111|222222222|333333333|4444444444\',1,10*format((result-target)/sd,1) ) Psd,
		ex_code,
		qc_id,`repeat`,sd,target,result,format((result-target)/sd,1)
		FROM 	`qc` 
		where  
		qc_id like \''.$qc_id.'\' and `repeat` like \''.$rpt.'\' and ex_code like \''.$ex_code.'\'
		order by ex_code, qc_id
		';
//////////
	echo '<form method=post action=qc_comment_step_1.php>';
	echo '<table border=1> <th colspan=12>Internal QC qc_id='.$qc_id.' repeat=\'%\' ex_code=\'%\'</th>';
	echo '<tr><td><input type=submit value=Save_Comments name=submit></td></tr>';
	echo '<tr>
	<td><tt>comment</tt></td>
	<td  align=right nowrap><tt>|__-4SD__||__-3SD__||__-2SD__||__-1SD__|</tt></TD>
	<td  align=left nowrap> <tt>|__+1SD__||__+2SD__||__+3SD__||__+4SD__| </tt></TD>
	<td><tt>ex_code</tt></td>
	<td><tt>qc_id</tt></td>
	<td><tt>repeat</tt></td>
	<td><tt>1_SD</tt></td>
	<td><tt>target</tt></td>
	<td><tt>result</tt></td>
	<td><tt>xSD</tt></td>
	
	
	</tr>
	';

///////////
	$result_qc=mysql_query($sql_qc,$link);
	while($array_qc=mysql_fetch_assoc($result_qc))
	{
		if($array_qc['result']!=NULL)
		{
			echo '<tr>';
			foreach ($array_qc as $key => $value)
			{
				if ($key=='Nsd')
				{
					echo '<td align=right><tt>'.$value.'</TT></td>';
				}
				else if ($key=='Psd')
				{
					echo '<td align=left><TT>'.$value.'</TT></td>';
				}
				else if ($key=='comment')
				{
echo '<td align=left><TT><input type=text value=\''.$value.'\' '.$disabled.
		' name=\'comment_'.$array_qc['ex_code'].'_'.$array_qc['qc_id'].'_'.$array_qc['repeat'].'\'></TT></td>';
					
				}
				else
				{
					echo '<td><tt>'.$value.'</tt></td>';
				}
			}
			echo '</tr>';
		}
	}	
	echo '<tr><td><input type=hidden value='.$qc_id.' name=qc_id></td></tr>';

	echo '</table>';
	echo '</form>';

}




function iqc($qc_id,$post_array)
{
	$link=start_nchsls();
	foreach ($post_array as $key=>$value)
		{
		$exp=explode("_",$key);
		if($exp[0]=='comment')
			{
	
			$sql_update=	'update qc set  
								comment=\''.$value.'\'
								where 		
								qc_id=\''.$exp[2].'\' and
								`repeat`=\''.$exp[3].'\' and
								ex_code=\''.$exp[1].'\' 
								';
					//echo '<br>'.$sql_update;
			if(!mysql_query($sql_update,$link))
			{
				echo '<br>(update)'.mysql_error();
			}
			else
			{
				// echo '<br>(update)'.mysql_affected_rows($link);
			}
			}
		
		}
}
		


if(!login_varify())
{
exit();
}

echo '<table  border=1>	
		<caption><h1>Miura-300: Give QC ID to comment on</h1></caption><form method=post  action=qc_comment_step_1.php>';
	echo '<tr>';
		echo '<td>qc_id [Format=XYYMMDDHH] (9 digit)</td>';
		echo '<td><input type=text name=qc_id ></td>';	
	echo '</tr>';
	echo '<tr><td><input type=submit value=OK name=submit></td></tr>';
	echo '</form></table>';

if(isset($_POST['qc_id']))
	{
	iqc($_POST['qc_id'],$_POST);
	if($_POST['submit']=='Save_Comments')
		{
		comment_qc($_POST['qc_id'],'%','%','disabled');
		}
	else
		{
		comment_qc($_POST['qc_id'],'%','%','');
		}
	}
	
main_menu();
?>
