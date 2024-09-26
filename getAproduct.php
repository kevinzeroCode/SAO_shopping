<?php
require_once 'config.php';

$productId = $_GET['id'];
$sql = "SELECT * FROM product WHERE productId = $productId";
$result = $conn->query($sql);
$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    $data[] = "No product found";
}
$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>