<?php

/*
 * to import into db
 * 
 * CREATE TABLE IF NOT EXISTS `cunli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `統計年月` varchar(10) DEFAULT NULL,
  `區域別` varchar(10) DEFAULT NULL,
  `村里` varchar(10) DEFAULT NULL,
  `戶數` int(10) DEFAULT '0',  `人口數` int(10) DEFAULT '0',  `人口數-男` int(10) DEFAULT '0',  `人口數-女` int(10) DEFAULT '0',  `0M` int(10) DEFAULT '0',  `0F` int(10) DEFAULT '0',  `1M` int(10) DEFAULT '0',  `1F` int(10) DEFAULT '0',  `2M` int(10) DEFAULT '0',  `2F` int(10) DEFAULT '0',  `3M` int(10) DEFAULT '0',  `3F` int(10) DEFAULT '0',  `4M` int(10) DEFAULT '0',  `4F` int(10) DEFAULT '0',  `5M` int(10) DEFAULT '0',  `5F` int(10) DEFAULT '0',  `6M` int(10) DEFAULT '0',  `6F` int(10) DEFAULT '0',  `7M` int(10) DEFAULT '0',  `7F` int(10) DEFAULT '0',  `8M` int(10) DEFAULT '0',  `8F` int(10) DEFAULT '0',  `9M` int(10) DEFAULT '0',  `9F` int(10) DEFAULT '0',  `10M` int(10) DEFAULT '0',  `10F` int(10) DEFAULT '0',  `11M` int(10) DEFAULT '0',  `11F` int(10) DEFAULT '0',  `12M` int(10) DEFAULT '0',  `12F` int(10) DEFAULT '0',  `13M` int(10) DEFAULT '0',  `13F` int(10) DEFAULT '0',  `14M` int(10) DEFAULT '0',  `14F` int(10) DEFAULT '0',  `15M` int(10) DEFAULT '0',  `15F` int(10) DEFAULT '0',  `16M` int(10) DEFAULT '0',  `16F` int(10) DEFAULT '0',  `17M` int(10) DEFAULT '0',  `17F` int(10) DEFAULT '0',  `18M` int(10) DEFAULT '0',  `18F` int(10) DEFAULT '0',  `19M` int(10) DEFAULT '0',  `19F` int(10) DEFAULT '0',  `20M` int(10) DEFAULT '0',  `20F` int(10) DEFAULT '0',  `21M` int(10) DEFAULT '0',  `21F` int(10) DEFAULT '0',  `22M` int(10) DEFAULT '0',  `22F` int(10) DEFAULT '0',  `23M` int(10) DEFAULT '0',  `23F` int(10) DEFAULT '0',  `24M` int(10) DEFAULT '0',  `24F` int(10) DEFAULT '0',  `25M` int(10) DEFAULT '0',  `25F` int(10) DEFAULT '0',  `26M` int(10) DEFAULT '0',  `26F` int(10) DEFAULT '0',  `27M` int(10) DEFAULT '0',  `27F` int(10) DEFAULT '0',  `28M` int(10) DEFAULT '0',  `28F` int(10) DEFAULT '0',  `29M` int(10) DEFAULT '0',  `29F` int(10) DEFAULT '0',  `30M` int(10) DEFAULT '0',  `30F` int(10) DEFAULT '0',  `31M` int(10) DEFAULT '0',  `31F` int(10) DEFAULT '0',  `32M` int(10) DEFAULT '0',  `32F` int(10) DEFAULT '0',  `33M` int(10) DEFAULT '0',  `33F` int(10) DEFAULT '0',  `34M` int(10) DEFAULT '0',  `34F` int(10) DEFAULT '0',  `35M` int(10) DEFAULT '0',  `35F` int(10) DEFAULT '0',  `36M` int(10) DEFAULT '0',  `36F` int(10) DEFAULT '0',  `37M` int(10) DEFAULT '0',  `37F` int(10) DEFAULT '0',  `38M` int(10) DEFAULT '0',  `38F` int(10) DEFAULT '0',  `39M` int(10) DEFAULT '0',  `39F` int(10) DEFAULT '0',  `40M` int(10) DEFAULT '0',  `40F` int(10) DEFAULT '0',  `41M` int(10) DEFAULT '0',  `41F` int(10) DEFAULT '0',  `42M` int(10) DEFAULT '0',  `42F` int(10) DEFAULT '0',  `43M` int(10) DEFAULT '0',  `43F` int(10) DEFAULT '0',  `44M` int(10) DEFAULT '0',  `44F` int(10) DEFAULT '0',  `45M` int(10) DEFAULT '0',  `45F` int(10) DEFAULT '0',  `46M` int(10) DEFAULT '0',  `46F` int(10) DEFAULT '0',  `47M` int(10) DEFAULT '0',  `47F` int(10) DEFAULT '0',  `48M` int(10) DEFAULT '0',  `48F` int(10) DEFAULT '0',  `49M` int(10) DEFAULT '0',  `49F` int(10) DEFAULT '0',  `50M` int(10) DEFAULT '0',  `50F` int(10) DEFAULT '0',  `51M` int(10) DEFAULT '0',  `51F` int(10) DEFAULT '0',  `52M` int(10) DEFAULT '0',  `52F` int(10) DEFAULT '0',  `53M` int(10) DEFAULT '0',  `53F` int(10) DEFAULT '0',  `54M` int(10) DEFAULT '0',  `54F` int(10) DEFAULT '0',  `55M` int(10) DEFAULT '0',  `55F` int(10) DEFAULT '0',  `56M` int(10) DEFAULT '0',  `56F` int(10) DEFAULT '0',  `57M` int(10) DEFAULT '0',  `57F` int(10) DEFAULT '0',  `58M` int(10) DEFAULT '0',  `58F` int(10) DEFAULT '0',  `59M` int(10) DEFAULT '0',  `59F` int(10) DEFAULT '0',  `60M` int(10) DEFAULT '0',  `60F` int(10) DEFAULT '0',  `61M` int(10) DEFAULT '0',  `61F` int(10) DEFAULT '0',  `62M` int(10) DEFAULT '0',  `62F` int(10) DEFAULT '0',  `63M` int(10) DEFAULT '0',  `63F` int(10) DEFAULT '0',  `64M` int(10) DEFAULT '0',  `64F` int(10) DEFAULT '0',  `65M` int(10) DEFAULT '0',  `65F` int(10) DEFAULT '0',  `66M` int(10) DEFAULT '0',  `66F` int(10) DEFAULT '0',  `67M` int(10) DEFAULT '0',  `67F` int(10) DEFAULT '0',  `68M` int(10) DEFAULT '0',  `68F` int(10) DEFAULT '0',  `69M` int(10) DEFAULT '0',  `69F` int(10) DEFAULT '0',  `70M` int(10) DEFAULT '0',  `70F` int(10) DEFAULT '0',  `71M` int(10) DEFAULT '0',  `71F` int(10) DEFAULT '0',  `72M` int(10) DEFAULT '0',  `72F` int(10) DEFAULT '0',  `73M` int(10) DEFAULT '0',  `73F` int(10) DEFAULT '0',  `74M` int(10) DEFAULT '0',  `74F` int(10) DEFAULT '0',  `75M` int(10) DEFAULT '0',  `75F` int(10) DEFAULT '0',  `76M` int(10) DEFAULT '0',  `76F` int(10) DEFAULT '0',  `77M` int(10) DEFAULT '0',  `77F` int(10) DEFAULT '0',  `78M` int(10) DEFAULT '0',  `78F` int(10) DEFAULT '0',  `79M` int(10) DEFAULT '0',  `79F` int(10) DEFAULT '0',  `80M` int(10) DEFAULT '0',  `80F` int(10) DEFAULT '0',  `81M` int(10) DEFAULT '0',  `81F` int(10) DEFAULT '0',  `82M` int(10) DEFAULT '0',  `82F` int(10) DEFAULT '0',  `83M` int(10) DEFAULT '0',  `83F` int(10) DEFAULT '0',  `84M` int(10) DEFAULT '0',  `84F` int(10) DEFAULT '0',  `85M` int(10) DEFAULT '0',  `85F` int(10) DEFAULT '0',  `86M` int(10) DEFAULT '0',  `86F` int(10) DEFAULT '0',  `87M` int(10) DEFAULT '0',  `87F` int(10) DEFAULT '0',  `88M` int(10) DEFAULT '0',  `88F` int(10) DEFAULT '0',  `89M` int(10) DEFAULT '0',  `89F` int(10) DEFAULT '0',  `90M` int(10) DEFAULT '0',  `90F` int(10) DEFAULT '0',  `91M` int(10) DEFAULT '0',  `91F` int(10) DEFAULT '0',  `92M` int(10) DEFAULT '0',  `92F` int(10) DEFAULT '0',  `93M` int(10) DEFAULT '0',  `93F` int(10) DEFAULT '0',  `94M` int(10) DEFAULT '0',  `94F` int(10) DEFAULT '0',  `95M` int(10) DEFAULT '0',  `95F` int(10) DEFAULT '0',  `96M` int(10) DEFAULT '0',  `96F` int(10) DEFAULT '0',  `97M` int(10) DEFAULT '0',  `97F` int(10) DEFAULT '0',  `98M` int(10) DEFAULT '0',  `98F` int(10) DEFAULT '0',  `99M` int(10) DEFAULT '0',  `99F` int(10) DEFAULT '0',  `100upM` int(10) DEFAULT '0',  `100upF` int(10) DEFAULT '0',  PRIMARY KEY (`id`)
  );
 * 
 * $q = new mysqli('localhost', 'root', '--', 'kiang_cunli');
 * 
 */

