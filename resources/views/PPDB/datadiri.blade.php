@extends('layouts.app')
@section('content')
    @if ($status_pembayaran == 1)
        <div class="alert alert-success" role="alert">Pembayaran Anda telah kami
            terima, Lanjutkan untuk mengisi form Selanjutnya</div>
    @endif
    <div class="card">
        <div class="card-header border-0 pt-0">
            <div class="card-title">
            </div>
        </div>
        <form id="form-data-diri">
            @csrf
            <div class="card-body pt-0">
                <div class="w-100">

                    <div class="pb-10 pb-lg-15">
                        <h2 class="fw-bolder text-dark">Data Diri Calon Peserta Didik</h2>
                        <div class="text-muted fw-bold fs-6">Isi Data diri Calon Peserta Didik Baru
                        </div>
                    </div>
                    <div class="mb-10 fv-row">
                        <label class="form-label mb-3">Nama Lengkap</label>
                        <input type="text" class="form-control form-control-lg form-control-solid" name="account_name"
                            placeholder="" value="{{ Auth::user()->name }}" readonly />
                    </div>
                    <div class="mb-10 fv-row">
                        <label class="form-label mb-3">NISN </label>
                        <input type="text" class="form-control form-control-lg form-control-solid" name="nisn"
                            placeholder="" value="" />
                    </div>
                    <div class="mb-10 fv-row">
                        <label class="form-label mb-3">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="" class="form-control form-control-lg form-control-solid">
                            <option value="">-- Jenis Kelamin --</option>
                            <option value="L">Laki - Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-10 fv-row">
                        <label class="form-label mb-3">Tanggal Lahir</label>
                        <input type="date" class="form-control form-control-lg form-control-solid" name="tanggal_lahir"
                            placeholder="" value="" />
                    </div>
                    <div class="mb-10 fv-row">
                        <label class="form-label mb-3">Tempat Lahir</label>
                        <select name="tempat_lahir" id="kota" class="form-control form-control-lg form-control-solid"
                            id="">
                            <option value="">-- Pilih Kota -- </option>

                            @foreach ($kota as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-10 fv-row">
                        <label class="form-label mb-3">Nomer Whatsapp</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">+62</span>
                            <input type="number" class="form-control form-control-lg form-control-solid" id="nomerhp"
                                aria-describedby="basic-addon1" placeholder="8xxx" name="nomerhp">
                        </div>
                    </div>

                    <div class="mb-10 fv-row">
                        <label class="form-label mb-3">Alamat Rumah</label>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-3 fv-row fv-plugins-icon-container">
                                    <select name="provinsi" id="prov_address"
                                        class="form-control form-control-lg form-control-solid">
                                        <option value=""></option>
                                        @foreach ($prov as $item)
                                            <option value="{{ $item->code }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3 fv-row fv-plugins-icon-container">
                                    <select name="kota_add" id="kota_address"
                                        class="form-control form-control-lg form-control-solid" disabled>
                                    </select>
                                </div>
                                <div class="col-lg-3 fv-row fv-plugins-icon-container">
                                    <select name="daerah" id="daerah"
                                        class="form-control form-control-lg form-control-solid" placeholder="Pilih Daerah"
                                        disabled>
                                    </select>
                                </div>
                                <div class="col-lg-3 fv-row fv-plugins-icon-container">
                                    <select name="desa" id="desa"
                                        class="form-control form-control-lg form-control-solid" disabled>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="mb-10 fv-row">
                        <textarea name="alamat" id="" cols="30" rows="10"
                            class="form-control form-control-lg form-control-solid" placeholder="Alamat Detail"></textarea>
                    </div>
                </div>
                <div class="d-flex flex-stack pt-15">
                    <button type="submit" class="btn btn-lg btn-primary" style="float:right">
                        <span class="indicator-label">Submit
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                            <span class="svg-icon svg-icon-4 ms-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="18" y="13" width="13" height="2"
                                        rx="1" transform="rotate(-180 18 13)" fill="black" />
                                    <path
                                        d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        url = "{{ route('PPDB.kirim_data') }}";
        $('#form-data-diri').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '/PPDB/post_data',
                data: $(this).serialize(),
                type: "POST",
                success: function(res) {
                    console.log(res);
                },
                error: function(er) {
                    console.log(er)
                    var pesan = er.responseJSON.message;
                    Swal.fire({
                        text: "Maaf ," + pesan + " .",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-light"
                        }
                    }).then((function() {
                        KTUtil.scrollTop()
                    }))
                }
            })
        })
        $('#kota').select2({
            placeholder: "Cari Kota",
        });

        $('#prov_address').select2({
            placeholder: " Pilih Provinsi",
        });
        $('#kota_address').select2({
            placeholder: "Pilih Kota",
        })
        $('#daerah').select2({
            placeholder: "Pilih Daerah",
        })
        $('#desa').select2({
            placeholder: "Pilih Desa",
        })

        $('#prov_address').change(function() {
            var id = $(this).val();
            var url = '/get_kota/' + id;
            $('#kota_address').prop('disabled', false);
            $('#daerah').prop('disabled', true);
            $('#desa').prop('disabled', true);
            $('#kota_address').select2({
                placeholder: "Pilih Kota",
                ajax: {
                    url: url,
                    dataType: 'json',
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.code,
                                    text: item.name
                                }
                            })
                        }
                    }
                }
            })
        })

        $('#kota_address').change(function() {
            var id = $(this).val();
            var url = '/get_daerah/' + id;
            $('#kota_address').prop('disabled', false);
            $('#daerah').prop('disabled', false);
            $('#desa').prop('disabled', true);
            $('#daerah').select2({
                placeholder: "Pilih Daerah",
                ajax: {
                    url: url,
                    dataType: "JSON",
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.code,
                                    text: item.name,
                                }
                            })
                        }
                    }
                }
            })
        })

        $('#daerah').change(function() {
            var id = $(this).val();
            var url = '/get_desa/' + id;
            $('#kota_address').prop('disabled', false);
            $('#daerah').prop('disabled', false);
            $('#desa').prop('disabled', false);
            $('#desa').select2({
                placeholder: "Pilih Desa",
                ajax: {
                    url: url,
                    dataType: "JSON",
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.code,
                                    text: item.name,
                                }
                            })
                        }
                    }
                }
            })
        })
    </script>
@endpush
