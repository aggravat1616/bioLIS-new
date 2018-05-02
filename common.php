<?php 

include 'autoverify_common.php';

function login()
{
echo '
<form method=post action=main_menu.php>
<table bgcolor=lightblue>
<tr><th colspan=50><h1>Clinical Chemistry Section</h1></td></tr>
<tr><th colspan=50><h1>Laboratory Services, S.S.G.Hospital and Medical College, Baroda</h1></td></tr>
</table>
<table border=0 style="border-collapse:collapse;  margin-top:30px">
<tr>
<td>Login Name</td>
<td><input type=text name=login value=></td>
</tr>
<tr>
<td>Password</td>
<td><input type=password name=password></td>
</tr>
<tr>
<td><input type=submit name=action value=Login></td>
</tr>
</table>



</form> ';
}

function logout()
{
echo '
<form method=post action=main_menu.php>
<table>
<tr>
<td>Login Name</td>
<td><input type=text name=login value=WriteLoginName></td>
</tr>
<tr>
<td>Password</td>
<td><input type=password name=password value=password></td>
</tr>
<tr>
<td><input type=submit name=action value=Login></td>
</tr>
</table>
</form> ';
}
/////////////////////////////////
function login_varify()
{
return mysql_connect('127.0.0.1',$_SESSION['login'],$_SESSION['password']);
}

/////////////////////////////////
function select_nchsls($link)
{
	return mysql_select_db('biochemistry',$link);
}

///////////////////////////////////
function start_nchsls()
{
	if(!$link=login_varify())
	{
		exit();
	}


	if(!select_nchsls($link))
	{
		exit();
	}
return $link;
}


function main_menu()
{

///////////// for top fixed bar --> link to CSS stylesheet
echo '<link rel="stylesheet" type="text/css" href="menu.css" media="screen" />';

echo '
	<div id="navwrapper">
	<ul id="nav" class="floatright">
	<li>'.$_SESSION['login'].'</li>
	<li>|</li>
	<li><A HREF=logout.php>Log-out</A></li>
	</ul>
	</div>
';


	if ($_SESSION['login']=='doctor')
	{
		echo '	
		
		<table align=center border=1 bgcolor=lightblue>
		<th colspan=6>CLINICAL CHEMISTRY SECTION, LABORATORY SERVICES, S.S.G. HOSPITAL and MEDICAL COLLEGE, BARODA</th>
		<tr>
			<td valign=top>
			<table  border=0 bgcolor=lightyellow><th><a href=single_report_step_1_doctor.php>View report by laboratory accession number</a></th></table>
			</td>
			<td valign=top>
			<table  border=0 bgcolor=lightyellow><th><a href=search_sample_step_1_doctor.php>Search report</a></th></table>
			</td>
			<td valign=top>
			<table  border=0 bgcolor=lightyellow><th><a href=doctor_announcements.php>Announcements</a></th></table>
			</td>
			<td valign=top>
			<table  border=0 bgcolor=lightyellow><th><a href=doctor_know_lab.php>Know the laboratory</a></th></table>
			</td>
			<td valign=top>
			<table  border=0 bgcolor=lightyellow><th><a href=complain_step_1.php>Feedback-complain</a></th></table>
			</td>
			<td valign=top>
			<table  border=0 bgcolor=lightyellow><th><a href=doctor_help.php>Help</a></th></table>
			</td>
		</tr>
	
	</table>';

	}
	else
	{


	echo '	

<table align=center border=0 bgcolor=lightpink>
<tr><th colspan=10 bgcolor=lightgrey style=\'font-size:120%\'>CLINICAL CHEMISTRY SECTION, LABORATORY SERVICES, S.S.G. HOSPITAL and MEDICAL COLLEGE, BARODA</th></tr>
<th colspan=10>
Main Menu
<a href=second_menu.php>Second Menu</a>
<a href=QC_query.php target="_blank">QC Targets</a>
<a href="CCLSSGH/Biochemistry/Documents/Internal_Documents/SOP/" target="_blank">SOP</a>
<a href="CCLSSGH/Biochemistry/Documents/Internal_Documents/WDI/" target="_blank">WDI</a>
<a href="CCLSSGH/Biochemistry/Documents/External_Documents/Kit_literature/" target="_blank">Kit Literature</a>
<a href="CCLSSGH/Biochemistry/Documents/Internal_Documents/LIS user-manual/LIS user-manual.odt" target="_blank">USER Manual</a>

</th>

			<tr>
				<td valign=top>
					<table  border=1 bgcolor=lightblue><th>New Request</th>	
					<tr><td><a href=new_request_step_1.php>New</a></td></tr>
					<tr><td><a href=serum_to_fluoride_copy_step_1.php>New [Copy to Fluoride]</a></td></tr>
					<tr><td><a href=fluoride_to_serum_copy_step_1.php>New [Copy to Serum]</a></td></tr>
					<tr><td><a href=new_abg_request_step_1.php>New ABG</a></td></tr>
					</table>
				</td>
				<td valign=top>
					<table  border=1 bgcolor=lightgreen><th>Edit Request</th>		
					<tr><td><a href=edit_request_step_1.php>Edit</a></td></tr>
					<tr><td><a href=delete_examination_step_1.php>Delete examination</a></td></tr>
					<tr><td><a href=delete_entire_request_step_1.php>Delete a sample ID</a></td></tr>
					<tr><td></td></tr>
					</table>
				</td>
				<td valign=top>
					<table  border=1 bgcolor=lightblue><th>Worklist</th>		
					<tr><td><a href=LIS_send_sample_to_miura.php>Send sample to Miura</a></td></tr>
					<tr><td><a href=display_sample_wise_worklist_one_by_one_step_1.php>Sample wise worklist one by one</a></td></tr>
					<tr><td><a href=make_examination_wise_worklist_step_1.php>Examination wise work list</a></td></tr>
					<tr><td><a href=make_sample_wise_worklist_step_1.php>Sample wise work list</a></td></tr>
					</table>
				</td>
				<td valign=top>
					<table  border=1 bgcolor=lightgreen><th>Results</th>		
					<tr><td><a href=import_results_step_1.php>Import results from Miura</a></td></tr>
					<tr><td><a href=examination_wise_results_step_1.php>Examination wise result entry</a></td></tr>
					<tr><td><a href=from_to_calculate_step_1.php>Calculate</td></tr>
					<tr><td><a href=from_to_report_problems_step_1.php>Autoverify</a></td></tr>
					<tr><td><a href=autoverify_step_1.php>Critical Alert</a></td></tr>
					</table>
				</td>
				<td valign=top>
					<table  border=1 bgcolor=lightblue><th>Reports</th>	
					<tr><td><a href=single_report_step_1.php>Single report</a></td></tr>
					<tr><td><a href=from_to_report_step_1.php>Reports from_ to_</a></td></tr>
					<tr><td><a href=search_sample_step_1.php>Search</a></td></tr>		
					<tr><td><a href=verify_report_technician_step_1.php>Verify [Technician]</a></td></tr>		
					<tr><td><a href=verify_report_signatory_step_1.php>Verify [Signatory]</a></td></tr>
					</table>
				</td>
				<td valign=top>
					<table  border=1 bgcolor=lightgreen><th>IQC-Miura</th>	
					<tr><td><a href=import_qc_step_1.php>Import</a></td></tr>
					<tr><td><a href=edit_qc_step_1.php>Insert/Edit QC</a></td></tr>
					<tr><td><a href=qc_comment_step_1.php>Comment on results</a></td></tr>
					<tr><td><a href=draw_text_lj.php>View LJ Chart</a</td></tr>
					<th>IQC- Other</th>
					<tr><td><a href=edit_qc_other_step_1.php>Insert/Edit QC</a></td></tr>
					<tr><td><a href=qc_comment_other_step_1.php>Comment on results</a></td></tr>
					<tr><td><a href=draw_text_lj_other.php>View LJ Chart</a</td></tr>
					</table>
				</td>
			</tr>
		</table>';
	

	}
}


function second_menu()
{

///////////// for top fixed bar --> link to CSS stylesheet
echo '<link rel="stylesheet" type="text/css" href="menu.css" media="screen" />';

echo '
	<div id="navwrapper">
	<ul id="nav" class="floatright">
	<li>'.$_SESSION['login'].'</li>
	<li>|</li>
	<li><A HREF=logout.php>Log-out</A></li>
	</ul>
	</div>';

	if ($_SESSION['login']=='doctor')
	{
		echo '	
		
		<table align=center border=1 bgcolor=lightblue>
		<th colspan=6>CLINICAL CHEMISTRY SECTION, LABORATORY SERVICES, S.S.G. HOSPITAL and MEDICAL COLLEGE, BARODA</th>
		<tr>

			<td valign=top>
			<table  border=0 bgcolor=lightyellow><th><a href=single_report_step_1_doctor.php>View report by laboratory accession number</a></th></table>
			</td>
			<td valign=top>

			<table  border=0 bgcolor=lightyellow><th><a href=search_sample_step_1_doctor.php>Search report</a></th></table>
			</td>
			<td valign=top>
			<table  border=0 bgcolor=lightyellow><th><a href=doctor_announcements.php>Announcements</a></th></table>
			</td>

			<td valign=top>
			<table  border=0 bgcolor=lightyellow><th><a href=doctor_know_lab.php>Know the laboratory</a></th></table>
			</td>
			<td valign=top>
			<table  border=0 bgcolor=lightyellow><th><a href=complain_step_1.php>Feedback-complain</a></th></table>

			</td>
			<td valign=top>
			<table  border=0 bgcolor=lightyellow><th><a href=doctor_help.php>Help</a></th></table>
			</td>
		</tr>
		</table>';
	}
	else
	{
	
	echo '	
</td>
<table align=center border=0 bgcolor=lightpink>
<tr><th colspan=10 bgcolor=lightgrey style=\'font-size:120%\'>CLINICAL CHEMISTRY SECTION, LABORATORY SERVICES, S.S.G. HOSPITAL and MEDICAL COLLEGE, BARODA</th></tr>
<th colspan=10>
<a href=main_menu_from_second.php>Main Menu</a>
Second Menu
<a href=QC_query.php target="_blank">QC Targets</a>
<a href="CCLSSGH/Biochemistry/Documents/Internal_Documents/SOP/" target="_blank">SOP</a>
<a href="CCLSSGH/Biochemistry/Documents/Internal_Documents/WDI/" target="_blank">WDI</a>
<a href="CCLSSGH/Biochemistry/Documents/External_Documents/Kit_literature/" target="_blank">Kit Literature</a>
<a href="CCLSSGH/Biochemistry/Documents/Internal_Documents/LIS user-manual/LIS user-manual.pdf" target="_blank">USER Manual</a>
</th>
				<tr>
				<td valign=top>
					<table  border=1 bgcolor=lightblue><th>Miscellaneous</th>
					<tr><td><a href="from_to_report_for_file_step_1.php" target="_blank">Report summary for file</a></td></tr>
					<tr><td><a href=qc_print_step_1.php>Print LJ chart</a></td></tr>
					<tr><td><a href=view_z_step_1.php>View "Z" results</a></td></tr>
					<tr><td><a href=scope_query.php>Laboratory test scope</a></td></tr>
					<tr><td><a href=check_threat.php>Check threat</a></td></tr>
					</table>
				<td valign=top>
					<table  border=1 bgcolor=lightgreen><th>Quality Indicators</th>		
					<tr><td><a href=get_monthly_qc_data.php>IQC data (Monthly summary)</a</td></tr>
					<tr><td><a href="CCLSSGH/Biochemistry/Records/EQA_results" target="_blank">EQA data</a></td></tr>
					<tr><td><a href=display_sample_wise_turnaround_time_one_by_one_step_1.php>Turnaround time-(Sample-wise)</a></td></tr>
					<tr><td><a href=turn_aroundtime_step_1.php>Turnaround time-(Examination-wise)</a></td></tr>
					<tr><td><a href=complain_action_step_1.php>Feedback-Complains</a></td></tr>
					<tr><td><a href=statistics_step_1.php>Statistics</a></td></tr>
					</table>
				</td>				
				<td valign=top>
					<table  border=1 bgcolor=lightblue><th>Documents and records</th>	
					<tr><td><a href=CCLSSGH target="_blank">View</a></td></tr>
					<tr><td><a href=dir_list.php>Directory structre</a></td></tr>
					<tr><td><a href=upload_step_1.php>Upload</a></td></tr>
					</table>
				</td>
			</tr>
		</table>';
	
	
	}
}


