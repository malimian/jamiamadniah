<?php

function debug_($bt , $sql){
			global $conn;
			$error = '<div class="card">';
			$error .= '<div class="card-header bg-danger text-white">Error</div>';
		 	$error .= "<div class='card-body'>";
		    $error .= "Error: " . $sql . "<br>" . $conn->error;
		    $error .="</br><code> File : ".$bt[0]['file']."</code></br>";
		    $error .="<code> line : ".$bt[0]['line']."</code></br>";
		    $error .="<code> function : ".$bt[0]['function']."</code>";
		    $error .="</div>";
		    $error .="</div>";
		  //  if(ENV == 2)
		  // 	echo $error;
}