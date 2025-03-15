<div class="collapse navbar-collapse" id="navbarCollapse">
	<!-- responsive nav -->
				<div class="navbar-nav ms-auto p-4 p-lg-0">
												
					<?php

					$menues = return_multiple_rows("Select * from category Where soft_delete = 0  and isactive = 1 and showInNavBar = 1 and ParentCategory = 0 Order By cat_sequence ASC");

					foreach ($menues as $menu) {

					if(return_single_ans("SELECT COUNT(catid) from pages Where catid = ".$menu['catid']." and isactive = 1 and soft_delete = 0 ") > 0 && $menu['CreateHierarchy']== 1)
					{

					 echo '<li class="nav-item">';

					 echo'<a href="'.$menu['cat_url'].'"  class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >'.$menu['catname'].'</a>';

				    echo '<div class="dropdown-menu youth">';

					$sub_menues = return_multiple_rows("Select * from pages Where soft_delete = 0  and isactive = 1 and catid = ".$menu['catid']." Order By pages_sequence ASC" );

					foreach ($sub_menues as $sub_menue) {
					
					$perma_link = return_single_ans("Select settings_value from og_settings Where soft_delete = 0  and isactive = 1 and settings_name ='FRIENDLY_URL' ");

					$path_info = pathinfo($sub_menue['page_url']);

					if($perma_link == 0 && $path_info['extension'] == "html")

					echo'<a href="info.php?url='.$sub_menue['page_url'].'" class="dropdown-item" >'.$sub_menue['page_title'].'</a>';								
					else
					echo'<a href="'.$sub_menue['page_url'] , null.'" class="dropdown-item"  >'.$sub_menue['page_title'].'</a>';


					}
					echo '</div>';

					echo '</li>';

					}else{

						echo '<a class="nav-item nav-link" href="'.$menu['cat_url'].'">'.$menu['catname'].'</a>';
					
					}

						}
					?>


					</ul>
	</div> 
<!-- .nav-collapse -->