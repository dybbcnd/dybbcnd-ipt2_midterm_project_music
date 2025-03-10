<?php
include('../database/database.php');

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "DELETE FROM music WHERE id = $id";

  if ($conn->query($sql)) {
    $status = "Record deleted successfully";
  } else {
    $status = "Error: " . $sql . "<br>" . $conn->error;
  }
  mysqli_close($conn);
  header("Location: ../index.php?status=$status");
  exit();
} else {
  header("Location: ../index.php?status=No ID provided");
  exit();
}
?>