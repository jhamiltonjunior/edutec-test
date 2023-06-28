<?php

include('../../shared/connection_db.php');

if (isset($_POST)) {
  $data = file_get_contents("php://input");
  $decode = json_decode($data, true);

  $name = $mysqli->real_escape_string($decode['name']);

  $sql_code = "DELETE FROM specialty WHERE name = '$name'";
  $sql_query = $mysqli->query($sql_code) or die(json_encode("Error in SQL code: " . $mysqli->error));

  if ($sql_query == true) {
    echo json_encode("successful!");
  } else {
    echo json_encode("failed!");
  }

}

