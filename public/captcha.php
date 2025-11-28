<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$code = substr(str_shuffle('ABCDEFGHJKMNPQRSTUVWXYZ23456789'), 0, 5);
$_SESSION['captcha_code'] = $code;

$width  = 120;
$height = 40;
$image  = imagecreatetruecolor($width, $height);

$bgColor   = imagecolorallocate($image, 240, 240, 240);
$textColor = imagecolorallocate($image, 50, 50, 50);

imagefilledrectangle($image, 0, 0, $width, $height, $bgColor);
imagestring($image, 5, 18, 10, $code, $textColor);

header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
