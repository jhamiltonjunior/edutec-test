<?php

include('../../shared/connection_db.php');



if (isset($_POST)) {
  $data = file_get_contents("php://input");
  $decode = json_decode($data, true);

  $initial_date = $mysqli->real_escape_string($decode['initialDate']);
  $finaly_date = $mysqli->real_escape_string($decode['finalyDate']);
  $specialty = $mysqli->real_escape_string($decode['specialty']);
  $grade_interval_min = $mysqli->real_escape_string($decode['gradeIntervalMin']);
  $grade_interval_max = $mysqli->real_escape_string($decode['gradeIntervalMax']);
  $professional = $mysqli->real_escape_string($decode['professional']);


  $sql_code = "SELECT * FROM grade WHERE ";
  
  if ($grade_interval_min && $grade_interval_max) {
    $sql_code .= " BETWEEN $grade_interval_min AND $grade_interval_max AND";
  }
  
  if ($professional) {
    $sql_code .= " professional_id = $professional AND";
  } 
  
  if ($specialty) {
    $sql_code .= " specialty_id = $specialty AND";
  } 
  
  if ($initial_date && $finaly_date) {
    $sql_code .= " created_at BETWEEN $initial_date AND $finaly_date AND";
  }
  
  $sql_code.= " order by grade_id";

  $sql_query = $mysqli->query($sql_code) or die("Fail in code SQL: " . $mysqli->error);
}
