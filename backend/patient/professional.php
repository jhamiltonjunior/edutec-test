<?php

include('../shared/connection_db.php');

if (isset($_POST)) {
  $data = file_get_contents("php://input");
  $decode = json_decode($data, true);

  $specialty = $mysqli->real_escape_string($decode['specialty']);

  $sql_code = "SELECT * FROM specialty WHERE name = '$specialty'";
  $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

  $quantity = $sql_query->num_rows;

  if ($quantity >= 1) {
    $specialty_id = $sql_query->fetch_assoc()['specialty_id'];

    $sql_code = "SELECT * FROM role_specialty WHERE specialty_id = '$specialty_id'";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

    $professionals = $sql_query->fetch_all();

    $reponse;

    for ($i = 0; $i <= count($professionals); ++$i) {
      $professional = $professionals[$i][2];
      $sql_code = "SELECT * FROM professional WHERE professional_id = '$professional'";
      $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

      $response[$i] = $sql_query->fetch_all();
    }

    echo json_encode($response);
  }
}
