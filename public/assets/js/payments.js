
$('#card-pembayaran').hide();
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});
$('#va').on('change', function (e) {
	var val = $(this).val();
	$.ajax({
		url: url_generate,
		type: "GET",
		data: {
			code: val
		},
		success: function (s) {
			$('#card-pembayaran').show();
			$('#code_virtual').html(s.external_id);
			$('#banks').html(s.bank_code);
			$('#external_id').val(s.external_id);
			$('#bank_code').val(s.bank_code);
			// var image = document.getElementById('logo_banks');
			// image.src = asset + '/' + s.bank_code + '.png';
			console.log(s)
		},
		error: function (e) {
			console.log(e)
		}
	});
})

$('#proses_pembayaran').on('click', function (e) {
	e.preventDefault();
	var id = $('#id').val();
	$.ajax({
		url: url_cek_pembayaran,
		type: "POST",
		data: { id: id },
		success: function (res) {
			console.log(res)
		}, error: function (er) {
			console.log(er)
		}
	})
})