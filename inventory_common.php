<?php

/*
session_start();

echo '<html>';
echo '<head>';
echo '<title>nchsls.biochemistry</title>';
echo '</head>';
echo '<body>';

echo '<pre>';
print_r($GLOBALS);
echo '</pre>';
*/

include 'common.php';

function insert_raw($query_id,$raw_array)
{
if(!isset($raw_array['submit'])){return -1;}
//echo '<<'.$sql_str.'>>';

$link=start_inventory();
$query_details=get_query_details($query_id);
$table_name=$query_details[0];
$insert_sql='insert into '.$table_name.' (';
foreach ($raw_array as $key=>$value)
{if($key!='submit' && $key!='query_id'){ 	
$insert_sql=$insert_sql.' `'.$key.'`  ,';}
}

$insert_sql=substr($insert_sql,0,-2);

$insert_sql=$insert_sql.' ) values(';

foreach ($raw_array as $key=>$value)
{if($key!='submit' && $key!='query_id'){ 	
$insert_sql=$insert_sql.' \''.$value.'\'  ,';}
}

$insert_sql=substr($insert_sql,0,-2);

$insert_sql=$insert_sql.' )';

//echo $insert_sql;

if(! mysql_query($insert_sql,$link))
    {
        echo 'insert failed:'.mysql_error();
    }
else
	{
	//echo '<br>insert success:'.$insert_sql;
	}
}


function select_inventory($link)
{
	return mysql_select_db('inventory',$link);
}

///////////////////////////////////
function start_inventory()
{
	if(!$link=login_varify())
	{
		exit();
	}


	if(!select_inventory($link))
	{
		exit();
	}
return $link;
}

function update_raw($raw_array)
{

if(!isset($raw_array['submit'])){return -1;}

$link=start_inventory();
$query_details=get_query_details($_POST['query_id']);
$table_name=$query_details[0];
$primary_key=primary_key_array($table_name);
	$sql_show='show columns from `'.$table_name.'`';
	if(!$result_show=mysql_query($sql_show,$link))
	{
	        echo mysql_error();
	        return FALSE;
	}
	$update_sql='update '.$table_name.' set ';
	while($array_show=mysql_fetch_assoc($result_show))
	{
	$update_sql=$update_sql.' `'.$array_show['Field'].'`=\''.$raw_array[$array_show['Field']].'\' , ';
	}
	
	$update_sql=substr($update_sql,0,-2);
	$update_sql=$update_sql.' where `'.$primary_key[0].'`=\''.$raw_array[$primary_key[0]].'\'';
	//echo '1111:'.$update_sql.'<br>';




if(! mysql_query($update_sql,$link))
    {
        echo mysql_error();

    }
}
//////////////////////////
function delete_raw($query_id,$raw_array)
{
$link=start_inventory();
$query_details=get_query_details($query_id);
$table_name=$query_details[0];
$array_primary_key=primary_key_array($table_name);
//$delete_sql='delete from '.$table_name.' where `'.$array_primary_key[0].'`=\''.$raw_array[$array_primary_key[0]].'\'';
$delete_sql='delete from '.$table_name.' where `'.$array_primary_key[0].'`=\''.$raw_array[$array_primary_key[0]].'\'';
echo $delete_sql;
mysql_query($delete_sql,$link);
echo mysql_error();
}



///////////////////////////
function make_array_inventory($sql_str, $fld,$dfl)
{
//echo $sql_str;
$link=start_inventory();

$result=mysql_query($sql_str,$link);
echo mysql_error(); 
while ($ops=mysql_fetch_assoc($result))
{
	$ar[]=$ops[$fld];
}
//echo $ar;
echo '<select  name='.$fld.'>';

		foreach ($ar as $key => $value)
		{
			if($value==$dfl)
			{
					echo '<option  selected > '.$value.' </option>';
			}
			else
			{
				echo '<option  > '.$value.' </option>';
			}
		}
	
		echo '</select>';

}

