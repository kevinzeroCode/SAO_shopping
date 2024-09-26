<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sword Art Online Shop</title>
    <!-- 引入 Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./front_page.css" />
</head>
<body>

<!-- front-page -->
<section class="front-page-section">
    <img src="./wallpaper.jpg" alt="wallpaper" class="wallpaper">
    <div class="container">
        <h1>Sword Art Online Shop</h1>
        <p class="info">Welcome to Sword Art Online Shop, Let's sign in !</p>
        <div class="loginBtn">
            <!-- 登入按钮 -->
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#loginModal">登入</button>
            <!-- 註冊按钮 -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registerModal">註冊</button>
        </div>
    </div>
</section>

<!-- 引入 Bootstrap JS 和 jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<!-- 註冊模态框 -->
<div class="modal registerModal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">註冊</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- 注册表单 -->
                <form id="registerForm">
                    <div class="form-group">
                        <label for="username">用戶名稱</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">電子郵件</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">密碼</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <!-- <div class="form-group">
                        <label for="confirm_password">確認密碼</label>
                        <input type="confirm_password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div> -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                <button type="button" class="btn btn-primary" id="submitRegistration">註冊</button>
            </div>
        </div>
    </div>
</div>

<!-- 登入模态框 -->
<div class="modal loginModal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">登入</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- 登录表单 -->
                <form id="loginForm">
                <div class="form-group">
                        <label for="loginUsername">用戶名</label>
                        <input type="text" class="form-control" id="loginUsername" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="loginPassword">密碼</label>
                        <input type="password" class="form-control" id="loginPassword" name="password" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                <button type="button" class="btn btn-primary" id="submitLogin">登入</button>
            </div>
        </div>
    </div>
</div>



<script src="scripts.js"></script>


</body>

</html>
<!-- 模态框结构 -->