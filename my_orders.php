<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>查看訂單</title>
<link rel="stylesheet" type="text/css" href="css/order_view.css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="order_view.js"></script>
</head>
<body>

<a href="dashboard.php" class="tbutton">返回商城</a>

<?php
session_start(); 

include_once 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: shopping_first.php");
    exit(); 
}

if (isset($_POST['logout'])) {

    session_unset();
    session_destroy();
    header("Location: shopping_first.php");
    exit(); 
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM orders WHERE customerid = $user_id";

$result = mysqli_query($conn, $query);

echo "
<table>
<tr>
    <th>付款人</th>
    <th>電話</th>
    <th>地址</th>
    <th>總金額</th>
    <th>下單日期</th>
    <th>操作</th>
</tr>";

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['payname'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo "<td>" . $row['address'] . "</td>";
        echo "<td>" . $row['total'] . "</td>";
        echo "<td>" . $row['orderdate'] . "</td>";
        echo "<td>
                <button class='delete-btn'  onclick='deleteRow(this)' data-order-id='" . $row['orderid'] . "'>删除</button>
                <button class='edit-btn toupdate' data-toggle='modal' data-target='#updateModal' data-order-id='" . $row['orderid'] . "'>修改</button>
                
                </td>";

        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "查無訂單：" . mysqli_error($conn);
}
?>

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">結帳</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- 結帳表單 -->
                <form id="checkoutForm">
                    <div class="form-group">
                        <label for="updatename">付款人</label>
                        <input type="text" class="form-control" id="updatename" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="updatephone">電話</label>
                        <input type="text" class="form-control" id="updatephone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="updateaddress">地址</label>
                        <input type="text" class="form-control" id="updateaddress" name="address" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                <button type="button" class="btn btn-primary" id="submitupdate">確認修改</button>
            </div>
        </div>
    </div>
</div>


</body>
</html>
