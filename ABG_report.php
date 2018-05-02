<?php


function print_ABG($sample_id)
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
			<table border=0 style="border-collapse:collapse; ">
				<tr>
					<td colspan=2 align=center>
						<table border=0 style="border-collapse:collapse;  margin-bottom:20px">
							<tr><th colspan=2><u><h3>Laboratory Services, S.S.G.Hospital and Medical College, Baroda</h3></u></td></tr>							
							<tr><th>Clinical Chemistry Section, Tel.: 2424848 Ext. 326</th></tr>
							<tr><th><u>Arterial Blood Gas Analysis Report</u></th></tr>					
						</table>
						
					</td>

				<tr style="border:1px solid #000; ">
								<td>
									<table border=0 >
										<tr><td><b>Patient Name: </b></td><td>'.$sample_array['patient_name'].'</td></tr>
										<tr><td><b>MRD Number: </b></td><td>'.$sample_array['patient_id'].'</td></tr>
									</table>
								</td>	
								<td align=right>
									<table border=0>

										<tr><td><b>'.$sample_array['clinician'].'</td><td><b>Unit: '.$sample_array['unit'].'</b></td></tr>
										<tr><td><b>'.$sample_array['location'].'</b></td></tr>
									</table>
								</td>						
				</tr>

				<tr style="border:1px solid #000;">
								<td>
									<table border=0>
										<tr><td style=\'font-size:150%\'>Sample ID: <FONT SIZE=4>'.$s_id_date.'</FONT><b><u>'.$s_id_id.'</b></u></td></tr>
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
							<tr  style="border:1px solid #000;"><td>Receipt Time: '.$sample_array['sample_receipt_time'].'</td><td align=right>Report Time: '.strftime('%d-%m-%Y, %H:%M').' </td></tr>
													
			';

		if(mysql_num_rows($result_examination_data=mysql_query($sql_examination_data,$link))>0)
		{
			echo '
				<tr><td colspan=2 align=center>
				<table border=1 style="border-collapse:collapse;  margin-top:20px">';
			echo '
					<tr  style="border:1px solid #000;">
						<th>Examination</th>
						<th>Result</th>
						<th>Unit</th>
						<th>Ref.Range</th>
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
							<td align=center>'.$examination_array['unit'].'</td>
							<td align=center>'.$examination_array['referance_range'].'</td>
							<td>'.$examination_array['method_of_analysis'].'</td>
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
echo '<tr><td colspan=6>Remark: Excess sodium heparin might affect the results of sodium and potassium.</td></tr>';

		}	
			
				
			echo '	<tr>
						<td colspan=24 align=center>


							<table border=1 style="border-collapse:collapse;  margin-top:20px">
								<tr>
									<td width=280 height=40>Technician:</td><td></td>
									<td>Sign:</td><td width=350></td>
								</tr>
								
								<tr>
									<td align=left colspan=2>'.$sample_verification_array['technician'].'</td>
									<td align=right colspan=2>'.$sample_verification_array['sign'].'</td>
								</tr>
								
							</table>								
						</td>
					</tr>
						';	
		
			echo '<tr><td colspan=6><f7>*All investigations have their own limitations; kindly correlate clinically and repeat if required.</f7></td></tr>';
			
			echo '<tr><td align=center colspan=6>-------- End of Report --------</td></tr>';	
			echo '</table>';	
			
echo'
<table style="border-collapse:collapse;  margin-top:20px">
<tr><td><b>HCO<font size=1>3</font>-Standard:</b> Calculated HCO<font size=1>3</font> concentration in plasma at a pCO<font size=1>2</font> of 40 mmHg, temperature of 37 deg.Celcius and complete O<font size=1>2</font> saturation of Hb.</td></tr>
<tr><td><b>BE:</b> The amount of acid/base required to return the blood pH to normal value with the amount of carbon dioxide held at standard value.</td></tr>
<tr><td><b>SBE:</b> The value of BE calculated for Hb of 6 g/dL.</td></tr>
<tr><td><b>BB:</b> Sum of all anion buffer concentrations in blood (hemoglobin, bicarbonate, protein, phosphate etc.)</td></tr>
<tr><td><b>p50:</b> Oxygen partial pressure at which Hb is 50% saturated with oxygen.</td></tr>
<tr><td><b>Normal value of AaDO<font size=1>2</font></b> (Alveolo-arterial diffusion gradient of O<font size=1>2</font>)= (Age in years+10) / 4</td></tr>
</table>
';
			
		return TRUE;

}
else
{
	return FALSE;
}
}


?>
