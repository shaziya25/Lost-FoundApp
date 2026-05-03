<?php
session_start();

$lang = $_GET['lang'] ?? 'en';

$_SESSION['lang'] = $lang;

// go back
header("Location: " . $_SERVER['HTTP_REFERER']);