function enter_block()
{
echo '<SCRIPT LANGUAGE="javascript">'; 
echo 'function testForEnter() ';
echo '{    ';
echo '	if (event.keyCode == 13) ';
echo '	{        ';
echo '		event.cancelBubble = true;';
echo '		event.returnValue = false;';
echo '         }';
echo '} ';
echo '</SCRIPT> ';
}





function edit_vcarchar30($fld)
{

$link=start_nchsls();
$sql='select '.$fld.' from '.$fld;
$result=mysql_query($sql,$link);
 
while ($ops=mysql_fetch_assoc($result))
{
	
	$ar[]=$ops[$fld];

}

return $ar;

}


function make_select_from_array($ar,$display_name)
{
echo '<select  name='.$display_name.'>';

		foreach ($ar as $key => $value)
		{
				echo '<option  > '.$value.' </option>';
		}
	
		echo '</select>';

}



function make_array($sql_str, $fld,$display_name)
{

$link=start_nchsls();

//$sql='select ex_code from qc_target';
$result=mysql_query($sql_str,$link);
 
while ($ops=mysql_fetch_assoc($result))
{
	$ar[]=$ops[$fld];
}


echo '<select  name='.$display_name.'>';

		foreach ($ar as $key => $value)
		{
				echo '<option  > '.$value.' </option>';
		}
	
		echo '</select>';

}

function make_array_with_persantage($sql_str, $fld,$display_name)
{

$link=start_nchsls();

//$sql='select ex_code from qc_target';
$result=mysql_query($sql_str,$link);
 
while ($ops=mysql_fetch_assoc($result))
{
	$ar[]=$ops[$fld];
}


echo '<select  name='.$display_name.'>';

		echo '<option  >%</option>';
		foreach ($ar as $key => $value)
		{
				echo '<option  > '.$value.' </option>';
		}
	
		echo '</select>';

}


function mk_option($fld,$dflt,$disabled)
{	
		$ar=edit_vcarchar30($fld);


		echo '<select  '.$disabled.' name='.$fld.'>';
		foreach ($ar as $key => $value)
		{
		if($value==$dflt)
		{
			echo '<option selected  > '.$value.' </option>';
		}
		else
			{
				echo '<option  > '.$value.' </option>';
			}
		}
	
		echo '</select>';
	
}

function read_sample_id($title,$filename)
{
	echo '<table  border=1>	
		<caption>'.$title.'</caption><form method=post   action=\''.$filename.'\'>';
	echo '<tr>';
	echo '<td>sample_id</td>';
	echo '<td><input type=text name=sample_id value=\''.strftime('%y%m%d').'\' style=\'font-size:150%\' size=9></td>';	
	echo '</tr>';
	echo '<tr><td><input type=submit value=OK name=submit></td></tr>';
	echo '</form></table>';
}

function read_sample_id_copy($title,$filename)
{
	echo '<table  border=1>	
		<caption>'.$title.'</caption><form method=post action=\''.$filename.'\'>';
	
	echo '<tr>';
	echo '<td>COPY from SERUM sample_id</td>';
	echo '<td><input type=text name=copy_sample_id value=\''.strftime('%y%m%d').'\' style=\'font-size:150%\' size=9></td>';	
	echo '</tr>';
	
	echo '<tr>';
	echo '<td>PASTE to FLUORIDE sample_id</td>';
	echo '<td><input type=text name=paste_sample_id value=\''.strftime('%y%m%d').'\' style=\'font-size:150%\' size=9></td>';	
	echo '</tr>';
	
	echo '<tr><td><input type=submit value=OK name=submit></td></tr>';
	echo '</form></table>';
}


function read_sample_id_copy_F($title,$filename)
{
	echo '<table  border=1>	
		<caption>'.$title.'</caption><form method=post action=\''.$filename.'\'>';
	
	echo '<tr>';
	echo '<td>COPY from FLUORIDE sample_id</td>';
	echo '<td><input type=text name=copy_sample_id value=\''.strftime('%y%m%d').'\' style=\'font-size:150%\' size=9></td>';	
	echo '</tr>';
	
	echo '<tr>';
	echo '<td>PASTE to SERUM sample_id</td>';
	echo '<td><input type=text name=paste_sample_id value=\''.strftime('%y%m%d').'\' style=\'font-size:150%\' size=9></td>';	
	echo '</tr>';
	
	echo '<tr><td><input type=submit value=OK name=submit></td></tr>';
	echo '</form></table>';
}




function make_sample_wise_worklist_get_id($title,$filename)
{
	echo '<table  border=1>	
		<caption>'.$title.'</caption><form method=post action=\''.$filename.'\'>';
	
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
}


function make_sample_wise_worklist_print($from_sample_id,$to_sample_id)
{
		$link=start_nchsls();
		$start_sample_id=$from_sample_id;
		
		$counter=1;
		$tr=' ';

echo '<table >';

		  $tr='  ';
		  
		  
		while($start_sample_id<=$to_sample_id)   //TAKE SAMPLE ID ONE BY ONE
		{
			echo $tr.'<td valign=top>';
			$sql='select * from examination where sample_id=\''.$start_sample_id.'\'';
			$result=mysql_query($sql,$link);
			
			echo '<table>';
			echo '<tr><td colspan=2 align=left>-----['.$start_sample_id.']-----<td>';
			
			
			while($post_array=mysql_fetch_assoc($result))  //take examinations one by on
			{
				
				echo '<tr></tr><td>'.$post_array['name_of_examination'].'</td><td>'.$post_array['code'].'</td>';
			}
			echo '</table>';
			
			$start_sample_id=$start_sample_id+1;
			$counter++;
			if($counter==4){$counter=1;$tr='<tr>';}else{$tr=' ';}
		}

echo '</table>';				
}




function print_examination_wise_turnaround_time($from_sample_id,$to_sample_id,$examination_id)
{
$link=start_nchsls();
$sql_exam='select name_of_examination,code from scope where id=\''.$examination_id.'\'';
$result_exam=mysql_query($sql_exam,$link);
$exam_array=mysql_fetch_assoc($result_exam);
echo '<H1>Turnaround time for '.$exam_array['name_of_examination'].'--'.$exam_array['code'].'</H1>';

$sql='select name_of_examination,sample_id,id from examination where sample_id between \''.$from_sample_id.'\' and \''.$to_sample_id.'\' and id=\''.$examination_id.'\'';
//echo $sql;
$result=mysql_query($sql,$link);
$tr=' ';$counter=0;
echo '<table border=1>';
echo '<tr><td>sample_id</td><td>name_of_examinaion</td><td>turn around time in hours</td></tr>';
while($ar=mysql_fetch_assoc($result))  
			{
				echo '<tr><td>'.$ar['sample_id'].'</td><td>'.$ar['name_of_examination'].'</td><td>'.find_turnaround_time($ar['sample_id'],$ar['id']).'</td></tr>';
			}		
echo '</table>';
}


function make_examination_wise_worklist_print($from_sample_id,$to_sample_id,$examination_id)



{
$link=start_nchsls();
$sql_exam='select name_of_examination,code from scope where id=\''.$examination_id.'\'';
$result_exam=mysql_query($sql_exam,$link);
$exam_array=mysql_fetch_assoc($result_exam);
echo $exam_array['name_of_examination'].'--'.$exam_array['code'].'<br>';

$sql='select sample_id,result from examination where sample_id between \''.$from_sample_id.'\' and \''.$to_sample_id.'\' and id=\''.$examination_id.'\'';
//echo $sql;
$result=mysql_query($sql,$link);
$tr=' ';$counter=0;
echo '<table>';
while($post_array=mysql_fetch_assoc($result))  
			{
				echo $tr.'<td>['.$post_array['sample_id'].']</td><td>_____'.$post_array['result'].'______</td>';
				$counter++;$tr=' ';
				if($counter==4){$tr='<tr>';$counter=0;}
			}		
echo '</table>';
}


function enter_examination_wise_result($from_sample_id,$to_sample_id,$examination_id,$filename)
{
$link=start_nchsls();
$sql_exam='select name_of_examination,code,id from scope where id=\''.$examination_id.'\'';
$result_exam=mysql_query($sql_exam,$link);
$exam_array=mysql_fetch_assoc($result_exam);

$sql='select sample_id,result from examination where sample_id between \''.$from_sample_id.'\' and \''.$to_sample_id.'\' and id=\''.$examination_id.'\'';
//echo $sql;
$result=mysql_query($sql,$link);
$tr=' ';$counter=0;
echo '<table  border=1>	
		<caption>Enter results</caption><form method=post action=\''.$filename.'\'>';
	echo 'Examination Name:<input type=text readonly name=name_of_examination value=\''.$exam_array['name_of_examination'].'\'>';
echo 'code:<input type=text readonly name=code value=\''.$exam_array['code'].'\'>';
echo 'examination_id:<input type=text readonly name=id value=\''.$exam_array['id'].'\'>';

while($post_array=mysql_fetch_assoc($result))  
			{
				echo $tr.'<td>['.$post_array['sample_id'].']</td><td><input type=text value=\''.$post_array['result'].'\' '.' name=\''.$post_array['sample_id'].'\'</td>';
				$counter++;$tr=' ';
				if($counter==4){$tr='<tr>';$counter=0;}
			}
			
echo '<tr><td>
		<input type=submit value=save name=results></td></tr>';
		
echo '</table>';
echo '</form>';
}


function view_examination_wise_result($from_sample_id,$to_sample_id,$examination_id)
{
$link=start_nchsls();
$sql_exam='select name_of_examination,code,id from scope where id=\''.$examination_id.'\'';
$result_exam=mysql_query($sql_exam,$link);
$exam_array=mysql_fetch_assoc($result_exam);

$sql='select sample_id,result from examination where sample_id between \''.$from_sample_id.'\' and \''.$to_sample_id.'\' and id=\''.$examination_id.'\'';
//echo $sql;
$result=mysql_query($sql,$link);
$tr=' ';$counter=0;
echo '<table  border=1>	
		<caption>Entered results</caption>';
		//<form method=post action=\''.$filename.'\'>';
	echo 'Examination Name:<input type=text readonly name=name_of_examination value=\''.$exam_array['name_of_examination'].'\'>';
echo 'code:<input type=text readonly name=code value=\''.$exam_array['code'].'\'>';
echo 'examination_id:<input type=text readonly name=id value=\''.$exam_array['id'].'\'>';

while($post_array=mysql_fetch_assoc($result))  
			{
				echo $tr.'<td>['.$post_array['sample_id'].']</td><td><input readonly type=text value=\''.$post_array['result'].'\' '.' name=\''.$post_array['sample_id'].'\'</td>';
				$counter++;$tr=' ';
				if($counter==4){$tr='<tr>';$counter=0;}
			}
			
//echo '<tr><td>	<input type=submit value=save name=results></td></tr>';
		
echo '</table>';
}




function update_result_examination_wise($post_array)
{
$link=start_nchsls();
echo '<table border=1>';
		  
	foreach ($post_array as $key => $value)
	{
		if(is_numeric($key))
		{

		$r='select sign from sample_verification where sample_id=\''.$key.'\'';
		$r1=mysql_query($r,$link);
		$r2=mysql_fetch_assoc($r1);
		//print_r($r2);
		if($r2['sign']=='Verification_pending')
			{

			$sql='update examination set result=\''.$value.'\' , details=\''.strftime('%Y-%m-%d %H:%M:%S').'\' where sample_id=\''.$key.'\' and id=\''.$post_array['id'].'\'';
			//echo $sql;
			//echo '<br>';
			if(!mysql_query($sql,$link))
				{
					echo mysql_error();
				}
			else
				{
				echo '<tr><td>'.$key.'</td><td>'.$value.'</td></tr>';
				}

			}	else	{echo '<tr><td>'.$key.'</td><td><font color=red>Not allowed. Sample is verified.</font></td></tr>';}
		} 
			
		else
			{
			echo '<b><i>'.$key.': </b></i><b><i><font color=blue>'.$value.' </font></b></i>';
			}
	}

echo '</table>';	
}


