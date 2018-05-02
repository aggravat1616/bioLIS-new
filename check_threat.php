<?php
session_start();

echo '<html>';
echo '<head>';
echo '<title>Clinical Chemistry, LSB</title>';

// set time since inactivity to auto-logout in seconds below in content="600; --> 600 seconds i.e. 10 minutes
echo '<meta http-equiv="refresh" content="600;url=http://10.218.56.164/logout.php" />';

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

second_menu();

$link=start_nchsls();
$sql='select login_name from signature_authority';
$result=mysql_query($sql,$link);

echo '<table border=1><th colspan=3>Threats recorded</th>';
echo '<tr><td align=center><b>Login name</b></td><td align=center><b>IP from where logged in</b></td><td align=center><b>Login time</b></td></tr>';

while($ar=mysql_fetch_assoc($result))
{
	//print_r($ar);

	foreach ($ar as $key => $value)   //for each login_name
	{

		/////set below IP addresses as your lowest and highest used IP addresses in the range.

		$r='SELECT * FROM `login_trace` WHERE `login_id` LIKE \''.$value.'\' AND `ip` NOT BETWEEN \'10.218.56.164\' AND \'10.218.56.175\' order by login_time';
		$r1=mysql_query($r,$link);

		if(mysql_num_rows($r1)<1 && $value!=NULL)
		{
		echo '<tr><td>'.$value.'</td><td colspan=2>No recorded threat</td></tr>';
		}
		
		else
		{
			while ($threat_q=mysql_fetch_assoc($r1))
			{
				foreach ($threat_q as $key=>$value)
				{
					if($key=='login_id')
					{
						echo '<tr>
							<td><font color=red>'.$threat_q['login_id'].'</font></td>
							<td><font color=red>'.$threat_q['ip'].'</font></td>
							<td><font color=red>'.$threat_q['login_time'].'</font></td>
						</tr>';
					}
					
				}
			}
		}
	}

}

echo '</table>';

?>
