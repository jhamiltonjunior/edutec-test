<?php

include('../../shared/connection_db.php');

if (isset($_POST)) {
  $data = file_get_contents("php://input");
  $decode = json_decode($data, true);

  $cpf = $mysqli->real_escape_string($decode['cpf']);

  $sql_code = "DELETE FROM professional WHERE cpf = '$cpf'";
  $sql_query = $mysqli->query($sql_code) or die(json_encode("Error in SQL code: " . $mysqli->error));

  // $quantity = $sql_query->num_rows;

  if ($sql_query == true) {
    echo json_encode("successful!");
  } else {
    echo json_encode("failed!");
  }

}

