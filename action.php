<?php

header('Content-type: application/json');
include ('include/db.php');
$diadinasaur = isset($_POST['dinasaur']) ? $_POST['dinasaur'] : ' ';
$current = isset($_POST['current']) ? $_POST['current'] : ' ';
$desired = isset($_POST['desired']) ? $_POST['desired'] : ' ';
$dinasaur_name = isset($_POST['dinasaur_name']) ? $_POST['dinasaur_name'] : ' ';

/**
 * Dinasaur image
 */
$img_query = "SELECT `icon`,`Name`,`Rarity`  FROM `xref-Dino_info` WHERE `Name` ='" . $dinasaur_name . "' AND  `Rarity` ='" . $diadinasaur . "' ";
$img_result = mysqli_query($con, $img_query);
foreach ($img_result as $img) {
    $img = $img['icon'];
}

/**
 * Dinasaur dna level search 
 */
$query = " SELECT * FROM Dino_Lvl_DNA_Coin_Stats WHERE `Dino_Level` IN (' " . $current . "','" . $desired . " ') AND `Dino_Rarity` LIKE '$diadinasaur'";
$result = mysqli_query($con, $query);
$arr = [];
foreach ($result as $data) {
    $cumulative_dna = $data['Cumulative_DNA'];
    $cumulative_cost = $data['Cumulative_Coins_Cost'];
    $cumulative_exp = $data['Cumulative_Exp'];
    $dino_level = $data['Dino_Level'];
    if ($dino_level == $current) {
        $arr['current_dna'] = $cumulative_dna;
        $arr['current_cumulative_cost'] = $cumulative_cost;
        $arr['current_cumulative_exp'] = $cumulative_exp;
    }
    if ($dino_level == $desired) {
        $arr['desired_dna'] = $cumulative_dna;
        $arr['desired_cumulative_cost'] = $cumulative_cost;
        $arr['desired_cumulative_exp'] = $cumulative_exp;
    }
}
if ($arr['desired_dna'] != '' && $arr['current_dna'] != '') {
    $dna_required = $arr['desired_dna'] - $arr['current_dna'];
}
if ($arr['desired_cumulative_cost'] != '' && $arr['current_cumulative_cost'] != '') {
    $coin_required = $arr['desired_cumulative_cost'] - $arr['current_cumulative_cost'];
}
if ($arr['desired_cumulative_exp'] != '' && $arr['current_cumulative_exp'] != '') {
    $exp_point = $arr['desired_cumulative_exp'] - $arr['current_cumulative_exp'];
}

$jsonstring = json_encode(
        [
            'img' => $img,
            'current_dna' => isset($arr['current_dna']) ? $arr['current_dna'] : '0',
            'required_dna' => isset($dna_required) ? $dna_required : '0',
            'coins_spent' => isset($arr['current_cumulative_cost']) ? $arr['current_cumulative_cost'] : '0',
            'coins_required' => isset($coin_required) ? $coin_required : '0',
            'exp_point' => isset($exp_point) ? $exp_point : '0'
        ]
);
echo $jsonstring;
?>