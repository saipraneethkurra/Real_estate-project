<?php
require_once '../../inc/dbh.php'; 
include_once '../../inc/head.php';
include_once '../../inc/nav.php'; 

$tenants = getAllTenants();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form submitted, process the data

    $tenantId = $_POST['tenant_id'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $rentAmount = $_POST['rent_amount'];

    // Add a new lease
    $result = addLease($tenantId, $startDate, $endDate, $rentAmount);

    if ($result === true) {
        echo "Lease added successfully!";
    } else {
        echo "Error: " . $result;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Lease</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
            <h1>Add Lease</h1>
    <form method="post" action="">
    <div class="form-group">
            <label for="request_description">Tenant:</label>
            <select name="tenant_id" class="form-control">
    <?php foreach ($tenants as $tenant): ?>
        <option value="<?php echo $tenant['tenant_id']; ?>">
            <?php echo $tenant['first_name'] . ' ' . $tenant['last_name']; ?>
        </option>
    <?php endforeach; ?>
</select>
        </div>

        <label for="start_date">Start Date:</label>
        <input class="form-control" type="date" name="start_date" required><br>

        <label for="end_date">End Date:</label>
        <input class="form-control" type="date" name="end_date" required><br>

        <label for="rent_amount">Rent Amount:</label>
        <input class="form-control" type="text" name="rent_amount" required><br>

        <button type="submit">Submit</button>
    </form>

            </div>
        </div>
    </div>
   
</body>
</html>
