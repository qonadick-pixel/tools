<?php
    session_start();
    session_destroy();
    $_SESSION['name'] = null;
    $_SESSION['pass'] = null;
    $_SESSION['auth'] = false;
    header('Location: /login');
?>