<?php

if (empty($_SESSION['weather_html'])) {

    // Step 1: Get User Location
    $locationData = json_decode(file_get_contents("https://ipinfo.io/json"), true);
    $city = isset($locationData['city']) ? $locationData['city'] : "Unknown";
    $country = isset($locationData['country']) ? $locationData['country'] : "";

    // Step 2: Get Weather Data
    $weatherData = json_decode(file_get_contents("https://wttr.in/{$city}?format=j1"), true);
    $temperature = isset($weatherData['current_condition'][0]['temp_C']) ? $weatherData['current_condition'][0]['temp_C'] . "°C" : "N/A";
    $weatherDesc = isset($weatherData['current_condition'][0]['weatherDesc'][0]['value']) ? $weatherData['current_condition'][0]['weatherDesc'][0]['value'] : "Unknown";

    // Step 3: Weather Icons
    $weatherIcons = [
        "Clear" => '<i class="fas fa-sun text-warning"></i>',
        "Sunny" => '<i class="fas fa-sun text-warning"></i>',
        "Partly cloudy" => '<i class="fas fa-cloud-sun text-primary"></i>',
        "Cloudy" => '<i class="fas fa-cloud text-secondary"></i>',
        "Overcast" => '<i class="fas fa-smog text-muted"></i>',
        "Mist" => '<i class="fas fa-smog text-secondary"></i>',
        "Fog" => '<i class="fas fa-smog text-secondary"></i>',
        "Light rain" => '<i class="fas fa-cloud-rain text-info"></i>',
        "Moderate rain" => '<i class="fas fa-cloud-showers-heavy text-info"></i>',
        "Heavy rain" => '<i class="fas fa-cloud-showers-heavy text-primary"></i>',
        "Showers" => '<i class="fas fa-cloud-showers-heavy text-info"></i>',
        "Drizzle" => '<i class="fas fa-cloud-rain text-info"></i>',
        "Thunderstorm" => '<i class="fas fa-bolt text-danger"></i>',
        "Snow" => '<i class="fas fa-snowflake text-light"></i>',
        "Light snow" => '<i class="fas fa-snowflake text-light"></i>',
        "Heavy snow" => '<i class="fas fa-snowman text-light"></i>',
        "Blizzard" => '<i class="fas fa-snowman text-light"></i>',
        "Sleet" => '<i class="fas fa-cloud-meatball text-info"></i>',
        "Hail" => '<i class="fas fa-icicles text-primary"></i>',
        "Windy" => '<i class="fas fa-wind text-secondary"></i>',
        "Tornado" => '<i class="fas fa-poo-storm text-danger"></i>',
        "Hurricane" => '<i class="fas fa-hurricane text-danger"></i>',
        "Cold" => '<i class="fas fa-thermometer-empty text-info"></i>',
        "Hot" => '<i class="fas fa-thermometer-full text-danger"></i>',
        "Haze" => '<i class="fas fa-smog text-warning"></i>',
        "Unknown" => '<i class="fas fa-question-circle text-muted"></i>'
    ];

    $weatherIcon = isset($weatherIcons[$weatherDesc]) ? $weatherIcons[$weatherDesc] : $weatherIcons['Unknown'];  // Default Icon

    // Step 4: Get Current Date
    $today = new DateTime();
    $formattedDate = $today->format('D, d M Y');

    // Step 5: Generate the HTML content
    $weatherHtml = '
    <div class="d-flex" id="weather-container">
        <span id="weather-icon" class="me-2 fs-3">' . $weatherIcon . '</span>
        <div class="d-flex align-items-center">
            <strong id="temperature" class="fs-4 text-secondary">' . $temperature . '</strong>
            <div class="d-flex flex-column ms-2" style="width: 150px;">
                <span id="city-name" class="text-body">' . $city . ', ' . $country . '</span>
                <small id="date-time">' . $formattedDate . '</small>
            </div>
        </div>
    </div>';

    // Store the generated HTML in the session
    $_SESSION['weather_html'] = $weatherHtml;

}

    echo $_SESSION['weather_html'];

?>