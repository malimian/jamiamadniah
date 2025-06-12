<?php
class ImageResizer {
    private $originalPath;
    private $image;
    private $originalWidth;
    private $originalHeight;
    private $mimeType;

    public function __construct($imagePath) {
        $this->originalPath = $imagePath;
        $this->validateImage();
        $this->loadImage();
    }

    private function validateImage() {
        if (!file_exists($this->originalPath)) {
            throw new Exception("Image file does not exist");
        }

        $this->mimeType = mime_content_type($this->originalPath);

        if (!in_array($this->mimeType, ['image/jpeg', 'image/png', 'image/webp'])) {
            throw new Exception("Unsupported image type");
        }

        list($this->originalWidth, $this->originalHeight) = getimagesize($this->originalPath);
    }

    private function loadImage() {
        switch ($this->mimeType) {
            case 'image/jpeg':
                $this->image = imagecreatefromjpeg($this->originalPath);
                break;
            case 'image/png':
                $this->image = imagecreatefrompng($this->originalPath);
                break;
            case 'image/webp':
                $this->image = imagecreatefromwebp($this->originalPath);
                break;
            default:
                throw new Exception("Unsupported image format");
        }

        if (!$this->image) {
            throw new Exception("Failed to load image");
        }
    }

    public function resize($width = null, $height = null) {
        if ($width === null && $height === null) {
            return;
        }

        if ($width === null) {
            $ratio = $this->originalWidth / $this->originalHeight;
            $width = $height * $ratio;
        } elseif ($height === null) {
            $ratio = $this->originalHeight / $this->originalWidth;
            $height = $width * $ratio;
        }

        $newImage = imagecreatetruecolor($width, $height);

        if ($this->mimeType === 'image/png' || $this->mimeType === 'image/webp') {
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
            $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
            imagefilledrectangle($newImage, 0, 0, $width, $height, $transparent);
        }

        imagecopyresampled(
            $newImage, $this->image,
            0, 0, 0, 0,
            $width, $height,
            $this->originalWidth, $this->originalHeight
        );

        imagedestroy($this->image);
        $this->image = $newImage;
        $this->originalWidth = $width;
        $this->originalHeight = $height;
    }

    public function output($format) {
        switch (strtolower($format)) {
            case 'jpg':
            case 'jpeg':
                header('Content-Type: image/jpeg');
                imagejpeg($this->image, null, 90);
                break;
            case 'png':
                header('Content-Type: image/png');
                imagepng($this->image, null, 9);
                break;
            case 'webp':
                header('Content-Type: image/webp');
                imagewebp($this->image, null, 90);
                break;
            default:
                throw new Exception("Unsupported output format");
        }

        imagedestroy($this->image);
    }

    public function __destruct() {
        if (is_resource($this->image)) {
            imagedestroy($this->image);
        }
    }
}
