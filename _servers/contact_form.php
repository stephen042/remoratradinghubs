<?php
include "db_conn.php";


// Connect to the database
$db_conn = connect_to_database();
$value = "Manager";
// Check if email or username already exists
$stmt = $db_conn->prepare("SELECT * FROM `accounts` WHERE JSON_EXTRACT(`datasource`, '$.account_role') = ?");
$stmt->bind_param("s", $value);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $manager_datasource = json_decode($row["datasource"], true);
}

