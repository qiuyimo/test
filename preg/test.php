<?php

$link = 'https://www.bestbuy.com/site/samsung-50-class-49-5-diag--led-2160p-smart-4k-ultra-hd-tv/6029002.p?skuId=6029002';

preg_match('/\/([0-9]{6,})\.p/', $link, $match);
var_dump($match);