$("#bank").on("submit", (e) => {
    e.preventDefault();
    $.ajax({
        url: "handler/execute/bank.php?action=create",
        type: "POST",
        data: $("#bank").serialize(),
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

function delete_bank(id) {
    $.ajax({
        url: "handler/execute/bank.php?action=delete&id=" + id,
        type: "GET",
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
}

$("#realname").bind("input", (e) => {
	$("#realname").val(format_str($("#realname").val()).toUpperCase());
});

function format_str(str) {
    return str
      .normalize("NFD")
      .replace(/[\u0300-\u036f]/g, "")
      .replace(/đ/g, "d")
      .replace(/Đ/g, "D");
}