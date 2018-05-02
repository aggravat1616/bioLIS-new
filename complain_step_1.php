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

main_menu();


/*
echo '<pre>';
$result=mysql_query('select * from feedback_complain',$link);



while($ar=mysql_fetch_assoc($result))
{
print_r($ar);
}

echo'<pre>';

$r=mysql_query("insert into feedback_complain values('k')",$link);
print_r($r);
echo mysql_error();
*/



echo '<form method=post action=complain_step_2.php>

<h2 align=center><u>Laboratory feedback-complain form</u></h2>
<h3><font color=green><i>Fill the form and press "SUBMIT" button located at bottom of the page</i></font></h3>

<table>
<tr><td>Feedback-complain ID:</td><td><input type=text name=feedback_id readonly value=\''.strftime("%y%m%d%H%M").'\'></td></tr>

<tr><td>Your name:</td><td><input type=text name=name><i>(optional)</i></td></tr>

<tr><td>Designation:</td><td><input type=text name=designation></td></tr>

<tr><td>Department:</td><td><input type=text name=department></td></tr>

<tr><td>e-mail:</td><td><input type=text name=e_mail><i>(optional) (for feedback from the lab)</i></td></tr>
</table>
----------------------------------------------------------------------------------------------------------------------
<h3><font color=green>Judge the laboratory: </font><font color=red><i>(On scale of 1 to 10; <font color=darkblue size=6%>1</font>= not at all satisfactory, <font color=darkblue size=6%>10</font>= excellent)</i></font></h3>

Quality (perceived accuracy) of test results: <input type=text name=quality_results style=\'font-size:150%\' size=1><i>(On scale of 1 to 10)</i><br>

Quality test reports: <input type=text name=quality_reports style=\'font-size:150%\' size=1><i>(On scale of 1 to 10)</i><br>

Delivery test reports: <input type=text name=delivery_reports style=\'font-size:150%\' size=1><i>(On scale of 1 to 10)</i><br>

Attitude of laboratory employees: <input type=text name=attitude style=\'font-size:150%\' size=1><i>(On scale of 1 to 10)</i><br>

Promptness of laboratory response: <input type=text name=response_promptness style=\'font-size:150%\' size=1><i>(On scale of 1 to 10)</i><br>

Response on urgent test: <input type=text name=response_urgent style=\'font-size:150%\' size=1><i>(On scale of 1 to 10)</i><br>

Overall satisfaction level with Clinical Chemistry Laboratory: <input type=text name=satisfaction_ccl style=\'font-size:150%\' size=1><i>(On scale of 1 to 10)</i><br>


----------------------------------------------------------------------------------------------------------------------
<h3><font color=green>Your suggestion(s)-complain(s) <i>(if any ):</font></i></h3><br><textarea name=feedback_complain style=\'font-size:120%\' cols=60 rows=6></textarea><br><br>

<input type=submit value=SUBMIT>

</form>
';


?>
