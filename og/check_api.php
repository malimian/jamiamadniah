<?php
require_once '../connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News API Checker</title>
</head>
<body>

    <h2>Enter API Keys (One per Line)</h2>
    <form action="" method="post">
        <textarea name="api_keys" rows="10" cols="50" placeholder="Enter API keys here..."></textarea><br><br>
        <input type="submit" value="Check API Keys">
    </form>

    <?php
// Set script timeout to unlimited
set_time_limit(0);

// Enable real-time output
ob_implicit_flush(true);
ob_end_flush();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["api_keys"]) || empty(trim($_POST["api_keys"]))) {
        echo "<p style='color: red;'>Please enter at least one API key.</p>";
    } else {
        // Get API keys from textarea and split by new lines
        $apiKeys = array_filter(array_map('trim', explode("\n", trim($_POST["api_keys"]))));

        $workingKeys = [];
        $nonWorkingKeys = [];
        echo "<div>";

        foreach ($apiKeys as $apiKey) {
            $url = "https://newsapi.org/v2/top-headlines?category=Business&apiKey=$apiKey";
            $isalread_added = return_single_ans("Select api_key from api_keys Where api_key = '$apiKey' ");

            // Initialize cURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            // ✅ FIX: Add User-Agent header to avoid rejection
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "User-Agent: MyNewsChecker/1.0 (https://yourwebsite.com)"
            ]);

            // Execute request
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            // Decode JSON response
            $data = json_decode($response, true);

            // Check if API key is valid
            if ($httpCode == 200 && isset($data["articles"])) {
                $workingKeys[] = [$apiKey, "Working"];
                echo "<p style='color: green;'>✔️ $apiKey is working</p>";
                               
                if(empty($isalread_added)){
                
                    echo Insert("INSERT INTO api_keys (api_id, api_key, api_username, api_password, api_package, isProcessed, isactive, createdon, createdby, updatedon, soft_delete) VALUES (NULL, '$apiKey', NULL, NULL, '1', '0', '1', current_timestamp(), NULL, current_timestamp(), '0')");


                }else{
                    echo "</br> Already Added";
                }
                

            } else {
                $nonWorkingKeys[] = [$apiKey, "Not Working"];
               
                echo "<p style='color: red;'>❌ $apiKey is not working</p>";

                  if(empty($isalread_added)){
                    
                    echo Delete("DELETE from api_keys Where api_key = '$apiKey' ");
                }

            }

            flush(); // Immediately send output to the browser
        }

        echo "</div>";

        // ✅ Save API keys status to CSV
        if (!empty($workingKeys) || !empty($nonWorkingKeys)) {
            echo "<p>Total Working Keys: " . count($workingKeys) . "</p>";
            echo "<p>Total Non-Working Keys: " . count($nonWorkingKeys) . "</p>";
            echo "<script>alert('Check complete! Working: " . count($workingKeys) . ", Failed: " . count($nonWorkingKeys) . "');</script>";

            $apiStatusFile = "api_keys_status.csv";
            $file = fopen($apiStatusFile, "w");
            fputcsv($file, ["API Key", "Status"]);

            foreach ($workingKeys as $row) {
                fputcsv($file, $row);
            }
            foreach ($nonWorkingKeys as $row) {
                fputcsv($file, $row);
            }

            fclose($file);
            echo "<p style='color: blue;'>API keys status saved! <a href='$apiStatusFile' download>Download API Status CSV</a></p>";
        } else {
            echo "<p style='color: red;'>No API keys were processed.</p>";
        }
    }
}


    ?>
</body>
</html>
