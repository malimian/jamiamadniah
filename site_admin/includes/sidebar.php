<!-- Sidebar -->
    <!-- <ul class="sidebar navbar-nav">

      <li class="nav-item">
        <a class="nav-link" href="<?php echo $_SESSION['user']['dashboard'];?>">
          <i class="fas fa-fw fa-home"></i>
          <span>Dashboard</span></a>
        </li>

         <li class="nav-item">
        <a class="nav-link" href="gallery.php">
          <i class="fas fa-fw fa-plus"></i>
          <span>Gallery</span></a>
        </li>
 
       <li class="nav-item">
        <a class="nav-link" href="categories.php">
          <i class="fas fa-fw fa-plus"></i>
          <span>Menue</span></a>
        </li>
        
         <li class="nav-item">
          <a  class="nav-link" href="#PackagesSubMenue" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
              <i class="fas fa-box"></i>
              <span>Custom Packages</span>
            </a>
             <ul class="collapse list-unstyled" id="PackagesSubMenue">
            <li class="nav-item">
              <a class="nav-link" href="og_packages_category.php">
              <i class="fas fa-fw fa-gift"></i>
              <span>Packages Category</span></a>
            </li>
              <li class="nav-item">
              <a class="nav-link" href="all_packages.php">
              <i class="fas fa-fw fa-gift"></i>
              <span>All Packages</span></a>
            </li>
          </ul>
        </li>
     
        <li class="nav-item">
        <a class="nav-link" href="view_promo_code.php">
          <i class="fas fa-fw fa-gift"></i>
          <span>Promo Codes</span></a>
        </li>
       
  <hr/>

    <li class="nav-item">
          <a  class="nav-link" href="#TemplateMenue" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
              <i class="fas fa-gift"></i>
              <span>Template</span>
            </a>
          <ul class="collapse list-unstyled" id="TemplateMenue">
            <li class="nav-item">
              <a class="nav-link" href="site_template.php">
              <i class="fas fa-fw fa-gift"></i>
              <span>Main Template</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages.php">
              <i class="fas fa-fw fa-pages"></i>
              <span>Pages</span></a>
            </li>
          </ul>
      </li>
    

      <li class="nav-item">
          <a  class="nav-link" href="#MainSettingsMenue" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
              <i class="fas fa-cog"></i>
              <span>Settings</span>
            </a>
             <ul class="collapse list-unstyled" id="MainSettingsMenue">
              <li class="nav-item">
                <a class="nav-link" href="file_manger.php">
                <i class="fas fa-fw fa-gift"></i>
                <span>File Manager</span></a>
              </li>
                <li class="nav-item">
                  <a class="nav-link" href="user.php">
                    <i class="fas fa-fw fa-users"></i>
                    <span>User Managment</span></a>
                  </li>
              <li class="nav-item">
              <a class="nav-link" href="og_setting.php">
              <i class="fas fa-fw fa-cog"></i>
              <span>Settings</span></a>
            </li>
          </ul>
      </li> 

   </ul>
 -->


 <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?=$_SESSION['user']['dashboard'];?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
        
          <?php
            $og_modules = $_SESSION['user']['sidebar_modules'];
            foreach ($og_modules as $og_module) {
          ?>

        <li class="nav-item">
        <a class="nav-link" href="<?=$og_module['url'];?>">
          <i class="<?=$og_module['iconclass'];?>"></i>
          <span><?=$og_module['title'];?></span></a>
        </li>
        
        <?php } ?>
        
    </ul>
    
