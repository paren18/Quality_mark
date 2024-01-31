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

    $product->readOne();

    if ($product->delete()) {
        http_response_code(200);
        echo json_encode(array("message" => "Товар был удалён"), JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Не удалось удалить товар"));
    }

}