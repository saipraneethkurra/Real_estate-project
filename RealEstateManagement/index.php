<?php 
require_once 'inc/dbh.php';
include_once 'inc/head.php';
include_once 'inc/nav.php' ;

$startDate = isset($_POST['startDate']) ? $_POST['startDate'] : '2023-01-01';
$endDate = isset($_POST['endDate']) ? $_POST['endDate'] : date("Y-m-d");
$usrData = fetchUserData($startDate, $endDate);
?>

<div class="container mt-3">
  <div class="row">
  <div class="col-md-3">
  <h6 class='mt-2'>Available Actions</h6>
  <div class="list-group">
    <a href="/RealEstateManagement/modules/tenants/add_tenant.php" class="list-group-item list-group-item-action">
      <div>
        <p class="text-sm m-0">Add Tenant</p>
        <small>Add a new tenant to the system</small>
      </div>
    </a>
    <a href="/RealEstateManagement/modules/maintenance_requests/add_maintenance_request.php" class="list-group-item list-group-item-action">
      <div>
        <p class="text-sm m-0">Add Maintenance Request</p>
        <small>Submit a maintenance request</small>
      </div>
    </a>
    <a href="/RealEstateManagement/modules/properties/add_property.php" class="list-group-item list-group-item-action">
      <div>
        <p class="text-sm m-0">Add Property</p>
        <small>Add a property to the system</small>
      </div>
    </a>
    <a href="/RealEstateManagement/modules/leases/add_lease.php" class="list-group-item list-group-item-action">
      <div>
        <p class="text-sm m-0">Add Lease</p>
        <small>Add a lease to the system</small>
      </div>
    </a>
  </div>
</div>

<div class="col-md-3">
  <h6 class='mt-2'>View All Items</h6>
  <div class="list-group">
    <a href="/RealEstateManagement/modules/tenants/view_all_tenants.php" class="list-group-item list-group-item-action">
      <div>
        <p class="text-sm m-0">View All Tenants</p>
        <small>View all reistered Tenants</small>
      </div>
    </a>
    <a href="/RealEstateManagement/modules/maintenance_requests/view_all_maintenance_requests.php" class="list-group-item list-group-item-action">
      <div>
        <p class="text-sm m-0">View All Maintenance Requests</p>
        <small>View all maintenance requests</small>
      </div>
    </a>
    <a href="/RealEstateManagement/modules/properties/view_all_properties.php" class="list-group-item list-group-item-action">
      <div>
        <p class="text-sm m-0">View All Properties</p>
        <small>View all properties</small>
      </div>
    </a>
    <a href="/RealEstateManagement/modules/leases/view_all_leases.php" class="list-group-item list-group-item-action">
      <div>
        <p class="text-sm m-0">View All Leases</p>
        <small>View all leases</small>
      </div>
    </a>
  </div>


    </div>
    <div class="col-md-6">
    <h6 class='mt-2'>Chart Data</h6>
    <?php

if (isset($usrData)) {
  # Build the array to display the chart correctly
  $chartData = array(
      'labels' => array(),
      'data' => array()
  );

  foreach ($usrData as $data) {
      $chartData['labels'][] = $data['first_name'] . ' ' . $data['last_name'];
      $chartData['data'][] = (float)$data['rent_amount'];
  }
  ?>
  <div class="container">
              <div class="card text-center" class="mt-3" style="margin-bottom: 20px">
                  <div class="card-body mx-auto">
                      <h5 class="card-title">Rent Amounts</h5>
                      <?php drawChart($chartData['labels'], $chartData['data'], false); ?>

                      <form method="POST" action="">
                      <div class="row justify-content-start">
                        <div class="col-md-4">
        <label for="startDate">Start Date:</label>
        <input class="form-control" type="date" id="startDate" name="startDate" value="<?php echo date("Y-m-d"); ?>" required>
        </div>

        <div class="col-md-4">
        <label for="endDate">End Date:</label>
        <input class="form-control" type="date" id="endDate" name="endDate" value="<?php echo date("Y-m-d"); ?>" required>
        </div>

        <div class="col-md-4">
        <label for="chartType">Chart Type:</label>
        <select class="form-control" id="chartType" name="chartType">
            <option value="line">Line Chart</option>
            <option value="bar">Bar Chart</option>
        </select>
        </div>


        <div class="col-md-4">
        <button class="btn btn-primary btn-small w-100 mt-3" type="submit">Generate Chart</button>
        </div>
    </form>
                  </div>
      </div>
  </div>
  <?php
} else {
  echo _('No data found for this period.');
}
?>

    </div>
   
  </div>
  
  
</div>

<?php include_once 'inc/scripts.php' ?>