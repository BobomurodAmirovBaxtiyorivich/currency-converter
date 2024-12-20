<?php
require "src/currency.php";

$currency = new Currency;

$currencies = $currency->getCurrencies();

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .currency-card {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .currency-section {
            padding: 60px 0;
        }

        .info-section {
            padding: 60px 0;
            text-align: center;
        }

        .btn-primary-custom {
            background-color: #d32f2f;
            border: none;
        }
    </style>
</head>

<body>
<div class="currency-section text-center pt-5 bg-primary-subtle">
    <h1>Currency Converter</h1>
    <p>Need to make an international business payment? Take a look at our live foreign exchange rates.</p>
    <div class="currency-card">
        <h3>Make fast and affordable international business payments</h3>
        <p>Send secure international business payments in XX currencies, all at competitive rates with no hidden
            fees.</p>
        <form action="">
            <div class="row g-3 align-items-center">
                <div class="col-md-5">
                    <label for="amount" class="form-label visually-hidden">Amount</label>
                    <input type="number" id="amount" name="amount" class="form-control" placeholder="Amount">
                </div>
                <div class="col-md-3 text-center">
                    <select class="form-select" name="Ccy">
                        <option value="UZS">UZS</option>
                        <?php

                        foreach ($currencies as $ccy => $rate) { ?>
                            <option value="<?= $ccy ?>"><?= $ccy ?></option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div class="col-md-1 text-center">
                    <span>⇆</span>
                </div>
                <div class="col-md-3">
                    <label>
                        <select class="form-select" name="Ccy2">
                            <option value="UZS" selected>UZS</option>
                            <?php

                            foreach ($currencies as $ccy => $rate) { ?>
                                <option value="<?= $ccy ?>"><?= $ccy ?></option>
                            <?php }
                            ?>
                        </select>
                    </label>
                </div>
            </div>
            <?php

            if (isset($_GET['sub'])) {
                if (!empty($_GET['amount']) && !empty($_GET['Ccy']) && !empty($_GET['Ccy2'])) {
                    if ($_GET['Ccy'] == 'UZS' && $_GET['Ccy2'] != 'UZS') {
                        $result = $currency->exchange($_GET['amount'], $_GET['Ccy'], $_GET['Ccy2']);
                        ?>
                        <p class="rate-info mt-2"><?= $result[0] ?> <?= $result[1] ?>
                            = <?= $result[3] ?> <?= $result[2] ?>
                            <i class="bi bi-info-circle"></i></p>
                    <?php } elseif ($_GET['Ccy'] != 'UZS' && $_GET['Ccy2'] == 'UZS') {
                        $result = $currency->exchange($_GET['amount'], $_GET['Ccy'], $_GET['Ccy2']);
                        ?>
                        <p class="rate-info mt-2"><?= $result[0] ?> <?= $result[1] ?>
                            = <?= $result[3] ?> <?= $result[2] ?>
                            <i class="bi bi-info-circle"></i></p>
                        </p>
                    <?php } elseif ($_GET['Ccy'] == $_GET['Ccy2']) {
                        $result = $currency->exchange($_GET['amount'], $_GET['Ccy'], $_GET['Ccy2']);
                        ?>
                        <p class="rate-info mt-2">
                            <?= $result ?>
                            <i class="bi bi-info-circle"></i>
                        </p>
                    <?php } else {
                        $result = $currency->exchange($_GET['amount'], $_GET['Ccy'], $_GET['Ccy2']);
                        ?>
                        <p class="rate-info mt-2">
                            <?php echo $result ?>
                            <i class="bi bi-info-circle"></i>
                        </p>
                    <?php }
                }
            }
            ?>

            <button type="submit" name="sub" class="btn btn-primary btn-primary-custom mt-3">Convert</button>
        </form>
    </div>
</div>
<div class="info-section bg-light">
    <h4 class="fw-bold">Let’s save you some time</h4>
    <p class="text-muted">If you want to know all exchange rate, click here</p>
    <a href="views/send_from_bot.php" class="btn btn-outline-danger">Find out more</a>
</div>
</body>

</html>