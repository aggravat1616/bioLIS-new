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

if(insert_sample($_POST['paste_sample_id']))
{
insert_sample_verification($sample_id);
copy_update_sample($_POST['copy_sample_id'],$_POST['paste_sample_id']);
insert_single_examination($_POST['paste_sample_id'],'1');
edit_sample($_POST['paste_sample_id'],'edit_request_step_3.php',' ');
}
else
{
echo '<br>sample id already exist<br>';
}

function insert_sample_verification($sample_id)
{
$link=start_nchsls();
if(! mysql_query('insert into sample_verification (sample_id) value (\''.$_POST['paste_sample_id'].'\')',$link))
    {

        echo mysql_error();
        return FALSE;
    }
	return TRUE;
}


main_menu();
?>
