<?php
require_once '../../inc/dbh.php';
include_once '../../inc/head.php';
include_once '../../inc/nav.php'; 

// Get all leases
$leases = getAllLeases();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Leases</title>
</head>
<body>
    <h1>All Leases</h1>

    <?php if (!empty($leases)) : ?>
        <table border="1">
            <tr>
                <th>Lease ID</th>
                <th>Tenant ID</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Rent Amount</th>
                <th>Payment Status</th>
                <th>Actions</th>
                <!-- Add additional columns as needed -->
            </tr>

            <?php foreach ($leases as $lease) : ?>
                <tr>
                    <td><?php echo $lease['lease_id']; ?></td>
                    <td><?php echo $lease['tenant_id']; ?></td>
                    <td><?php echo $lease['start_date']; ?></td>
                    <td><?php echo $lease['end_date']; ?></td>
                    <td><?php echo $lease['rent_amount']; ?></td>
                    <td><?php echo $lease['payment_status']; ?></td>
                    <td>
                        <a href="view_lease.php?lease_id=<?php echo $lease['lease_id']; ?>">View</a>
                        <a href="update_lease.php?lease_id=<?php echo $lease['lease_id']; ?>">Edit</a>
                        <a href="delete_lease.php?lease_id=<?php echo $lease['lease_id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
    <?php else : ?>
        <p>No leases found.</p>
    <?php endif; ?>
</body>
</html>
