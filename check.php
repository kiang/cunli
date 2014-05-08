<?php

$fixes = explode("\n", file_get_contents('fix_102_05_21_3826.txt'));
$fixStack = array();
foreach ($fixes AS $fix) {
    $items = explode(' ', $fix);
    $fixStack[$items[1]] = $items[4];
}

$villmastStack = array();
$fh = fopen('villmast_excel.csv', 'r');
fgetcsv($fh, 1024); //title
fgetcsv($fh, 1024); //column name
/*
 * Array
(
    [0] => 選舉年
    [1] => 市縣別
    [2] => 鄉鎮市
    [3] => 村里別
    [4] => 姓     名
    [5] => 職稱
    [6] => 性別
    [7] => 黨籍
    [8] => 村里辦公處(服務處)地址
    [9] => 辦公電話
    [10] => 電子信箱
    [11] => 學   歷
    [12] => 簡    歷
    [13] => 所轄鄰數
    [14] => 布落格
    [15] => 連結網頁
)
 */
while($line = fgetcsv($fh, 1024)) {
    if(!isset($villmastStack[$line[1]])) {
        $villmastStack[$line[1]] = array();
    }
    if(!isset($villmastStack[$line[1]][$line[2]])) {
        $villmastStack[$line[1]][$line[2]] = array();
    }
    if(empty($line[3])) continue;
    $villmastStack[$line[1]][$line[2]][$line[3]] = 'csv';
}
//print_r($villmastStack); exit();
$list = json_decode(file_get_contents('102_05_21_3826.json'), true);
/*
 * Array
(
    [type] => Polygon
    [arcs] => Array
        (
            [0] => Array
                (
                    [0] => 0
                    [1] => 1
                    [2] => 2
                    [3] => 3
                    [4] => 4
                    [5] => 5
                    [6] => 6
                )

        )

    [properties] => Array
        (
            [ID] => 
            [OBJECTID_1] => 1
            [VILLAGE] => 中山里
            [TOWN] => 東區
            [COUNTY] => 嘉義市
            [VILLAGE_ID] => 061
            [TOWN_ID] => 10020010
            [COUNTY_ID] => 10020
            [TV_ALL] => 東區中山里
            [VILLCODE] => A2001-061-00
            [ORI_VILLAG] => 
            [AREA] => 230686.7713
            [MAX_X] => 195185.2188
            [MAX_Y] => 2598108.1036
            [MIN_X] => 194071.1719
            [MIN_Y] => 2597691.75
            [X] => 194698.7905
            [Y] => 2597889.207
            [V_ID] => 10020010-061
            [SORT] => 20
            [COUNTYNAME] => 
            [TOWNNAME] => 
            [OBJECTID] => 0
            [ORIG_FID] => 0
            [Shape_Leng] => 0
            [Shape_Le_1] => 2734.72622959
            [Shape_Area] => 230686.768164
            [ET_ID] => 0
        )

)
 */
foreach($list['objects']['layer1']['geometries'] AS $cunli) {
    if(isset($fixStack[$cunli['properties']['V_ID']])) {
        $cunli['properties']['VILLAGE'] = $fixStack[$cunli['properties']['V_ID']];
        //$cunli['properties']['TV_ALL'] = $cunli['properties']['TOWN'] . $fixStack[$cunli['properties']['V_ID']];
    }
    switch($cunli['properties']['COUNTY']) {
        case '臺北市':
            $cunli['properties']['COUNTY'] = '台北市';
            break;
        case '臺中市':
            $cunli['properties']['COUNTY'] = '台中市';
            break;
        case '臺南市':
            $cunli['properties']['COUNTY'] = '台南市';
            break;
        case '臺東縣':
            $cunli['properties']['COUNTY'] = '台東縣';
            break;
    }
    switch($cunli['properties']['TOWN']) {
        case '臺西鄉':
            $cunli['properties']['TOWN'] = '台西鄉';
            break;
        case '臺東市':
            $cunli['properties']['TOWN'] = '台東市';
            break;
    }
    if(isset($villmastStack[$cunli['properties']['COUNTY']][$cunli['properties']['TOWN']][$cunli['properties']['VILLAGE']])) {
        unset($villmastStack[$cunli['properties']['COUNTY']][$cunli['properties']['TOWN']][$cunli['properties']['VILLAGE']]);
        if(empty($villmastStack[$cunli['properties']['COUNTY']][$cunli['properties']['TOWN']])) {
            unset($villmastStack[$cunli['properties']['COUNTY']][$cunli['properties']['TOWN']]);
        }
        if(empty($villmastStack[$cunli['properties']['COUNTY']])) {
            unset($villmastStack[$cunli['properties']['COUNTY']]);
        }
    } elseif(isset($villmastStack[$cunli['properties']['COUNTY']][$cunli['properties']['TOWN']])) {
        $villmastStack[$cunli['properties']['COUNTY']][$cunli['properties']['TOWN']][$cunli['properties']['VILLAGE']] = 'json:' . $cunli['properties']['V_ID'];
    }
}

print_r($villmastStack);