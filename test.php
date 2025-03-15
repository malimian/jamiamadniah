<?php

include 'front_connect.php';

		function fetchCategories($parent_id, $conn) {
		    $categories = [];
		    $query = "SELECT * FROM category WHERE ParentCategory = ".$parent_id;
		    $result = $conn->query($query);

		    while ($row = $result->fetch_assoc()) {
		        $row['subcategories'] = fetchCategories($row['catid'], $conn); // Recursive call
		        $categories[] = $row;
		    }

		    return $categories;
		}

		$categories = fetchCategories(115, $conn);



		function displayMenu($categories) {
		    echo '<ul class="menu">';
		    foreach ($categories as $category) {
		        echo '<li class="menu-item">';
		        echo '<a href="#">' . $category['catname'] . '</a>';

		        if (!empty($category['subcategories'])) {
		            echo '<div class="dropdown-content">';
		            displayMenu($category['subcategories']); // Recursive call to display subcategories
		            echo '</div>';
		        }

		        echo '</li>';
		    }
		    echo '</ul>';
		}

?>


<div class="mega-menu">
    <?php displayMenu($categories); ?>
</div>