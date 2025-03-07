<?php
include 'index.php';
include('database/database.php');
include('partials/header.php');
include('partials/sidebar.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $album = $_POST['album'];
    $genre = $_POST['genre'];

    $sql = "INSERT INTO music (title, artist, album, genre) VALUES ('$title', '$artist', '$album', '$genre')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Add Music</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Forms</li>
        <li class="breadcrumb-item active">Add Music</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Add New Music</h5>

            <!-- Add Music Form -->
            <form method="POST" action="create.php">
              <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
              </div>
              <div class="mb-3">
                <label for="artist" class="form-label">Artist</label>
                <input type="text" class="form-control" id="artist" name="artist" required>
              </div>
              <div class="mb-3">
                <label for="album" class="form-label">Album</label>
                <input type="text" class="form-control" id="album" name="album" required>
              </div>
              <div class="mb-3">
                <label for="genre" class="form-label">Genre</label>
                <input type="text" class="form-control" id="genre" name="genre" required>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <!-- End Add Music Form -->

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->

<?php
include('partials/footer.php');
?>