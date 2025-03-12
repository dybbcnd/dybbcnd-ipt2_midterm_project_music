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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $Title = $_POST['Title'];
  $Artist = $_POST['Artist'];
  $Album = $_POST['Album'];
  $Genre = $_POST['Genre'];

  $sql = "UPDATE music SET Title = '$Title', Artist = '$Artist', Album = '$Album', Genre = '$Genre' WHERE id = $id";

  if ($conn->query($sql)) {
    $status = "Record updated successfully";
  } else {
    $status = "Error: " . $sql . "<br>" . $conn->error;
  }
  mysqli_close($conn);
  header("Location: ../index.php?status=$status");
  exit();
}
?>