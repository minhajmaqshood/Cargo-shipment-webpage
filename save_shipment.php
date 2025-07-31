<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

$host = "localhost";
$user = "root";   // default XAMPP user
$pass = "";       // default XAMPP password
$db   = "shipment_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "DB connection failed"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
if (!$data) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid input"]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO shipments (shipment_name, shipping_mark, product_name, length, width, height, weight, box_count) VALUES (?,?,?,?,?,?,?,?)");
$stmt->bind_param("sssssssi",
    $data['shipment'],
    $data['mark'],
    $data['product'],
    $data['length'],
    $data['width'],
    $data['height'],
    $data['weight'],
    $data['box']
);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "id" => $stmt->insert_id]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Insert failed"]);
}
$stmt->close();
$conn->close();
?>
