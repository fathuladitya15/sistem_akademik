var url_profile_sekolah;
$(function () {
	$('#account_profile_details_form').on('submit', function (e) {
		e.preventDefault();

		$.ajax({
			url: url_profile_sekolah,
			data: new FormData(this),
			processData: false,
			contentType: false,
			type: "POST",
			success: function (res) {
				console.log(res)
				if (res.sukses == true) {
					Swal.fire({
						title: res.pesan,
						icon: 'success',
						html: 'Merefresh Halaman',
						timer: 2000,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading()
						},
					}).then((result) => {
						window.location.href = res.link_reload;
					})
				} else {
					Swal.fire({
						text: "Opps ," + res.pesan + "",
						icon: "error",
						buttonsStyling: !1,
						confirmButtonText: "Ok, Mengerti!",
						customClass: {
							confirmButton: "btn btn-primary"
						}
					})
				}
			}, error: function (er) {
				console.log(er)
			}

		})
	});
})