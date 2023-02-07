<?php

header("content-Type: application/json");
require_once 'config.php';

// $con = mysqli_connect("127.0.0.1", "admin", "DigiTex@2022", "db_isa");
//  if ($con) {
//      // echo "DB connected";
// } else {
//     echo "DB connection is failed";
//     exit();
// }


$quer = "SELECT `pack_qte` FROM `p4_pack_operation` WHERE `cur_date` = DATE_FORMAT(CURRENT_DATE, '%d/%m/%Y')
AND `prod_line` LIKE '%ISA203%'
AND `pack_num` NOT IN (SELECT `pack_num` FROM `p4_pack_operation`  
WHERE `p4_pack_operation`.`cur_date` < DATE_FORMAT(CURRENT_DATE, '%d/%m/%Y')
GROUP BY `pack_num` ORDER BY `cur_date`) GROUP BY `pack_num`;";
$rsl= $con->query($quer);

$tabl=[];
while ($items = $rsl->fetch_assoc()){
    $tabl[]=$items;
}

$quer1 = "SELECT DISTINCT pack_num, pack_qte FROM `p4_pack_operation` WHERE prod_line LIKE '%ISA203%';";
$rsl1= $con->query($quer1);

$tabl1=[];
while ($items1 = $rsl1->fetch_assoc()){
    $tabl1[]=$items1;
}

$query = "SELECT DISTINCT pack_num, pack_qte FROM `p4_pack_operation` WHERE prod_line LIKE '%ISA203%' AND cur_date = DATE_FORMAT(CURRENT_DATE, '%d/%m/%Y')";
$rslt = $con->query($query);

$tab = [];
while ($item = $rslt->fetch_assoc()) {
    $tab[] = $item;
}


$query2 = "SELECT DISTINCT pack_num, qte_fp, qte FROM `p12_control` WHERE prod_line LIKE '%ISA203%' AND cur_day = DATE_FORMAT(CURRENT_DATE, '%d/%m/%Y')";
$rslt2 = $con->query($query2);

$tab2 = [];
while ($item2 = $rslt2->fetch_assoc()) {
    $tab2[] = $item2;
}


$i = 0;
$qengaged = 0;
//$prodline = $tab['prod_line'];
while ($i < count($tabl)) {
    
        $qengaged +=$tabl[$i]['pack_qte'];
    
    $i++;
}

$ii = 0;
$total = 0;
//$prodline = $tab['prod_line'];
while ($ii < count($tabl1)) {
    $total += $tabl1[$ii]['pack_qte'];
    $ii++;
}

$qdf = 0;
$qfab = 0;
$i1 = 0;
$F = count($tab2);
$cq = 0;
while ($i1 < $F) {
    $qfab += $tab2[$i1]['qte'];
    $qdf += $tab2[$i1]['qte_fp'];
    $cq = ($qdf / $qfab) * 100;
    $i1++;
}


$query3 = "SELECT `performance` FROM `p9_prod_performance_h` WHERE `prod_line` LIKE '%ISA203%' AND `cur_date` = DATE_FORMAT(CURRENT_DATE, '%d/%m/%Y') ORDER BY `id` DESC LIMIT 1";
$rslt3 = $con->query($query3);

$tab3 = [];
while ($item3 = $rslt3->fetch_assoc()) {
    $tab3[] = $item3;
}

// echo json_encode($tab3);


// $query4 = "SELECT DISTINCT operator_reg_num, prod_line FROM `p5_presence` WHERE cur_date = DATE_FORMAT(CURRENT_DATE, '%d/%m/%Y') AND prod_line LIKE '%ISA203%'";
// $rslt4 = $con->query($query4);
// $tab4 = [];
// while ($item4 = $rslt4->fetch_assoc()) {
//     $tab4[] = $item4;
// }
// $p = count($tab4);
// $i2 = 0;
$performance = $tab3[count($tab3)-1]['performance'];

// // json_encode($tab4);

// // echo "\r\n Nombre des paquets engagés = ", json_encode ($T = count($tab)), "\n"; //nombre des Paquets engagés

// // echo " La Quantité Engagée = ", json_encode ($qengaged),"\n";

// // echo " Nombre des paquets encours = ",json_encode( count($tab) - count($tab2)), "\n"; //nombre des Paquets engagés


$qencours = $total - $qfab;

// // echo "La Quantité encours = ", json_encode($qencours), "\n";

// // echo " La Quantité Fabriquée = ", json_encode($qfab), "\n";

$cq = ($qdf / $qfab) * 100;

// // echo " Indice de controle qualité = ",  json_encode(number_format($cq,2)), "%";

// // echo "Performance de la chaine = ", json_encode($performance / $p);

echo json_encode([
    //"prodline" =>$prodline,
    "qengaged" => $qengaged,
    "qencours" => $qencours,
    "qfab" => $qfab,
    "df"=> $qdf,
    "cq" => round($cq,2),
    "performance" => round($performance),
]);
