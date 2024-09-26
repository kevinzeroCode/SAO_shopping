<?php
require_once 'config.php';

$sql = "SELECT productId, imgUrl, proName, proPrice, proComm, groupId FROM product";
$result = $conn->query($sql);
$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    $data[] = "0 results";
}
$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>