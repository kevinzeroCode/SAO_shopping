setTimeout(function() {
    document.getElementById("myGif").style.display = "none"; // 隐藏 GIF
}, 3000);

window.onload = function() {
    var oBox = document.getElementById("box");
    var oCar = document.getElementById("car");
    var oUl = document.getElementById("shoplist");
    
    getphpdata('getgroup.php', 'get', 'json', processGroupData);
    
    var orderArr = new Array()

    var total = 0;
    $("#topay").click(function() {
        orderArr = new Array();
        var order = [];
        total = 0;
        $(".row:has(.i_acity)").each(function() {
            // 獲取商品名稱、單價和數量
            var id = $(this).data('id');
            var name = $(this).find(".name").text();
            var price = parseFloat($(this).find(".price").text());
            var number = parseInt($(this).find(".item_count_i").find(".c_num").text());

            // 計算小計
            var subtotal = price * number;

            // 更新訂單詳情和總金額
            orderArr.push([id,name,price,number])
            order += name + " : "+ price + "X"+ number + " = " + subtotal + "\n";
            total += subtotal;
        });
        
        console.log(orderArr)
        $("#order").val(order);
        $("#total").val(total);
    });

    $("#submitCheckout").click(function() {

        var formData = {
            payname: $("#payname").val(),
            phone: $("#payphone").val(),
            address: $("#payaddress").val(),
            time: new Date().toISOString(),
            totalAmount: total,
            order: orderArr,
        };

        // 通过 AJAX 发送数据到服务器
        $.ajax({
            url: 'paycheckout.php', // 处理注册的 PHP 脚本
            type: 'POST',
            data: formData,
            success: function(response) {
                alert(response); // 或者显示成功信息
                $('#payModal').modal('hide'); // 关闭模态框
            },
            error: function() {
                alert("結帳失敗，請稍後再嘗試。");
            }
        });
    });


    $.ajax({
        url: 'getproduct.php',
        type: 'get',
        dataType: 'json',
        success: function(product) {
            console.log(product);
            
            
            for (var i = 0; i < product.length; i++) {
                var oLi = document.createElement("li");
                oLi.id = "product";
                oLi.dataset.id = product[i]["productId"];
                oLi.dataset.group = product[i]["groupId"];
                oLi.innerHTML += '<div class="pro_img"><img src="' + product[i]["imgUrl"] + '" width="150" height="150"></div>';
                oLi.innerHTML += '<h3 class="pro_name"><a href="productPage.html?productId=' + product[i]["productId"] + '">' + product[i]["proName"] + '</a></h3>';
                oLi.innerHTML += '<p class="pro_price">' + product[i]["proPrice"] + '元</p>';
                oLi.innerHTML += '<p class="pro_rank">' + product[i]["proComm"] + '萬人好評</p>';
                oLi.innerHTML += '<div class="add_btn">加入購物車</div>';
                oUl.appendChild(oLi);
            };


            var aBtn = getClass(oBox, "add_btn");//獲取box下的所有添加購物車按鈕
            var number = 0;//初始化商品數量
            for (var i = 0; i < aBtn.length; i++) {
                number++;
                aBtn[i].index = i;
                aBtn[i].onclick = function() {
                    var oDiv = document.createElement("div");
                    var data = product[this.index];
                    oDiv.className = "row hid";
                    oDiv.dataset.id = data["productId"];
                    oDiv.innerHTML += '<div class="check left"> <i class="i_check" id="i_check" onclick="i_check()" >√</i></div>';
                    oDiv.innerHTML += '<div class="img left"><img src="' + data["imgUrl"] + '" width="80" height="80"></div>';
                    oDiv.innerHTML += '<div class="name left"><span>' + data["proName"] + '</span></div>';
                    oDiv.innerHTML += '<div class="price left"><span>' + data["proPrice"] + '元</span></div>';
                    oDiv.innerHTML +=' <div class="item_count_i"><div class="num_count"><div class="count_d">-</div><div class="c_num">1</div><div class="count_i">+</div></div> </div>'
                    oDiv.innerHTML += '<div class="subtotal left"><span>' + data["proPrice"] + '元</span></div>'
                    oDiv.innerHTML += '<div class="ctrl left"><a href="javascript:;">×</a></div>';
                    oCar.appendChild(oDiv);
                    var flag = true;
                    var check = oDiv.firstChild.getElementsByTagName("i")[0];
                    check.onclick = function() {
                        // console.log(check.className);
                        if (check.className == "i_check i_acity") {
                            check.classList.remove("i_acity");

                        } else {
                            check.classList.add("i_acity");
                        }
                        getAmount();
                    }
                    var delBtn = oDiv.lastChild.getElementsByTagName("a")[0];
                    delBtn.onclick = function() {
                        var result = confirm("確定刪除嗎?");
                        if (result) {
                            oCar.removeChild(oDiv);
                            number--;
                            getAmount();
                        }
                    }
                    var i_btn = document.getElementsByClassName("count_i");
                    for (var k = 0; k < i_btn.length; k++) {
                        i_btn[k].onclick = function() {
                            bt = this;
                            //獲取小計節點
                            at = this.parentElement.parentElement.nextElementSibling;
                            //獲取單價節點
                            pt = this.parentElement.parentElement.previousElementSibling;
                            //獲取數量值
                            node = bt.parentNode.childNodes[1];
                            console.log(node);
                            num = node.innerText;
                            num = parseInt(num);
                            num++;
                            node.innerText = num;
                            //獲取單價
                            price = pt.innerText;
                            price = price.substring(0, price.length - 1);
                            //計算小計值
                            at.innerText = price * num + "元";
                            //計算總計值
                            getAmount();
                        }
                    }
                    //獲取所有的數量減號按鈕
                    var d_btn = document.getElementsByClassName("count_d");
                    for (k = 0; k < i_btn.length; k++) {
                        d_btn[k].onclick = function() {
                            bt = this;
                            //獲取小計節點
                            at = this.parentElement.parentElement.nextElementSibling;
                            //獲取單價節點
                            pt = this.parentElement.parentElement.previousElementSibling;
                            //獲取c_num節點
                            node = bt.parentNode.childNodes[1];
                            num = node.innerText;
                            num = parseInt(num);
                            if (num > 1) {
                                num--;
                            }
                            node.innerText = num;
                            //獲取單價
                            price = pt.innerText;
                            price = price.substring(0, price.length - 1);
                            //計算小計值     
                            at.innerText = price * num + "元";
                            //計算總計值
                            getAmount();
                        }
                    }

                    delBtn.onclick = function() {
                        var result = confirm("確定刪除嗎?");
                        if (result) {
                            oCar.removeChild(oDiv);
                            number--;
                            getAmount();
                        }
                    }

                }
            }


        },
        error: function(jqXHR, textStatus, errorThrown) {
            // 當請求失敗時執行的程式碼
            console.error('AJAX 請求失敗:', textStatus, ', 錯誤訊息:', errorThrown);
        }
    });

}

