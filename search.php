<?php
include('database/database.php');
include('partials/header.php');
include('partials/sidebar.php');

$search = '';
if (isset($_GET['search'])) {
  $search = $_GET['search'];
}

$sql = "SELECT * FROM music WHERE Title LIKE '%$search%' OR Artist LIKE '%$search%' OR Album LIKE '%$search%' OR Genre LIKE '%$search%'";
$music = $conn->query($sql);

// Check if the query was successful
if (!$music) {
  die("Query failed: " . $conn->error);
}
?>
 
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Search Results</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Search</li>
        <li class="breadcrumb-item active">Results</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div>
                <h5 class="card-title">Search Results for "<?php echo htmlspecialchars($search); ?>":</h5>
              </div>
              <div>
                <button class="btn btn-primary btn-sm mt-4 mx-3" data-bs-toggle="modal" data-bs-target="#addMusicModal">Add Music</button>
              </div>
            </div>

            <!-- Default Table -->
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Title</th>
                  <th scope="col">Artist</th>
                  <th scope="col">Album</th>
                  <th scope="col">Genre</th>
                  <th scope="col" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($music->num_rows > 0): ?>
                  <?php while($row = $music->fetch_assoc()): ?>
                    <tr>
                      <th scope="row"><?php echo isset($row['id']) ? $row['id'] : 'N/A'; ?></th>
                      <td><?php echo isset($row['Title']) ? $row['Title'] : 'N/A'; ?></td>
                      <td><?php echo isset($row['Artist']) ? $row['Artist'] : 'N/A'; ?></td>
                      <td><?php echo isset($row['Album']) ? $row['Album'] : 'N/A'; ?></td>
                      <td><?php echo isset($row['Genre']) ? $row['Genre'] : 'N/A'; ?></td>
                      <td class="d-flex justify-content-center">   
                        <button class="btn btn-success btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#editMusicModal<?php echo $row['id']; ?>">Edit</button>
                        <button class="btn btn-primary btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#viewMusicModal<?php echo $row['id']; ?>">View</button>
                        <a href="database/delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm mx-1" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                      </td>
                    </tr>

                    <!-- Edit Music Modal -->
                    <div class="modal fade" id="editMusicModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="editMusicModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editMusicModalLabel<?php echo $row['id']; ?>">Edit Music</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form method="POST" action="database/update.php?id=<?php echo $row['id']; ?>">
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
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Edit Music Modal -->

                    <!-- View Music Modal -->
                    <div class="modal fade" id="viewMusicModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="viewMusicModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="viewMusicModalLabel<?php echo $row['id']; ?>">View Music</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <p><strong>Title:</strong> <?php echo $row['Title']; ?></p>
                            <p><strong>Artist:</strong> <?php echo $row['Artist']; ?></p>
                            <p><strong>Album:</strong> <?php echo $row['Album']; ?></p>
                            <p><strong>Genre:</strong> <?php echo $row['Genre']; ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End View Music Modal -->

                  <?php endwhile; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="6" class="text-center">No data found</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
            <!-- End Default Table Example -->
          </div>
          <div class="mx-4">
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
              </ul>
            </nav>
          </div>
        </div>

      </div>
    </div>

    <!-- Add Music Modal -->
    <div class="modal fade" id="addMusicModal" tabindex="-1" aria-labelledby="addMusicModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addMusicModalLabel">Add New Music</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST" action="database/create.php">
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
          </div>
        </div>
      </div>
    </div>
    <!-- End Add Music Modal -->

    <!-- Modal -->
    <div class="modal fade" id="editInfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editInfoLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="editInfoLabel">Music Information</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </section>

</main><!-- End #main -->
<?php
include('partials/footer.php');
?>