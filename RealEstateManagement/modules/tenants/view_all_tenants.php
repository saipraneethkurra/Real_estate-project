<?php
require_once '../../inc/dbh.php';
include_once '../../inc/head.php';
include_once '../../inc/nav.php'; 

// Get all tenants
$tenants = getAllTenants();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Tenants</title>
</head>
<body>

<div class="container">
    <h1>All Tenants</h1>

    <?php if (!empty($tenants)) : ?>
        <table border="1"  class="table">
            <tr>
                <th>Tenant ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Rental History</th>
                <th>Lease Terms</th>
                <th>Actions</th>
            </tr>

            <?php foreach ($tenants as $tenant) : ?>
                <tr>
                    <td><?php echo $tenant['tenant_id']; ?></td>
                    <td><?php echo $tenant['first_name']; ?></td>
                    <td><?php echo $tenant['last_name']; ?></td>
                    <td><?php echo $tenant['contact_number']; ?></td>
                    <td><?php echo $tenant['email']; ?></td>
                    <td><?php echo $tenant['rental_history']; ?></td>
                    <td><?php echo $tenant['lease_terms']; ?></td>
                    <td>
                        <a href="view_tenant.php?tenant_id=<?php echo $tenant['tenant_id']; ?>">View</a>
                        <a href="update_tenant.php?tenant_id=<?php echo $tenant['tenant_id']; ?>">Edit</a>
                        <a href="delete_tenant.php?tenant_id=<?php echo $tenant['tenant_id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
    <?php else : ?>
        <p>No tenants found.</p>
    <?php endif; ?>
    </div>
</body>
</html>
