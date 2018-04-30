<?php
session_start();

// remove all session variables
session_unset(); 

// destroy the session
session_destroy();

echo '<script type="text/javascript">
window.open("../index.php");
window.close("log_out.php");
</script>';
exit;

?>