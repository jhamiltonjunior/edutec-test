<?php

include('../../shared/connection_db.php');

if (isset($_GET)) {
  $sql_code = "SELECT * FROM role_specialty";
  $sql_query = $mysqli->query($sql_code) or die("Fail in code SQL: " . $mysqli->error);

  $quantity = $sql_query->num_rows;

  if ($quantity >= 1) {

    $specialty = $sql_query->fetch_all();

    echo json_encode($specialty);
  } else {
    echo json_encode("failed!");
  }
}