function make_sample_wise_worklist_print_single($sample_id)
{
		$link=start_nchsls();
		  
		
			$sql='select * from examination where sample_id=\''.$sample_id.'\'';
			$result=mysql_query($sql,$link);
			
			echo '<table>';
			echo '<tr><td colspan=2 align=left>-----['.$sample_id.']-----<td>';
			
			
			while($post_array=mysql_fetch_assoc($result))  //take examinations one by on
			{
				
				echo '<tr><td>'.$post_array['name_of_examination'].'</td><td>'.$post_array['code'].'</td><td>'.$post_array['result'].'</td></tr>';
			}
			
			echo '</table>';
}

function read_qc($qc_id,$ex_code)
{
		$link=start_nchsls();
		$sql='select * from qc where qc_id=\''.$qc_id.'\' and ex_code=\''.$ex_code.'\'';
		$result=mysql_query($sql,$link);
		while($qc_array=mysql_fetch_assoc($result))
		{
			//echo '<pre>-----------------------------';
			//print_r($qc_array);
			//echo '</pre>';
$sql_target='select * from qc_target where ex_code=\''.$qc_array['ex_code'].'\' and qc_type=\''.(int)($qc_array['qc_id']/10000000).'\'';
//echo $sql_target;

		$result_target=mysql_query($sql_target,$link);
		while($target_array=mysql_fetch_assoc($result_target))
			{
			//echo '<pre>';
			//print_r($target_array);
			//echo '</pre>';
			//echo 	' qc_id='	.$qc_array['qc_id'].
			//	' ex_code='	.$qc_array['ex_code'].
			//	' result='	.$qc_array['result'].
			//	' target='	.$target_array['target'].
			//	' sd='		.$target_array['sd'].'<br>';
			array($qc_array['qc_id'],$qc_array['ex_code'],$qc_array['result'],$target_array['target'],$target_array['sd']);			
			}
		}
		
	
}


function insert_sample($sample_id)
{
$link=start_nchsls();
if(! mysql_query('insert into sample (sample_id,sample_receipt_time,patient_id) values (\''.$sample_id.'\',\''.strftime("%d-%m-%Y, %H:%M").'\',\'\')',$link))
    {

        echo mysql_error();
        return FALSE;
    }
	return TRUE;
}



function edit_sample($sample_id,$filename,$disabled)
{
$link=start_nchsls();
$sql='SHOW COLUMNS FROM sample';
$result=mysql_query($sql,$link);
$sql_sample_data='select * from sample where sample_id='.$sample_id;

if(mysql_num_rows($result_sample_data=mysql_query($sql_sample_data,$link))!=1){echo 'No such sample.';return FALSE;}
$sample_array=mysql_fetch_assoc($result_sample_data);

		
echo '<form method=post action=\''.$filename.'\'>';
echo '<table  border=1 bgcolor=lightyellow CELLPADDING=0 CELLSPACING=0>	
		<tr><td><input type=submit '.$disabled.' value=save_sample name=save_sample></td><th colspan=4>2. Sample Entry Form</th></tr>';
	  
	  $rcount=0;
	  $tr='<tr>';

while($ar=mysql_fetch_assoc($result))
{
	if($ar['Type']=='varchar(30)')
	{
		echo $tr.'<td>'.$ar['Field'].'</td><td>';
		mk_option($ar['Field'],$sample_array[$ar['Field']],$disabled);
		echo '</td>';
	}
	
	else if($ar['Type']=='bigint(12)')
	{	
	echo $tr.'<td>'.$ar['Field'].'</td><td><input type=text  readonly  value=\''.$sample_array[$ar['Field']].'\' name='.$ar['Field'].'></td>';
	}

	else
	{	
	echo $tr.'<td>'.$ar['Field'].'</td><td><input type=text  '.$disabled.' value=\''.$sample_array[$ar['Field']].'\' name='.$ar['Field'].'></td>';
	}
	
	$rcount++;
	if($rcount==4)
	{$tr='<tr>';$rcount=0;}
	else
	{$tr=' ';}




}
//echo '<tr><td><input type=submit '.$disabled.' value=save_sample name=save_sample></td></tr>';
echo '</form></table>';
return TRUE;
}

////doc
function doc_edit_sample($filename,$disabled)
{
$link=start_nchsls();
$sql='SHOW COLUMNS FROM sample';
$result=mysql_query($sql,$link);

$sql_last_sample='select max(sample_id) from sample';

if(mysql_num_rows($result_last_sample=mysql_query($sql_last_sample,$link))!=1){echo 'Max_ID failed';return FALSE;}
$max_sample_array=mysql_fetch_assoc($result_last_sample);
//print_r($max_sample_array);

$next_sample=$max_sample_array['max(sample_id)'] + 1;

		
echo '<form method=post action=\''.$filename.'\'>';
echo '<table  border=1 bgcolor=lightyellow CELLPADDING=0 CELLSPACING=0>	
		<tr><td><input type=submit '.$disabled.' value=save_sample name=save_sample></td><th colspan=4>2. Sample Entry Form Sample ID=YYYYMMXXXXXX=YEARMONUMBER=12 digit </th></tr>';
	  
	  $rcount=0;
	  $tr='<tr>';

while($ar=mysql_fetch_assoc($result))
{
	if($ar['Type']=='varchar(30)')
	{
		echo $tr.'<td>'.$ar['Field'].'</td><td>';
		mk_option($ar['Field'],'',$disabled);
		echo '</td>';
	}
	
	elseif($ar['Type']=='bigint(12)')
	{	
	echo $tr.'<td>'.$ar['Field'].'</td><td><input type=text  value=\''.$next_sample.'\' readonly name='.$ar['Field'].'></td>';
	}
	
	else
	{	
	echo $tr.'<td>'.$ar['Field'].'</td><td><input type=text  '.$disabled.' name='.$ar['Field'].'></td>';
	}
	
	$rcount++;
	if($rcount==4)
	{$tr='<tr>';$rcount=0;}
	else
	{$tr=' ';}

}

echo '</form></table>';
return TRUE;

}



//////doc end


function search_sample($filename)
{
$link=start_nchsls();
$sql='SHOW COLUMNS FROM sample';
$result=mysql_query($sql,$link);
		
echo '<form method=post action=\''.$filename.'\'>';
echo '<table  border=1 bgcolor=lightyellow CELLPADDING=0 CELLSPACING=0>	
		<tr><td><input type=submit value=search_sample name=search_sample></td><th colspan=4>Sample Search Form (finds first 20 matching reports)</th></tr>';
	  
	  $rcount=0;
	  $tr='<tr>';

while($ar=mysql_fetch_assoc($result))
{
	if($ar['Type']=='varchar(30)')
	{
		//echo $tr.'<td>'.$ar['Field'].'</td><td>';
		echo $tr.'<td><input type=checkbox name=\''.$ar['Field'].'-c\' >'.$ar['Field'].'</td><td>';
		mk_option($ar['Field'],' ',' ');
		echo '</td>';
	}
	
	else
	{	
	echo $tr.'<td><input type=checkbox name=\''.$ar['Field'].'-c\' >'.$ar['Field'].'</td><td><input type=text name='.$ar['Field'].'></td>';
	}
	
	$rcount++;
	if($rcount==4)
	{$tr='<tr>';$rcount=0;}
	else
	{$tr=' ';}

}
echo '</form></table>';
return TRUE;
}


function run_search_query($post_array)
{
		$link=start_nchsls();
	$ex = array();

$search_query='select sample_id from sample where ';
	
foreach ($post_array as $key => $value) 
	{
	if(isset($_POST[$key.'-c']))
		{
			//echo $key.'->'.$value.'<br>';
			//echo $key.'-c'.'->'.$_POST[$key.'-c'].'<br>';
			$ex[]=$key;
			$search_query=$search_query.' '.$key.' like \'%'.$value.'%\' and   ';
			
		}
	}
	
	$search_query=substr($search_query,0,-6);
	$search_query=$search_query.' limit 0,20';
		//print_r($ex);
		//echo $search_query;
				
			
			$result=mysql_query($search_query,$link);
			
						
			while($post_array=mysql_fetch_assoc($result))  //take examinations one by on
			{
				//echo '<tr></tr><td>'.$post_array['name_of_examination'].'</td><td>'.$post_array['code'].'</td>';
				print_sample($post_array['sample_id']);
				echo '<h2 style="page-break-before: always;"></h2>';
				
			}
			
			
}

function run_search_query_doctor($post_array)
{
		$link=start_nchsls();
	$ex = array();

$search_query='select sample_id from sample where ';
	
foreach ($post_array as $key => $value) 
	{
	if(isset($_POST[$key.'-c']))
		{
			//echo $key.'->'.$value.'<br>';
			//echo $key.'-c'.'->'.$_POST[$key.'-c'].'<br>';
			$ex[]=$key;
			$search_query=$search_query.' '.$key.' like \'%'.$value.'%\' and   ';
			
		}
	}
	
	$search_query=substr($search_query,0,-6);
	$search_query=$search_query.' limit 0,20';
		//print_r($ex);
		//echo $search_query;
				
			
			$result=mysql_query($search_query,$link);
			
						
			while($post_array=mysql_fetch_assoc($result))  //take examinations one by on
			{
				//echo '<tr></tr><td>'.$post_array['name_of_examination'].'</td><td>'.$post_array['code'].'</td>';
				print_sample_doctor($post_array['sample_id']);
				echo '<h2 style="page-break-before: always;"></h2>';
				
			}
			
			
}



function show_sample($sample_id)
{
$link=start_nchsls();

$sql_sample_data='select * from sample where sample_id='.$sample_id;
$result_sample_data=mysql_query($sql_sample_data,$link);
$ar=$sample_array=mysql_fetch_assoc($result_sample_data);

echo '<table  border=1>	';
	  	  
	  $rcount=0;
	  $tr='<tr>';

foreach ($ar as $key => $value)
{
	echo $tr.'<td>'.$key.'</td><td>'.$value.'</td>';
	
	$rcount++;
	if($rcount==4)
	{$tr='<tr>';$rcount=0;}




	else
	{$tr=' ';}

}


echo '</table>';
}



function update_sample($post_array)
{
$link=start_nchsls();
$fsql='SHOW COLUMNS FROM sample';
$fresult=mysql_query($fsql,$link);

$sql='update sample set ';
while($ar=mysql_fetch_assoc($fresult))
{
	foreach ($post_array as $key => $value)
	{
		if($key==$ar['Field'])
		{
		$sql=$sql.' '.$key.'=\''.$value.'\' , ';
		}
	}
}
$sql=substr($sql,0,-2);
$sql=$sql.' where sample_id= \''.$post_array['sample_id'].'\'';
//echo $sql;

if(!mysql_query($sql,$link)){echo mysql_error();}
}


function doc_insert_sample($post_array)
{
$link=start_nchsls();
$fsql='SHOW COLUMNS FROM sample';
$fresult=mysql_query($fsql,$link);

$sql='insert into sample values (';
while($ar=mysql_fetch_assoc($fresult))
{
	foreach ($post_array as $key => $value)
	{
		if($key==$ar['Field'])
		{
			if($key=='status')
			{
				$sql=$sql.' \'requested\' , ';
			}
			else if($key=='position')
			{
				$sql=$sql.' NULL  , ';
			}
			else
			{
				$sql=$sql.' \''.$value.'\' , ';
			}
		}
	}
}
$sql=substr($sql,0,-2);
$sql=$sql.' ) ';
//echo $sql;

if(!mysql_query($sql,$link)){echo mysql_error().'doc_insert_sample()';}
}


