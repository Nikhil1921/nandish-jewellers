<?php

function convert_webp($path, $image, $name) {
    imagepalettetotruecolor($image);
    imagealphablending($image, true);
    imagesavealpha($image, true);
    imagewebp($image, "$path$name.webp", 100);
    imagedestroy($image);
    return "$name.webp";
}