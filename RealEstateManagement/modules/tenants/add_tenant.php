<?php
include_once '../../inc/dbh.php';
include_once '../../inc/head.php';
include_once '../../inc/nav.php'; 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form submitted, process the data

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $contactNumber = $_POST['contact_number'];
    $email = $_POST['email'];
    $rentalHistory = $_POST['rental_history'];
    $leaseTerms = $_POST['lease_terms'];

    // Add a new tenant
    // $firstName, $lastName, $contactNumber, $email, $rentalHistory, $leaseTerms
    $result = addTenant($firstName, $lastName, $contactNumber, $email, $rentalHistory, $leaseTerms);

    if ($result === true) {
        echo "Tenant added successfully!";
    } else {
        echo "Error: " . $result;
    }
}
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">        
    <h1>Add Tenant</h1>
    <form method="post" action="">
        <label for="first_name">First Name:</label>
        <input class="form-control" type="text" name="first_name" required><br>

        <label for="last_name">Last Name:</label>
        <input class="form-control" type="text" name="last_name" required><br>

        <label for="contact_number">Contact Number:</label>
        <input class="form-control" type="text" name="contact_number"><br>

        <label for="email">Email:</label>
        <input class="form-control" type="email" name="email"><br>

        <label for="rental_history">Rental History:</label>
        <textarea class="form-control" name="rental_history"></textarea><br>

        <label for="lease_terms">Lease Terms:</label>
        <textarea class="form-control" name="lease_terms"></textarea><br>

        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</div>
</div>
    </div>
