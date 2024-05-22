<?php

session_start();

// session_destroy();


echo 
'<script type="text/javascript">',
    'window.localStorage.clear();',
    'window.location.reload(true);',
    'window.location.replace("../../admin-dashboard.php");',
'</script>';

exit();

?>