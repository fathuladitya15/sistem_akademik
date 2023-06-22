"use strict";
var KTSigninGeneral = function () {
	var t, e, i;
	return {
		init: function () {
			t = document.querySelector("#kt_sign_in_form"),
				e = document.querySelector("#kt_sign_in_submit"),
				i = FormValidation.formValidation(t, {
					fields: {
						username: {
							validators: {
								notEmpty: {
									message: "username wajib diisi"
								}
							}
						},
						password: {
							validators: {
								notEmpty: {
									message: "Password wajib diisi"
								}
							}
						}
					},
					plugins: {
						trigger: new FormValidation.plugins.Trigger,
						bootstrap: new FormValidation.plugins.Bootstrap5({
							rowSelector: ".fv-row"
						})
					}
				}),
				e.addEventListener("click", (function (n) {
					n.preventDefault(),

						i.validate().then((function (i) {
							"Valid" == i ? (e.setAttribute("data-kt-indicator", "on"),
								e.disabled = !0,
								setTimeout((function () {
									$.ajax({
										url: url_login,
										data: $('#kt_sign_in_form').serialize(),
										type: "POST",
										success: function (res) {
											if (res.sukses == true) {
												e.removeAttribute("data-kt-indicator");
												e.disabled = !1;
												Swal.fire({
													title: 'Login Berhasil !',
													icon: 'success',
													html: 'Melanjutkan Ke Dashboard',
													timer: 2000,
													timerProgressBar: true,
													didOpen: () => {
														Swal.showLoading()
													},
												}).then((result) => {
													window.location.href = "/home";
												})
											} else {
												e.removeAttribute("data-kt-indicator");
												e.disabled = !1;
												Swal.fire({
													text: "Opps , Username Atau Password Tidak Sesuai !",
													icon: "error",
													buttonsStyling: !1,
													confirmButtonText: "Ok, Mengerti!",
													customClass: {
														confirmButton: "btn btn-primary"
													}
												})
											}
										}, error: function (er) {
											e.removeAttribute("data-kt-indicator");
											e.disabled = !1;
											var pesan = er.responseJSON.errors.username[1];
											Swal.fire({
												text: pesan,
												icon: "error",
												buttonsStyling: !1,
												confirmButtonText: "Ok, Mengerti!",
												customClass: {
													confirmButton: "btn btn-primary"
												}
											})
										}
									})
								}
								), 2e3)) :
								Swal.fire({
									text: "Opps , Terjadi Kesalahan, Mohon coba kembali !",
									icon: "error",
									buttonsStyling: !1,
									confirmButtonText: "Ok, Mengerti!",
									customClass: {
										confirmButton: "btn btn-primary"
									}

								})
						}
						))
				}
				))
		}
	}
}();
KTUtil.onDOMContentLoaded((function () {
	KTSigninGeneral.init()
}
));
