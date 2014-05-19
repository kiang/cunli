<?php
/*
 * villmast_excel.csv - http://cand.moi.gov.tw/of/home.jsp?mserno=201011010008&serno=201011010008&menudata=OfMenu&contlink=ap\/villmast_list.jsp&level3=N
 * http://data.gov.tw/node/7440
 * ronnywang> shp 只負責地理輪廓資訊
 * ronnywang> dbf 則是每一個地理區塊的值，以村里疆界資料來說就會包括縣市名、村里名、村里代號、面積等資運
 * twVillage1982.topo.json - https://github.com/g0v/twgeojson
 * tw-fix.topo.json - https://gist.github.com/clkao/5468139
 */

// to apply the fixes from https://gist.github.com/clkao/5468139
$fixes = explode("\n", file_get_contents('fix_102_05_21.txt'));
$fixStack = array();
foreach ($fixes AS $fix) {
    $items = explode(' ', $fix);
    $fixStack[$items[1]] = $items[4];
}

$all = json_decode(file_get_contents('json/102_05_21_4326.topo.json'), true);
$blank = $all;
$blank['objects']['layer1']['geometries'] = array();
$stack = array();
$listInfo = array(
    'counties' => array(),
    'towns' => array(),
    'county2towns' => array(),
    'town2county' => array(),
);
foreach($all['objects']['layer1']['geometries'] AS $k => $v) {
    if(isset($fixStack[$v['properties']['V_ID']])) {
        $v['properties']['VILLAGE'] = $fixStack[$v['properties']['V_ID']];
        $v['properties']['TV_ALL'] = $v['properties']['TOWN'] . $fixStack[$v['properties']['V_ID']];
    }
    
    if(empty($v['properties']['COUNTY_ID']) || empty($v['properties']['TOWN_ID'])) {
        continue;
    }
    
    if(!isset($stack[$v['properties']['COUNTY_ID']])) {
        $stack[$v['properties']['COUNTY_ID']] = array();
        $listInfo['counties'][$v['properties']['COUNTY_ID']] = $v['properties']['COUNTY'];
    }
    if(!isset($stack[$v['properties']['COUNTY_ID']][$v['properties']['TOWN_ID']])) {
        $stack[$v['properties']['COUNTY_ID']][$v['properties']['TOWN_ID']] = array();
        $listInfo['towns'][$v['properties']['TOWN_ID']] = $v['properties']['TOWN'];
        if(!isset($listInfo['county2towns'][$v['properties']['COUNTY_ID']])) {
            $listInfo['county2towns'][$v['properties']['COUNTY_ID']] = array();
        }
        $listInfo['county2towns'][$v['properties']['COUNTY_ID']][] = $v['properties']['TOWN_ID'];
        $listInfo['town2county'][$v['properties']['TOWN_ID']] = $v['properties']['COUNTY_ID'];
    }
    $stack[$v['properties']['COUNTY_ID']][$v['properties']['TOWN_ID']][] = $v;
}

file_put_contents("json/list.json", json_encode($listInfo));

foreach($stack AS $countyId => $towns) {
    foreach($towns AS $townId => $town) {
        $new = $blank;
        $new['objects']['layer1']['geometries'] = $town;
        file_put_contents("json/{$countyId}_{$townId}.json", json_encode($new));
    }
}