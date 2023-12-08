<nav class="navbar navbar-expand-lg navbar-dark bg-primary custom-nav">
  <a class="navbar-brand" href="<?= URL_ROOT . 'index.php' ?>">
    <?= APP_NAME ?>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto pl-4">
      <li class="nav-item">
        <a class="nav-link" href="<?= URL_ROOT . 'index.php' ?>">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/RealEstateManagement/modules/tenants/view_all_tenants.php">View All Tenants</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/RealEstateManagement/modules/leases/view_all_leases.php">View All Leases</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/RealEstateManagement/modules/properties/view_all_properties.php">View All Properties</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/RealEstateManagement/modules/maintenance_requests/view_all_maintenance_requests.php">View All Maintenance
          Requests</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= URL_ROOT . 'users.php' ?>">Users</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link">Welcome <b>
            <?= $_SESSION['first_name'] ?>
          </b></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= URL_ROOT . 'logout.php' ?>">Logout</a>
      </li>
    </ul>
  </div>
</nav>