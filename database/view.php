<?php
include('../database/database.php');

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Fetch the current details of the music entry
  $sql = "SELECT * FROM music WHERE id = $id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
  } else {
    die("Record not found");
  }
} else {
  die("No ID provided");
}
?>