function get_data($query_id,$filename)
{
	$query_details=get_query_details($query_id);
	$table_name=$query_details[0];
	echo '<table border=1><th colspan=2>'.$table_name.'</th><form method=post action=\''.$filename.'\'>';
	echo '<input type=hidden name=query_id value=\''.$query_id.'\'></td>';	  

	$link=start_inventory();
	$array_foreign_keys=find_foreign_keys($table_name);
	//$array_primary_key=primary_key_array($table_name);
	$sql_show='show columns from `'.$table_name.'`';
	if(!$result=mysql_query($sql_show,$link))
	{
	        echo mysql_error();
	        return FALSE;
	}
	while($array_show=mysql_fetch_assoc($result))
	{

			$sql_make_array=' ';
			if($array_foreign_keys!=NULL)
			{
			foreach ($array_foreign_keys as $key=>$value)
			{
				if(($array_show['Field']==$key))
				{
					$sql_make_array='select distinct `'.$key.'` from `'.$value.'`';
					//echo $sql_make_array;
				}
			}
			}		
		
		if($array_show['Extra']=='auto_increment')
		{
		}
		else
		{
			if($sql_make_array==' ')
			{
				echo '<tr><td>'.$array_show['Field'].'</td><td><textarea rows=5 cols=40 name=\''.$array_show['Field'].'\'></textarea></td></tr>';
			}
			else
			{
				echo '<tr><td>'.$array_show['Field'].'</td><td>';
				make_array_inventory($sql_make_array,$array_show['Field'],'');
				echo '</td></tr>';
			}
		}
	}
    
    	echo '<tr><td><input type=submit value=insert name=submit></td></tr>';
    echo '</form></table>';
    return TRUE;
}


function find_foreign_keys($table_name)
{
	$link=start_inventory();
	$sql_show_create='show create table `'.$table_name.'`';
	if(!$result_show_create=mysql_query($sql_show_create,$link))
	{
		echo 'show create::'.mysql_error();
        	return FALSE;
    	}
	$array_show_create=mysql_fetch_assoc($result_show_create);
	
//echo '<pre>';
//print_r($array_show_create);
//echo '****</pre>';

$exploded_array=explode(' ',$array_show_create['Create Table']);

//echo '<pre>';
//print_r($exploded_array);
//echo '</pre>';



$i=0;
while	(
	isset($exploded_array[$i]) &&
	isset($exploded_array[$i+1]) &&
	isset($exploded_array[$i+2]) &&
	isset($exploded_array[$i+3]) &&
	isset($exploded_array[$i+4]) &&
	isset($exploded_array[$i+5]) 
	)
	{
			//echo $exploded_array[$i];
		
		if($exploded_array[$i]=='FOREIGN')
		{
			//echo $exploded_array[$i];
			//echo $exploded_array[$i+1];
			//echo $exploded_array[$i+2];
			$field_exploded=explode('`',$exploded_array[$i+2]);
			//echo $field_exploded[1];
			
			//echo $exploded_array[$i+3];
			//echo $exploded_array[$i+4];
			$table_exploded=explode('`',$exploded_array[$i+4]);
			//echo $exploded_array[$i+5];
			//echo $table_exploded[1];
			//$foreign_key_array=array($field_exploded[1]=>$table_exploded[1]);
			$foreign_key_array[$field_exploded[1]]=$table_exploded[1];
			
		}
	$i++;
	}
	
//echo '<pre>';
//print_r($foreign_key_array);
//echo '</pre>';
	if(isset($foreign_key_array))
	{
		return $foreign_key_array;
	}
	else
	{
		return NULL;
	}
}



function primary_key_array($table_name)
{
	$link=start_inventory();
	//echo 'tnnn:'.$table_name;
	$sql_show_create='desc `'.$table_name.'`';
	//echo 'qqqqqqq:'.$sql_show;
	if(!$result_show_create=mysql_query($sql_show_create,$link))
	{
		echo 'show create::'.mysql_error();
        	return FALSE;
    	}

	while($array_show_create=mysql_fetch_assoc($result_show_create))
	{
		if($array_show_create['Key']=='PRI')
			{
			$primary_key_array[]=$array_show_create['Field'];	
			}

	}


		//echo '<pre>';
		//print_r($primary_key_array);
		//echo '</pre>';

	return $primary_key_array;
}




