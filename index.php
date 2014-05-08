<?php
/*
 * villmast_excel.csv - http://cand.moi.gov.tw/of/home.jsp?mserno=201011010008&serno=201011010008&menudata=OfMenu&contlink=ap\/villmast_list.jsp&level3=N
 * http://data.gov.tw/node/7440
 * ronnywang> shp 只負責地理輪廓資訊
 * ronnywang> dbf 則是每一個地理區塊的值，以村里疆界資料來說就會包括縣市名、村里名、村里代號、面積等資運
 * twVillage1982.topo.json - https://github.com/g0v/twgeojson
 * tw-fix.topo.json - https://gist.github.com/clkao/5468139
 */
$all = json_decode(file_get_contents('102_05_21_3826.json'), true);
$blank = $all;
$blank['objects']['layer1']['geometries'] = array();
$stack = array();
foreach($all['objects']['layer1']['geometries'] AS $k => $v) {
    if(!isset($stack[$v['properties']['COUNTY']])) {
        $stack[$v['properties']['COUNTY']] = array();
    }
    $stack[$v['properties']['COUNTY']][] = $v;
}

foreach($stack AS $k => $county) {
    $new = $blank;
    $count = count($county);
    $new['objects']['layer1']['geometries'] = $county;
    file_put_contents("json/{$k}_{$count}.json", json_encode($new));
}