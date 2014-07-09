<?php

$baseNames = array();
$bnFh = fopen('villages.csv', 'r');
fgetcsv($bnFh, 2048);
while ($line = fgetcsv($bnFh, 2048)) {
    if (!isset($baseNames[$line[4]])) {
        $baseNames[$line[4]] = array();
    }
    if (!isset($baseNames[$line[4]][$line[3]])) {
        $baseNames[$line[4]][$line[3]] = array();
    }
    $baseNames[$line[4]][$line[3]][$line[2]] = $line[1];
}

$resultFh = false;

foreach (glob('10304_age_cityname/*.csv') AS $csvFile) {
    $fh = fopen($csvFile, 'r');
    $fieldNames = array();
    $fieldNamesDone = false;
    while ($line = fgetcsv($fh, 2048)) {
        if (false === $fieldNamesDone && false === $resultFh) {
            $fieldNames = array_merge($fieldNames, $line);
            if (count($fieldNames) === 211) {
                foreach ($fieldNames AS $k => $v) {
                    $v = trim($v);
                    if (empty($v)) {
                        unset($fieldNames[$k]);
                    } else {
                        $fieldNames[$k] = str_replace(array(
                            '歲-男', '歲-女', '歲以上-男', '歲以上-女', pack('H*', 'EFBBBF'), //BOM characters
                                ), array(
                            'M', 'F', 'upM', 'upF', '',
                                ), $v);
                    }
                }
                $fieldNames[] = '';
                $resultFh = fopen('10304_age.csv', 'w');
                fputcsv($resultFh, $fieldNames);
                $fieldNamesDone = true;
            }
            continue;
        } else {
            /*
             * 
             * to import into db
             * 
              unset($line[209]);
              $sql = 'INSERT INTO cunli VALUES (NULL, \'';
              $sql .= implode("', '", $line);
              $sql .= "');\n";
              $q->query($sql);
             * 
             */
            /*
             *     [0] => 統計年月
              [1] => 區域別
              [2] => 村里
              [3] => 戶數
              [4] => 人口數
              [5] => 人口數-男
              [6] => 人口數-女
             */
            $line[1] = str_replace(' ', '', $line[1]);
            $county = mb_substr($line[1], 0, 3, 'utf-8');
            $town = mb_substr($line[1], 3, null, 'utf-8');
            switch ($town) {
                case '三民一':
                case '三民二':
                    $town = '三民區';
                    break;
                case '鳳山一':
                case '鳳山二':
                    $town = '鳳山區';
                    break;
            }
            switch ($line[1] . $line[2]) {
                case '桃園縣蘆竹市上竹村':
                case '桃園縣蘆竹市上興村':
                case '桃園縣蘆竹市中山村':
                case '桃園縣蘆竹市中福村':
                case '桃園縣蘆竹市中興村':
                case '桃園縣蘆竹市五福村':
                case '桃園縣蘆竹市內厝村':
                case '桃園縣蘆竹市南崁村':
                case '桃園縣蘆竹市南榮村':
                case '桃園縣蘆竹市南興村':
                case '桃園縣蘆竹市吉祥村':
                case '桃園縣蘆竹市坑口村':
                case '桃園縣蘆竹市坑子村':
                case '桃園縣蘆竹市外社村':
                case '桃園縣蘆竹市大竹村':
                case '桃園縣蘆竹市宏竹村':
                case '桃園縣蘆竹市富竹村':
                case '桃園縣蘆竹市山腳村':
                case '桃園縣蘆竹市山鼻村':
                case '桃園縣蘆竹市新興村':
                case '桃園縣蘆竹市新莊村':
                case '桃園縣蘆竹市海湖村':
                case '桃園縣蘆竹市營盤村':
                case '桃園縣蘆竹市營福村':
                case '桃園縣蘆竹市瓦窯村':
                case '桃園縣蘆竹市福昌村':
                case '桃園縣蘆竹市福祿村':
                case '桃園縣蘆竹市福興村':
                case '桃園縣蘆竹市羊稠村':
                case '桃園縣蘆竹市興榮村':
                case '桃園縣蘆竹市蘆竹村':
                case '桃園縣蘆竹市蘆興村':
                case '桃園縣蘆竹市錦中村':
                case '桃園縣蘆竹市錦興村':
                case '桃園縣蘆竹市長壽村':
                case '桃園縣蘆竹市長興村':
                case '桃園縣蘆竹市順興村':
                    $line[2] = str_replace('村', '里', $line[2]);
                    break;
                case '彰化縣彰化市下廍里':
                    $line[2] = '下廍里';
                    break;
                case '彰化縣彰化市南瑶里':
                    $line[2] = '南詋里';
                    break;
                case '彰化縣彰化市寶廍里':
                    $line[2] = '寶廍里';
                    break;
                case '彰化縣彰化市磚󿾨里':
                    $line[2] = '磚磘里';
                    break;
                case '彰化縣埔鹽鄉瓦󿾨村':
                    $line[2] = '瓦磘村';
                    break;
                case '彰化縣埔心鄉南舘村':
                    $line[2] = '南館村';
                    break;
                case '彰化縣埔心鄉埤脚村':
                    $line[2] = '埤肑村';
                    break;
                case '彰化縣埔心鄉新舘村':
                    $line[2] = '新館村';
                    break;
                case '彰化縣埔心鄉舊舘村':
                    $line[2] = '舊館村';
                    break;
                case '彰化縣二水鄉上豊村':
                    $line[2] = '上豐村';
                    break;
                case '南投縣竹山鎮硘󿾨里':
                    $line[2] = '硘磘里';
                    break;
                case '雲林縣麥寮鄉瓦󿾨村': //missing 雲林縣麥寮鄉中興村
                    $line[2] = '瓦磘村';
                    break;
                case '雲林縣元長鄉瓦󿾨村':
                    $line[2] = '瓦磘村';
                    break;
                case '雲林縣四湖鄉󿿀子村':
                    $line[2] = '箔子村';
                    break;
                case '雲林縣四湖鄉󿿀東村':
                    $line[2] = '箔東村';
                    break;
                case '嘉義縣中埔鄉塩舘村':
                    $line[2] = '雙館村';
                    break;
                case '嘉義縣中埔鄉石硦村':
                    $line[2] = '石哢村';
                    break;
                case '嘉義縣竹崎鄉文峯村':
                    $line[2] = '文号村';
                    break;
                case '屏東縣新園鄉瓦󿾨村':
                    $line[2] = '瓦磘村';
                    break;
                case '澎湖縣馬公市󼱹裡里':
                    $line[2] = '嵵裡里';
                    break;
                case '嘉義市西區磚󿾨里':
                    $line[2] = '磚磘里';
                    break;
//                case '高雄市左營區復興里': //??
//                    $cunliKey = '64000030-014';
//                    break;
                case '新北市中和區瓦󿾨里': // missing 新北市中和區灰磘里
                    $line[2] = '瓦磘里';
                    break;
                case '新北市樹林區󿾵寮里':
                    $line[2] = '獇寮里';
                    break;
                case '臺中市大安區龜売里':
                    $line[2] = '龜壳里';
                    break;
                case '臺南市安南區公󻕯里':
                    $line[2] = '公塭里';
                    break;
                case '臺南市安南區󻕯南里':
                    $line[2] = '塭南里';
                    break;
            }
            if (isset($baseNames[$county][$town][$line[2]])) {
                $cunliKey = $baseNames[$county][$town][$line[2]];
                unset($baseNames[$county][$town][$line[2]]);
                $line[1] = $cunliKey;
                $line[2] = "{$county}{$town}{$line[2]}";
                fputcsv($resultFh, $line);
                if(empty($baseNames[$county][$town])) {
                    unset($baseNames[$county][$town]);
                }
                if(empty($baseNames[$county])) {
                    unset($baseNames[$county]);
                }
            }
        }
    }
    fclose($fh);
}
fclose($resultFh);

foreach($baseNames AS $county => $d1) {
    foreach($d1 AS $town => $d2) {
        foreach($d2 AS $cunli => $id) {
            echo "[{$id}]{$county}{$town}{$cunli}\n";
        }
    }
}