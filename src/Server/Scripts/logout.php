<?php
    /**
     * This script is used to destory all session variables.
     */
    session_start();
    session_unset();
    session_destroy();

    header("location: ../../index.php");
?>