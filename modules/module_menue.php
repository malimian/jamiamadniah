<div class="collapse navbar-collapse bg-light py-3" id="navbarCollapse">
    <div class="navbar-nav mx-auto border-top">
        <?php
        // Get all active menu items that should be shown in navbar
        $menus = return_multiple_rows("
            SELECT * FROM category 
            WHERE soft_delete = 0 
            AND isactive = 1 
            AND showInNavBar = 1 
            ORDER BY cat_sequence ASC
        ");
        
        // Organize menus into a hierarchical structure
        $menuTree = [];
        foreach ($menus as $menu) {
            $parentId = $menu['ParentCategory'];
            if (!isset($menuTree[$parentId])) {
                $menuTree[$parentId] = [];
            }
            $menuTree[$parentId][] = $menu;
        }
        
        // Function to display menu items recursively
        function displayCategoryMenuItems($parentId, $menuTree, $level = 0) {
            if (!isset($menuTree[$parentId])) return;
            
            foreach ($menuTree[$parentId] as $menu) {
                $hasChildren = isset($menuTree[$menu['catid']]) && !empty($menuTree[$menu['catid']]);
                $hasPages = return_single_ans("
                    SELECT COUNT(catid) FROM pages 
                    WHERE catid = ".$menu['catid']." 
                    AND isactive = 1 
                    AND soft_delete = 0
                ") > 0;
                
                // Determine if this menu should be a dropdown
                $shouldDropdown = ($hasChildren || ($hasPages && $menu['CreateHierarchy'] == 1));
                
                if ($shouldDropdown) {
                    echo '<div class="nav-item dropdown">';
                    echo '<a href="'.$menu['cat_url'].'" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">'.$menu['catname'].'</a>';
                    echo '<div class="dropdown-menu m-0">';
                    
                    // Show child categories first
                    if ($hasChildren) {
                        displayCategoryMenuItems($menu['catid'], $menuTree, $level + 1);
                    }
                    
                    // Then show pages if configured to do so
                    if ($hasPages && $menu['CreateHierarchy'] == 1) {
                        $sub_pages = return_multiple_rows("
                            SELECT * FROM pages 
                            WHERE soft_delete = 0 
                            AND isactive = 1 
                            AND catid = ".$menu['catid']." 
                            ORDER BY pages_sequence ASC"
                        );
                        
                        foreach ($sub_pages as $page) {
                            $perma_link = return_single_ans("
                                SELECT settings_value FROM og_settings 
                                WHERE soft_delete = 0 
                                AND isactive = 1 
                                AND settings_name ='FRIENDLY_URL'
                            ");
                            
                            $path_info = pathinfo($page['page_url']);
                            $page_url = ($perma_link == 0 && $path_info['extension'] == "html") 
                                ? "info.php?url=".$page['page_url'] 
                                : $page['page_url'];
                            
                            echo '<a href="'.$page_url.'" class="dropdown-item">'.$page['page_title'].'</a>';
                        }
                    }
                    
                    echo '</div>';
                    echo '</div>';
                } else {
                    // Simple menu item with no dropdown
                    echo '<a class="nav-item nav-link" href="'.$menu['cat_url'].'">'.$menu['catname'].'</a>';
                }
            }
        }
        
        // Start displaying from root menus (parent_id = 0)
        displayCategoryMenuItems(0, $menuTree);
        ?>
    </div>
</div>