"use strict";
var url_profile_sekolah;
var KTAccountSettingsProfileDetails = function() {
	var button, e, t;
    return {
        init: function() {
			e = document.getElementById("kt_account_profile_details_form"),
			e.querySelector("#kt_account_profile_details_submit"),
			button = document.querySelector('#kt_account_profile_details_submit');
			t = FormValidation.formValidation(e, {
					fields: {
						nama_aplikasi: {
							validators: {
								notEmpty: {
									message: "Nama Aplikasi Wajib di isi"
								}
							}
						},
						nama_sekolah: {
							validators: {
								notEmpty: {
									message: "Nama Sekolah Wajib diisi"
								}
							}
						},
						nomer_telepon_sekolah: {
							validators: {
								notEmpty: {
									message: "Nomer kontak wajib diisi"
								}
							}
						},
						email_sekolah: {
							validators: {
								notEmpty: {
									message: "Email Wajib di isi"
								}
							}
						},
						timezone: {
							validators: {
								notEmpty: {
									message: "Please select a timezone"
								}
							}
						}
					},
					plugins: {
						trigger: new FormValidation.plugins.Trigger,
						submitButton: new FormValidation.plugins.SubmitButton,
						bootstrap: new FormValidation.plugins.Bootstrap5({
							rowSelector: ".fv-row",
							eleInvalidClass: "",
							eleValidClass: ""
						})
					}
			}),
				button.addEventListener("click", (function (n) {
					n.preventDefault(),
						t.validate().then((function (t) {
							var form = document.getElementById("kt_account_profile_details_form")
							"Valid" == t ? (
								$('#kt_account_profile_details_submit').html("Please Wait ... <span class='spinner-border spinner-border-sm align-middle ms-2'></span>"),
								$('#kt_account_profile_details_submit').attr('disabled', 'disabled'),
								setTimeout((function () {
									$.ajax({
										url: url_profile_sekolah,
										data: new FormData(form),
										processData: false,
										contentType: false,
										type: "POST",
										success: function (res) {
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
											Swal.fire({
												text: "Opps , Terjadi Kesalahan, Hubungi Tim IT !",
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
								), 2e3)) : Swal.fire({
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
KTUtil.onDOMContentLoaded((function() {
    KTAccountSettingsProfileDetails.init()
}
));