function copy_update_sample($copy_sample_id,$paste_sample_id)
{
$link=start_nchsls();

$csql='select * from sample where sample_id=\''.$copy_sample_id.'\'';
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
		$sql=$sql.' '.$key.'=\''.$paste_sample_id.'\' , ';
		}
		
		else if($key=='sample_type')
		{
			$sql=$sql.' '.$key.'=\''.'Blood(Plasma)'.'\' , ';
		}
		
		else if($key=='preservative')
		{
			$sql=$sql.' '.$key.'=\''.'Fluoride'.'\' , ';
		}
		else
		{
		$sql=$sql.' '.$key.'=\''.$value.'\' , ';	
		}
	}

$sql=substr($sql,0,-2);
$sql=$sql.' where sample_id= \''.$paste_sample_id.'\'';
//echo $sql;

if(!mysql_query($sql,$link)){echo mysql_error();}


}


function copy_update_sample_F($copy_sample_id,$paste_sample_id)
{
$link=start_nchsls();

$csql='select * from sample where sample_id=\''.$copy_sample_id.'\'';
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
		$sql=$sql.' '.$key.'=\''.$paste_sample_id.'\' , ';
		}
		
		else if($key=='sample_type')
		{
			$sql=$sql.' '.$key.'=\''.'Blood(Serum)'.'\' , ';
		}
		
		else if($key=='preservative')
		{
			$sql=$sql.' '.$key.'=\''.'None'.'\' , ';
		}
		else
		{
		$sql=$sql.' '.$key.'=\''.$value.'\' , ';	
		}
	}

$sql=substr($sql,0,-2);
$sql=$sql.' where sample_id= \''.$paste_sample_id.'\'';
//echo $sql;

if(!mysql_query($sql,$link)){echo mysql_error();}
}





function edit_header_examination()
{
$link=start_nchsls();
$sql='SHOW COLUMNS FROM examination';
$result=mysql_query($sql,$link);
		  

	
while($ar=mysql_fetch_assoc($result))
{
	echo '<th>'.$ar['Field'].'</th>';	
}
}


function select_examination_for_insert($sample_id,$filename,$disabled)
{

$link=start_nchsls();

$sql_sample_data='select sample_type,preservative from sample where sample_id='.$sample_id;
if(mysql_num_rows($result_sample_data=mysql_query($sql_sample_data,$link))!=1){echo 'No such sample';return FALSE;}
$sample_array=mysql_fetch_assoc($result_sample_data);
//print_r($sample_array);

//to select only relevent examinations
$sql='select * from scope where sample_type=\''.$sample_array['sample_type'].'\' and preservative=\''.$sample_array['preservative'].'\' order by id';
//echo $sql;
$result=mysql_query($sql,$link);


echo '	  <form method=post action=\''.$filename.'\'>';
echo '<table border=1 bgcolor=lightgreen CELLPADDING=0 CELLSPACING=0 >	
		<tr><td><input type=submit value=add_examinations  '.$disabled.' name=add_examinations></td><th colspan=3>3B.Scope Menu(Tests)</th></tr>'	  ;


edit_header_examination();
	
while($ar=mysql_fetch_assoc($result))
{

	echo '<tr>';
	foreach ($ar as $key => $value)   //for every row in scope
	{
			if($key=='id')
			{
				echo '<td nowrap><input type=checkbox  '.$disabled.' name=\''.$value.'\' >'.$value.'</td>';
			}
			else if($key=='sample_id')
			{
				echo '<td nowrap><input type=text  readonly name=sample_id value=\''.$sample_id. '\'> </td>';
			}
			else if($key=='result')
			{
				echo '<td nowrap><input type=text readonly name=\''.$key.$ar['id'].'\' value=\''.$value.'\'></td>';
			}
			else
			{
				echo '<td nowrap><input type=text  readonly '.$disabled.' name=\''.$key.$ar['id'].'\' value=\''.$value.'\'></td>';
			}
	}
		
}


//echo '<tr><td><input type=submit value=add_examinations  '.$disabled.' name=add_examinations></td></tr>';
echo '</form></table>';
}



/////////////qc edit

function view_qc($qc_id,$repeat)
{

$link=start_nchsls();

$sql_qc='select * from qc where qc_id=\''.$qc_id.'\' order by ex_code';
$result_qc=mysql_query($sql_qc,$link);

echo '<table border=1>';
while($array_qc=mysql_fetch_assoc($result_qc))
{
	echo '<tr>';
		echo '<td>';
		echo $array_qc['qc_id'];
		echo '</td>';
		echo '<td>';
		echo $array_qc['repeat'];
		echo '</td>';
		echo '<td>';
		echo $array_qc['ex_code'];
		echo '</td>';
		echo '<td>';
		echo $array_qc['result'];
		echo '</td>';
		echo '<td>';
		echo $array_qc['target'];
		echo '</td>';
		echo '<td>';
		echo $array_qc['sd'];
		echo '</td>';
		echo '<td>';
		echo $array_qc['comment'];
		echo '</td>';
	echo '</tr>';
}
echo '<table>';

}

function input_qc($qc_id,$repeat,$filename)
{
$link=start_nchsls();

$sql_qc_target='select * from qc_target where qc_type=\''.(int)($qc_id/100000000).'\' order by ex_code';
$result_qc_target=mysql_query($sql_qc_target,$link);

echo '<form method=post action=\''.$filename.'\'>';
echo '<table border=1>';
echo '<input type=text readonly name=qc_id value=\''.$qc_id.'\' >';
echo '<input type=text readonly name=repeat value=\''.$repeat.'\' >';

echo '<tr><td>qc_type</td><td>repeat</td><td>delete</td><td>ex_code</td><td>result</td><td>target</td><td>sd</td><td>details</td></tr>';	  
while($array_qc_target=mysql_fetch_assoc($result_qc_target))
{

$sql_qc='select * from qc where 
					qc_id=\''.(int)$qc_id.'\' and 
					`repeat`=\''.(int)$repeat.'\' and 
					ex_code=\''.$array_qc_target['ex_code'].'\'';
//echo $sql_qc.'<br>'					;
if(!$result_qc=mysql_query($sql_qc,$link)){echo mysql_error();}


	

	
	echo '<tr>';
		echo '<td>';
		echo $array_qc_target['qc_type'];
		echo '</td>';
		echo '<td>';
		echo $repeat;
		echo '</td>';
		echo '<td>';
		echo '<input type=checkbox name=\''.$array_qc_target['ex_code'].'-del\' >';
		echo '</td>';
		echo '<td>';
		echo $array_qc_target['ex_code'];
		echo '</td>';
		echo '<td>';
		if($array_qc=mysql_fetch_assoc($result_qc))
		{
			echo '<input type=text name=\''.$array_qc_target['ex_code'].'\'  value=\''.$array_qc['result'].'\' >';
		}
		else
		{
			echo '<input type=text name=\''.$array_qc_target['ex_code'].'\' >';
		}

		echo '</td>';
		echo '<td>';
		echo $array_qc_target['target'];
		echo '</td>';
		echo '<td>';
		echo $array_qc_target['sd'];
		echo '</td>';
		echo '<td>';
		echo $array_qc_target['details'];
		echo '</td>';
		
	echo '</tr>';
}
echo '<tr><td><input type=submit value=save  name=save></td></tr>';
echo '</table>';
echo '</form>';
}



///////////////end qc edit



function select_examination_for_worklist($filename)
{

$link=start_nchsls();

$sql='select * from scope order by id';

//echo $sql;
$result=mysql_query($sql,$link);
	
echo '<form method=post action=\''.$filename.'\'>';
echo '<table border=1 bgcolor=lightblue CELLPADDING=0 CELLSPACING=0 >	
		<tr><td><input type=submit value=submit  name=submit></td><th colspan=3>Select examination for worklist</th></tr>'	  ;

	echo '<tr>';
	echo '<td>from sample_id</td>';
	echo '<td><input type=text name=from_sample_id value=\''.strftime('%y%m%d').'\' style=\'font-size:150%\' size=9></td>';	

	
	echo '<td>to sample_id</td>';
	echo '<td><input type=text name=to_sample_id value=\''.strftime('%y%m%d').'\' style=\'font-size:150%\' size=9></td>';	
	echo '</tr>';

edit_header_examination();

while($ar=mysql_fetch_assoc($result))
{
	echo '<tr>';
	foreach ($ar as $key => $value)   //for every row in scope
	{
			if($key=='id')
			{
				echo '<td nowrap><input type=radio   name=selected_examination value=\''.$value.'\'>'.$value.'</td>';
			}
			else
			{
				echo '<td nowrap>'.$value.'</td>';
			}
	}
		
}

echo '</form></table>';
}

//////////////ttt
function select_examination_for_turnaround_time($filename)
{

$link=start_nchsls();

$sql='select * from scope order by id';
//echo $sql;
$result=mysql_query($sql,$link);
	
echo '<form method=post action=\''.$filename.'\'>';
echo '<table border=1 bgcolor=lightblue CELLPADDING=0 CELLSPACING=0 >	
		<tr><td><input type=submit value=submit  name=submit></td><th colspan=3>Select examination for calculating turnaround time</th></tr>'	  ;

	echo '<tr>';
	echo '<td>from sample_id</td>';
	echo '<td><input type=text name=from_sample_id value=\''.strftime('%y%m%d').'\' style=\'font-size:150%\' size=9></td></td>';	
	
	echo '<td>to sample_id</td>';
	echo '<td><input type=text name=to_sample_id value=\''.strftime('%y%m%d').'\' style=\'font-size:150%\' size=9></td></td>';	
	echo '</tr>';

edit_header_examination();

while($ar=mysql_fetch_assoc($result))
{
	echo '<tr>';
	foreach ($ar as $key => $value)   //for every row in scope
	{
			if($key=='id')
			{
				echo '<td nowrap><input type=radio   name=selected_examination value=\''.$value.'\'>'.$value.'</td>';
			}
			else
			{
				echo '<td nowrap>'.$value.'</td>';
			}
	}
		
}

echo '</form></table>';
}












///////////////





function select_examination_for_calculation($filename)
{

$link=start_nchsls();

$sql='select * from scope where method_of_analysis=\'Calculation\' order by id';
//echo $sql;
$result=mysql_query($sql,$link);
	
echo '<form method=post action=\''.$filename.'\'>';
echo '<table border=1 bgcolor=lightblue CELLPADDING=0 CELLSPACING=0 >	
		<tr><td><input type=submit value=submit  name=submit></td><th colspan=3>Select examination for calculation</th></tr>'	  ;

	echo '<tr>';
	echo '<td>from sample_id</td>';
	echo '<td><input type=text name=from_sample_id value=\''.strftime('%y%m%d').'\' style=\'font-size:150%\' size=9></td></td>';	
	
	echo '<td>to sample_id</td>';
	echo '<td><input type=text name=to_sample_id value=\''.strftime('%y%m%d').'\' style=\'font-size:150%\' size=9></td></td>';	
	echo '</tr>';

edit_header_examination();




while($ar=mysql_fetch_assoc($result))
{
	echo '<tr>';
	foreach ($ar as $key => $value)   //for every row in scope
	{
			if($key=='id')
			{
				echo '<td nowrap><input type=radio   name=selected_examination value=\''.$value.'\'>'.$value.'</td>';
			}
			else
			{
				echo '<td nowrap>'.$value.'</td>';
			}
	}
		
}

echo '</form></table>';
}


function get_result_number($sql_query,$link)
{
		
		$ex_result=mysql_query($sql_query,$link);
		if(mysql_num_rows($ex_result)==1)
		{
		$ex_array=mysql_fetch_assoc($ex_result);
		if($ex_array['result']>0)
			{
				return $ex_value=$ex_array['result'];
			}
		else{return NULL;}		
		}
		else{return NULL;}		
}


