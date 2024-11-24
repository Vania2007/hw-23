<?php
$startDir = './start_dir';
function createDirectoryTree($startDir) {
    $dirs = [
        'folder1',
        'folder2/folder2.1',
        'folder2/folder2.2',
        'folder3'
    ];

    foreach ($dirs as $dir) {
        $path = $startDir . '/' . $dir;
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
            echo "Створено папку: $path\n";
        }
    }
}

function deleteTextFiles($dir) {
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }

        $path = $dir . '/' . $file;

        if (is_dir($path)) {
            deleteTextFiles($path);
        } elseif (pathinfo($path, PATHINFO_EXTENSION) === 'txt') {
            unlink($path);
            echo "Видалено текстовий файл: $path\n";
        }
    }
}

function sortImagesByExtension($dir) {
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }

        $path = $dir . '/' . $file;

        if (is_dir($path)) {
            sortImagesByExtension($path);
        } elseif (in_array(pathinfo($path, PATHINFO_EXTENSION), ['jpg', 'png', 'gif'])) {
            $extension = pathinfo($path, PATHINFO_EXTENSION);
            $extensionDir = $dir . '/' . $extension;

            if (!is_dir($extensionDir)) {
                mkdir($extensionDir, 0755, true);
                echo "Створено папку для розширення: $extensionDir\n";
            }

            rename($path, $extensionDir . '/' . $file);
            echo "Переміщено файл: $path у папку: $extensionDir\n";
        }
    }
}



createDirectoryTree($startDir);

deleteTextFiles($startDir);

sortImagesByExtension($startDir);

echo "Обробка завершена.\n";
?>