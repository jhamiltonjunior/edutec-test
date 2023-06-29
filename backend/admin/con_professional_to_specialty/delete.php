<?php

include('../../shared/connection_db.php');

if (isset($_POST)) {
  $data = file_get_contents("php://input");
  $decode = json_decode($data, true);

  $professional_cpf = $mysqli->real_escape_string($decode['cpf']);
  $specialty_name = $mysqli->real_escape_string($decode['name']);

  $sql_code = "SELECT * FROM professional WHERE cpf = '$professional_cpf'";
  $sql_query = $mysqli->query($sql_code) or die(json_encode("Error in SQL code: " . $mysqli->error));

  $professional_id = $sql_query->fetch_assoc()['professional_id'];
  
  $sql_code = "SELECT * FROM specialty WHERE name = '$specialty_name'";
  $sql_query = $mysqli->query($sql_code) or die(json_encode("Error in SQL code: " . $mysqli->error));
  
  $specialty_id = $sql_query->fetch_assoc()['specialty_id'];

  $sql_code = "DELETE FROM role_specialty WHERE specialty_id = '$specialty_id' AND professional_id = '$professional_id'";
  $sql_query = $mysqli->query($sql_code) or die(json_encode("Error in SQL code: " . $mysqli->error));

  if ($sql_query == true) {
    echo json_encode("successful!");
  } else {
    echo json_encode("failed!");
  }

}