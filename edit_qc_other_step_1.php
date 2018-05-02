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

///////iqc start/////////

include 'common.php';


function iqc()
{
	$link=start_nchsls();
	if(	$_POST['qc_id']>100000000 and 
		$_POST['qc_id']<999999999 and 
		$_POST['result']!=NULL and 
		$_POST['repeat']!=NULL)
	{
		$sql_qc_target = 'select * from qc_target_other where ex_code=\''.$_POST['ex_code'].'\' 
		and qc_type=format('.$_POST['qc_id'].'/100000000, 0)';
					//	echo $sql_qc_target;
		$result_qc_target=mysql_query($sql_qc_target,$link);
		if(!$result_qc_target){echo 'error at following sql:'.$sql_qc_target.mysql_error();}
		$array_qc_target=mysql_fetch_assoc($result_qc_target);
					//qc_id,repeat,ex_code,result
					$sql='insert into qc_other values(
					\''.$_POST['qc_id'].'\' ,				
					\''.$_POST['repeat'].'\' ,				
					\''.$_POST['ex_code'].'\' ,
					\''.$_POST['result'].'\' ,
					\''.$array_qc_target['target'].'\' ,
					\''.$array_qc_target['sd'].'\',
					\''.$_POST['comment'].'\' 
					)';
					//echo '<br>'.$sql;
		if(!mysql_query($sql,$link))
		{
			//echo '(insert)'.mysql_error();
			$sql_update=	'update qc_other set  
								result=\''.$_POST['result'].'\' ,  
								comment=\''.$_POST['comment'].'\'
								where 		
								qc_id=\''.$_POST['qc_id'].'\' and
								`repeat`=\''.$_POST['repeat'].'\' and
								ex_code=\''.$_POST['ex_code'].'\' 
								';
					//echo '<br>'.$sql_update;
			if(!mysql_query($sql_update,$link))
			{
				//echo '<br>(update)'.mysql_error();
			}
			else
			{
				 //echo '<br>(update)'.mysql_affected_rows($link);
			}
		}
		else
		{
			//echo '<br>(insert)'.mysql_affected_rows($link);
		}
					//print_r($data);
	}
	else 
	{
	echo 'Not a valid qc_id/qc_id field empty / result field empty/ repeat field empty';
	}		
	
}

if(!login_varify())
{
exit();
}

echo '<table  border=1>	
		<caption><h1>Write QC ID  and repeat number in the box</h1></caption><form method=post  action=edit_qc_other_step_1.php>';
	echo '<tr>';

	echo '<td>qc_id [Format=XYYMMDDHH] (9 digit)</td>';
	if(isset($_POST['qc_id']))
	{
		echo '<td><input type=text name=qc_id value='.$_POST['qc_id'].'></td>';	
	}
	else
	{
		echo '<td><input type=text name=qc_id ></td>';	
	}

	echo '<td>repeat</td>';
	if(isset($_POST['repeat']))
	{
		echo '<td><input type=text name=repeat value='.$_POST['repeat'].'></td>';
	}
	else
	{
		echo '<td><input type=text name=repeat ></td>';	
	}
	echo '</tr>';
	
	echo '<tr>';	
	echo '<td>ex_code</td>';
	echo '<td>';
	make_array("select distinct ex_code from qc_target_other", "ex_code","ex_code");
	echo '</td>';


	echo '<td>result</td>';
	echo '<td><input type=text name=result></td>';


	echo '<td>comment</td>';
	echo '<td><input type=text name=comment></td>';
	echo '</tr>';

	echo '<tr><td><input type=submit value=OK name=submit></td></tr>';
	echo '</form></table>';


if(	isset($_POST['qc_id'], 
		$_POST['result'], 
		$_POST['repeat']))
		{
			iqc();
		}

if(isset($_POST['qc_id']))
	{
	echo '<table border=1> <th colspan=12>Internal QC qc_id='.$_POST['qc_id'].' repeat=\'%\' ex_code=\'%\'</th>';
echo '<tr>
<td><tt>comment</tt></td>
<td><tt>qc_id</tt></td>
<td><tt>repeat</tt></td>
<td><tt>1_SD</tt></td>
<td><tt>target</tt></td>
<td><tt>result</tt></td>
<td><tt>xSD</tt></td>
<td><tt>ex_code</tt></td>
<td  align=right nowrap><tt>|__-4SD__||__-3SD__||__-2SD__||__-1SD__|</tt></TD>
<td  align=left nowrap> <tt>|__+1SD__||__+2SD__||__+3SD__||__+4SD__| </tt></TD>
</tr>
';
draw_qc_other($_POST['qc_id'],'%','%');
echo '</table>';
	}
//view_qc($_POST['qc_id'],$_POST['repeat']);
main_menu();
?>
