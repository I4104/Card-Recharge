/*
	
	File create by I4104
	Please don't copy this

*/

// Login

$("#login").on("submit", function(e) {
	e.preventDefault();
	$.ajax({
		url: "handler/execute/users.php?action=login",
		type: "POST",
		data: $(this).serialize(),
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

// Change password

$("#changepass").on("submit", function(e) {
	e.preventDefault();
	$.ajax({
		url: "handler/execute/users.php?action=changepass",
		type: "POST",
		data: $(this).serialize(),
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

$("#boss_users").on("submit", function(e) {
	e.preventDefault();
	$.ajax({
		url: "handler/execute/users.php?action=create",
		type: "POST",
		data: $(this).serialize(),
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