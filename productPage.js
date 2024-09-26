window.onload = function() {
    // 從 URL 中獲取產品 ID
    var urlParams = new URLSearchParams(window.location.search);
    var productId = urlParams.get('productId');

    // 假設你有一個函數可以根據產品 ID 獲取產品資訊
    getProductById(productId);
}

function getProductById(productId) {
    $.ajax({
        url: 'getAproduct.php',
        type: 'get',
        data: { id: productId },
        dataType: 'json',
        success: function(product) {
            // 更新頁面上的產品資訊
            console.log(product);
            if (product[0] === "No product found") {
                window.location.href = "dashboard.php";
            } else {
                document.querySelector('.pro_img').innerHTML = '<img src="' + product[0].imgUrl + '" width="150" height="150">';
                document.querySelector('.pro_name').textContent = product[0].proName;
                document.querySelector('.pro_price').textContent = product[0].proPrice + '元';
                document.querySelector('.pro_rank').textContent = product[0].proComm + '萬人好評';
                document.querySelector('.pro_info').textContent = product[0].proInfo;
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // 當請求失敗時執行的程式碼
            console.error('AJAX 請求失敗:', textStatus, ', 錯誤訊息:', errorThrown);
        }
    });
}