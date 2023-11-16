$("#withdraw").on("submit", (e) => {
    e.preventDefault();
    $.ajax({
        url: "handler/execute/withdraw.php?action=withdraw",
        type: "POST",
        data: $("#withdraw").serialize(),
        success: function(data) {
            var data = JSON.parse(data);
            // Sau khi đã lấy dữ liệu từ phần php xử lý, hiển thị ra màn hình
            swal(data.title, data.message, data.type).then(function() {
                // Nếu đăng nhập thành công, reload lại trang để chuyển người dùng về trang chủ
                if (data.reload) {
                    window.location.reload();
                }
            });
        }
    });
});

$("#bank").on("change", () => {
	if ($("#bank").val() != "") {
		$("#btnSubmit").text("❖ Rút tiền ngay");
		$("#btnSubmit").attr("disabled", false);
		$("#price").attr("readonly", false);
	} else {
		$("#btnSubmit").text("❖ Vui lòng chọn ngân hàng");
		$("#btnSubmit").attr("disabled", true);
		$("#price").attr("readonly", true);
	}
});

$("#price").bind("input", () => {
	var prices = $("#price").val();
	var total = "";
	var re = new RegExp(',', 'g');
    prices = prices.replace(re, '');

	if (isNumber(prices)) {
		total = price(prices);
	} else {
		prices = prices.substr(0, prices.length - 1);
		total = price(prices);
	}
	$("#price").val(total);
});

function price(total) {
	var re = new RegExp(',', 'g');
    total = total.replace(re, '');
    total = parseFloat(total, 10).toFixed(3).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
    total = total.substr(0, total.length - 4);
    return total;
}

function isNumber(number) {
    var regex = /^[0-9]*$/g
    return regex.test(number);
}