<?php

session_start();
session_destroy();
header('Location: ../index.php?action=display_login');

?>