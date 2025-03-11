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

<?php include('../partials/header.php'); ?>
<?php include('../partials/sidebar.php'); ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Edit Music</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="../index.php">Music</a></li>
        <li class="breadcrumb-item active">Edit Music</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Music</h5>

            <!-- Edit Music Form -->
            <form method="POST" action="update.php?id=<?php echo $id; ?>">
              <div class="mb-3">
                <label for="Title" class="form-label">Title</label>
                <input type="text" class="form-control" id="Title" name="Title" value="<?php echo $row['Title']; ?>" required>
              </div>
              <div class="mb-3">
                <label for="Artist" class="form-label">Artist</label>
                <input type="text" class="form-control" id="Artist" name="Artist" value="<?php echo $row['Artist']; ?>" required>
              </div>
              <div class="mb-3">
                <label for="Album" class="form-label">Album</label>
                <input type="text" class="form-control" id="Album" name="Album" value="<?php echo $row['Album']; ?>" required>
              </div>
              <div class="mb-3">
                <label for="Genre" class="form-label">Genre</label>
                <input type="text" class="form-control" id="Genre" name="Genre" value="<?php echo $row['Genre']; ?>" required>
              </div>
              <button type="submit" class="btn btn-primary">Update Music</button>
            </form>
            <!-- End Edit Music Form -->

          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->

<?php include('../partials/footer.php'); ?>