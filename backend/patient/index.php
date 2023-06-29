<?php


include('../shared/connection_db.php');


if (isset($_POST)) {
  $data = file_get_contents("php://input");
  $user = json_decode($data, true);

  $cpf = $mysqli->real_escape_string($user['cpf']);


  $name = $mysqli->real_escape_string($user['name']);

  $sql_code = "SELECT * FROM patient WHERE cpf = '$cpf' AND name = '$name'";
  $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

  $quantity = $sql_query->num_rows;

  if ($quantity == 1) {

    $patient = $sql_query->fetch_assoc();

    echo json_encode($patient);
  } else {
    $sql_code = "INSERT INTO patient(name, cpf) VALUES ('$name', '$cpf')";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

    // $patient = $sql_query->fetch_assoc();

    $patient = 'Account created';

    echo json_encode($patient);
    }

}

// $quantity = $sql_query->num_rows;

// echo json_encode([$sql_query]);
// // json_encode([$quantity, $sql_query]);

// if ($quantity == 1) {

//   $patient = $sql_query->fetch_assoc();

//   if (!isset($_SESSION)) {
//     session_start();
//   }
// } else {

//   echo json_encode('Patient does not exist');
// }