function calculate_examination_results($from_sample_id,$to_sample_id,$examination_id)
{
$link=start_nchsls();
if($examination_id==8)
{
	for ($sid=$from_sample_id;$sid<=$to_sample_id;$sid++)
	{
		echo '<br>';
		
		$sql_tbil='select result from examination where sample_id=\''.$sid.'\' and id=\'6\'';
		$tbil_value=get_result_number($sql_tbil,$link);
		echo '['.$sid.']'.'TBIL='.$tbil_value.' ';
		
		$sql_dbil='select result from examination where sample_id=\''.$sid.'\' and id=\'7\'';
		$dbil_value=get_result_number($sql_dbil,$link);
		echo '['.$sid.']'.'DBIL='.$dbil_value.' ';
		
		if($dbil_value!=NULL && $tbil_value!=NULL)
			{
			if($dbil_value <= $tbil_value)
				{
					$ibil_value=$tbil_value -$dbil_value;

					$ibil_value= number_format($ibil_value, 1, '.', '');	// to convert to 1 decimal i.e. 1 to 1.0

					echo '['.$sid.']'.'IBIL='.$ibil_value.' ';

					$sql='update examination set result=\''.$ibil_value.'\' where sample_id=\''.$sid.'\' and id=\'8\'';
					//echo $sql;
					if(!mysql_query($sql,$link)){echo mysql_error();}
				}
			}
	}
		
		unset($dbil_value);
		unset($tbil_value);
		unset($ibil_value);
		//echo $sql_tbil;
		//echo $sql_dbil;
		
		
}



if($examination_id==55)
{
	for ($sid=$from_sample_id;$sid<=$to_sample_id;$sid++)
	{
		echo '<br>';
		$sql_cho='select result from examination where sample_id=\''.$sid.'\' and id=\'12\'';
		$cho_value=get_result_number($sql_cho,$link);
		echo '['.$sid.']'.'CHO='.$cho_value.' ';
				
		$sql_hdl='select result from examination where sample_id=\''.$sid.'\' and id=\'53\'';
		$hdl_value=get_result_number($sql_hdl,$link);
		echo '['.$sid.']'.'HDL='.$hdl_value.' ';
		
		$sql_ldl='select result from examination where sample_id=\''.$sid.'\' and id=\'54\'';
		$ldl_value=get_result_number($sql_ldl,$link);
		echo '['.$sid.']'.'LDL='.$ldl_value.' ';		

		if($cho_value!=NULL && $hdl_value!=NULL && $ldl_value!=NULL)
		{
		
					$vldl_value=$cho_value-$hdl_value-$ldl_value;
					echo '['.$sid.']'.'VLDL='.$vldl_value;
			
					$sql_vldl='update examination set result=\''.$vldl_value.' \' where sample_id=\''.$sid.'\' and id=\'55\'';
					//echo $sql_vldl;
					if(!mysql_query($sql_vldl,$link)){echo mysql_error();}
								
				
			}
	}
		
		unset($cho_value);
		unset($hdl_value);

		unset($ldl_value);
		unset($vldl_value);
		
		
		
		
}


////////////
if($examination_id==25)
{
	for ($sid=$from_sample_id;$sid<=$to_sample_id;$sid++)
	{
		echo '<br>';
						
		$sql_tg='select result from examination where sample_id=\''.$sid.'\' and id=\'10\'';
		$tg_value=get_result_number($sql_tg,$link);
		echo '['.$sid.']'.'TG='.$tg_value.' ';
		
				
		if($tg_value!=NULL)
		{
					$vldl_value=$tg_value/5 ;
					echo '['.$sid.']'.'VLDL='.$vldl_value;
			
					$sql_vldl='update examination set result=\''.$vldl_value.' \' where sample_id=\''.$sid.'\' and id=\'25\'';
					echo $sql_vldl;
					if(!mysql_query($sql_vldl,$link)){echo mysql_error();}
			
		}
	}
		
		
		unset($tg_value);
		unset($vldl_value);
		
}

//////////




}









function select_profile($sample_id,$filename,$disabled)
{

$link=start_nchsls();



$sql_sample_data='select sample_type,preservative from sample where sample_id='.$sample_id;
if(mysql_num_rows($result_sample_data=mysql_query($sql_sample_data,$link))!=1){echo 'No such sample';return FALSE;}
$sample_array=mysql_fetch_assoc($result_sample_data);
//print_r($sample_array);

//to select only relevent examinations
$sql='select * from profile where (sample_type=\''.$sample_array['sample_type'].'\' and preservative=\''.$sample_array['preservative'].'\') or profile like \'Z_%\' ';
//echo $sql;



//$sql='select * from profile';
//echo $sql;
$result=mysql_query($sql,$link);

echo '	  <form method=post action=\''.$filename.'\'>';
echo '<table border=1 bgcolor=lightyellow CELLPADDING=0 CELLSPACING=0 >	
		<tr><th>3A. Scope Menu(Profiles) </th>';
		echo '<th nowrap><input type=text  readonly name=sample_id value=\''.$sample_id. '\'> </th>';
$counter=0;
echo '</tr><tr>';

while($ar=mysql_fetch_assoc($result))
{
	
	foreach ($ar as $key => $value)   //for every row in scope
	{		if($key=='profile')

			{
			echo '<td nowrap><input type=submit  '.$disabled.' name=\''.$key.'\' value=\''.$value.'\'</td>';$counter++;
			}
			if($counter%5==0){echo '</tr><tr>';}
	}
}

echo '</tr></form></table>';



}






function find_examination_in_post($post_array)
{
	$ex = array();
	
foreach ($post_array as $key => $value) 
	{
	if(is_int($key))
		{
			//echo $key.'->'.$value;
			$ex[]=$key;
		}
	}
	
	return $ex;
		//print_r($ex);
}

