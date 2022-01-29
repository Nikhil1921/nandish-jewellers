<?php
// thumbimage.php
class ThumbImage
{
    private $source;

    public function __construct($sourceImagePath)
    {
        $this->source = $sourceImagePath;
    }

    public function createThumb($destImagePath, $thumbWidth=100)
    {
        $sourceImage = imagecreatefromjpeg($this->source);
        $orgWidth = imagesx($sourceImage);
        $orgHeight = imagesy($sourceImage);
        $thumbHeight = floor($orgHeight * ($thumbWidth / $orgWidth));
        $destImage = imagecreatetruecolor($thumbWidth, $thumbHeight);
        imagecopyresampled($destImage, $sourceImage, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $orgWidth, $orgHeight);
        imagejpeg($destImage, $destImagePath);
        imagedestroy($sourceImage);
        imagedestroy($destImage);
    }

    public function convert_webp($path, $img, $name)
    {
        $image = imagecreatefromjpeg($path.$img);

        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);
        imagewebp($image, "$path$name.webp", 100);
        imagedestroy($image);
        return "$name.webp";
    }
}