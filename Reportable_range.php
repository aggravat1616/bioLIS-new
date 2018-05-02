<?php
$link=mysql_connect('127.0.0.1','root','lipoprotein');

$xx=mysql_select_db('biochemistry',$link);

//echo '<pre>';
//print_r($GLOBALS);
//echo '</pre>';

session_start();
include 'common.php';



make_sample_wise_worklist_get_id('<h1>write first and last sample_id of report to be autoverified for Reportable Range</h1>','Reportable_range_step_1.php');

	

?>
