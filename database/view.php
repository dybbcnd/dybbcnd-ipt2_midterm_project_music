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

<?php include('../partials/header.php'); ?>
<?php include('../partials/sidebar.php'); ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Music Details</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="../index.php">Music</a></li>
        <li class="breadcrumb-item active">Music Details</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Music Details</h5>
            <p><strong>Title:</strong> <?php echo $row['Title']; ?></p>
            <p><strong>Artist:</strong> <?php echo $row['Artist']; ?></p>
            <p><strong>Album:</strong> <?php echo $row['Album']; ?></p>
            <p><strong>Genre:</strong> <?php echo $row['Genre']; ?></p>
          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->

<?php include('../partials/footer.php'); ?>