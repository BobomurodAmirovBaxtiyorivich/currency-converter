<?php
require "../Weather.php";

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
        <style>
                .t_weather {
                        border: 1px solid white;
                        background-color: white;
                        border-radius: 10px;
                        margin-top: 200px;

                }
        </style>
</head>

<body style="background-color: #C9E6F0;">
        <div class="container mb-5">
                <div class="row t_weather">
                        <h5>Today weather is <?php echo $weather_info['weather'][0]->description ?>, temperatur is <?php echo round($weather_info['main']->temp - 273.15, 2) . "°C" ?> but feels like <?php echo round($weather_info['main']->feels_like - 273.15, 2) . "°C" ?> and wind speed is <?php echo $weather_info['wind']->speed . "m/s" ?></h5>
                </div>
        </div>
        <h1 align="center"><a href="../index.php" class="btn btn-primary">Back to Currency Converter</a></h1>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous"></script>
</body>

</html>