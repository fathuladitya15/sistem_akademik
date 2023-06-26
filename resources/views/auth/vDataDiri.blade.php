<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../../">
    <title>Registrasi Peserta Didik Baru </title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }} " />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body id="kt_body" class="bg-body">
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid stepper stepper-pills stepper-column" >
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid ">
                <!--begin::Content-->
                <div class="d-flex flex-center flex-column flex-column-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-700px p-10 p-lg-15 mx-auto">
                        <!--begin::Form-->
                        <form class="my-auto pb-5" novalidate="novalidate" id="kt_create_account_form">
                            <div class="current" data-kt-stepper-element="content">
                                <!--begin::Wrapper-->
                                <div class="w-100" id="">
                                    <!--begin::Heading-->
                                    <div class="pb-10 pb-lg-15">
                                        <!--begin::Title-->
                                        <h2 class="fw-bolder d-flex align-items-center text-dark">Pembayaran Biaya
                                            Registrasi
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                title="Silahkan Selesaikan Pembyaran Terlebih dahulu untuk melanjutkan ke task berikutnya"></i>
                                        </h2>
                                        <!--end::Title-->
                                        <!--begin::Notice-->
                                        <div class="text-muted fw-bold fs-6">Apabila Halaman ini Tidak Berubah setelah
                                            pembayaran silahkan isi form dibawah untuk memverifikasi
                                            {{-- <a href="#" class="link-primary fw-bolder">Help Page</a>. --}}
                                        </div>
                                        <!--end::Notice-->
                                    </div>
                                    <div class="mb-10 fv-row">
                                        <label class="form-label mb-3">Metode Pembayaran</label>
                                        <select name="va" id="va"
                                            class="form-control form-control-lg form-control-solid">
                                            <option value="">- Pilih Metode Virtual Account </option>
                                            @foreach ($va as $item)
                                                <option value="{{ $item['code'] }}"
                                                    {{ $item['is_activated'] != true ? 'disabled' : '' }}>
                                                    {{ $item['name'] }}
                                                    {{ $item['is_activated'] != true ? '( Dalam Perbaikan )' : '' }}
                                                </option>
                                            @endforeach
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="mb-10 fv-row">
                                        <div class="card" style="background-color: white; display:none"
                                            id="card-pembayaran">
                                            <div class="card-body">
                                                <h2>Virtual Account</h2>
                                                {{-- <img src="{{ asset('assets/media/logos/Banks/Mandiri.png') }}"
                                                    alt="" id="logo_banks" width="150" height="90"> --}}
                                                <h3 id="banks"></h3>
                                                <br>
                                                <h1 class="text-center" id="code_virtual"></h1>
                                                <br />
                                                <button type="button" id="proses_pembayaran"
                                                    class="btn btn-lg btn-light-success me-3" style="float: right;">
                                                    Proses Pembayaran
                                                </button>
                                            </div>
                                            <div class="card-footer">
                                                <h3>Tata Cara Pembayaran</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="external_id" name="external_id">
                                    <input type="hidden" id="bank_code" name="bank_code">
                                    <!--end::Heading-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <div class="d-flex flex-stack pt-15">
                                <div class="mr-2">
                                    <button type="button" class="btn btn-lg btn-light-primary me-3"
                                        data-kt-stepper-action="previous">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
                                        <span class="svg-icon svg-icon-4 me-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="6" y="11" width="13"
                                                    height="2" rx="1" fill="black" />
                                                <path
                                                    d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->Previous
                                    </button>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-lg btn-primary"
                                        data-kt-stepper-action="submit">
                                        <span class="indicator-label">Submit
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                            <span class="svg-icon svg-icon-4 ms-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="18" y="13"
                                                        width="13" height="2" rx="1"
                                                        transform="rotate(-180 18 13)" fill="black" />
                                                    <path
                                                        d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                        fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <button type="button" class="btn btn-lg btn-primary"
                                        data-kt-stepper-action="next">Continue
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                        <span class="svg-icon svg-icon-4 ms-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="18" y="13" width="13"
                                                    height="2" rx="1" transform="rotate(-180 18 13)"
                                                    fill="black" />
                                                <path
                                                    d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </button>
                                </div>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Multi-steps-->
    </div>
    <!--end::Main-->
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script>
        url_cek_pembayaran = "{{ route('Xendit.AuthPayment') }}";
        url_generate = "{{ route('Xendit.generateVA') }}";
        asset = "{{ asset('assets/media/logos/Banks/') }}";
        status_pembayaran = "{{ $status_pembayaran }}";
    </script>
    <script src="{{ asset('assets/js/payments.js') }}"></script>
    <script src="{{ asset('assets/js/custom/modals/create-account.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/RegistrasiUser.js') }}"></script> --}}
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
