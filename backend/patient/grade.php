<?php

include('../shared/connection_db.php');

if (isset($_POST)) {
  $data = file_get_contents("php://input");
  $decode = json_decode($data, true);

  $cpf = $mysqli->real_escape_string($decode['cpf']);
  $professional = $mysqli->real_escape_string($decode['professional']);
  $feedback = $mysqli->real_escape_string($decode['feedback']);
  $average = $mysqli->real_escape_string($decode['average']);
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

  $sql_code = "SELECT * FROM specialty WHERE name = '$specialty'";
  $sql_query = $mysqli->query($sql_code) or die(json_encode("Falha na execução do código SQL: " . $mysqli->error));

  $specialty_id = $sql_query->fetch_assoc()['specialty_id'];

  $sql_code = "INSERT INTO grade(service, punctuality, frontDesk, infrastructure, average, feedback, patient_id, professional_id, specialty_id, created_at) VALUES ('$service', '$punctuality', '$frontDesk', '$infrastructure', '$average', '$feedback', '$patient', '$professional_id', '$specialty_id', NOW())";
  $sql_query = $mysqli->query($sql_code) or die(json_encode("Falha na execução do código SQL: " . $mysqli->error));

  echo json_encode('success');

}
