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
        <a class="nav-link" id="logout">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>

  <?php

  if (isset($_POST['logout'])) {
    $_SESSION = array();
    session_destroy();
  }
  ?>