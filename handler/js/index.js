
$("#card").on("submit", (e) => {
	e.preventDefault();
    $.ajax({
        url: "handler/execute/card.php?action=card",
        type: "POST",
        data: $("#card").serialize(),
        success: function(data) {
        	console.log(data);
            var data = JSON.parse(data);
            swal(data.title, data.message, data.type).then(function() {
                if (data.reload) {
                    window.location.reload();
                }
            });
        }
    });
});