<?php

include('../shared/connection_db.php');

if (isset($_GET)) {
  $sql_code = "SELECT * FROM specialty";
  $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

  $quantity = $sql_query->num_rows;

  if ($quantity >= 1) {

    $specialty = $sql_query->fetch_all();

    echo json_encode($specialty);
  }

}
