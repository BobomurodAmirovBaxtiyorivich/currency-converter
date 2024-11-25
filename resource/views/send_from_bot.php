<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <form method="POST">
            <div class="mb-3">
                <label for="chat" class="form-label">Enter your telegram chat id to get info</label>
                <input type="number" class="form-control" name="chat_id" id="chat" aria-describedby="Chat id">
            </div>
            <button type="submit" name="sub" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <h1 align="center"><a href="../../index.php" class="btn btn-primary">Back to Currency Converter</a></h1>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>

<?php

require '../src/Bot.php';

require "../currency.php";

$currency = new Currency;

$currencies = $currency->getCurrencies();

$bot = new Bot();

if (isset($_POST['sub'])) {
    echo '<h1 align="center">All info has been sent!</h1>';
    $chat_id = $_POST['chat_id'];
    $currency_list = '';
    foreach ($currencies as $ccy => $rate) {
        $currency_list .= "1 " . $ccy . ' = ' . $rate . " UZS" . "\n";
    }
    $bot->makeRequest('sendMessage', ['chat_id' => $chat_id, 'text' => $currency_list]);
}

?>