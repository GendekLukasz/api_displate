<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$prices = array();

function add_test_price($product_id, $country, $price) {
    global $prices;
    $prices[] = array(
        'id' => $product_id,
        'country' => $country,
        'price' => $price,
    );
}

function get_price($product_id, $country) {
    global $prices;
    foreach ($prices as $price) {
        if ($price['id'] == $product_id && $price['country'] == $country)
            return array('price' => $price['price']);
    }
    return array('error' => 'no price');
}

add_test_price(1, 'GB', 10);
add_test_price(1, 'PL', 30);

if(isset($_GET['id'])) {
    $product_id = $_GET['id'];
} else {
    print_r(json_encode(array('error' => 'send id')));
    die();
}

if(isset($_GET['country'])) {
    $country = $_GET['country'];
} else {
    print_r(json_encode(array('error' => 'send country')));
    die();
}

print_r(json_encode(get_price((int)$product_id, $country)));
