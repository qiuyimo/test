<?php
/**
 * 测试图片处理包, intervention/image, 一个基于 laravel 的图片处理包
 * User: qiuyu
 * Date: 2018/3/12
 * Time: 上午10:37
 */

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\Constraint;

require dirname(__FILE__)."/../vendor/autoload.php";

// configure with favored image driver (gd by default)
// Image::configure(['driver' => 'imagick']);

// open an image file
$img = Image::make('./tv.jpg');
// $img = Image::make('https://images10.newegg.com/NeweggImage/ProductImageCompressAll300/89-356-331-S02.jpg');

// now you are able to resize the instance
// $img->resize(320, 240);

$height = $img->getHeight();
$width = $img->getWidth();
if ($height >= $width) {
    $img->widen(250, null, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
    });
} else {
    $img->heighten(250, null, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
    });
}

$mime = $img->mime();
dump($mime);

// finally we save the image as a new file
$img->save('./tv_resize.jpg');

// resize image to new height but do not exceed original size
// $mime = $img->mime();
// dump($mime);
// $img = $img->heighten(250, function ($constraint) {
//     $constraint->upsize();
// });

// and insert a watermark for example
// $img->insert('public/watermark.png');


