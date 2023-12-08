<?php
require_once '../../inc/dbh.php';
include_once '../../inc/head.php';
include_once '../../inc/nav.php'; 

$tenants = getAllTenants();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have form fields like request_description in your HTML form

    $request_description = $_POST['request_description']; // Adjust based on your form field name
    $tenant_id = $_POST['tenant_id']; // Adjust based on your form field name

    // Validation if needed

    // Call the function to add maintenance request
    $result = addMaintenanceRequest($tenant_id, $request_description);

    if ($result === true) {
        echo "<div class='alert alert-success' role='alert'>
                Maintenance request added successfully!
              </div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>
                Error: $result
              </div>";
    }
}
?>

<div class="container mt-5">
    <h2>Add Maintenance Request</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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
        <div class="form-group">
            <label for="request_description">Request Description:</label>
            <textarea class="form-control" id="request_description" name="request_description" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Request</button>
    </form>
</div>
