<?php

ob_start();
session_start();

defined("DS") ? null : define("DS" , DIRECTORY_SEPERATOR);

defined("DB_HOST") ? null : define("DB_HOST" . "localhost");
defined("DB_USER") ? null : define("DB_USER" . "root");
defined("DB_PASS") ? null : define("DB_PASS" . "");
defined("DB_NAME") ? null : define("DB_NAME" . "icle");


$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

//require_once("functions.php");
//echo __DIR__;

?>