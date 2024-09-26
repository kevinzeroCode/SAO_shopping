function deleteRow(button) {
    var row = button.parentNode.parentNode;
    var orderId = button.getAttribute('data-order-id');

    var confirmation = confirm("確定删除該筆定單嗎？");

    if (confirmation) {
        row.parentNode.removeChild(row);
        // 现在你可以使用 orderId 和 orderDate 变量来执行你想要的操作
        console.log("訂單ID：" + orderId);

        $.ajax({
            type: 'POST',
            url: 'delete_order.php',
            data: { orderId: orderId},
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
}


$(document).ready(function() {
    var orderId; 
    $(".toupdate").click(function() {
        // 點擊按鈕時顯示模態對話框
        $("#updateModal").modal("show");
        orderId = $(this).data('order-id');
        console.log("Edit button clicked ", orderId);
        var row = $(this).closest("tr");
        var payname = row.find("td:eq(0)").text();
        var phone = row.find("td:eq(1)").text();
        var address = row.find("td:eq(2)").text();
        
        // 將獲取到的信息填充到模態對話框中的表單中
        $("#updatename").val(payname);
        $("#updatephone").val(phone);
        $("#updateaddress").val(address);
    });

    $("#submitupdate").click(function() {

        var paynameValue = $("#updatename").val();
        var phoneValue = $("#updatephone").val();
        var addressValue = $("#updateaddress").val();

        console.log("OrderId:", orderId);
        console.log("付款人:", paynameValue);
        console.log("電話:", phoneValue);
        console.log("地址:", addressValue);

        var updatedate = {
            orderId : orderId,
            payname : paynameValue,
            phone : phoneValue,
            address : addressValue,
            time : new Date().toISOString(),
        }

        $.ajax({
            url: 'update_order.php', 
            type: 'POST',
            data: updatedate,
            success: function(response) {
                alert(response); 
                $('#updateModal').modal('hide');
            },
            error: function() {
                alert("更新失敗，請稍後再嘗試。");
            }
        });
        window.location.href = window.location.href;
    });
});

