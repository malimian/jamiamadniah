<?php
include '../front_connect.php';
set_time_limit(0);

$directory = __DIR__;
$files = scandir($directory);

foreach ($files as $file) {
    $filePath = $directory . '/' . $file;
    if (is_file($filePath) && strtolower(pathinfo($file, PATHINFO_EXTENSION)) == "docx") {
        
        $filenameWithoutExtension = pathinfo($file, PATHINFO_FILENAME);
        $cleanName = preg_replace('/\d+/', '', $filenameWithoutExtension);
        echo "<strong>$cleanName</strong><br>";

        $text = readDocx($filePath);

        // Extract fatwa number
        $fatwaNumber = '';
        if (preg_match('/فتوی نمبر\s*[:\-]?\s*(\d+)/u', $text, $matches)) {
            $fatwaNumber = trim($matches[1]);
            echo "<strong>فتوی نمبر:</strong> " . htmlspecialchars($fatwaNumber) . "<br>";
        }

        // Extract swal سوال
        $sawal = '';
        if (preg_match('/السلام علیکم.*?(.*?)الجواب/u', $text, $matches)) {
            $sawal = trim($matches[1]);
            echo "<strong>سوال:</strong><br>" . nl2br(htmlspecialchars($sawal)) . "<br>";
        }

        // Extract jwab جواب
        $jawab = '';
        if (preg_match('/الجواب.*?(.*)$/us', $text, $matches)) {
            $jawab = trim($matches[1]);
            echo "<strong>جواب:</strong><br>" . nl2br(htmlspecialchars($jawab)) . "<br>";
        }

        // Now prepare to insert
        if (!empty($fatwaNumber)) {
            $page_url = "fatwa-" . uniqid().".html";
            $page_title = escape($cleanName);
            $page_desc = escape($jawab);
            $sawal = escape($sawal);

            $check_fatwa_file = return_single_ans("SELECT * FROM page_files WHERE f_name = '$file' ");
            
            if (empty($check_fatwa_file)) {
                $page_id = Insert("INSERT INTO `pages` (`pid`, `catid`, `site_template_id`, `template_id`, `page_url`, `page_title`, `page_desc`, `page_meta_title`, `page_meta_index`, `page_meta_follow`, `page_meta_archive`, `page_meta_imageindex`, `include_in_sitemap`, `sitemap_priority`, `sitemap_changefreq`, `pages_sequence`, `isactive`, `activatedon`, `visibility`, `useCKEditor`, `createdon`, `updatedon`, `soft_delete`) VALUES 
                    (NULL, '154', '1', '17', '$page_url', '$page_title', '$page_desc', '$page_title', '1', '1', '1', '1', '1', '0.8', 'weekly', '45', '1', NOW(), '1', '1', NOW(), NOW(), '0')");
                if (!empty($page_id)) {

                    echo Insert("INSERT INTO `page_attribute_values` (`page_id`, `attribute_id`, `attribute_value`, `isactive`, `soft_delete`) VALUES 
                        ('$page_id', '367', '$sawal', '1', '0')");

                    echo Insert("INSERT INTO `page_attribute_values` (`page_id`, `attribute_id`, `attribute_value`, `isactive`, `soft_delete`) VALUES 
                        ('$page_id', '366', '$fatwaNumber', '1', '0')");

                    echo Insert("INSERT INTO `page_files` (`pid`, `f_name`, `f_sequence`, `createdon`, `isactive`, `soft_delete`) VALUES 
                        ('$page_id', '$file', '1', NOW(), '1', '0')");

                    $newDir = '../files/';
                    rename($filePath, $newDir . basename($filePath));
                    echo "<small>Moved to files/ ".basename($filePath)."</small><br>";
                }

                echo "<hr></br>\n\n";
            }
        }else{
        	  echo "</br>already exits<hr></br>\n\n";
        	  unlink($filePath);
    		  echo "<small>Deleted duplicate file: ".basename($filePath)."</small><br>";

        }
    }
}



// Function to read docx text
function readDocx($filePath) {
    $zip = new ZipArchive;
    if ($zip->open($filePath) === TRUE) {
        // content is stored in word/document.xml inside docx
        $xmlContent = $zip->getFromName('word/document.xml');
        $zip->close();
        // strip tags to get plain text
        $plainText = strip_tags($xmlContent);
        return $plainText;
    }
    return '';
}
?>
