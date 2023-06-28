<?php

include('../../shared/connection_db.php');


function check($first, $end) {
  if ($first) {
    return $first;
  } else {
    return $end;
  }
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

    $checked_cpf = check($cpf, $sql_query->fetch_assoc()['cpf']);
    $checked_name = check($name, $sql_query->fetch_assoc()['name']);
    $checked_image = check($image, $sql_query->fetch_assoc()['image']);


    $sql_code = "UPDATE  professional SET cpf = '$checked_cpf', name = '$checked_name', image = '$checked_image' WHERE professional_id = '$id'";
    
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
