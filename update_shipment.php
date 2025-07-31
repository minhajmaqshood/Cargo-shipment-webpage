<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$host = "localhost";
$user = "root";
$pass = "";
$db   = "shipment_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    http_response_code(500);
    echo "Database connection failed.";
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
if (!$data || !isset($data['id'])) {
    http_response_code(400);
    echo "Invalid data.";
    exit;
}

$id = intval($data['id']);
$shipment_name = $data['shipment_name'];
$shipping_mark = $data['shipping_mark'];
$product_name  = $data['product_name'];
$length        = floatval($data['length']);
$width         = floatval($data['width']);
$height        = floatval($data['height']);
$weight        = floatval($data['weight']);
$box_count     = intval($data['box_count']);

$sql = "UPDATE shipments SET 
            shipment_name = ?, 
            shipping_mark = ?, 
            product_name = ?, 
            length = ?, 
            width = ?, 
            hight = ?, 
            weight = ?, 
            box_count = ?
        WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("", $shipment_name, $shipping_mark, $product_name, $length, $width, $height, $weight, $box_count, $id);

if ($stmt->execute()) {
    echo "Updated successfully.";
} else {
    http_response_code(500);
    echo "Failed to update entry.";
}

$stmt->close();
$conn->close();
?>
