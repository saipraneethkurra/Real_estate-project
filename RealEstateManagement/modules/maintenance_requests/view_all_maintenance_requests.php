<?php
require_once '../../inc/dbh.php';
include_once '../../inc/head.php';
include_once '../../inc/nav.php'; 

// Get all maintenance requests
$requests = getAllMaintenanceRequests();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Maintenance Requests</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>All Maintenance Requests</h1>

        <?php if (!empty($requests)) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Tenant</th>
                        <th>Description</th>
                        <th>Request Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requests as $request) : ?>
                        <tr>
                            <td><?php echo $request['request_id']; ?></td>
                            <td><?php echo $request['first_name'].' '.$request['last_name']; ?></td>
                            <td><?php echo $request['request_description']; ?></td>
                            <td><?php echo $request['request_date']; ?></td>
                            <td><?php echo $request['status']; ?></td>
                            <td>
                                <a href="view_maintenance_request.php?request_id=<?php echo $request['request_id']; ?>" class="btn btn-primary">View</a>
                                <a href="update_maintenance_request.php?request_id=<?php echo $request['request_id']; ?>" class="btn btn-warning">Update</a>
                                <a href="delete_maintenance_request.php?request_id=<?php echo $request['request_id']; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No maintenance requests found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
