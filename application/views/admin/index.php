<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <!-- Content Row -->
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Admin</div>
              <div class="p mb-0 text-gray-800">Management data transactions dan role access</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">User</div>
              <div class="p mb-0 text-gray-800">Management user</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Menu</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="p mb-0 mr-3 text-gray-800">Management menu system and submenu system</div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-folder-open fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- Area Administratos -->
    <div class="col-xl-4 col-lg-7">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Role Access Administrator</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          The Administrator has access to clustering data transaction, management data transaction,
          management role access, management menu system, management submenu system and management administrator's account.
          
        </div>
      </div>
    </div>

    <!-- Area User -->
    <div class="col-xl-4 col-lg-7">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Role Access User</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          User/Customer has access to management their account, such as edit profile, change password and 
          see product recommendations.
        </div>
      </div>
    </div>

    <!-- Area User -->
    <div class="col-xl-4 col-lg-7">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Cluster Quality</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Silhouette Width</th>
                <th scope="col">Interpretations</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>0,71 - 1</td>
                <td>Strong cluster</td>
              </tr>
              <tr>
                <td>0,51 - 0,7</td>
                <td>Reasonable Cluster</td>
              </tr>
              <tr>
                <td>0,26 - 0,5</td>
                <td>Weak or Artificial Cluster</td>
              </tr>
              <tr>
                <td><= 0,25</td>
                <td>Bad Cluster</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
    
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->