function getphpdata(url, type, dataType, callback){
    $.ajax({
        url: url,
        type: type,
        dataType: dataType,
        success: function(data) {
            callback(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX 請求失敗:', textStatus, ', 錯誤訊息:', errorThrown);
        }
    });
}

function processGroupData(group) {//產生group選擇按鈕
    var lUl = document.getElementById("grouplist");
    for (var i = 0; i < group.length; i++) {
        var lLi = document.createElement("div");
        lLi.id = "group";
        lLi.className = "button";
        lLi.dataset.group = group[i]["groupId"];
        lLi.innerHTML += group[i]["groupName"];
        lLi.addEventListener('click', function() {
            displayProducts(this.dataset.group);
        });
        lUl.appendChild(lLi);
    }
}

function displayProducts(groupId) {//商品顯示邏輯
    var items = document.getElementById("shoplist").querySelectorAll('li');
    if (groupId == 0){
        for (var i = 0; i < items.length; i++) {
            items[i].style.display = 'block';
        }
    }else{
        for (var i = 0; i < items.length; i++) {
            // 如果 data-group 的值不等於 1，則隱藏該元素
            if (items[i].getAttribute('data-group') !== groupId) {
                items[i].style.display = 'none';
            }else{
                items[i].style.display = 'block';
            }
        }
    }
    console.log("Displaying products for group: " + groupId);
}

function getClass(oBox, tagname) {
    var aTag = oBox.getElementsByTagName("*");
    var aBox = [];
    for (var i = 0; i < aTag.length; i++) {
        if (aTag[i].className == tagname) {
            aBox.push(aTag[i]);
        }
    }
    return aBox;
}

var index = false;
function checkAll() {
    var choose = document.getElementById("car").getElementsByTagName("i");
    // console.log(choose);
    if (choose.length != 1) {
        for (i = 1; i < choose.length; i++) {
            if (!index) {
                choose[0].classList.add("i_acity2")
                choose[i].classList.add("i_acity");
            } else {
                choose[i].classList.remove("i_acity");
                choose[0].classList.remove("i_acity2")
            }
        }
        index = !index;
    }
    getAmount();
}

//進行價格合計
function getAmount() {
    // console.log(ys);
    ns = document.getElementsByClassName("i_acity");
    console.log(ns);
    sum = 0;
    //選中框
    document.getElementById("price_num").innerText = sum;
    for (y = 0; y < ns.length; y++) {
        //小計
        amount_info = ns[y].parentElement.parentElement.lastElementChild.previousElementSibling;
        num = parseInt(amount_info.innerText);
        sum += num;
        document.getElementById("price_num").innerText = sum;
    }
}

