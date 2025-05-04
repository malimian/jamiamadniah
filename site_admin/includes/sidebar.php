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
