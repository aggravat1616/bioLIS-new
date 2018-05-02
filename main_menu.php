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


$_SESSION['login']=$_POST['login'];
$_SESSION['password']=$_POST['password'];


include 'common.php';

if(!login_varify())
{
echo '	<table border=0 style="border-collapse:collapse; margin-top:20px"><tr><td><h2><b><FONT COLOR="#004586"><i>Incorrect login name and/or password.</i></FONT></b></h2></td></tr></table>
	<td style=\'font-size:150%\'>Go <b><a href=http://10.218.56.164>back</a></b> and retype login name and password. Make sure that <b><i>Caps Lock</i></b> is off.</td>';
exit();
}


$link=start_nchsls();
$ip=$_SERVER['REMOTE_ADDR'];
$sql=mysql_query('insert into login_trace (login_time,login_id,ip) values(\''.strftime("%d-%m-%Y, %H:%M").'\',\''.$_SESSION['login'].'\',\''.$ip.'\')',$link);    
echo mysql_error();


main_menu();

?>
