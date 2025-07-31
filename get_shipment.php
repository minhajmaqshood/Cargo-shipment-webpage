<?php
$sql = "SELECT shipment_name, shipping_mark, product_name, l, w, h, weight, box_count FROM shipment_db";

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");


$host = "localhost";
$user = "root";
$pass = "";
$db   = "shipment_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "DB connection failed"]);
    exit;
}

$result = $conn->query("SELECT * FROM shipments ORDER BY created_at DESC");
$rows = [];
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}
echo json_encode($rows);
$conn->close();
?>
