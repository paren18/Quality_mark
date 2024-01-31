<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "Db.php";
include_once "Goods/Goods.php";

$database = new Database();
$db = $database->getConnection();

$product = new Goods($db);

if (isset($_GET['search'])) {
    $search = $_GET['search'];

    $stmt = $product->search($search);
    $num = $stmt->rowCount();

    if ($num > 0) {
        $products_arr = array();
        $products_arr["records"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $product_item = array(
                "id" => $id,
                "name" => $name,
                "inn" => $inn,
                "barcode" => $barcode,
                "description" => html_entity_decode($description),
                "price" => $price,
                "category_id" => $category_id
            );
            array_push($products_arr["records"], $product_item);
        }

        http_response_code(200);
        echo json_encode($products_arr, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "Товары не найдены."), JSON_UNESCAPED_UNICODE);
    }
} else {
    $stmt = $product->read();
    $num = $stmt->rowCount();

    if ($num > 0) {
        $products_arr = array();
        $products_arr["records"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $product_item = array(
                "id" => $id,
                "name" => $name,
                "inn" => $inn,
                "barcode" => $barcode,
                "description" => html_entity_decode($description),
                "price" => $price,
                "category_id" => $category_id
            );
            array_push($products_arr["records"], $product_item);
        }

        http_response_code(200);
        echo json_encode($products_arr, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "Товары не найдены."), JSON_UNESCAPED_UNICODE);
    }
}
