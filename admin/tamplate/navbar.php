  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- SEARCH FORM -->
    <div class="input-group input-group-sm" style="width: unset;">
      <!-- <input name="current" type="hidden" value=""> -->
      <input class="form-control form-control-navbar" value="" id="search" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-navbar" type="button">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" href=".signout">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <?php
  if (isset($_POST['signout'])) {
    $_SESSION = array();
    session_destroy();
    header('location: index.php');
  }
  ?>
  <!-- Modal -->
  <div class="modal fade signout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Sign Out</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="padding: 0;">
          <form method="post" action="">
            <div class="card-body">
              <div class="form-group">
                <p for="Confirm">apakah anda ingin signout?</p>
              </div>
            </div>
            <div class="modal-footer">
              <button name="signout" type="submit" class="btn btn-danger">sign out</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>