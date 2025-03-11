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

include('../partials/header.php');
include('../partials/sidebar.php');
?>

<main id="main" class="main">
  <div class="pageTitle">
    <h1>Add New Music</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="../index.php">Music</a></li>
        <li class="breadcrumb-item active">Add Music</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-Title">Add Music</h5>

            <!-- Add Music Form -->
            <form method="POST" action="create.php">
              <div class="mb-3">
                <label for="Title" class="form-label">Title</label>
                <input type="text" class="form-control" id="Title" name="Title" required>
              </div>
              <div class="mb-3">
                <label for="Artist" class="form-label">Artist</label>
                <input type="text" class="form-control" id="Artist" name="Artist" required>
              </div>
              <div class="mb-3">
                <label for="Album" class="form-label">Album</label>
                <input type="text" class="form-control" id="Album" name="Album" required>
              </div>
              <div class="mb-3">
                <label for="Genre" class="form-label">Genre</label>
                <input type="text" class="form-control" id="Genre" name="Genre" required>
              </div>
              <button type="submit" class="btn btn-primary">Add Music</button>
            </form>
            <!-- End Add Music Form -->

          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->

<?php
include('../partials/footer.php');
?>