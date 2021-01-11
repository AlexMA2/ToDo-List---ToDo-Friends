<?php
    session_start();
    $variable = filter_input(INPUT_POST, 'variable');
    $_SESSION[$variable] = filter_input(INPUT_POST, 'idVar');
?>