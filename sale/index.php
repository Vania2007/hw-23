<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Акція</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            width: 600px;
        }
        h1 {
            color: #ff5733;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .countdown {
            font-size: 18px;
            margin: 10px auto;
            padding: 10px;
            background: #e7f3fe;
            border: 1px solid #b3d7ff;
            border-radius: 5px;
            width: 380px
        }
        .current-time {
            font-size: 16px;
            color: #555;
            margin-top: 20px;
        }
        .expired {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    date_default_timezone_set('Europe/Kiev');

    $currentDateTime = time();

    $endDateTime = strtotime('30.11.2024 00:00:00');

    $timeLeft = $endDateTime - $currentDateTime;

    echo "<h1>Спеціальна Акція!</h1>";

    if ($timeLeft < 0) {
        echo "<p class='expired'>Акція закінчилась.</p>";
    } else {
        $days = floor($timeLeft / (60 * 60 * 24));
        $hours = floor(($timeLeft % (60 * 60 * 24)) / (60 * 60));
        $minutes = floor(($timeLeft % (60 * 60)) / 60);
        echo "<div class='countdown'>Залишилось часу: $days днів, $hours годин, $minutes хвилин.</div>";
        echo "<p>Акція триває до: " . date('d.m.Y H:i:s', $endDateTime) . "</p>";
    }
    echo "<div class='current-time'>Поточна дата та час: " . date('d.m.Y H:i:s', $currentDateTime) . "</div>";
    ?>
</div>

</body>
</html>