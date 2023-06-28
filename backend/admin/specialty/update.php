<?php

include('../../shared/connection_db.php');


function check($first, $end) {
  if ($first != "") {
    return $first;
  } else {
    return $end;
  }
}

if (isset($_POST)) {
  $data = file_get_contents("php://input");
  $decode = json_decode($data, true);

  $name = $mysqli->real_escape_string($decode['name']);
  $newName = $mysqli->real_escape_string($decode['newName']);

  $sql_code = "SELECT * FROM specialty WHERE name = '$name'";
  $sql_query = $mysqli->query($sql_code) or die("Fail in code SQL: " . $mysqli->error);

  $quantity = $sql_query->num_rows;

  if ($quantity >= 1) {
    $id = $sql_query->fetch_assoc()['specialty_id'];

    $sql_code = "UPDATE  specialty SET name = '$newName' WHERE specialty_id = '$id'";
    
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
