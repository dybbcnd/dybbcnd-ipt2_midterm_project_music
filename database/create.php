<?php
include('../database/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $Title = $_POST['Title'];
  $Artist = $_POST['Artist'];
  $Album = $_POST['Album'];
  $Genre = $_POST['Genre'];

  $sql = "INSERT INTO music (Title, Artist, Album, Genre) VALUES ('$Title', '$Artist', '$Album', '$Genre')";

  if ($conn->query($sql)) {
    $status = "New record created successfully";
  } else {
    $status = "Error: " . $sql . "<br>" . $conn->error;
  }
  mysqli_close($conn);
  header("Location: ../index.php?status=$status");
  exit();
}