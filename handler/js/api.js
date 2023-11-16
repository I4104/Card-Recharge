$("#apikey").on("submit", (e) => {
    e.preventDefault();
    $.ajax({
        url: "handler/execute/apikey.php?action=create",
        type: "POST",
        data: $("#apikey").serialize(),
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

$("#edit_apikey").on("submit", (e) => {
    e.preventDefault();
    $.ajax({
        url: "handler/execute/apikey.php?action=edit&id=" + $("#btn_save").attr("data-edit"),
        type: "POST",
        data: $("#edit_apikey").serialize(),
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

function edit_api(id) {
	$.ajax({
        url: "handler/execute/apikey.php?action=check&id=" + id,
        type: "GET",
        success: function(data) {
            if (data != "") {
				var data = JSON.parse(data);
                $("#btn_save").attr("data-edit", id);
				$("#edit_callback").val(data.callback);
				$("#edit").modal("show");
            } else {
				swal("Thất bại", "APIKey này không còn tồn tại!", "error").then(() => { window.location.reload(); });
            }
        }
    });
}

$("#boss_apikey").on("submit", (e) => {
    e.preventDefault();
    $.ajax({
        url: "handler/execute/apikey.php?action=create",
        type: "POST",
        data: $("#boss_apikey").serialize(),
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

$("#edit_boss_apikey").on("submit", (e) => {
    e.preventDefault();
    $.ajax({
        url: "handler/execute/apikey.php?action=edit&id=" + $("#btn_save").attr("data-edit"),
        type: "POST",
        data: $("#edit_boss_apikey").serialize(),
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

function edit_boss_api(id) {
    $.ajax({
        url: "handler/execute/apikey.php?action=check&id=" + id,
        type: "GET",
        success: function(data) {
            if (data != "") {
                var data = JSON.parse(data);
                $("#btn_save").attr("data-edit", id);
                $("#edit_username").val(data.username);
                $("#edit_callback").val(data.callback);
                $("#edit").modal("show");
            } else {
                swal("Thất bại", "APIKey này không còn tồn tại!", "error").then(() => { window.location.reload(); });
            }
        }
    });
}

function delete_api(id) {
    $.ajax({
        url: "handler/execute/apikey.php?action=delete&id=" + id,
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