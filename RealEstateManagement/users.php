<?php 
require_once 'inc/dbh.php';
include_once 'inc/head.php';
include_once 'inc/nav.php' ;

$result = mysqli_query($conn, "SELECT * FROM `users`");
?>

<div class="container">
  <div class="row">
    <div class="col-md-8 m-auto">
      <h1 class="h2 text-center mt-5 mb-4">Registered Users</h1>
      <div class="table-responsive">
        <table class="table table-bordered table-sm table-striped table-hover text-center">
          <thead>
            <tr>
              <th>No.</th>
              <th>Full name</th>
              <th>User name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $counter = 1; while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><?= $counter ?></td>
              <td><?= $row['first_name'] . ' ' . $row['last_name'] ?></td>
              <td><?= $row['user_name'] ?></td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-secondary btn-sm">Edit</button>
                  <button class="btn btn-danger btn-sm">Delete</button>
                </div>
              </td>
            </tr>
            <?php $counter++; endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include_once 'inc/scripts.php' ?>