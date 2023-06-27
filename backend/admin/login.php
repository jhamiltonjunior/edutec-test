<?php

include('../shared/connection_db.php');

if (isset($_POST)) {
  $data = file_get_contents("php://input");
  $decode = json_decode($data, true);

  $cpf = $mysqli->real_escape_string($decode['cpf']);
  $password = $mysqli->real_escape_string($decode['password']);

  $encrypted_password = md5($password);

  $sql_code = "SELECT * FROM admin WHERE cpf = '$cpf' AND password = '$encrypted_password'";
  $sql_query = $mysqli->query($sql_code) or die(json_encode("Error in SQL code: " . $mysqli->error));

  $quantity = $sql_query->num_rows;

  if ($quantity == 1) {
    echo json_encode("Login successful!");
  } else {
    echo json_encode("Login Failed!");
  }

}