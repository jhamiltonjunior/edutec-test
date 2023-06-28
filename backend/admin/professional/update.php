<?php

include('../../shared/connection_db.php');


function check($first, $end)
{
  if ($first == null) {
    return $end;
  }
  return $first;
}

if (isset($_POST)) {
  $data = file_get_contents("php://input");
  $decode = json_decode($data, true);

  $cpf = $mysqli->real_escape_string($decode['cpf']);
  $name = $mysqli->real_escape_string($decode['name']);
  $image = $mysqli->real_escape_string($decode['image']);

  $sql_code = "SELECT * FROM professional WHERE cpf = '$cpf'";
  $sql_query = $mysqli->query($sql_code) or die("Fail in code SQL: " . $mysqli->error);

  $quantity = $sql_query->num_rows;

  if ($quantity >= 1) {
    $id = $sql_query->fetch_assoc()['professional_id'];

    $sql_code = "UPDATE  professional SET name = '$name', cpf = '$cpf', image = '$image' WHERE professional_id = '$id'";

    $sql_query = $mysqli->query($sql_code) or die(json_encode("Error in SQL code: " . $mysqli->error));

    if ($sql_query == true) {
      echo json_encode("successful!");
    } else {
      echo json_encode("failed!");
    }
  } else {
    echo json_encode("failed!");
  }
}
