<?php
session_start();
session_destroy();
// Redirectare la paginaprincipalaproduse:
header('Location: adminlogin.html');
?>