function edit_data($post_array,$filename)
{
	$link=start_inventory();
	$query_details=get_query_details($post_array['query_id']);
	$table_name=$query_details[0];

	$array_foreign_keys=find_foreign_keys($table_name);
	$array_primary_key=primary_key_array($table_name);

	$sql_selected='select * from `'.$table_name.'` ';
	$sql_selected=$sql_selected.' where '; 
	$sql_selected=$sql_selected.'`'.$array_primary_key[0].'`=\''.$post_array[$array_primary_key[0]].'\'';

	if(!$result_selected=mysql_query($sql_selected,$link))
	{
        	echo 'selection:'.mysql_error();
        	return FALSE;
    	}

	echo '<table border=1><th colspan=2>'.$table_name.'</th><form method=post action=\''.$filename.'\'>';
	echo '<input type=hidden name=query_id value=\''.$post_array['query_id'].'\'></td>';
	while($array_selected=mysql_fetch_assoc($result_selected))
	{
		foreach ($array_selected as $key=>$value)
		{
			$sql_make_array=' ';$read_only=' ';
			if($array_foreign_keys!=NULL)
			{
				foreach ($array_foreign_keys as $keyy=>$valuee)
				{
					if(($key==$keyy))
					{
						$sql_make_array='select distinct `'.$keyy.'` from `'.$valuee.'`';
					}
				}
			}		

			if($key==$array_primary_key[0])
			{
				$read_only='yes';
			}
		
			if($sql_make_array==' ')
			{
				if($read_only=='yes')
				{
					echo '<tr><td>'.$key.'</td><td><textarea rows=5 cols=40 readonly name='.$key.'>'.$value.'</textarea></td></tr>';
				}
				else
				{
					echo '<tr><td>'.$key.'</td><td><textarea rows=5 cols=40 name='.$key.'>'.$value.'</textarea></td></tr>';
				}		
			}
			else
			{
				if($read_only=='yes')
				{
					echo '<tr><td>'.$key.'</td><td><textarea rows=5 cols=40 readonly name='.$key.'>'.$value.'</textarea></td></tr>';
				}
				else
				{
					echo '<tr><td>'.$key.'</td><td>';
					make_array_inventory($sql_make_array,$key,$value);
					echo '</td></tr>';
				}
			}
		}
	}
    	echo '<tr><td><input type=submit value=update name=submit></td></tr>';
    	echo '</form></table>';
    	return TRUE;
}



///////////////////
function all_query($filename)
{
	$link=start_inventory();
	$table_name='query';	
	$where_condition='';	
	$array_primary_keys=primary_key_array($table_name);
	$sql_str='select * from `'.$table_name.'` '.$where_condition;
	if(!$result_selected=mysql_query($sql_str,$link))
    	{
        	echo 'display_table:'.mysql_error();
        	return FALSE;
    	}
	echo '<table border=1><th>select '.$table_name.'</th><form method=post action=\''.$filename.'\'>';

	while($array_selected=mysql_fetch_assoc($result_selected))
	{
		echo '<tr>';		
		foreach ($array_selected as $key=>$value)
		{
			if($array_primary_keys!=NULL)
			{
			foreach ($array_primary_keys as $keyy=>$valuee)
				{
					if($valuee==$key)
					{
						echo '<td><input type=submit name=\''.$key.'\' value=\''.$value.'\'></td>';
					}
				}
			}
			echo '<td>'.$value.'</td>';
		}
		echo '</tr>';
	}
	echo '</form></table>';
}

function display_table($id,$filename)
{
	$query_details=get_query_details($id);
	$link=start_inventory();
	$table_name=$query_details[0];	
	$where_condition=$query_details[1];	
	$array_primary_keys=primary_key_array($table_name);
	//echo htmlspecialchars($sql_str,ENT_QUOTES);
	$sql_str='select * from `'.$table_name.'` '.$where_condition;

	if(!$result_header=mysql_query($sql_str,$link))
    	{
        	echo 'display_table:'.mysql_error();
        	return FALSE;
    	}


	if(!$result_selected=mysql_query($sql_str,$link))
    	{
        	echo 'display_table:'.mysql_error();
        	return FALSE;
    	}

	$array_header=mysql_fetch_assoc($result_header);


	echo '<table border=1><th>select '.$table_name.'</th><form method=post action=\''.$filename.'\'>';

		echo '<tr>';		
		//echo '<td></td>';
		foreach ($array_header as $key=>$value)
		{
			if($array_primary_keys!=NULL)
			{
			foreach ($array_primary_keys as $keyy=>$valuee)
				{
					if($valuee==$key)
					{
						echo '<td>'.$key.'</td>';
					}
				}
			}
			echo '<td>'.$key.'</td>';
		}
		echo '</tr>';

	




	while($array_selected=mysql_fetch_assoc($result_selected))
	{
		echo '<tr>';		
		echo '<input type=hidden name=query_id value=\''.$id.'\'>';
		foreach ($array_selected as $key=>$value)
		{
			if($array_primary_keys!=NULL)
			{
			foreach ($array_primary_keys as $keyy=>$valuee)
				{
					if($valuee==$key)
					{
						echo '<td><input type=submit name=\''.$key.'\' value=\''.$value.'\'></td>';
					}
				}
			}
			echo '<td>'.$value.'</td>';
		}
		echo '</tr>';
	}
	echo '</form></table>';
}


function get_query_details($query_id)
{
	$link=start_inventory();
	$sql_qr='select * from query where query_id=\''.$query_id.'\'';
	if(!$result_qr=mysql_query($sql_qr,$link))
	{
	       	echo 'query table:'.mysql_error();
	       	return FALSE;
	}
	$array_qr=mysql_fetch_assoc($result_qr);
	return array($array_qr['table_name'],$array_qr['where_condition']);
}




?>
