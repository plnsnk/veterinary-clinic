<?php
$review = \App\Models\Review::first();
if ($review && $review->photo_path) {
    $path = 'storage/app/public/' . ltrim($review->photo_path, 'storage/');
    echo "Файл: $path<br>";
    echo "Существует: " . (file_exists($path) ? '✅ ДА' : '❌ НЕТ') . "<br>";
    echo "URL: " . asset('storage/app/public/' . ltrim($review->photo_path, 'storage/'));
}
?>