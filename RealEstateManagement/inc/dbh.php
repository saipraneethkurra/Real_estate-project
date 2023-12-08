<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'real_estate');

// Application configurations
define('URL_ROOT', 'http://localhost/RealEstateManagement/');
define('APP_NAME', 'Real Estate Management');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

function filter($str) {
    global $conn;

    // Ensure $conn is available
    if (!$conn) {
        die('Connection error: ' . mysqli_connect_error());
    }

    if (!is_string($str)) {
        return FALSE;
    }

    return mysqli_real_escape_string($conn, strip_tags($str));
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// function to insert a new user
function insertUser($first_name, $last_name, $user_name, $password) {
    global $conn;

    $first_name = filter($first_name);
    $last_name = filter($last_name);
    $user_name = filter($user_name);
    $password = filter($password);

    $query = "INSERT INTO `users`(`first_name`, `last_name`, `user_name`, `password`) 
              VALUES('$first_name', '$last_name', '$user_name', '$password')";

    
    if ($conn->query($query) === TRUE) {
        return true;
    } else {
        return false;
    }
    
}


// Function to add a new tenant
function addTenant($firstName, $lastName, $contactNumber, $email, $rentalHistory, $leaseTerms) {
    global $conn;

    $firstName = filter($firstName);
    $lastName = filter($lastName);
    $contactNumber = filter($contactNumber);
    $email = filter($email);
    $rentalHistory = filter($rentalHistory);
    $leaseTerms = filter($leaseTerms);

    $sql = "INSERT INTO tenants (first_name, last_name, contact_number, email, rental_history, lease_terms)
            VALUES ('$firstName', '$lastName', '$contactNumber', '$email', '$rentalHistory', '$leaseTerms')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}


// Function to get all tenants
function getAllTenants() {
  global $conn;

  $sql = "SELECT * FROM tenants";
  $result = $conn->query($sql);

  $tenants = array();

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $tenants[] = $row;
      }
  }

  return $tenants;
}


// Function to get tenant information by ID
function getTenantById($tenantId) {
    global $conn;

    $tenantId = filter($tenantId);

    $sql = "SELECT * FROM tenants WHERE tenant_id = $tenantId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

// Function to update tenant information
function updateTenant($tenantId, $firstName, $lastName, $contactNumber, $email, $rentalHistory, $leaseTerms) {
    global $conn;

    $tenantId = filter($tenantId);
    $firstName = filter($firstName);
    $lastName = filter($lastName);
    $contactNumber = filter($contactNumber);
    $email = filter($email);
    $rentalHistory = filter($rentalHistory);
    $leaseTerms = filter($leaseTerms);

    $sql = "UPDATE tenants 
            SET first_name='$firstName', last_name='$lastName', contact_number='$contactNumber', 
                email='$email', rental_history='$rentalHistory', lease_terms='$leaseTerms' 
            WHERE tenant_id=$tenantId";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return "Error updating record: " . $conn->error;
    }
}

// Function to delete a tenant
function deleteTenant($tenantId) {
    global $conn;

    $tenantId = filter($tenantId);

    $sql = "DELETE FROM tenants WHERE tenant_id=$tenantId";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return "Error deleting record: " . $conn->error;
    }
}


