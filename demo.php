<?php

/**
* Created by PhpStorm.
* User: 抠脚强
* Date: 2017/11/16
* Time: 3:13
* My Blog : https://imlyq.top
*
* phpqrcode.php提供了一个关键的png()方法，
* @param $text  生成二位的的信息文本；
* @param $outfile  是否输出二维码图片 文件，默认否；
* @param $level  容错率，也就是有被覆盖的区域还能识别，分别是 L（QR_ECLEVEL_L，7%），                               *  M（QR_ECLEVEL_M， 15%），Q（QR_ECLEVEL_Q，25%），H（QR_ECLEVEL_H，30%）；
* @param $size  生成图片大小，默认是3；
* @param $margin  二维码周围边框空白区域间距值；
* @param $saveandprint  是否保存二维码并 显示。
*/

//本地文档相对路径
$url = 'images/';

//引入php QR库文件
include_once('phpqrcode/phpqrcode.php');

$value = 'yeyangyang';
$errorCorrentionLevel = 'L'; //容错级别
$matrixPoinSize = 6; //生成图片大小

//生成二维码,第二个参数为二维码保存路径
QRcode::png($value,$url.'qrcode.png',$errorCorrentionLevel,$matrixPoinSize,2);
//以上生成了二维码


//如不加logo，下面logo code 注释掉，输出$url.qrcode.png即可。
$logo =$url.'logo.png'; //logo
$QR = $url.'qrcode.png'; //已经生成的二维码
    
if($logo !== FALSE){
$QR = imagecreatefromstring(file_get_contents($QR));
$logo = imagecreatefromstring(file_get_contents($logo));
$QR_width = imagesx($QR);//二维码图片宽度
$QR_height = imagesy($QR);//二维码图片高度
$logo_width = imagesx($logo);//logo图片宽度
$logo_height = imagesy($logo);//logo图片高度
$logo_qr_width = $QR_width / 5;
$scale = $logo_width/$logo_qr_width;
$logo_qr_height = $logo_height/$scale;
$from_width = ($QR_width - $logo_qr_width) / 2;
//重新组合图片并调整大小
imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,
$logo_qr_height, $logo_width, $logo_height);
}

//新图片
$img = $url.'helloweba.png';
//输出图片
imagepng($QR, $img);
echo "<img src=$img />";

?>
