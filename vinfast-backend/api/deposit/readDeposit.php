<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/contacts.php');
include_once('../../model/deposit/deposit.php');

$db = new db();
$connect = $db->connect();

$deposit = new DepositLuxSa($connect);
$read = $deposit->read();

$num = $read->rowCount();

if ($num > 0) {
    $deposit_array = [];
    $deposit_array['data'] = [];

    while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $deposit_item = array(
            'id' => $id,
            'name' => $name,
            'count' => $count,
            'image' => $image,
            'color' => $color,
            'colorCode' => $colorCode,
            'price' => $price,
            'deposits' => $deposits,
        );
        array_push($deposit_array['data'], $deposit_item);
    }
    echo json_encode(($deposit_array));
}