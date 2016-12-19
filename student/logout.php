<?php

// SESSION SMASH!!!!!!!!

session_start();
session_destroy();

header("Location: index.php");

?>