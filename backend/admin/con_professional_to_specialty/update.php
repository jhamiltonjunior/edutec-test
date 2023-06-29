<?php

include('../../shared/connection_db.php');

if (isset($_POST)) {
  $data = file_get_contents("php://input");
  $decode = json_decode($data, true);

  $professional_cpf = $mysqli->real_escape_string($decode['cpf']);
  $specialty_name = $mysqli->real_escape_string($decode['name']);

  $new_professional = $mysqli->real_escape_string($decode['newProfessional']);
  $new_specialty = $mysqli->real_escape_string($decode['newSpecialty']);

  $sql_code = "SELECT * FROM professional WHERE cpf = '$professional_cpf'";
  $sql_query = $mysqli->query($sql_code) or die(json_encode("Error in SQL code: " . $mysqli->error));

  $professional_id = $sql_query->fetch_assoc()['professional_id'];

  $sql_code = "SELECT * FROM specialty WHERE name = '$specialty_name'";
  $sql_query = $mysqli->query($sql_code) or die(json_encode("Error in SQL code: " . $mysqli->error));

  $specialty_id = $sql_query->fetch_assoc()['specialty_id'];

  $sql_code = "SELECT * FROM role_specialty WHERE specialty_id = '$specialty_id' AND professional_id = '$professional_id'";
  $sql_query = $mysqli->query($sql_code) or die(json_encode("Error in SQL code: " . $mysqli->error));


  $sql_code = "SELECT * FROM professional WHERE cpf = '$new_professional'";
  $sql_query = $mysqli->query($sql_code) or die(json_encode("Error in SQL code: " . $mysqli->error));

  $new_cpf = $sql_query->fetch_assoc()['professional_id'];

  $sql_code = "SELECT * FROM specialty WHERE name = '$new_specialty'";
  $sql_query = $mysqli->query($sql_code) or die(json_encode("Error in SQL code: " . $mysqli->error));

  $new_specialty_name = $sql_query->fetch_assoc()['specialty_id'];


  $sql_code = "SELECT * FROM role_specialty WHERE specialty_id = '$specialty_id' AND professional_id = '$professional_id'";
  $sql_query = $mysqli->query($sql_code) or die(json_encode("Error in SQL code: " . $mysqli->error));

  $id = $sql_query->fetch_assoc()['role_specialty_id'];

  echo $id;

  $sql_code = "UPDATE role_specialty SET specialty_id = '$new_specialty_name', professional_id = '$new_cpf' WHERE role_specialty_id = '$id'";

  $sql_query = $mysqli->query($sql_code) or die(json_encode("Error in SQL code: " . $mysqli->error));



  if ($sql_query == true) {
    echo json_encode("successful!");
  } else {
    echo json_encode("failed!");
  }
}