// Function to add a new lease
function addLease($tenantId, $startDate, $endDate, $rentAmount) {
  global $conn;

  $startDate = filter($startDate);
  $endDate = filter($endDate);
  $rentAmount = filter($rentAmount);

  $sql = "INSERT INTO leases (tenant_id, start_date, end_date, rent_amount)
          VALUES ('$tenantId', '$startDate', '$endDate', '$rentAmount')";

  if ($conn->query($sql) === TRUE) {
      return true;
  } else {
      return "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Function to get lease information by ID
function getLeaseById($leaseId) {
  global $conn;

  $leaseId = filter($leaseId);

  $sql = "SELECT * FROM leases WHERE lease_id = $leaseId";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      return $result->fetch_assoc();
  } else {
      return null;
  }
}

// Function to update lease information
function updateLease($leaseId, $startDate, $endDate, $rentAmount) {
  global $conn;

  $leaseId = filter($leaseId);
  $startDate = filter($startDate);
  $endDate = filter($endDate);
  $rentAmount = filter($rentAmount);

  $sql = "UPDATE leases 
          SET start_date='$startDate', end_date='$endDate', rent_amount='$rentAmount' 
          WHERE lease_id=$leaseId";

  if ($conn->query($sql) === TRUE) {
      return true;
  } else {
      return "Error updating record: " . $conn->error;
  }
}

// Function to delete a lease
function deleteLease($leaseId) {
  global $conn;

  $leaseId = filter($leaseId);

  $sql = "DELETE FROM leases WHERE lease_id=$leaseId";

  if ($conn->query($sql) === TRUE) {
      return true;
  } else {
      return "Error deleting record: " . $conn->error;
  }
}

// Function to check and send renewal notifications
function checkAndSendRenewalNotifications() {
  global $conn;

  $currentDate = date('Y-m-d');

  $sql = "SELECT * FROM leases WHERE end_date = DATE_ADD('$currentDate', INTERVAL 30 DAY) AND renewal_notification_sent = 0";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      // Send renewal notifications (you can implement this part based on your notification system)
      
      // Update the flag to indicate that notifications have been sent
      $updateSql = "UPDATE leases SET renewal_notification_sent = 1 WHERE end_date = DATE_ADD('$currentDate', INTERVAL 30 DAY)";
      $conn->query($updateSql);
      
      return true;
  } else {
      return false;
  }
}

// Function to get all leases
function getAllLeases() {
  global $conn;

  $sql = "SELECT * FROM leases";
  $result = $conn->query($sql);

  $leases = array();

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $leases[] = $row;
      }
  }

  return $leases;
}

// Function to get all properties
function getAllProperties() {
    global $conn;

    $sql = "SELECT * FROM properties";
    $result = $conn->query($sql);

    $properties = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $properties[] = $row;
        }
    }

    return $properties;
}

// Function to get property information by ID
function getPropertyById($propertyId) {
    global $conn;

    $propertyId = filter_var($propertyId, FILTER_SANITIZE_NUMBER_INT);

    $sql = "SELECT * FROM properties WHERE property_id = $propertyId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

// Function to add a new property
function addProperty($title, $description, $image_url, $price) {
    global $conn;

    $title = filter_var($title, FILTER_SANITIZE_STRING);
    $description = filter_var($description, FILTER_SANITIZE_STRING);
    $image_url = filter_var($image_url, FILTER_SANITIZE_STRING);
    $price = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    $sql = "INSERT INTO properties (title, description, image_url, price)
            VALUES ('$title', '$description', '$image_url', '$price')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Function to update property information
function updateProperty($propertyId, $title, $description, $image_url, $price) {
    global $conn;

    $propertyId = filter_var($propertyId, FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($title, FILTER_SANITIZE_STRING);
    $description = filter_var($description, FILTER_SANITIZE_STRING);
    $image_url = filter_var($image_url, FILTER_SANITIZE_STRING);
    $price = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    $sql = "UPDATE properties 
            SET title='$title', description='$description', image_url='$image_url', price='$price' 
            WHERE property_id=$propertyId";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return "Error updating record: " . $conn->error;
    }
}

// Function to delete a property
function deleteProperty($propertyId) {
    global $conn;

    $propertyId = filter_var($propertyId, FILTER_SANITIZE_NUMBER_INT);

    $sql = "DELETE FROM properties WHERE property_id=$propertyId";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return "Error deleting record: " . $conn->error;
    }
}

// Function to set the status of a property (for rent or rented)
function setPropertyStatus($propertyId, $status) {
    global $conn;

    $propertyId = filter_var($propertyId, FILTER_SANITIZE_NUMBER_INT);
    $status = filter_var($status, FILTER_SANITIZE_STRING);

    $sql = "UPDATE properties 
            SET status='$status' 
            WHERE property_id=$propertyId";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return "Error updating status: " . $conn->error;
    }
}

// Function to get all maintenance requests
function getAllMaintenanceRequests() {
    global $conn;

    $sql = "SELECT * FROM maintenance_requests LEFT JOIN tenants On maintenance_requests.tenant_id = tenants.tenant_id";
    $result = $conn->query($sql);

    $requests = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $requests[] = $row;
        }
    }

    return $requests;
}

