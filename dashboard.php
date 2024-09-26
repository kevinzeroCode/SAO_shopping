<?php
// 開始 PHP 會話
session_start();

// 檢查用戶是否已經登入
if (!isset($_SESSION['username'])) {
    // 如果未登入，將用戶重新導向到登入頁面
    header("Location: shopping_first.php");
    exit(); // 結束程式執行，確保用戶不會繼續訪問未授權的頁面
}
if (isset($_POST['logout'])) {
    // 清除會話
    session_unset();
    session_destroy();
    // 將用戶重新導向到登入頁面
    header("Location: shopping_first.php");
    exit(); // 確保用戶不會繼續訪問未授權的頁面
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>購物畫面</title>
    <!-- 引入 Bootstrap 或其他样式库 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/help-center.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="./shopping.js"></script>
</head>
<body>

<nav>
    <a href="logout.php" class="button">登出</a>
    <a href="my_orders.php" id="myOrdersButton" class="button">我的訂單</a>
</nav>

<div class="header">
            <img src="./img/Link_Star.gif" id="myGif" alt="過場動畫" width="2000"/>
            <div class="container">

                <div class="center-flex">
                    <img src="./img/Title.png" alt="Congraduations" class="center-margin" width="2000">
                </div>
                <div class="header-title" id="J_miniHeaderTitle">
                    <h2 style="font-size: 30px">我的購物車</h2>
                </div>
                   
            </div>

            <div id="car" class="car">

                <div class="head_row hid">
                    <div class="check left"> <i onclick="checkAll()">√</i></div>
                    <div class="img left">&nbsp;&nbsp;全選</div>
                    <div class="name left">商品名稱</div>
                    <div class="price left">單價</div>
                    <div class="number left">數量</div>
                    <div class="subtotal left">小計</div>
                    <div class="ctrl left">操作</div>
                </div>

            </div>
            <div id="sum_area">
                <div id="pay_amout">合計：<span id="price_num">0</span>元</div>
                <button type="button" class="pay_btn" id="topay" data-toggle="modal" data-target="#payModal">確認訂單</button>
            </div>

            <div id="box">
                <br>
                <h2 class="box_head"><span>買購物車中商品的人還買了</span></h2>
                <div id="grouplist"></div>
                <ul id="shoplist">
                </ul>
            </div>
            
</div>


<!-- 結帳框 -->
<div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labelledby="payModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="payModalLabel">結帳</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- 結帳表單 -->
                <form id="checkoutForm">
                    <div class="form-group">
                        <label for="payname">名字</label>
                        <input type="text" class="form-control" id="payname" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="payphone">電話</label>
                        <input type="text" class="form-control" id="payphone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="payaddress">地址</label>
                        <input type="text" class="form-control" id="payaddress" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="order">訂單</label>
                        <textarea class="form-control" id="order" name="order" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label for="total">總金額</label>
                        <input type="text" class="form-control" id="total" name="total" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                <button type="button" class="btn btn-primary" id="submitCheckout">結帳</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
