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
        switch (pathinfo($this->source,PATHINFO_EXTENSION)) {
            case 'webp':
                $sourceImage = imagecreatefromwebp($this->source);
                break;

            case 'png':
                $sourceImage = imagecreatefrompng($this->source);
                break;
            
            default:
                $sourceImage = imagecreatefromjpeg($this->source);
                break;
        }

        $orgWidth = imagesx($sourceImage);
        $orgHeight = imagesy($sourceImage);
        $thumbHeight = floor($orgHeight * ($thumbWidth / $orgWidth));
        $destImage = imagecreatetruecolor($thumbWidth, $thumbHeight);
        imagecopyresampled($destImage, $sourceImage, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $orgWidth, $orgHeight);
        
        switch (pathinfo($this->source,PATHINFO_EXTENSION)) {
            case 'webp':
                imagewebp($destImage, $destImagePath);
                break;

            case 'png':
                imagepng($destImage, $destImagePath);
                break;
            
            default:
                imagejpeg($destImage, $destImagePath);
                break;
        }
        imagedestroy($sourceImage);
        imagedestroy($destImage);
    }
}