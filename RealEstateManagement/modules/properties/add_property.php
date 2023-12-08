<?php
require_once '../../inc/dbh.php';
include_once '../../inc/head.php';
include_once '../../inc/nav.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title']; 
    $description = $_POST['description'];
    $image_url = $_POST['image'];
    $price = $_POST['price'];

    // Validation if needed

    // Call the function to add property
    $result = addProperty($title, $description, $image_url, $price);

    if ($result === true) {
        echo "<div class='alert alert-success' role='alert'>
                Property added successfully!
              </div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>
                Error: $result
              </div>";
    }
}
?>

<div class="container mt-5">
    <h2>Add Property</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="image">Image URL:</label>
            <input type="text" class="form-control" id="image" name="image" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Property</button>
    </form>
</div>
