<?php
error_reporting(0);
session_start();

$host     = "localhost";
$username = "root";
$password = "";
$database = "krs_onlinee";

$conn     = mysqli_connect($host, $username, $password, $database);
