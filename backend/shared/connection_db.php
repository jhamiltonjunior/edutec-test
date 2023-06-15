<?php

// cors
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Origin: *");

$hostname = "172.17.0.5";
$username = "root";
$password = "0000";
$dbname = "edutec";

$mysqli = new mysqli($hostname, $username, $password, $dbname);

if ($mysqli->connect_errno) {
  echo "Erro: (" . $mysqli->connect_errno . ")" . $mysqli->connect_error;
}

