<?php
require_once '../../inc/dbh.php';
include_once '../../inc/head.php';
include_once '../../inc/nav.php'; 

// Get all properties
$properties = getAllProperties();
?>

<body>
    <div class="container mt-4">
        <h1>All Properties</h1>

        <?php if (!empty($properties)) : ?>
            <div class="row">
                <?php foreach ($properties as $property) : ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="<?php echo $property['image_url']; ?>" class="card-img-top" alt="Property Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $property['title']; ?></h5>
                                <p class="card-text"><?php echo $property['description']; ?></p>
                                <p class="card-text">Price: $<?php echo $property['price']; ?></p>
                                <p class="card-text">Status: <?php echo $property['status']; ?></p>
                                <a href="view_property.php?property_id=<?php echo $property['property_id']; ?>" class="btn btn-primary">View</a>
                                <a href="update_property.php?property_id=<?php echo $property['property_id']; ?>" class="btn btn-warning">Edit</a>
                                <a href="delete_property.php?property_id=<?php echo $property['property_id']; ?>" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p>No properties found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