function insert_examination($post_array)
	{
		$link=start_nchsls();
		
		$ex=find_examination_in_post($post_array);
		
		foreach ($ex as $key=>$value)
		{
			$sql='insert into examination (`sample_id`, `id`, `name_of_examination`, `sample_type`, `preservative`, `method_of_analysis`, `result`, `unit`, `referance_range`, `code`, `details`) 
					values ('.
					'\''.$post_array['sample_id'].'\' , '.
					'\''.$value.'\' , '.
					'\''.$post_array['name_of_examination'.$value].'\' , '.
					'\''.$post_array['sample_type'.$value].'\' , '.
					'\''.$post_array['preservative'.$value].'\' , '.
					'\''.$post_array['method_of_analysis'.$value].'\' , '.
					'\''.$post_array['result'.$value].'\' , '.
					'\''.$post_array['unit'.$value].'\' , '.
					'\''.$post_array['referance_range'.$value].'\' , '.
					'\''.$post_array['code'.$value].'\' , '.
					'\'\' , ';
//					'\''.$post_array['details'.$value].'\' , ';
			$sql=substr($sql,0,-2);
			$sql=$sql.')';
			//echo $sql;
			if(!mysql_query($sql,$link)){echo mysql_error();}
		}
			
					
	}


function insert_single_examination($sample_id,$id)
	{
		$link=start_nchsls();
		$sql='select * from scope where id=\''.$id.'\'';
		$result=mysql_query($sql,$link);
		$post_array=mysql_fetch_assoc($result);
				
		$sql='insert into examination (`sample_id`, `id`, `name_of_examination`, `sample_type`, `preservative`, `method_of_analysis`, `result`, `unit`, `referance_range`, `code`, `details`) 
					values ('.
					'\''.$sample_id.'\' , '.
					'\''.$post_array['id'].'\' , '.
					'\''.$post_array['name_of_examination'].'\' , '.
					'\''.$post_array['sample_type'].'\' , '.
					'\''.$post_array['preservative'].'\' , '.
					'\''.$post_array['method_of_analysis'].'\' , '.
					'\''.$post_array['result'].'\' , '.
					'\''.$post_array['unit'].'\' , '.
					'\''.$post_array['referance_range'].'\' , '.
					'\''.$post_array['code'].'\' , '.
					'\'\' , ';
					//'\''.$post_array['details'].'\' , ';
			$sql=substr($sql,0,-2);
			$sql=$sql.')';
			//echo $sql;
			if(!mysql_query($sql,$link)){echo mysql_error();}
					
	}

function insert_profile($sample_id,$profile)
{
	$link=start_nchsls();
		$sql='select * from profile where profile=\''.$profile.'\'';
		$result=mysql_query($sql,$link);
		
	while($profile_row=mysql_fetch_assoc($result))
	{
		foreach ($profile_row as $key => $value)   //for every row in profile
		{
			if($key!='profile' && $value!=NULL && $key!='sample_type' && $key!='preservative')
			{
			insert_single_examination($sample_id,$value);
			}
		}
	}
}

		
function input_result($sample_id,$filename,$disabled)
{

$link=start_nchsls();
$sql='select * from examination where sample_id=\''.$sample_id.'\'';
$result=mysql_query($sql,$link);

if($disabled=='disabled' || $disabled=='readonly'){$rd='readonly';}else{$rd='';}
echo '	  <form method=post action=\''.$filename.'\'>';
echo '<table border=1 bgcolor=lightgrey CELLPADDING=0 CELLSPACING=0>';		  

if($_SESSION['login']!='doctor')
{
echo '	  <tr><td><input type=submit value=save_results  '.$disabled.' name=save_results></td><th colspan=5>4. List of Examinations selected and its Result Entry Form</th></tr> ';
}

edit_header_examination();
	
while($ar=mysql_fetch_assoc($result))
{
if($ar['id']<1000)
{
	echo '<tr>';
	foreach ($ar as $key => $value)   //for every row in scope
	{
			if($key=='id')
			{
				echo '<td nowrap><input type=checkbox checked onclick=\'this.checked = true\';'.$disabled.' name=\''.$value.'\' >'.$value.'</td>';
			}
			
			else if($key=='sample_id')
			{
				echo '<td nowrap><input type=text  readonly name=sample_id value=\''.$sample_id. '\'> </td>';
			}
			else if($key=='result')
			{
				echo '<td nowrap><input type=text '.$disabled.' name=\''.$key.$ar['id'].'\' value=\''.$value.'\'></td>';
			}
			else
			{
				echo '<td nowrap><input type=text  readonly name=\''.$key.$ar['id'].'\' value=\''.$value.'\'></td>';
			}
	}
}

elseif($ar['id']>=1000)
{
	
	echo '<tr>';
					echo '<td colspan=10>
						<table>
							<tr>';
	foreach ($ar as $key => $value)   //for every row in scope
	{
			if($key=='id')
			{
				echo '<td nowrap><input type=checkbox checked onclick=\'this.checked = true\';'.$disabled.' name=\''.$value.'\' >'.$value.'</td>';
			}
			else if($key=='sample_id')
			{
				echo '<td nowrap><input type=text  readonly name=sample_id value=\''.$sample_id. '\'> </td>';
			}
			else if($key=='result')
			{
							//echo '<td nowrap><b>'.$ar['name_of_examination'].'</b></td><td><textarea '.$rd.' rows=5 cols=50 name=\''.$key.$ar['id'].'\'>'.$value.'</textarea></td>';
				echo '<td><b>'.trim($ar['name_of_examination'],'Z_').':</b></td><td><input size=40 type=text '.$disabled.' name=\''.$key.$ar['id'].'\' value=\''.$value.'\'></td>';
			}
			else
			{
				//echo '<td nowrap><input type=text  readonly name=\''.$key.$ar['id'].'\' value=\''.$value.'\'></td>';
			}
	}
	
					echo 	'</tr>
							</table>
						</td>';			

	
	
}




		
}

//echo '<tr><td><input type=submit value=save_results  '.$disabled.' name=save_results></td></tr>';
echo '</form></table>';
}	





function update_result($post_array)
{
$link=start_nchsls();
$ex=find_examination_in_post($post_array);
	if(count($ex)>0)
	{
	foreach ($ex as $key => $value)
	{
		$sql='update examination set result=\''.$post_array['result'.$value].'\' where sample_id=\''.$post_array['sample_id'].'\' and id=\''.$value.'\'';
		//echo $sql;
		if(!mysql_query($sql,$link)){echo mysql_error();}
	}
	}
	else
	{
		echo 'No examinations selected';
	}

}



function delete_request($sample_id)
{
$link=start_nchsls();
$ex='delete from sample where sample_id=\''.$sample_id.'\'';
if(!mysql_query($ex,$link)){echo mysql_error();}
else
	{
	echo '<h3>Success. Now sample_id='.$sample_id.' is not present in database.</h3>';
	}
}


function select_delete_examination($sample_id,$filename,$disabled)
{

$link=start_nchsls();
$sql='select * from examination where sample_id=\''.$sample_id.'\'';
$result=mysql_query($sql,$link);


echo '<table border=1 bgcolor=lightgrey CELLPADDING=0 CELLSPACING=0>		  
	  <form method=post action=\''.$filename.'\'>
	  <tr><th colspan=3>Examination Request Delete Form</th></tr>	  
	  ';
	
edit_header_examination();
	
while($ar=mysql_fetch_assoc($result))
{
	echo '<tr>';
	foreach ($ar as $key => $value)   //for every row in scope
	{
			if($key=='id')
			{
				echo '<td nowrap><input type=checkbox  '.$disabled.' name=\''.$value.'\' >'.$value.'</td>';
			}
			
			else if($key=='sample_id')
			{
				echo '<td nowrap><input type=text  readonly name=sample_id value=\''.$sample_id. '\'> </td>';
			}
			else if($key=='result')
			{
				echo '<td nowrap><input type=text '.$disabled.' name=\''.$key.$ar['id'].'\' value=\''.$value.'\'></td>';
			}
			else
			{
				echo '<td nowrap><input type=text  readonly name=\''.$key.$ar['id'].'\' value=\''.$value.'\'></td>';
			}
	}
		
}

echo '<tr><td><input type=submit value=delete_examination  '.$disabled.' name=delete_examination></td></tr>';
echo '</form></table>';
}	

function delete_examination($post_array)
{
$link=start_nchsls();
$ex=find_examination_in_post($post_array);

	foreach ($ex as $key => $value)
	{
		$dlt='delete from examination where sample_id=\''.$post_array['sample_id'].'\' and id=\''.$value.'\'';
		//print_r( $ex);
		//echo $dlt;
		if(!mysql_query($dlt,$link)){echo mysql_error();}
	}
}

function print_sample_old($sample_id)
{
$link=start_nchsls();
$sql='SHOW COLUMNS FROM sample';
$result=mysql_query($sql,$link);
$sql_sample_data='select * from sample where sample_id='.$sample_id;

if(mysql_num_rows($result_sample_data=mysql_query($sql_sample_data,$link))>0)
{
$sample_array=mysql_fetch_assoc($result_sample_data);


echo '<table>	
		<tr><td colspan=4 >Examination report: Biochemistry Section NCHSLS, NCH, Surat</td></tr>';
	  $rcount=0;
	  $tr='<tr>';
		$sid='style=\'font-size:80%\'';
while($ar=mysql_fetch_assoc($result))
{
	if($ar['Field']=='sample_id'){$sid='style=\'font-size:200%\'';}else{$sid=' ';}
	
	echo $tr.'<td align=left>|'.$ar['Field'].'</td><td '.$sid.'>='.$sample_array[$ar['Field']].'</td>';
	
	$rcount++;
	if($rcount==3)
	{$tr='<tr>';$rcount=0;}
	else
	{$tr=' ';}

}

echo '</table>';
return TRUE;
}
else
{
	return TRUE;
}
}

///////////////////////////////
/*
function print_sample($sample_id)
{
$link=start_nchsls();
$sql='SHOW COLUMNS FROM sample';
$result=mysql_query($sql,$link);
$sql_sample_data='select * from sample where sample_id='.$sample_id;

if(mysql_num_rows($result_sample_data=mysql_query($sql_sample_data,$link))>0)
{
	$sample_array=mysql_fetch_assoc($result_sample_data);
//	if($sample_array['status']!='interim' && $sample_array['status']!='final')
//	{
//		echo '<br>sample_id='.$sample_id.' status is incorrent for print. verify results and set status';
//		return FALSE;
//	}
//	else
//	{
		echo '<table>	
		<tr><td colspan=4 >Examination report: Biochemistry Section NCHSLS, NCH, Surat</td></tr>';
		  $rcount=0;
		  $tr='<tr>';
		$sid='style=\'font-size:80%\'';
		while($ar=mysql_fetch_assoc($result))
		{
			if($ar['Field']=='sample_id'){$sid='style=\'font-size:200%\'';}else{$sid=' ';}
			echo $tr.'<td align=left>|'.$ar['Field'].'</td><td '.$sid.'>='.$sample_array[$ar['Field']].'</td>';
			$rcount++;
			if($rcount==3)
			{$tr='<tr>';$rcount=0;}
			else
			{$tr=' ';}
		}
		echo '</table>';
		return TRUE;
//	}
}
else
{
	return FALSE;
}
}


////////////////////////////////

function print_examinations($sample_id)
{
$link=start_nchsls();
$sql='select id,name_of_examination,result,unit,referance_range from examination where sample_id=\''.$sample_id.'\' order by id';


if(mysql_num_rows($result=mysql_query($sql,$link))>0)
{
echo '<table border=0>';
echo '<tr><td colspan=8 >-------------------------------------------------------------------------------</td></tr>';
echo '<tr><td>Examination</td><td>Result</td><td>Unit</td><td>Ref. Range</td></tr>';

	//$rcount=0;
	//  $tr='<tr>';
	
while($ar=mysql_fetch_assoc($result))
{
	if($ar['id']<1000)
	{
		echo '<tr><td>'.$ar['name_of_examination'].'</td><td>'.$ar['result'].'</td><td>'.$ar['unit'].'</td><td>'.$ar['referance_range'].'</td></tr>';
	}
	elseif($ar['id']>=1000)
	{
		echo '	<tr>
				<td colspan="10">
					<table border=0>
					<tr>
								<tr><td><b>'.trim($ar['name_of_examination'],'Z_').':</b></td><td>'.$ar['result'].'</td></tr>
						
					</tr>
					</table>	
				</td>
				</tr>';
	}
}
// for remarks <td valign="top"><b>'.$ar['name_of_examination'].'</b></td><td><textarea readonly cols=50 rows=5 style="border-width: 0; overflow: auto;">'.$ar['result'].'</textarea></td><td>

date_default_timezone_set('Asia/Kolkata');
echo '<tr><td colspan=8 >----end of report---- '.strftime('%Y-%m-%d %H:%M:%S').'--------</td></tr>';
echo '</table>';
}
}	
*/

function print_sample($sample_id)
{
$link=start_nchsls();
$sql_sample_data='select * from sample where sample_id='.$sample_id;
$sql_examination_data='select * from examination where sample_id=\''.$sample_id.'\' order by id';
$sql_sample_verification_data='select * from sample_verification where sample_id='.$sample_id;
$result_sample_verification_data=mysql_query($sql_sample_verification_data,$link);
$sample_verification_array=mysql_fetch_assoc($result_sample_verification_data);

if(mysql_num_rows($result_sample_data=mysql_query($sql_sample_data,$link))>0)
{
	$sample_array=mysql_fetch_assoc($result_sample_data);


	/////////////for dividing & formatting sample_id in two parts
	$number=$sample_array['sample_id'];
	list($s_id_date,$s_id_id) = str_split($number,6); 

		echo '
			<table border=0 style="border-collapse:collapse;">
				<tr>

					<td colspan=2 align=center>
						<table border=0>
							<tr><th colspan=2 style=\'font-size:120%\'>Laboratory Services, S.S.G.Hospital and Medical College, Baroda</th></tr>
							<tr><td></td></tr><tr><td></td></tr>
							<tr>
								<th>Laboratory Report: Clinical Chemistry Section, Tel.: 2424848 Ext. 326</th>

							</tr>
						</table>
					</td>

				<tr style="border:1px solid #000;">
								<td align=left>
									<table border=0>
										<tr><td><b>Patient Name: </b>'.$sample_array['patient_name'].'</td></tr>
										<tr><td><b>MRD Number: </b>'.$sample_array['patient_id'].'</td></tr>
									</table>
								</td>	
								<td align=right>
									<table border=0>

										<tr><td><b>'.$sample_array['clinician'].'</td><td><b>: '.$sample_array['unit'].'</b></td></tr>
										<tr><td><b>'.$sample_array['location'].'</b></td></tr>
									</table>
								</td>						
				</tr>

				<tr style="border:1px solid #000;">
								<td>
									<table border=0>
										<tr><td style=\'font-size:150%\'>Sample ID: <FONT SIZE=4>'.$s_id_date.'</FONT><b>'.$s_id_id.'</b></td></tr>
										<tr><td><b>'.$sample_array['sample_details'].'</b></td></tr>
									</table>
								</td>	
								<td align=right>
									<table border=0>
										<tr><td><b>Sample type: </b>'.$sample_array['sample_type'].'</td></tr>
										<tr><td><b>Preservative: </b>'.$sample_array['preservative'].'</td></tr>
									</table>
								</td>						
				</tr>';
			
				echo '
							<tr  style="border:1px solid #000;"><td colspan=3>Details: '.$sample_array['details'].'</b></td></tr>
							<tr  style="border:1px solid #000;"><td>Receipt Time: '.$sample_array['sample_receipt_time'].'</td><td align=right>Report Time: '.strftime('%d-%m-%Y, %H:%M').' </td></tr>
													
			';

		if(mysql_num_rows($result_examination_data=mysql_query($sql_examination_data,$link))>0)
		{
			echo '
				<tr><td colspan=2 align=center>
				<table border=1 style="border-collapse:collapse;  margin-top:10px">';
			echo '
					<tr  style="border:1px solid #000;">
						<th>Examination</th>
						<th>Result</th>
						<th>Reference Range</th>
						<th>Alert</th>
						<th>Method</th>
						
					</tr>
					';	
					
			while($examination_array=mysql_fetch_assoc($result_examination_data))
			{
				if($examination_array['id']<1000)
				{
					echo '

						<tr>
							<td>'.$examination_array['name_of_examination'].'</td>
							<td align=center><b>'.$examination_array['result'].'</b></td>
							<td align=center style=\'font-size:90%\'>'.$examination_array['referance_range'].' '.$examination_array['unit'].'</td>
							<td align=center style=\'font-size:90%\'>'.abnormal_report_for_code($sample_id,$examination_array['code']).' '.av_report_for_code($sample_id,$examination_array['code']).'</td>
							<td style=\'font-size:85%\'>'.$examination_array['method_of_analysis'].'</td>
							
						</tr>
						';		
				}
				elseif($examination_array['id']>=1000)
				{
					echo '
						<tr>
							<td colspan="10" >
								<table border=0>
									<tr>
										<tr><td><b>'.trim($examination_array['name_of_examination'],'Z_').'</b></td><td>'.$examination_array['result'].'</td></tr>
									</tr>
								</table>	
							</td>
						</tr>';
				}
			}
			

			echo '</table>';
		}	
			//echo '<table align=right><tr><td style=\'font-size:85%\'>Alert: H= High; L=Low</td></tr></table>';
				
			echo '	<tr>
						<td colspan=24 align=center>


							<table border=1 style="border-collapse:collapse;  margin-top:10px">
								<tr>
									<td width=220 height=35>Technician:</td><td></td>
									<td>Sign:</td><td width=350></td>
								</tr>
								
								<tr>
									<td align=left colspan=2> '.$sample_verification_array['technician'].'</td>
									<td align=right colspan=2>'.$sample_verification_array['sign'].'</td>
								</tr>
								
							</table>								
						</td>
					</tr>
						';	
		
			echo '<tr><td colspan=6 style=\'font-size:85%\'> All investigations have their own limitations; kindly correlate clinically.</td></tr>';
			echo '<tr><td colspan=6 style=\'font-size:85%\'># NABL accredited parameter.</td></tr>';
			echo '<tr><td align=center colspan=6 style=\'font-size:85%\'>-----End of Report-----</td></tr>';	
			echo '</table>';	
			
			
		return TRUE;

}
else
{
	return FALSE;
}
}


function print_sample_doctor($sample_id)
{
$link=start_nchsls();
$sql_sample_data='select * from sample where sample_id='.$sample_id;
$sql_examination_data='select * from examination where sample_id=\''.$sample_id.'\' order by id';
$sql_sample_verification_data='select * from sample_verification where sample_id='.$sample_id;
$result_sample_verification_data=mysql_query($sql_sample_verification_data,$link);
$sample_verification_array=mysql_fetch_assoc($result_sample_verification_data);

if(mysql_num_rows($result_sample_data=mysql_query($sql_sample_data,$link))>0)
{
	$sample_array=mysql_fetch_assoc($result_sample_data);

	/////////////for dividing & formatting sample_id in two parts
	$number=$sample_array['sample_id'];
	list($s_id_date,$s_id_id) = str_split($number,6); 


		echo '
			<table border=0 style="border-collapse:collapse;">
				<tr>

					<td colspan=2 align=center>
						<table border=0>
							<tr><th colspan=2><h3>Laboratory Services, S.S.G.Hospital and Medical College, Baroda</h3></td></tr>
							

							<tr>
								<th>Laboratory Report: Clinical Chemistry Section, Tel.: 2424848 Ext. 326</th>

							</tr>
						</table>

					</td>

				<tr style="border:1px solid #000;">
								<td>
									<table border=0>

										<tr><td><b>Patient Name: </b></td><td>'.$sample_array['patient_name'].'</td></tr>
										<tr><td><b>MRD Number: </b></td><td>'.$sample_array['patient_id'].'</td></tr>
									</table>
								</td>	

								<td align=right>
									<table border=0>
										<tr><td><b>'.$sample_array['clinician'].'</td><td><b>: '.$sample_array['unit'].'</b></td></tr>
										<tr><td><b>'.$sample_array['location'].'</b></td></tr>

									</table>
								</td>						
				</tr>

				<tr style="border:1px solid #000;">

								<td>
									<table border=0>
										<tr><td style=\'font-size:150%\'>Sample ID: <FONT SIZE=4>'.$s_id_date.'</FONT><b><u>'.$s_id_id.'</u></b></td></tr>
										<tr><td><b>'.$sample_array['sample_details'].'</b></td></tr>

									</table>
								</td>	
								<td align=right>
									<table border=0>
										<tr><td><b>Sample type: </b>'.$sample_array['sample_type'].'</td></tr>

										<tr><td><b>Preservative: </b>'.$sample_array['preservative'].'</td></tr>
									</table>
								</td>						
				</tr>';
			
				echo '
							<tr  style="border:1px solid #000;"><td colspan=3>Clinical Details: '.$sample_array['details'].'</b></td></tr>
							<tr  style="border:1px solid #000;"><td>Receipt Time: '.$sample_array['sample_receipt_time'].'</td><td align=right>Print Time: '.strftime('%d-%m-%Y, %H:%M').' </td></tr>

													
			';

		if(mysql_num_rows($result_examination_data=mysql_query($sql_examination_data,$link))>0)
		{
			echo '
				<tr><td colspan=2 align=center>
				<table border=1 style="border-collapse:collapse;  margin-top:20px; margin-bottom:10px">';
			echo '
					<tr  style="border:1px solid #000;">
						<th>Examination</th>
						<th>Result</th>
						<th>Reference Range</th>
						<th>Alert</th>
						<th>Method</th>
						
					</tr>
					';	
					
			while($examination_array=mysql_fetch_assoc($result_examination_data))
			{
				if($examination_array['id']<1000)
				{
					echo '
						<tr>
							<td>'.$examination_array['name_of_examination'].'</td>
							<td align=center><b>'.$examination_array['result'].'</b></td>
							<td align=center style=\'font-size:90%\'>'.$examination_array['referance_range'].' '.$examination_array['unit'].'</td>
							<td align=center style=\'font-size:90%\'>'.av_report_for_code($sample_id,$examination_array['code']).'</td>
							<td style=\'font-size:85%\'>'.$examination_array['method_of_analysis'].'</td>
							
						</tr>
						';		
				}
				elseif($examination_array['id']>=1000)
				{
					echo '
						<tr>
							<td colspan="10" >
								<table border=0>
									<tr>

										<tr><td><b>'.trim($examination_array['name_of_examination'],'Z_').'</b></td><td>'.$examination_array['result'].'</td></tr>
									</tr>
								</table>	
							</td>

						</tr>';
				}
			}
			



			echo '</table>';
		}	
			
			echo '<tr><td>Verified by: '.$sample_verification_array['sign'].'</td></tr>';	
			echo '<tr><td colspan=6 style=\'font-size:90%\'><b><i>This is electronically generated report form Clinical Chemistry Laboratory server http://10.218.56.164</b></i></td></tr>';	
			echo '<tr><td colspan=6 style=\'font-size:90%\'><f7>*All investigations have their own limitations; kindly correlate clinically and repeat if required.</f7></td></tr>';
			echo '<tr><td align=center colspan=6>-----End of Report-----</td></tr>';	
			echo '</table>';	
			
			
		return TRUE;

}
else
{
	return FALSE;
}
}



////////////////////////////////

function print_examinations($sample_id)
{
$link=start_nchsls();
$sql='select id,name_of_examination,result,unit,referance_range from examination where sample_id=\''.$sample_id.'\' order by id';


if(mysql_num_rows($result=mysql_query($sql,$link))>0)
{
echo '<table border=0>';

echo '<tr><td>Examination</td><td>Result</td><td>Unit</td><td>Ref. Range</td></tr>';

	//$rcount=0;
	//  $tr='<tr>';
	
while($ar=mysql_fetch_assoc($result))
{
	if($ar['id']<1000)
	{
		echo '<tr><td>'.$ar['name_of_examination'].'</td><td>'.$ar['result'].'</td><td>'.$ar['unit'].'</td><td>'.$ar['referance_range'].'</td></tr>';
	}
	elseif($ar['id']>=1000)
	{
		echo '	<tr>
				<td colspan="10">
					<table border=0>
					<tr>
								<tr><td><b>'.trim($ar['name_of_examination'],'Z_').':</b></td><td>'.$ar['result'].'</td></tr>
						
					</tr>
					</table>	
				</td>
				</tr>';
	}
}
// for remarks <td valign="top"><b>'.$ar['name_of_examination'].'</b></td><td><textarea readonly cols=50 rows=5 style="border-width: 0; overflow: auto;">'.$ar['result'].'</textarea></td><td>

date_default_timezone_set('Asia/Kolkata');
echo '<tr><td colspan=8 >----end of report---- '.strftime('%Y-%m-%d %H:%M:%S').'--------</td></tr>';
echo '</table>';
}
}	

function get_time_difference( $start, $end )
{
    $uts['start']      =    strtotime( $start );
    $uts['end']        =    strtotime( $end );
    if( $uts['start']!==-1 && $uts['end']!==-1 )

    {
        if( $uts['end'] >= $uts['start'] )
        {
            $diff    =    $uts['end'] - $uts['start'];
            if( $days=intval((floor($diff/86400))) )
                $diff = $diff % 86400;
            if( $hours=intval((floor($diff/3600))) )
                $diff = $diff % 3600;
            if( $minutes=intval((floor($diff/60))) )
                $diff = $diff % 60;
            $diff    =    intval( $diff );            
            return( array('days'=>$days, 'hours'=>$hours, 'minutes'=>$minutes, 'seconds'=>$diff) );
        }
        else
        {
            //trigger_error( "Ending date/time is earlier than the start date/time", E_USER_WARNING );
        }
    }
    else
    {
        //trigger_error( "Invalid date/time data detected", E_USER_WARNING );
    }
    return( false );
}


function print_examinations_tt($sample_id)
{
$link=start_nchsls();

$sql_tt='select sample_receipt_time from sample where sample_id=\''.$sample_id.'\'';
$sql='select id,name_of_examination,details,result,unit,referance_range from examination where sample_id=\''.$sample_id.'\' order by id';

//echo $sql_tt;
$result_tt=mysql_query($sql_tt,$link);
$sample_r_t=mysql_fetch_assoc($result_tt);
$sample_receipt_time=$sample_r_t['sample_receipt_time'];

if(mysql_num_rows($result=mysql_query($sql,$link))>0)
{
echo '<table border=1>';
echo '<tr><td>sample_id</td><td>Examination</td><td>turnaround time(Hours)</td></tr>';

	//$rcount=0;
	//  $tr='<tr>';
	
while($ar=mysql_fetch_assoc($result))
{
	if($ar['id']<1000)
	{
		//$ex=explode('|',$ar['details']);
		//$tt=get_time_difference($sample_receipt_time, $ex[0]);
		//$tt_in_hours=ceil($tt['days']*24+$tt['hours']+($tt['minutes']/60));
		////echo '<tr><td>'.$ar['name_of_examination'].'</td><td>'.$sample_receipt_time.'</td><td>'.$ex[0].'</td><td>'.$tt['days'].':'.$tt['hours'].':'.$tt['minutes'].'</td></tr>';
		//echo '<tr><td>'.$ar['name_of_examination'].'</td><td>'.$sample_receipt_time.'</td><td>'.$ex[0].'</td><td>'.$tt_in_hours.'</td><td>'.$ex[1].'</td></tr>';
		echo '<tr><td>'.$sample_id.'</td><td>'.$ar['name_of_examination'].'</td><td>'.find_turnaround_time($sample_id,$ar['id']).'</td></tr>';
	}
}

$x_tt='select sign_time from sample_verification where sample_id=\''.$sample_id.'\'';

$sign_tt=mysql_query($x_tt,$link);
$sample_sign_t=mysql_fetch_assoc($sign_tt);
$sample_sign_time=$sample_sign_t['sign_time'];


echo '</table>';
}
}	




function find_turnaround_time($sample_id,$id)
{
$link=start_nchsls();

$sql_tt='select sample_receipt_time from sample where sample_id=\''.$sample_id.'\'';
$sql='select id,name_of_examination,details,result,unit,referance_range from examination where sample_id=\''.$sample_id.'\' and id=\''.$id.'\'';

//echo $sql_tt;
$result_tt=mysql_query($sql_tt,$link);
$sample_r_t=mysql_fetch_assoc($result_tt);
$sample_receipt_time=$sample_r_t['sample_receipt_time'];

if(mysql_num_rows($result=mysql_query($sql,$link))>0)
{
while($ar=mysql_fetch_assoc($result))
{
	if($ar['id']<1000)
	{
		$ex=explode('|',$ar['details']);
		$tt=get_time_difference($sample_receipt_time, $ex[0]);
		return $tt_in_hours=ceil($tt['days']*24+$tt['hours']+($tt['minutes']/60));
	}
}

}
}	


function from_to_report_print($from_sample_id,$to_sample_id)
{
	for ( $counter = $from_sample_id; $counter <= $to_sample_id; $counter ++) 
	{
		if(print_sample($counter))
		{
		//print_examinations($counter);
		}
		echo '<h2 style="page-break-before: always;"></h2>';	
	}
	
}


function from_to_report_print_tt($from_sample_id,$to_sample_id)
{
	for ( $counter = $from_sample_id; $counter <= $to_sample_id; $counter ++) 
	{
		//if(print_sample($counter))
		//{
		print_examinations_tt($counter);
		//}
		echo '<h2 style="page-break-before: always;"></h2>';	
	}
	
}




function from_to_report_problem_print($from_sample_id,$to_sample_id)
{
	$link=start_nchsls();
echo '<table>	<tr><th colspan=3>From sample_id  '.$from_sample_id.' To '.$to_sample_id.       '</th></tr>
		<tr><th colspan=3>Following sample_id donot exist				 </th></tr>
		<tr><th colspan=3>or donot have any examination 				 </th></tr>
		<tr><th colspan=3>or its results are [empty] or [zero] or [not numerical]	 </th></tr>';
	for ( $counter = $from_sample_id; $counter <= $to_sample_id; $counter ++) 
	{
		//print_sample($counter);
		//print_examinations($counter);
		//echo '<h2 style="page-break-before: always;"></h2>';	
		$sql='select sample_id from sample where sample_id=\''.$counter.'\'';
		if(mysql_num_rows($result=mysql_query($sql,$link))==0)
		{
			echo '<tr><td><h5> sample_id='.$counter.'</h5></td><td><h5>sample_id not found </h5></td></tr>';
		}
		else
		{
			$sqle='select * from examination where sample_id=\''.$counter.'\'';
			
			if(mysql_num_rows($resulte=mysql_query($sqle,$link))==0)
			{
			echo '<tr><td>sample_id='.$counter.' </td><td>EXAMINATIONS not found </td></tr>';
			}
			else
			{
				while($ex_array=mysql_fetch_assoc($resulte))
				{
					//print_r($ex_array);
				if($ex_array['result']<=0)

				{
echo '<tr><td>sample_id='.$counter.' </td><td>examination='.$ex_array['name_of_examination'].' </td><td>result='.$ex_array['result'].'</td></tr>';
				}
				}
			}
		}
		
	}
	
echo '</table>';
}


function print_examinations_long($sample_id)
{
$link=start_nchsls();
$sql='select * from examination where sample_id=\''.$sample_id.'\'';


if(mysql_num_rows($result=mysql_query($sql,$link))>0)
{
echo '<table>';

echo '<tr><td colspan=8 >-------------------------------------------------------------------------------</td></tr>';

edit_header_examination();
while($ar=mysql_fetch_assoc($result))
{
	echo '<tr>';
	foreach ($ar as $key => $value)   //for every row in scope
	{
		if($key=='details')

		{
			echo '<td valign=top width=200>'.$value.'</td>';
		}
		else
		{
			echo '<td valign=top width=60>'.$value.'</td>';
		}
	}
	echo '</tr>';
		
}
date_default_timezone_set('Asia/Kolkata');
echo '<tr><td colspan=8 >------------------end of report---------------------- '.strftime("%d-%m-%y:%H:%M").'--------</td></tr>';
echo '</table>';
}
}	




///////////////////draw qc///////////////////
function draw_qc($qc_id,$rpt,$ex_code)
{
	$link=start_nchsls();
	
		$sql_qc = 
		'SELECT 
		comment,qc_id,`repeat`,sd,target,result,format((result-target)/sd,1),ex_code,
		reverse(SUBSTRING(\'111111111|222222222|333333333|4444444444\',1,-10*format((result-target)/sd,1)) ) 	Nsd, 
		SUBSTRING(\'111111111|222222222|333333333|4444444444\',1,10*format((result-target)/sd,1) ) Psd
		FROM 	`qc` 
		where  
		qc_id like \''.$qc_id.'\' and `repeat` like \''.$rpt.'\' and ex_code like \''.$ex_code.'\'
		order by ex_code, qc_id
		';
	//echo $sql_qc;
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
				else
				{
					echo '<td><tt>'.$value.'</tt></td>';
				}
			}
			echo '</tr>';
		}
	}	


}
////////////////
function draw_qc_xl($qc_id,$rpt,$ex_code)
{
	$link=start_nchsls();
	
		$sql_qc = 
		'SELECT 
		comment,qc_id,`repeat`,sd,target,result,format((result-target)/sd,1),ex_code,
		reverse(SUBSTRING(\'111111111|222222222|333333333|4444444444\',1,-10*format((result-target)/sd,1)) ) 	Nsd, 
		SUBSTRING(\'111111111|222222222|333333333|4444444444\',1,10*format((result-target)/sd,1) ) Psd
		FROM 	`qc_xl` 
		where  
		qc_id like \''.$qc_id.'\' and `repeat` like \''.$rpt.'\' and ex_code like \''.$ex_code.'\'
		order by ex_code, qc_id
		';

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
				else
				{
					echo '<td><tt>'.$value.'</tt></td>';
				}
			}
			echo '</tr>';
		}
	}	


}



//////////////


function draw_qc_other($qc_id,$rpt,$ex_code)
{
	$link=start_nchsls();
	
		$sql_qc = 
		'SELECT 
		comment,qc_id,`repeat`,sd,target,result,format((result-target)/sd,1),ex_code,
		reverse(SUBSTRING(\'111111111|222222222|333333333|4444444444\',1,-10*format((result-target)/sd,1)) ) 	Nsd, 

		SUBSTRING(\'111111111|222222222|333333333|4444444444\',1,10*format((result-target)/sd,1) ) Psd
		FROM 	`qc_other` 
		where  
		qc_id like \''.$qc_id.'\' and `repeat` like \''.$rpt.'\' and ex_code like \''.$ex_code.'\'
		order by ex_code, qc_id

		';

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
				else
				{
					echo '<td><tt>'.$value.'</tt></td>';
				}
			}
			echo '</tr>';
		}
	}	


}



//////////////
function qc_id_to_details($qc_id)
{


	//511051209	
	//   100000
		


	$details='';

	if (number_format($qc_id/100000000,0)==5)
		{
			$details=$details.'Normal QC ';
		}	
	else if(number_format($qc_id/100000000,0)==8)
	 	{
			$details=$details.'Abnormal QC ';
		}	
	
	$x=number_format(($qc_id%100000000)/1000000,0);
	$details=$details.'Year='.$x.' ';
	
	$xx=($qc_id%100000000);
	$xxx=number_format(($xx%1000000)/10000,0);
	$details=$details.'Month='.$xxx.' ';
	
	$xxxx=($qc_id%1000000);
	$xxxxx=number_format(($xxxx%10000)/100,0);
	$details=$details.'Day='.$xxxxx.' ';
	
	$xxxxxx=($qc_id%10000);
	$xxxxxxx=number_format(($xxxx%100)/1,0);
	$details=$details.'hour='.$xxxxxxx.' ';
	return $details;	
}

function make_qc_string($sd)
{
if($sd<0)					//-1.2
	{	
		$sd_final=max($sd,-4);		//-1.2
		$sd_final=40+10*$sd_final;	//40-12=28
	}
else if($sd>0)					//1.2
	{
		$sd_final=min($sd,4);		//1.2
		$sd_final=10*$sd_final+40;	//12+40=52
	}
else if($sd==0)
	{
	$sd_final=$sd;			//0
	$sd_final=40;			//40
	}
$str='';	

for ($i=0;$i<=80;$i++)
	{
	if($i==$sd_final)
		{
		$str=$str.'<font color=red>X</font>';
		}
	else if($i==40)
		{
		$str=$str.'<font>I</font>';
		}
	else if($i==50 || $i==30)
		{
		$str=$str.'<font color=green>|</font>';
		}
	else if($i==20 || $i==60)
		{
		$str=$str.'<font color=blue>|</font>';
		}
	else if($i==70 || $i==10)
		{
		$str=$str.'<font color=red>|</font>';
		}	
	else if($i%10)
		{
		$str=$str.'<font color=white>.</font>';
		}
	else 
		{
		$str=$str.'|';
		}

	

	}
	//	$str=$str.$sd;
	return $str;
}


/*
function make_qc_string($sd)
{
if($sd<0)					//-1.2
	{	
		$sd_final=max($sd,-4);		//-1.2
		$sd_final=40+10*$sd_final;	//40-12=28
	}
else if($sd>0)					//1.2
	{
		$sd_final=min($sd,4);		//1.2
		$sd_final=10*$sd_final+40;	//12+40=52
	}
else if($sd==0)
	{
	$sd_final=$sd;			//0
	$sd_final=40;			//40
	}
$str='';	

for ($i=0;$i<=80;$i++)
	{
	if($i==$sd_final)
		{
		$str=$str.'xx';
		}
	else if($i==40)
		{
		$str=$str.'00';
		}
	else if($i==30)
		{
		$str=$str.'-1';
		}
	else if($i==20)
		{
		$str=$str.'-2';
		}
	else if($i==10)
		{
		$str=$str.'-3';
		}
	else if($i==0)
		{
		$str=$str.'-4';
		}
	else if($i==50)
		{
		$str=$str.'+1';
		}
	else if($i==60)
		{
		$str=$str.'+2';
		}
	else if($i==70)
		{
		$str=$str.'+3';
		}
	else if($i==80)
		{
		$str=$str.'+4';
		}
	else if($i%10)
		{
		$str=$str.'  ';
		}
	else 
		{
		$str=$str.'|';
		}

	

	}
	//	$str=$str.$sd;
	return $str;
}

*/


////////////////qc end
function draw_qc_x($qc_id,$rpt,$ex_code)
{
	$link=start_nchsls();
	
		$sql_qc = 
		'SELECT ex_code,`repeat`, qc_id,
		target,sd,result,format((result-target)/sd,1) as lj,comment 
		FROM 	`qc` 
		where  
		qc_id like \''.$qc_id.'\' and `repeat` like \''.$rpt.'\' and ex_code like \''.$ex_code.'\'
		order by ex_code, qc_id, `repeat`
		';


	$result_qc=mysql_query($sql_qc,$link);
	echo mysql_error();
	while($array_qc=mysql_fetch_assoc($result_qc))
	{
		if($array_qc['result']!=NULL && is_numeric($array_qc['result']))
		{
			echo '<tr><td 
title=\''.qc_id_to_details($array_qc['qc_id']).'
repeat='.$array_qc['repeat'].', 
ex_code='.$array_qc['ex_code'].', 
result='.$array_qc['result'].', 
target='.$array_qc['target'].', 
sd='.$array_qc['sd'].' 
sd of result='.$array_qc['lj'].'
comment='.$array_qc['comment'].'\'><tt>';

			echo make_qc_string($array_qc['lj']);
			echo '</tt></td></tr>';
		}
	}	


}

/////////////////////
function draw_qc_x_xl($qc_id,$rpt,$ex_code)
{
	$link=start_nchsls();
	
		$sql_qc = 
		'SELECT ex_code,`repeat`, qc_id,
		target,sd,result,format((result-target)/sd,1) as lj,comment 
		FROM 	`qc_xl` 
		where  
		qc_id like \''.$qc_id.'\' and `repeat` like \''.$rpt.'\' and ex_code like \''.$ex_code.'\'
		order by ex_code, qc_id, `repeat`
		';

	$result_qc=mysql_query($sql_qc,$link);
	echo mysql_error();
	while($array_qc=mysql_fetch_assoc($result_qc))
	{
		if($array_qc['result']!=NULL && is_numeric($array_qc['result']))
		{
			echo '<tr><td 
title=\''.qc_id_to_details($array_qc['qc_id']).'
repeat='.$array_qc['repeat'].', 
ex_code='.$array_qc['ex_code'].', 
result='.$array_qc['result'].', 
target='.$array_qc['target'].', 
sd='.$array_qc['sd'].' 
sd of result='.$array_qc['lj'].'
comment='.$array_qc['comment'].'\'><tt>';
			echo make_qc_string($array_qc['lj']);
			echo '</tt></td></tr>';
		}
	}	


}







//////////////////////
function draw_qc_x_other($qc_id,$rpt,$ex_code)
{
	$link=start_nchsls();
	
		$sql_qc = 
		'SELECT ex_code,`repeat`, qc_id,
		target,sd,result,format((result-target)/sd,1) as lj,comment 
		FROM 	`qc_other` 
		where  
		qc_id like \''.$qc_id.'\' and `repeat` like \''.$rpt.'\' and ex_code like \''.$ex_code.'\'
		order by ex_code, qc_id, `repeat`
		';

	$result_qc=mysql_query($sql_qc,$link);
	echo mysql_error();
	while($array_qc=mysql_fetch_assoc($result_qc))
	{
		if($array_qc['result']!=NULL && is_numeric($array_qc['result']))
		{
			echo '<tr><td 
title=\''.qc_id_to_details($array_qc['qc_id']).'
repeat='.$array_qc['repeat'].', 
ex_code='.$array_qc['ex_code'].', 
result='.$array_qc['result'].', 
target='.$array_qc['target'].', 

sd='.$array_qc['sd'].' 
sd of result='.$array_qc['lj'].'
comment='.$array_qc['comment'].'\'><tt>';
			echo make_qc_string($array_qc['lj']);
			echo '</tt></td></tr>';
		}
	}	


}







//////////////////////



?>
