<?php
session_start();
$_SESSION = array();
if(isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
    }
session_unset();
session_destroy();
session_write_close();
session_regenerate_id(true);
setcookie("phpdigadmin", "", mktime(12,0,0,1, 1, 1970), "/");
$_SESSION['login']=$_POST['login']=='xyz';
header("Location: index.php? msg=Successfully logged out");
exit;
?>
