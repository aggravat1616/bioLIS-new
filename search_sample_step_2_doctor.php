<?php
session_start();

echo '<html>';
echo '<head>';

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

echo '	<table border=0 style="border-collapse:collapse;  margin-top:10px" bgcolor=lightpink>
	<tr><td height=30><i>Reports are best viewed and printed in Mozilla Firefox.</i></td></tr>	
	</table>';

echo '	<table border=0 style="border-collapse:collapse;  margin-top:10px" bgcolor=lightgrey>
	<tr><td height=30><i><font size=5 color=green>* Empty result field indicate pending reports.</font</i></td></tr>
	<tr><td height=30><i><font size=5 color=green>* Entries having sample ID other than 10 digit are those generated for internal testing purpose.</font></i></td></tr>	
	</table>';

echo '	<table border=0 style="border-collapse:collapse;  margin-top:10px" bgcolor=lightpink>
	<tr><td height=30><b><font size=5>To print a report:</font></b></td></tr>
	<tr><td>Go to <i><u>Print Preview</u></i> function form the <i><u>File</u></i> menu of your web browser. Go to the page displaying the report to be printed. Set appropriate print size using <i><u>Change print size/ Scale</u></i> function and give print of the displayed page number.</td></tr>
	<tr><td>For convenient printing, a page-break has been given after menu as well as after each displayed report.</td></tr>
	</table>';

echo '<h2 style="page-break-before: always;"></h2>';	
run_search_query_doctor($_POST);
?>
