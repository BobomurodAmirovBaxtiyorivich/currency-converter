<?php
require "src/Weather.php";

$weather = new Weather();

$weather_info = $weather->getWeather();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body style="background-color: #C9E6F0;">

<div class="container text-center">
    <h1 class="my-4">Weather in <span id="city-name"><?= $weather_info['name'] ?></span></h1>

    <div class="weather-card text-center">
        <div class="mb-3">
            <img id="weather-icon"
                 src="<?php echo 'https://openweathermap.org/img/wn/' . $weather_info['weather'][0]->icon . '@2x.png'; ?>"
                 alt="Weather Icon" class="weather-icon">
        </div>
        <h2 class="mb-3" id="temperature"><?php echo round($weather_info['main']->temp - 273.15, 2) . "°C" ?></h2>
        <p id="description"><?= $weather_info['weather'][0]->main ?></p>

        <div class="d-flex justify-content-around">
            <div>
                <h5>Feels like</h5>
                <p> <?php echo round($weather_info['main']->feels_like - 273.15, 2) . "°C" ?> </p>
            </div>
            <div>
                <h5>Humidity</h5>
                <p id="feels-like"><?php echo $weather_info['main']->humidity ?> %</p>
            </div>
            <div>
                <h5>Wind</h5>
                <p id="wind-speed"><?php echo $weather_info['wind']->speed . "m/s" ?></p>
            </div>
        </div>
    </div>
</div

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>