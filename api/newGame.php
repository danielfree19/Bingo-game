<?php

session_start();
session_regenerate_id(true);
session_unset();
$_SESSION = array();
session_destroy();
session_start();
?>
<script>
    onload(window.location.assign("../"))
</script>
