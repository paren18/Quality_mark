<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../Db.php";
include_once "Goods.php";

$database = new Database();
$db = $database->getConnection();
$product = new Goods($db);

$request_uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

$id_position = array_search("Goods", $request_uri);

if ($id_position !== false && isset($request_uri[$id_position + 2])) {
    $product->id = $request_uri[$id_position + 2];

    $data = json_decode(file_get_contents("php://input"));

    $product->name = $data->name;
    $product->inn = $data->inn;
    $product->barcode = $data->barcode;
    $product->description = $data->description;
    $product->price = $data->price;
    $product->category_id = $data->category_id;

    if ($product->update()) {
        http_response_code(200);
        echo json_encode(array("message" => "Товар был обновлён"), JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Невозможно обновить товар"), JSON_UNESCAPED_UNICODE);
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Неверный запрос. Укажите id товара."), JSON_UNESCAPED_UNICODE);
}
