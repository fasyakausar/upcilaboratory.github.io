
//Session Berakhir Dalam 10 Detik
$minutesBeforeSessionExpire=30;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > ($minutesBeforeSessionExpire*60))) {
    session_unset();     // unset $_SESSION   
    session_destroy();   // destroy session data  
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity
