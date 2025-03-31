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
    
    // Organize modules by parent and create ID map
    $menuItems = [];
    $idToItemMap = [];
    $allParents = [];
    
    foreach ($og_modules as $module) {
        $menuItems[$module['Parent']][] = $module;
        $idToItemMap[$module['id']] = $module;
        $allParents[] = $module['Parent'];
    }
    $allParents = array_unique($allParents);
    
    // Track processed items to prevent duplicates
    $processedItems = [];
    
    // Function to build menu items
    function buildMenuItem($item, &$menuItems, &$idToItemMap, &$processedItems) {
        if (in_array($item['id'], $processedItems)) return;
        
        $processedItems[] = $item['id'];
        $hasChildren = isset($menuItems[$item['id']]);
        
        echo '<li class="nav-item' . ($hasChildren ? ' dropdown' : '') . '">';
        
        if ($hasChildren) {
            echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown'.$item['id'].'" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        } else {
            echo '<a class="nav-link" href="'.$item['url'].'">';
        }
        
        echo '<i class="'.$item['iconclass'].'"></i>&nbsp;';
        echo '<span>'.$item['title'].'</span>';
        echo '</a>';
        
        if ($hasChildren) {
            echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown'.$item['id'].'">';
            buildMenu($item['id'], $menuItems, $idToItemMap, $processedItems);
            echo '</div>';
        }
        
        echo '</li>';
    }
    
    // Function to build menu hierarchy
    function buildMenu($parentId, &$menuItems, &$idToItemMap, &$processedItems) {
        if (!isset($menuItems[$parentId])) return;
        
        foreach ($menuItems[$parentId] as $item) {
            if ($parentId != 0) {
                // Child items in dropdown
                if (!in_array($item['id'], $processedItems)) {
                    echo '<a class="dropdown-item" href="'.$item['url'].'">';
                    echo '<i class="'.$item['iconclass'].'"></i>&nbsp;';
                    echo $item['title'];
                    echo '</a>';
                    $processedItems[] = $item['id'];
                }
            } else {
                // Top-level items
                buildMenuItem($item, $menuItems, $idToItemMap, $processedItems);
            }
        }
    }
    
    // First build top-level menu items (Parent = 0)
    buildMenu(0, $menuItems, $idToItemMap, $processedItems);
    
    // Then build any remaining parent items that have children but weren't top-level
    foreach ($allParents as $parentId) {
        if ($parentId != 0 && !in_array($parentId, $processedItems) && isset($menuItems[$parentId])) {
            if (isset($idToItemMap[$parentId])) {
                // Parent exists in menu items
                buildMenuItem($idToItemMap[$parentId], $menuItems, $idToItemMap, $processedItems);
            } else {
                // Parent doesn't exist - create generic entry
                echo '<li class="nav-item dropdown">';
                echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown'.$parentId.'" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                echo '<i class="fa fa-folder"></i>&nbsp;';
                echo '<span>Menu '.$parentId.'</span>';
                echo '</a>';
                echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown'.$parentId.'">';
                buildMenu($parentId, $menuItems, $idToItemMap, $processedItems);
                echo '</div>';
                echo '</li>';
            }
        }
    }
    ?>
</ul>
