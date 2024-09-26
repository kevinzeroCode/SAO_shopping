
$("#submitRegistration").click(function() {
    
    var formData = {
        username: $("#username").val(),
        email: $("#email").val(),
        password: $("#password").val(),
    };

    $.ajax({
        url: 'register.php', 
        type: 'POST',
        data: formData,
        success: function(response) {
            alert(response); 
            $('#registerModal').modal('hide'); //關閉對話視窗
        },
        error: function() {
            alert("註冊失败，请稍後再试。");
        }
    });
});


$("#submitLogin").click(function() {
    var formData = {
        username: $("#loginUsername").val(),
        password: $("#loginPassword").val(),
    };


    $.ajax({
        url: 'login.php',
        type: 'POST',
        data: formData,
        success: function(response) {
            if (response === "登录成功") {
                window.location.href = 'dashboard.php'; // 轉送到dashboard.php
            } else {
                alert("用戶名稱或密碼錯誤");
            }
        },
        error: function() {
            alert("登录失败，请稍后再试。");
        }
    });    
});


