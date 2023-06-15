<?php

include('./backend/shared/connection_db.php');

if (isset($_POST)) {
  $data = file_get_contents("php://input");
  $decode = json_decode($data, true);

  $cpf = $mysqli->real_escape_string($decode['cpf']);
  $professional = $mysqli->real_escape_string($decode['professional']);
  $feedback = $mysqli->real_escape_string($decode['feedback']);
  $specialty = $mysqli->real_escape_string($decode['specialty']);
  $service = $mysqli->real_escape_string($decode['service']);
  $punctuality = $mysqli->real_escape_string($decode['punctuality']);
  $frontDesk = $mysqli->real_escape_string($decode['frontDesk']);
  $infrastructure = $mysqli->real_escape_string($decode['infrastructure']);

  $sql_code = "SELECT * FROM patient WHERE cpf = '$cpf'";
  $sql_query = $mysqli->query($sql_code) or die(json_encode("Falha na execução do código SQL: " . $mysqli->error));

  $patient = $sql_query->fetch_assoc()['patient_id'];

  $sql_code = "SELECT * FROM professional WHERE name = '$professional'";
  $sql_query = $mysqli->query($sql_code) or die(json_encode("Falha na execução do código SQL: " . $mysqli->error));

  $professional_id = $sql_query->fetch_assoc()['professional_id'];


  $sql_code = "INSERT INTO patient(service, punctuality, frontDesk, feedback, infrastructure, patient_id, professional_id, feedback) VALUES ('$service', '$punctuality'. '$frontDesk', '$feedback', '$infrastructure', '$patient', '$professional_id', '$feedback');";
  $sql_query = $mysqli->query($sql_code) or die(json_encode("Falha na execução do código SQL: " . $mysqli->error));

  echo json_encode('success');

}
