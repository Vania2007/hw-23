<?php
$city = isset($_POST['city']) ? $_POST['city'] : 'Kharkiv,ua';
$apiKey = '6c5583ebef40b104e592c990ca92065d';
$weathers_json = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q={$city}&lang=uk&APPID={$apiKey}&units=metric");
$weathers = json_decode($weathers_json);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Погода в місті</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        /* Основные стили */
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to bottom, #EAF6FF, #FFFFFF);
            color: #3A5975;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 100vh;
            padding: 20px;
        }

        h1 {
            font-size: 36px;
            color: #2380BE;
            margin-bottom: 20px;
            text-shadow: 0 2px 8px rgba(35, 128, 190, 0.3);
        }

        .form-container {
            width: 100%;
            max-width: 600px;
            background: #FFFFFF;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }

        form label {
            font-size: 18px;
            font-weight: 500;
            color: #2380BE;
            margin-bottom: 10px;
            display: block;
        }

        select, input[type="submit"] {
            font-size: 16px;
            padding: 10px 15px;
            margin-top: 10px;
            border: 1px solid #BDDBF1;
            border-radius: 12px;
            background: #F7F9FC;
            color: #2380BE;
            width: 100%;
            transition: all 0.3s ease;
        }

        select:hover, input[type="submit"]:hover {
            border-color: #2380BE;
            background: #EAF6FF;
        }

        .weather-container {
            max-width: 700px;
            background: #FFFFFF;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(35, 128, 190, 0.2);
            padding: 30px;
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        .weather-header {
            background: linear-gradient(to bottom right, #BDDBF1, #2380BE);
            border-radius: 20px;
            padding: 20px;
            width: 100%;
            text-align: center;
            color: #FFFFFF;
            margin-bottom: 20px;
        }

        .weather-header h2 {
            font-size: 28px;
            font-weight: 700;
            margin: 0;
        }

        .weather-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .weather-icon {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: #EAF6FF;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .weather-description {
            text-align: left;
            flex-grow: 1;
            padding-left: 20px;
        }

        .weather-description p {
            margin: 5px 0;
            font-size: 18px;
        }

        .weather-highlight {
            font-size: 36px;
            font-weight: 700;
            color: #2380BE;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .weather-info {
                flex-direction: column;
                align-items: center;
                text-align: center.
            }
            .weather-description {
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <h1>Прогноз погоди</h1>
    <div class="form-container">
        <form method="post">
            <label for="city">Виберіть місто:</label>
            <select name="city" id="city">
                <option value="Kharkiv,ua" <?= $city == 'Kharkiv,ua' ? 'selected' : '' ?>>Харків</option>
                <option value="Kyiv,ua" <?= $city == 'Kyiv,ua' ? 'selected' : '' ?>>Київ</option>
                <option value="Lviv,ua" <?= $city == 'Lviv,ua' ? 'selected' : '' ?>>Львів</option>
                <option value="Odesa,ua" <?= $city == 'Odesa,ua' ? 'selected' : '' ?>>Одеса</option>
                <option value="Dnipro,ua" <?= $city == 'Dnipro,ua' ? 'selected' : '' ?>>Дніпро</option>
            </select>
            <input type="submit" value="Отримати погоду">
        </form>
    </div>
    <?php
    if (isset($weathers->cod) && $weathers->cod !== 200) {
        echo "<div class='weather-container'><p>Помилка: {$weathers->message}</p></div>";
    } else {
        $icon = "http://openweathermap.org/img/wn/{$weathers->weather[0]->icon}@4x.png";
        $temperature = $weathers->main->temp;
        $description = $weathers->weather[0]->description;
        $pressure = $weathers->main->pressure;
        $humidity = $weathers->main->humidity;
        $wind_speed = $weathers->wind->speed;

        echo "<div class='weather-container'>
            <div class='weather-header'>
                <h2>{$weathers->name}</h2>
                <p>{$description}</p>
            </div>
            <div class='weather-info'>
                <div class='weather-icon'>
                    <img src='{$icon}' alt='Weather Icon' width='100'>
                </div>
                <div class='weather-description'>
                    <p><span class='weather-highlight'>{$temperature} °C</span></p>
                    <p>Тиск: {$pressure} гПа</p>
                    <p>Вологість: {$humidity}%</p>
                    <p>Швидкість вітру: {$wind_speed} м/с</p>
                </div>
            </div>
        </div>";
    }
    ?>
</body>
</html>
