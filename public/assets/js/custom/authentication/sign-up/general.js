"use strict";
var KTSignupGeneral = function () {
	var e, t, a, s, r = function () {
		return 100 === s.getScore()
	};
	return {
		init: function () {
			e = document.querySelector("#kt_sign_up_form"),
				t = document.querySelector("#kt_sign_up_submit"),
				s = KTPasswordMeter.getInstance(e.querySelector('[data-kt-password-meter="true"]')),
				a = FormValidation.formValidation(e, {
					fields: {
						"first-name": {
							validators: {
								notEmpty: {
									message: "Nama Depan diperlukan"
								}
							}
						},
						"last-name": {
							validators: {
								notEmpty: {
									message: "Nama Belakang diperlukan"
								}
							}
						},
						email: {
							validators: {
								notEmpty: {
									message: "Alamat Email diperlukan"
								},
								emailAddress: {
									message: "Alamat email anda tidak valid"
								}
							}
						},
						password: {
							validators: {
								notEmpty: {
									message: "Password diperlukan"
								},
								callback: {
									message: "Masukan Password yang Valid",
									// callback: function (e) {
									// 	if (e.value.length > 0)
									// 		return r()
									// }
								}
							}
						},
						"password-confirm": {
							validators: {
								notEmpty: {
									message: "Konfirmasi Password diperlukan"
								},
								identical: {
									compare: function () {
										return e.querySelector('[name="password"]').value
									},
									message: "Kata sandi dan konfirmasinya tidak sama"
								}
							}
						},
						toc: {
							validators: {
								notEmpty: {
									message: "Anda harus menerima syarat dan ketentuan"
								}
							}
						}
					},
					plugins: {
						trigger: new FormValidation.plugins.Trigger(),
						bootstrap: new FormValidation.plugins.Bootstrap5({
							rowSelector: ".fv-row",
							eleInvalidClass: "",
							eleValidClass: ""
						})
					}
				}),
				t.addEventListener("click", (function (r) {
					r.preventDefault(),
						a.revalidateField("password"),
						a.validate().then((function (a) {
							"Valid" == a ? (
								t.setAttribute("data-kt-indicator", "on"),
								t.disabled = !0,
								setTimeout((function () {
									$.ajax({
										headers: {
											Accept: "application/json"
										},
										url: url_register,
										data: $('#kt_sign_up_form').serialize(),
										type: "POST",
										success: function (res) {
											console.log(res)
											if (res.sukses == true) {
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
													// window.location.href = "/home";
													console.log(res);
												})
											} else {
												console.log(res)
												Swal.fire({
													text: res.er,
													icon: "error",
													buttonsStyling: !1,
													confirmButtonText: "Ok, Mengerti!",
													customClass: {
														confirmButton: "btn btn-primary"
													}
												})
											}
										}, error: function (er) {
											var msg = er.responseJSON.message
											console.log(er)
											Swal.fire({
												text: "Opps ," + msg,
												icon: "error",
												buttonsStyling: !1,
												confirmButtonText: "Ok, Mengerti!",
												customClass: {
													confirmButton: "btn btn-primary"
												}
											})
										}, complete: function () {
											document.getElementById('kt_sign_up_submit').removeAttribute("data-kt-indicator");
											document.getElementById('kt_sign_up_submit').disabled = !1;

										}
									})

								}
								), 1500)) : Swal.fire({
									text: "Sorry, Form Pendaftaran Belum lengkap, cek dan coba kembali.",
									icon: "error",
									buttonsStyling: !1,
									confirmButtonText: "Ok, Mengerti !",
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
	KTSignupGeneral.init()
}
));
