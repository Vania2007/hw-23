<?php
$directory = './images';

if (!is_dir($directory)) {
    die("Директорія не знайдена: $directory");
}

$files = scandir($directory);

foreach ($files as $file) {
    if (preg_match('/^IMG_(\d{8})_\d{6}\.jpg$/', $file, $matches)) {
        $dateString = $matches[1]; 
        $year = substr($dateString, 0, 4);
        $month = substr($dateString, 4, 2);

        $yearFolder = $directory . '/' . $year;

        if (!is_dir($yearFolder)) {
            mkdir($yearFolder, 0755, true);
            echo "Створено папку: $yearFolder\n";
        }
        $monthFolder = $yearFolder . '/' . $month;

        if (!is_dir($monthFolder)) {
            mkdir($monthFolder, 0755, true);
            echo "Створено папку: $monthFolder\n";
        }

        rename($directory . '/' . $file, $monthFolder . '/' . $file);
        echo "Переміщено файл: $file у папку: $monthFolder\n";
    }
}

echo "Обробка завершена!";
?>