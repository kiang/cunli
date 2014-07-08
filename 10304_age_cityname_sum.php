<?php

$path = __DIR__ . '/cunli';
if (!file_exists($path)) {
    mkdir($path, 0777, true);
}
/*
 * [7] => 0歲-男
 * [47] => 20歲-男
 * [77] => 35歲-男
 * [107] => 50歲-男
 * [147] => 70歲-男
 */
foreach (glob('10304_age_cityname/*.csv') AS $csvFile) {
    $fh = fopen($csvFile, 'r');
    fgetcsv($fh, 2048);
    while ($line = fgetcsv($fh, 2048)) {
        if (count($line) !== 210)
            continue;
        $line[1] = str_replace(' ', '', $line[1]);
        $line[4] = intval($line[4]);
        $ages = array(
            '0-19' => 0,
            '20-34' => 0,
            '35-49' => 0,
            '50-69' => 0,
            '70' => 0,
        );
        $agesP = array();
        foreach ($line AS $k => $v) {
            if ($k > 6 && $k < 47) { // 0 ~ 19
                $ages['0-19'] += intval($v);
            } elseif ($k > 46 && $k < 77) { // 20 ~ 34
                $ages['20-34'] += intval($v);
            } elseif ($k > 76 && $k < 107) { // 35 ~ 49
                $ages['35-49'] += intval($v);
            } elseif ($k > 106 && $k < 147) { // 50 ~ 69
                $ages['50-69'] += intval($v);
            } elseif ($k > 146) { // 70up
                $ages['70'] += intval($v);
            }
        }
        foreach ($ages AS $k => $v) {
            $agesP['p' . $k] = round($ages[$k] / $line[4], 4) * 100;
        }
        if (!file_exists("{$path}/{$line[1]}.csv")) {
            $cfh = fopen("{$path}/{$line[1]}.csv", 'w');
            fputcsv($cfh, array_merge(
                            array('村里'), array_keys($ages), array('總人口'), array_keys($agesP)
            ));
        }
        fputcsv($cfh, array_merge(
                        array($line[2]), $ages, array($line[4]), $agesP
        ));
    }
    fclose($fh);
}