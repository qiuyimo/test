<?php

require dirname(__FILE__)."/../vendor/autoload.php";

$Parsedown = new Parsedown();

echo($Parsedown->text('Hello _Parsedown_!'));
// you can also parse inline markdown only
echo($Parsedown->line('Hello _Parsedown_!'));

// 解析 markdown 为html.
$md = file_get_contents(__DIR__ . '/demo.md');
$html = $Parsedown->parse($md);

$htmlTemplate = file_get_contents(__DIR__ . '/demo.html');

echo str_replace(['{{$html}}'], [$html], $htmlTemplate);