$areas = array();
foreach (glob('10304_age_cityname/*.csv') AS $csvFile) {
    $fh = fopen($csvFile, 'r');
    $fieldNames = array();
    $fieldNamesDone = false;
    while ($line = fgetcsv($fh, 2048)) {
        if (false === $fieldNamesDone) {
            $fieldNames = array_merge($fieldNames, $line);
            if (count($fieldNames) === 211) {
                foreach ($fieldNames AS $k => $v) {
                    $v = trim($v);
                    if (empty($v)) {
                        unset($fieldNames[$k]);
                    } else {
                        $fieldNames[$k] = str_replace(array(
                            '歲-男', '歲-女', '歲以上-男', '歲以上-女', pack('H*', 'EFBBBF'),
                                ), array(
                            'M', 'F', 'upM', 'upF', '',
                                ), $v);
                    }
                }
                $fieldNames[] = '';
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
            if (!isset($areas[$line[1]])) {
                $areas[$line[1]] = array();
            }
            $areas[$line[1]][$line[2]] = true;
        }
    }
    fclose($fh);
}
//print_r($areas);
$diff1 = array();
$diff2 = $areas;
$newStack = array(
    '高雄市三民區' => array(),
    '高雄市鳳山區' => array(),
);
$list = json_decode(file_get_contents('json/list.json'), true);
foreach ($list['county2towns'] AS $countyId => $towns) {
    foreach ($towns AS $townId) {
        $listArea = $list['counties'][$countyId] . $list['towns'][$townId];
        $listArea = str_replace(array('臺中市龍井區(海)', '桃園縣蘆竹鄉'), array('臺中市龍井區', '桃園縣蘆竹市'), $listArea);
        /*
         * to find differences in areas
         * 
          if(!isset($areas[$listArea])) {
          echo "{$listArea}\n";
          } else {
          unset($areas[$listArea]);
          }
         * 
         */
        $townJson = json_decode(file_get_contents("json/{$countyId}_{$townId}.json"), true);

        foreach ($townJson['objects']['layer1']['geometries'] AS $geometry) {
            if (!isset($diff2[$listArea][$geometry['properties']['VILLAGE']])) {
                $diff1[$listArea . $geometry['properties']['VILLAGE']] = true;
            } else {
                unset($diff2[$listArea][$geometry['properties']['VILLAGE']]);
                if(empty($diff2[$listArea])) {
                    unset($diff2[$listArea]);
                }
            }
            switch ($listArea) {
                case '高雄市三民區':
                    $newStack['高雄市三民區'][] = $geometry['properties']['VILLAGE'];
                    break;
                case '高雄市鳳山區':
                    $newStack['高雄市鳳山區'][] = $geometry['properties']['VILLAGE'];
                    break;
            }
        }
    }
}
$towns = array('高雄市三民一', '高雄市三民二', '高雄市鳳山一', '高雄市鳳山二');
foreach($towns AS $town) {
    foreach($diff2[$town] AS $k => $v) {
        $townK = str_replace(array('一', '二'), array('區', '區'), $town);
        if(isset($diff1[$townK.$k])) {
            unset($diff1[$townK.$k]);
            unset($diff2[$town][$k]);
        }
    }
}
print_r($diff1);
print_r($diff2);
