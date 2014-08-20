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

$allTopo = json_decode(file_get_contents('json/103_05_01_4326.topo.json'), true);
$allGeo = json_decode(file_get_contents('json/103_05_01_4326.geo.json'), true);
$blank = $allTopo;
$blank['objects']['layer1']['geometries'] = array();
$stack = array();
$listInfo = array(
    'counties' => array(),
    'towns' => array(),
    'county2towns' => array(),
    'town2county' => array(),
);
foreach ($allTopo['objects']['layer1']['geometries'] AS $k => $v) {
    if (isset($fixStack[$v['properties']['V_ID']])) {
        $v['properties']['VILLAGE'] = $fixStack[$v['properties']['V_ID']];
        $v['properties']['TV_ALL'] = $v['properties']['TOWN'] . $fixStack[$v['properties']['V_ID']];
    }



    if (isset($allGeo['features'][$k]['geometry']['coordinates'])) {
        $v['properties']['MAX_X'] = 0.00000000001;
        $v['properties']['MAX_Y'] = 0.00000000001;
        $v['properties']['MIN_X'] = 360.00000000001;
        $v['properties']['MIN_Y'] = 360.00000000001;
        foreach ($allGeo['features'][$k]['geometry']['coordinates'] AS $polygon) {
            foreach ($polygon AS $point) {
                if ($point[0] > $v['properties']['MAX_X']) {
                    $v['properties']['MAX_X'] = $point[0];
                }
                if ($point[1] > $v['properties']['MAX_Y']) {
                    $v['properties']['MAX_Y'] = $point[1];
                }
                if ($point[0] < $v['properties']['MIN_X']) {
                    $v['properties']['MIN_X'] = $point[0];
                }
                if ($point[1] < $v['properties']['MIN_Y']) {
                    $v['properties']['MIN_Y'] = $point[1];
                }
            }
        }

        (float)$v['properties']['X'] = ((float)$v['properties']['MAX_X'] + (float)$v['properties']['MIN_X']) / 2;
        (float)$v['properties']['Y'] = ((float)$v['properties']['MAX_Y'] + (float)$v['properties']['MIN_Y']) / 2;
    }

    if (empty($v['properties']['COUNTY_ID']) || empty($v['properties']['TOWN_ID'])) {
        continue;
    }

    if (!isset($stack[$v['properties']['COUNTY_ID']])) {
        $stack[$v['properties']['COUNTY_ID']] = array();
        $listInfo['counties'][$v['properties']['COUNTY_ID']] = $v['properties']['COUNTY'];
    }
    if (!isset($stack[$v['properties']['COUNTY_ID']][$v['properties']['TOWN_ID']])) {
        $stack[$v['properties']['COUNTY_ID']][$v['properties']['TOWN_ID']] = array();
        $listInfo['towns'][$v['properties']['TOWN_ID']] = $v['properties']['TOWN'];
        if (!isset($listInfo['county2towns'][$v['properties']['COUNTY_ID']])) {
            $listInfo['county2towns'][$v['properties']['COUNTY_ID']] = array();
        }
        $listInfo['county2towns'][$v['properties']['COUNTY_ID']][] = $v['properties']['TOWN_ID'];
        $listInfo['town2county'][$v['properties']['TOWN_ID']] = $v['properties']['COUNTY_ID'];
    }
    $stack[$v['properties']['COUNTY_ID']][$v['properties']['TOWN_ID']][] = $v;
}

file_put_contents("json/list.json", json_encode($listInfo));

foreach ($stack AS $countyId => $towns) {
    foreach ($towns AS $townId => $town) {
        $new = $blank;
        $new['objects']['layer1']['geometries'] = $town;
        file_put_contents("json/{$countyId}_{$townId}.json", json_encode($new));
    }
}