<nav class="navbar navbar-expand navbar-dark bg-dark px-3">
  <!-- Left side: Logo and sidebar toggle -->
  <div class="d-flex align-items-center">
    <a class="navbar-brand" href="<?php echo $_SESSION['user']['dashboard']; ?>">
      <?php echo SITE_TITLE; ?>
    </a>
    <button class="btn btn-link btn-sm text-white ml-2" id="sidebarToggle">
      <i class="fas fa-bars"></i>
    </button>
  </div>

  <!-- Right side: Search + User info -->
  <div class="ml-auto d-flex align-items-center gap-3">
    <!-- Search Form -->
    <form class="form-inline mr-3">
      <div class="input-group">
        <input type="text" class="form-control" id="datatable_search" placeholder="Search for..." />
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>


        <a href="<?= BASE_URL ?>" 
           target="_blank" 
           class="btn btn-sm btn-outline-light ml-2"
           title="Visit Website">
            <i class="fas fa-home mr-1"></i> Visit Website
        </a>

    <!-- User Dropdown -->
    <div class="nav-item dropdown">
      <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" id="userDropdown"
         role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

        <?php if (!empty($_SESSION['user']['profile_pic'])): ?>
          <img src="<?= BASE_URL . ABSOLUTE_IMAGEPATH . $_SESSION['user']['profile_pic'] ?>"
               class="rounded-circle" width="32" height="32" alt="Profile" />
        <?php else: ?>
          <img src="http://localhost/ibspotlight/images/profile_pics/images.png"
               class="rounded-circle" width="32" height="32" alt="Profile" />
        <?php endif; ?>

        <span class="ml-2 d-none d-lg-inline text-white small">
          Hi, <?= htmlspecialchars($_SESSION['user']['fullname'] ?? $_SESSION['user']['username']) ?>
        </span>
      </a>

      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="account.php">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
        </a>
      </div>
    </div>
  </div>
</nav>
