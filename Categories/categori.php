<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../Db.php";
include_once "Categories.php";

$database = new Database();
$db = $database->getConnection();

$category = new Categories($db);

$stmt = $category->readAllWithCount();
$num = $stmt->rowCount();

if ($num > 0) {
    $categories_arr = array();
    $categories_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $category_item = array(
            "id" => $id,
            "name" => $name,
            "uri" => html_entity_decode($uri),
            "product_count" => $product_count
        );
        array_push($categories_arr["records"], $category_item);
    }

    http_response_code(200);
    echo json_encode($categories_arr, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Категории не найдены"), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
?>
