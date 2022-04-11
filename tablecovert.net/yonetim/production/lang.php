<?php 
session_start();

$_SESSION['lang'] = $_GET['lang'];




$fa = $_SERVER['HTTP_REFERER']; 
header("Location: ".$fa."");
die;
?>