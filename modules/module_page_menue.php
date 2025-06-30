<div class="collapse navbar-collapse bg-white" id="navbarCollapse">
    <div class="navbar-nav me-lg-auto mx-xl-auto">
        <?php
        $menues = return_multiple_rows("SELECT * FROM category WHERE soft_delete = 0 AND isactive = 1 AND showInNavBar = 1 AND ParentCategory = 0 ORDER BY cat_sequence ASC");

        foreach ($menues as $menu) {
            $has_pages = return_single_ans("SELECT COUNT(catid) FROM pages WHERE catid = {$menu['catid']} AND isactive = 1 AND soft_delete = 0");
            $has_hierarchy = $menu['CreateHierarchy'] == 1;

            if ($has_pages > 0 && $has_hierarchy) {
                echo '<div class="nav-item dropdown">';
                echo '<a href="' . $menu['cat_url'] . '" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">' . $menu['catname'] . '</a>';
                echo '<div class="dropdown-menu m-0 rounded-0">';

                $sub_menues = return_multiple_rows("SELECT * FROM pages WHERE soft_delete = 0 AND isactive = 1 AND catid = {$menu['catid']} ORDER BY pages_sequence ASC");

                foreach ($sub_menues as $sub) {
                    $permalink = return_single_ans("SELECT settings_value FROM og_settings WHERE soft_delete = 0 AND isactive = 1 AND settings_name = 'FRIENDLY_URL'");
                    $path_info = pathinfo($sub['page_url']);

                    $href = ($permalink == 0 && isset($path_info['extension']) && $path_info['extension'] == "html")
                        ? "info.php?url=" . $sub['page_url']
                        : $sub['page_url'];

                    echo '<a href="' . $href . '" class="dropdown-item">' . $sub['page_title'] . '</a>';
                }

                echo '</div>';
                echo '</div>';
            } else {
                echo '<a href="' . $menu['cat_url'] . '" class="nav-item nav-link">' . $menu['catname'] . '</a>';
            }
        }
        ?>
    </div>
</div>