// Function to get maintenance request information by ID
function getMaintenanceRequestById($requestId) {
    global $conn;

    $requestId = filter_var($requestId, FILTER_SANITIZE_NUMBER_INT);

    $sql = "SELECT * FROM maintenance_requests WHERE request_id = $requestId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

// Function to add a new maintenance request
function addMaintenanceRequest($tenantId, $requestDescription) {
    global $conn;

    $tenantId = filter_var($tenantId, FILTER_SANITIZE_NUMBER_INT);
    $requestDescription = filter_var($requestDescription, FILTER_SANITIZE_STRING);

    $requestDate = date('Y-m-d');
    $status = 'Pending';

    $sql = "INSERT INTO maintenance_requests (tenant_id, request_description, request_date, status)
            VALUES ('$tenantId', '$requestDescription', '$requestDate', '$status')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Function to update maintenance request information
function updateMaintenanceRequest($requestId, $resolutionDescription) {
    global $conn;

    $requestId = filter_var($requestId, FILTER_SANITIZE_NUMBER_INT);
    $resolutionDescription = filter_var($resolutionDescription, FILTER_SANITIZE_STRING);

    $resolutionDate = date('Y-m-d');
    $status = 'Resolved';

    $sql = "UPDATE maintenance_requests 
            SET resolution_description='$resolutionDescription', resolution_date='$resolutionDate', status='$status' 
            WHERE request_id=$requestId";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return "Error updating record: " . $conn->error;
    }
}

// Function to delete a maintenance request
function deleteMaintenanceRequest($requestId) {
    global $conn;

    $requestId = filter_var($requestId, FILTER_SANITIZE_NUMBER_INT);

    $sql = "DELETE FROM maintenance_requests WHERE request_id=$requestId";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return "Error deleting record: " . $conn->error;
    }
}

function fetchUserData($startDate, $endDate)
{
    global $conn;  # Assuming $conn is your MySQLi connection
    $query = "SELECT tenants.first_name, tenants.last_name, leases.start_date, leases.end_date, leases.rent_amount, leases.payment_status 
              FROM tenants
              LEFT JOIN leases ON tenants.tenant_id = leases.tenant_id
              WHERE leases.start_date BETWEEN ? AND ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $startDate, $endDate);
    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}


/* Creates a chartjs graph displaying data.
 *  dataset $labels = labels for y axis (fx. [1,2,3...]
 *  array $data = array of data for x axis
 *  boolean $isPie = true for pie chart
 *  int $maxHeight/$maxWidth = maximum height and width for canvas
 *
 *  function drawChart(array $labels, array $data, boolean $isPie, int $maxHeight, int $maxWidth)
 */
function drawChart($labels, $data, $isPie = false, $maxHeight = null, $maxWidth = null) {
	$colVal = rand(0,359);
	$labels = implode(',', array_map(function($value) {return (!is_numeric($value)) ? '"' . $value . '"' : $value;}, $labels));
	$jsondata = '';
	$id = rand(0,9999)."chart";
		$colorSet = '[';
		foreach ($data as $json) {
			$colorSet .= '"hsl('.$colVal.',70%,65%)",';
			$colVal = ($colVal + rand(30,130)) % 360;
		}
		$colorSet = substr($colorSet,0,-1).']';
		$data = implode(',', array_map(function($value) {return (!is_numeric($value)) ? '"' . $value . '"' : $value;}, $data));
		$jsondata = '{backgroundColor: '.$colorSet.', data: ['.$data.']}';
		$pieType = 'type: "pie",';
		$showLegend = 'true';

	$chart = <<<SCR
	<canvas id="{$id}" style="max-width: {$maxWidth}px; max-height: {$maxHeight}px;"></canvas>
	<script>
	new Chart("{$id}", {
		{$pieType}
		data: {
			labels: [{$labels}],
			datasets: [{$jsondata}]
		},
		options: {
			responsive: true,
			plugins: {legend: {display: {$showLegend}}},
SCR;
		if (!$isPie) {
			$chart .= <<<SCR
				scales: {
					borderWidth: 0,
					xAxes: {
						ticks: {min: 6, max:9},
						grid: {
							display: false,
							drawBorder: true,
							color: "#ff0000",
							borderColor: "#eee"
						}
					},
					yAxes: {
						grid: {
							display: false,
							drawBorder: true,
							color: "#ff0000",
							borderColor: "#eee"
						}
					}
				}
SCR;
			}
			$chart .= '}});</script>';
	echo $chart;
}



// Close the database connection
// $conn->close();
?>
