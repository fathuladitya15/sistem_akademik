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
        <div class="d-flex flex-column flex-lg-row flex-column-fluid stepper stepper-pills stepper-column"
            id="kt_create_account_stepper">
            <div class="d-flex flex-column flex-lg-row-auto w-xl-500px bg-lighten shadow-sm">
                <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-500px scroll-y">
                    <div class="d-flex flex-row-fluid flex-column flex-center p-10 pt-lg-20">
                        <a href="#" class="mb-10 mb-lg-20">
                            <img alt="Logo" src="{{ asset('assets/media/logos/logo-1.svg') }}" class="h-40px" />
                        </a>
                        <div class="stepper-nav">
                            <!--begin::Step 1-->
                            <div class="stepper-item current" data-kt-stepper-element="nav">
                                <!--begin::Line-->
                                <div class="stepper-line w-40px"></div>
                                <!--end::Line-->
                                <!--begin::Icon-->
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="stepper-check fas fa-check"></i>
                                    <span class="stepper-number">1</span>
                                </div>
                                <!--end::Icon-->
                                <!--begin::Label-->
                                <div class="stepper-label">
                                    <h3 class="stepper-title">Biaya Registrasi</h3>
                                    <div class="stepper-desc fw-bold">Verifikasi Pembayaran Registrasi</div>
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Step 1-->
                            <!--begin::Step 2-->
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <!--begin::Line-->
                                <div class="stepper-line w-40px"></div>
                                <!--end::Line-->
                                <!--begin::Icon-->
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="stepper-check fas fa-check"></i>
                                    <span class="stepper-number">2</span>
                                </div>
                                <!--end::Icon-->
                                <!--begin::Label-->
                                <div class="stepper-label">
                                    <h3 class="stepper-title">Data Diri</h3>
                                    <div class="stepper-desc fw-bold">Masukan Data Diri Anda</div>
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Step 2-->
                            <!--begin::Step 3-->
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <!--begin::Line-->
                                <div class="stepper-line w-40px"></div>
                                <!--end::Line-->
                                <!--begin::Icon-->
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="stepper-check fas fa-check"></i>
                                    <span class="stepper-number">3</span>
                                </div>
                                <!--end::Icon-->
                                <!--begin::Label-->
                                <div class="stepper-label">
                                    <h3 class="stepper-title">
                                        Pilih Jurusan
                                    </h3>
                                    <div class="stepper-desc fw-bold">Plih Jurusan Anda</div>
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Step 3-->
                            <!--begin::Step 4-->
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <!--begin::Line-->
                                <div class="stepper-line w-40px"></div>
                                <!--end::Line-->
                                <!--begin::Icon-->
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="stepper-check fas fa-check"></i>
                                    <span class="stepper-number">4</span>
                                </div>
                                <!--end::Icon-->
                                <!--begin::Label-->
                                <div class="stepper-label">
                                    <h3 class="stepper-title">Upload Berkas</h3>
                                    <div class="stepper-desc fw-bold">Upload Berkas Berkas yang dibutuhkan</div>
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Step 4-->
                            <!--begin::Step 5-->
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <!--begin::Line-->
                                <div class="stepper-line w-40px"></div>
                                <!--end::Line-->
                                <!--begin::Icon-->
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="stepper-check fas fa-check"></i>
                                    <span class="stepper-number">5</span>
                                </div>
                                <!--end::Icon-->
                                <!--begin::Label-->
                                <div class="stepper-label">
                                    <h3 class="stepper-title">Completed</h3>
                                    <div class="stepper-desc fw-bold">Woah, we are here</div>
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Step 5-->
                        </div>
                        <!--end::Nav-->
                    </div>
                    <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-150px min-h-lg-300px"
                        style="background-image: url({{ asset('assets/media/illustrations/sketchy-1/16.png') }}"></div>
                </div>
            </div>
            <!--begin::Aside-->
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid py-10">
                <!--begin::Content-->
                <div class="d-flex flex-center flex-column flex-column-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-700px p-10 p-lg-15 mx-auto">
                        <!--begin::Form-->
                        <form class="my-auto pb-5" novalidate="novalidate" id="kt_create_account_form">
                            <!--begin::Step 1-->
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
                                        @if ($status_pembayaran == 1)
                                            <div class="alert alert-success" role="alert">Pembayaran Anda telah kami
                                                terima, Lanjutkan untuk mengisi form Selanjutnya</div>
                                        @endif
                                        <label class="form-label mb-3">Metode Pembayaran</label>
                                        <select name="va" id="va"
                                            class="form-control form-control-lg form-control-solid">
                                            <option value="">- Pilih Metode Virtual Account </option>
                                            @if ($status_pembayaran == 1)
                                                <option value="1" selected>Sudah Dibayarkan</option>
                                            @else
                                                @foreach ($va as $item)
                                                    <option value="{{ $item['code'] }}"
                                                        {{ $item['is_activated'] != true ? 'disabled' : '' }}>
                                                        {{ $item['name'] }}
                                                        {{ $item['is_activated'] != true ? '( Dalam Perbaikan )' : '' }}
                                                    </option>
                                                @endforeach
                                            @endif
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
                            <!--end::Step 1-->
                            <!--begin::Step 2-->
                            <div class="" data-kt-stepper-element="content">
                                <!--begin::Wrapper-->
                                <div class="w-100">
                                    <!--begin::Heading-->
                                    <div class="pb-10 pb-lg-15">
                                        <!--begin::Title-->
                                        <h2 class="fw-bolder text-dark">Data Diri Calon Peserta Didik</h2>
                                        <!--end::Title-->
                                        <!--begin::Notice-->
                                        <div class="text-muted fw-bold fs-6">Isi Data diri Calon Peserta Didik Baru
                                            {{-- <a href="#" class="link-primary fw-bolder">Help Page</a>. --}}
                                        </div>
                                        <!--end::Notice-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <label class="form-label mb-3">Nama Lengkap</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-lg form-control-solid"
                                            name="account_name" placeholder="" value="{{ Auth::user()->name }}"
                                            readonly />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <label class="form-label mb-3">NISN </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-lg form-control-solid"
                                            name="nisn" placeholder="" value="" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <label class="form-label mb-3">Jenis Kelamin</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="jenis_kelamin" id=""
                                            class="form-control form-control-lg form-control-solid">
                                            <option value="">-- Jenis Kelamin --</option>
                                            <option value="L">Laki - Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <label class="form-label mb-3">Tanggal Lahir</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="date" class="form-control form-control-lg form-control-solid"
                                            name="tanggal_lahir" placeholder="" value="" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <label class="form-label mb-3">Tempat Lahir</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="tempat_lahir" id="kota"
                                            class="form-control form-control-lg form-control-solid" id="">
                                            <option value="">-- Pilih Kota -- </option>

                                            @foreach ($kota as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Step 2-->
                            <!--begin::Step 3-->
                            <div class="" data-kt-stepper-element="content">
                                <!--begin::Wrapper-->
                                <div class="w-100">
                                    <!--begin::Heading-->
                                    <div class="pb-10 pb-lg-12">
                                        <!--begin::Title-->
                                        <h2 class="fw-bolder text-dark">Business Details</h2>
                                        <!--end::Title-->
                                        <!--begin::Notice-->
                                        <div class="text-muted fw-bold fs-6">If you need more info, please check out
                                            <a href="#" class="link-primary fw-bolder">Help Page</a>.
                                        </div>
                                        <!--end::Notice-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label required">Business Name</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input name="business_name"
                                            class="form-control form-control-lg form-control-solid"
                                            value="Keenthemes Inc." />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-10">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center form-label">
                                            <span class="required">Shortened Descriptor</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover"
                                                data-bs-trigger="hover" data-bs-html="true"
                                                data-bs-content="&lt;div class='p-4 rounded bg-light'&gt; &lt;div class='d-flex flex-stack text-muted mb-4'&gt; &lt;i class='fas fa-university fs-3 me-3'&gt;&lt;/i&gt; &lt;div class='fw-bold'&gt;INCBANK **** 1245 STATEMENT&lt;/div&gt; &lt;/div&gt; &lt;div class='d-flex flex-stack fw-bold text-gray-600'&gt; &lt;div&gt;Amount&lt;/div&gt; &lt;div&gt;Transaction&lt;/div&gt; &lt;/div&gt; &lt;div class='separator separator-dashed my-2'&gt;&lt;/div&gt; &lt;div class='d-flex flex-stack text-dark fw-bolder mb-2'&gt; &lt;div&gt;USD345.00&lt;/div&gt; &lt;div&gt;KEENTHEMES*&lt;/div&gt; &lt;/div&gt; &lt;div class='d-flex flex-stack text-muted mb-2'&gt; &lt;div&gt;USD75.00&lt;/div&gt; &lt;div&gt;Hosting fee&lt;/div&gt; &lt;/div&gt; &lt;div class='d-flex flex-stack text-muted'&gt; &lt;div&gt;USD3,950.00&lt;/div&gt; &lt;div&gt;Payrol&lt;/div&gt; &lt;/div&gt; &lt;/div&gt;"></i>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input name="business_descriptor"
                                            class="form-control form-control-lg form-control-solid"
                                            value="KEENTHEMES" />
                                        <!--end::Input-->
                                        <!--begin::Hint-->
                                        <div class="form-text">Customers will see this shortened version of your
                                            statement descriptor</div>
                                        <!--end::Hint-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label required">Corporation Type</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="business_type"
                                            class="form-select form-select-lg form-select-solid"
                                            data-control="select2" data-placeholder="Select..."
                                            data-allow-clear="true" data-hide-search="true">
                                            <option></option>
                                            <option value="1">S Corporation</option>
                                            <option value="1">C Corporation</option>
                                            <option value="2">Sole Proprietorship</option>
                                            <option value="3">Non-profit</option>
                                            <option value="4">Limited Liability</option>
                                            <option value="5">General Partnership</option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-10">
                                        <!--end::Label-->
                                        <label class="form-label">Business Description</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <textarea name="business_description" class="form-control form-control-lg form-control-solid" rows="3"></textarea>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-0">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-bold form-label required">Contact Email</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input name="business_email"
                                            class="form-control form-control-lg form-control-solid"
                                            value="corp@support.com" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Step 3-->
                            <!--begin::Step 4-->
                            <div class="" data-kt-stepper-element="content">
                                <!--begin::Wrapper-->
                                <div class="w-100">
                                    <!--begin::Heading-->
                                    <div class="pb-10 pb-lg-15">
                                        <!--begin::Title-->
                                        <h2 class="fw-bolder text-dark">Billing Details</h2>
                                        <!--end::Title-->
                                        <!--begin::Notice-->
                                        <div class="text-muted fw-bold fs-6">If you need more info, please check out
                                            <a href="#" class="text-primary fw-bolder">Help Page</a>.
                                        </div>
                                        <!--end::Notice-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-7 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                            <span class="required">Name On Card</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                title="Specify a card holder's name"></i>
                                        </label>
                                        <!--end::Label-->
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                            name="card_name" value="Max Doe" />
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-7 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold form-label mb-2">Card Number</label>
                                        <!--end::Label-->
                                        <!--begin::Input wrapper-->
                                        <div class="position-relative">
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Enter card number" name="card_number"
                                                value="4111 1111 1111 1111" />
                                            <!--end::Input-->
                                            <!--begin::Card logos-->
                                            <div class="position-absolute translate-middle-y top-50 end-0 me-5">
                                                <img src="{{ asset('assets/media/svg/card-logos/visa.svg') }}"
                                                    alt="" class="h-25px" />
                                                <img src="{{ asset('assets/media/svg/card-logos/mastercard.svg') }}"
                                                    alt="" class="h-25px" />
                                                <img src="{{ asset('assets/media/svg/card-logos/american-express.svg') }}"
                                                    alt="" class="h-25px" />
                                            </div>
                                            <!--end::Card logos-->
                                        </div>
                                        <!--end::Input wrapper-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-10">
                                        <!--begin::Col-->
                                        <div class="col-md-8 fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-6 fw-bold form-label mb-2">Expiration
                                                Date</label>
                                            <!--end::Label-->
                                            <!--begin::Row-->
                                            <div class="row fv-row">
                                                <!--begin::Col-->
                                                <div class="col-6">
                                                    <select name="card_expiry_month"
                                                        class="form-select form-select-solid" data-control="select2"
                                                        data-hide-search="true" data-placeholder="Month">
                                                        <option></option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-6">
                                                    <select name="card_expiry_year"
                                                        class="form-select form-select-solid" data-control="select2"
                                                        data-hide-search="true" data-placeholder="Year">
                                                        <option></option>
                                                        <option value="2021">2021</option>
                                                        <option value="2022">2022</option>
                                                        <option value="2023">2023</option>
                                                        <option value="2024">2024</option>
                                                        <option value="2025">2025</option>
                                                        <option value="2026">2026</option>
                                                        <option value="2027">2027</option>
                                                        <option value="2028">2028</option>
                                                        <option value="2029">2029</option>
                                                        <option value="2030">2030</option>
                                                        <option value="2031">2031</option>
                                                    </select>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-4 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                <span class="required">CVV</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                    data-bs-toggle="tooltip" title="Enter a card CVV code"></i>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input wrapper-->
                                            <div class="position-relative">
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                    minlength="3" maxlength="4" placeholder="CVV"
                                                    name="card_cvv" />
                                                <!--end::Input-->
                                                <!--begin::CVV icon-->
                                                <div class="position-absolute translate-middle-y top-50 end-0 me-3">
                                                    <!--begin::Svg Icon | path: icons/duotune/finance/fin002.svg-->
                                                    <span class="svg-icon svg-icon-2hx">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M22 7H2V11H22V7Z" fill="black" />
                                                            <path opacity="0.3"
                                                                d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19ZM14 14C14 13.4 13.6 13 13 13H5C4.4 13 4 13.4 4 14C4 14.6 4.4 15 5 15H13C13.6 15 14 14.6 14 14ZM16 15.5C16 16.3 16.7 17 17.5 17H18.5C19.3 17 20 16.3 20 15.5C20 14.7 19.3 14 18.5 14H17.5C16.7 14 16 14.7 16 15.5Z"
                                                                fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::CVV icon-->
                                            </div>
                                            <!--end::Input wrapper-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Label-->
                                        <div class="me-5">
                                            <label class="fs-6 fw-bold form-label">Save Card for further
                                                billing?</label>
                                            <div class="fs-7 fw-bold text-muted">If you need more info, please check
                                                budget planning</div>
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Switch-->
                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                checked="checked" />
                                            <span class="form-check-label fw-bold text-muted">Save Card</span>
                                        </label>
                                        <!--end::Switch-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Step 4-->
                            <!--begin::Step 5-->
                            <div class="" data-kt-stepper-element="content">
                                <!--begin::Wrapper-->
                                <div class="w-100">
                                    <!--begin::Heading-->
                                    <div class="pb-8 pb-lg-10">
                                        <!--begin::Title-->
                                        <h2 class="fw-bolder text-dark">Your Are Done!</h2>
                                        <!--end::Title-->
                                        <!--begin::Notice-->
                                        <div class="text-muted fw-bold fs-6">If you need more info, please
                                            <a href="#" class="link-primary fw-bolder">Sign In</a>.
                                        </div>
                                        <!--end::Notice-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Body-->
                                    <div class="mb-0">
                                        <!--begin::Text-->
                                        <div class="fs-6 text-gray-600 mb-5">Writing headlines for blog posts is as
                                            much an art as it is a science and probably warrants its own post, but for
                                            all advise is with what works for your great &amp; amazing audience.</div>
                                        <!--end::Text-->
                                        <!--begin::Alert-->
                                        <!--begin::Notice-->
                                        <div
                                            class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
                                            <!--begin::Icon-->
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                                            <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.3" x="2" y="2"
                                                        width="20" height="20" rx="10"
                                                        fill="black" />
                                                    <rect x="11" y="14" width="7"
                                                        height="2" rx="1" transform="rotate(-90 11 14)"
                                                        fill="black" />
                                                    <rect x="11" y="17" width="2"
                                                        height="2" rx="1" transform="rotate(-90 11 17)"
                                                        fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            <!--end::Icon-->
                                            <!--begin::Wrapper-->
                                            <div class="d-flex flex-stack flex-grow-1">
                                                <!--begin::Content-->
                                                <div class="fw-bold">
                                                    <h4 class="text-gray-900 fw-bolder">We need your attention!</h4>
                                                    <div class="fs-6 text-gray-700">To start using great tools, please,
                                                        please
                                                        <a href="#" class="fw-bolder">Create Team Platform</a>
                                                    </div>
                                                </div>
                                                <!--end::Content-->
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                        <!--end::Notice-->
                                        <!--end::Alert-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Step 5-->
                            <!--begin::Actions-->
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
                                        <!--end::Svg Icon-->Sebelumnya
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
                                        data-kt-stepper-action="next">Lanjutkan
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
    <script>
        $('#kota').select2({
            placeholder: "Cari Kota",
        });
    </script>
    <script src="{{ asset('assets/js/payments.js') }}"></script>
    <script src="{{ asset('assets/js/custom/modals/create-account.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/RegistrasiUser.js') }}"></script> --}}
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
