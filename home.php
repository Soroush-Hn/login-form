<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
	header('Location: login.html');
	exit();
}
if ($_SESSION['access'] === "basic"){
	require "view/basic.php";
}elseif ($_SESSION['access'] === "admin"){
	require "view/admin.php";
}else{
	require "view/404.php";
}

session_unset();
session_destroy();

