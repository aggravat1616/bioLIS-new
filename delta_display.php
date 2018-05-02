<?php


function get_patient_id_display($sample_id)
{
$all_details=get_all_details_of_a_sample_display($sample_id);
return $all_details[0]['patient_id'];

}

function get_all_sample_id_from_patient_id_display($patient_id)
{
$link=start_nchsls(); 
$sql='select sample_id from sample where patient_id=\''.$patient_id.'\' order by sample_id desc LIMIT 0, 15';
//echo $sql;
if(!$result=mysql_query($sql,$link)){echo mysql_error();return FALSE;}
while ($array_sample_id=mysql_fetch_assoc($result))
	{	
		$return_array[]=$array_sample_id['sample_id'];
		
	}

		//echo '<pre>';
		//print_r($return_array);
		//echo '</pre>';	
		return $return_array;
}

function get_all_sample_id_from_sample_id_display($sample_id)
{
return get_all_sample_id_from_patient_id_display(get_patient_id_display($sample_id));
}



function get_chronology_of_an_examination_display($name_of_examination,$sample_id)
{
$sample_id_array=get_all_sample_id_from_sample_id_display($sample_id);

$counter=0;

foreach($sample_id_array as $key=>$value)
	{
	$chronology[$value]=get_examination_result_display($name_of_examination,$value);
	//echo '<td>'.$chronology[$value].'</td>';
	//echo $value;

	$link=start_nchsls(); 
	$sql='select * from sample where sample_id=\''.$value.'\'';
	$result=mysql_query($sql,$link);
	$ar=mysql_fetch_assoc($result);

	$counter=$counter+1;
	//echo $counter;

	if ($odd = $counter%2){$td='<td bgcolor=lightyellow align=center>';}else{$td='<td bgcolor=lavender align=center>';}

	echo '<tr>'.$td.$counter.'</td>'.$td.$value.'</td>'.$td.$ar['sample_receipt_time'].'</td>'.$td.$ar['patient_name'].'</td>'.$td.$ar['sample_details'].'</td>'.$td.'<b>'.$chronology[$value].'</b></td></tr>';

	}
//return $chronology;
}




function get_all_details_of_a_sample_display($sample_id)
{
	$link=start_nchsls();
	$sql_sample_examination='select 
						*
					from 
						examination
						join sample ON sample.sample_id = examination.sample_id
					where 
						sample.sample_id=\''.$sample_id.'\' ';
	
	if(!$result_sample_examination=mysql_query($sql_sample_examination,$link)){echo mysql_error();return FALSE;}
	while ($array_sample_examination=mysql_fetch_assoc($result_sample_examination))
	{	
		$return_array[]=$array_sample_examination;
	}
		//echo '<pre>';
		//print_r($return_array[0]['patient_id']);
		//echo '</pre>';	
        	//if(!isset($return_array)){echo 'no such sample/no examinations for this sample';return FALSE;}
		return $return_array;

}


function get_examination_result_display($name_of_examination,$sample_id)
{
$all_array=get_all_details_of_a_sample_display($sample_id);
foreach($all_array as $key=>$value)
	{
	foreach($value as $keyy=>$valuee)
		{
		if($valuee==$name_of_examination && $keyy=='name_of_examination')
			{
			if(strlen($value['result'])<=0)
				{
				return 'ND';	// Not_Done
				}
			else
				{
				return $value['result'];
				}				
			}
		}
	}
return 'NR';	// Not_Requested
}


function get_examination_result_num_display($code,$sample_id)
{
$if_num=is_str_num(get_examination_result_display($code,$sample_id));
if(!$if_num){return FALSE;}
else{return $if_num;}
}


?>
