<?php

define('CACHE_TIME', 3600 * 24 * 30);
define('DEFAULT_THUMB_WIDTH', 150);

function make_thumb($src, $dest, $desired_width)
{

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $src);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // good edit, thanks!
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1); // also, this seems wise considering output is image.
    $data = curl_exec($ch);
    curl_close($ch);

    $source_image = imagecreatefromstring($data);
    /* read the source image */
    $width = imagesx($source_image);
    $height = imagesy($source_image);

    /* find the "desired height" of this thumbnail, relative to the desired width  */
    $desired_height = floor($height * ($desired_width / $width));

    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

    /* copy source image at a resized size */
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

    /* create the physical thumbnail image to its destination */
    imagejpeg($virtual_image, $dest);
}

function not_found()
{
    header("HTTP/1.0 404 Not Found");
    die;
}

$hostname = $_SERVER['SERVER_ADDR'];
$port = $_SERVER['SERVER_PORT'];
$uri = str_replace('/thumbnail.php/', '', $_SERVER['REQUEST_URI']);
$uri_parts = explode('/w=', $uri);

$orgil_img = isset($uri_parts[0]) ? $uri_parts[0] : '';
$desired_width = isset($uri_parts[1]) ? (int) $uri_parts[1] : DEFAULT_THUMB_WIDTH;
//check if file exists
if (!$orgil_img)
{
    not_found();
}
if (strpos($orgil_img, '/') !== 0 && strpos($orgil_img, 'http') !== 0)
{
    $orgil_img = '/' . $orgil_img;
}
if (strpos($orgil_img, '/') === 0 && strpos($orgil_img, 'http') !== 0)
{
    $orgil_img = 'http://' . $hostname . ':' . $port . $orgil_img;
}

$cached_img = __DIR__ . '/cache/thumb/' . md5($uri);
if (!file_exists($cached_img) || filemtime($cached_img) < time() - CACHE_TIME)
{
    if (!getimagesize($orgil_img))
    {
        not_found();
    }
    $dir = dirname($cached_img);
    if (!is_dir($dir))
    {
        mkdir($dir, 0777, true);
    }
    make_thumb($orgil_img, $cached_img, $desired_width);
}
header("Content-Type: image/JPEG");
readfile($cached_img);
