<!DOCTYPE html>
<html lang="en">

<head>
    <base href="">
    <title>Sistem Informasi Akademik -- Login Page</title>
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="bg-body">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative"
                style="background-color: #F2C98A">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                    <!--begin::Content-->
                    <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
                        <!--begin::Logo-->
                        <a href="../../demo8/dist/index.html" class="py-9 mb-5">
                            <img alt="Logo" src="{{ asset('assets/media/logos/logo-2.svg') }}" class="h-60px" />
                        </a>
                        <!--end::Logo-->
                        <!--begin::Title-->
                        <h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #986923;">Selamat Datang di Sistem
                            Informasi Akademik</h1>
                        <!--end::Title-->
                        <!--begin::Description-->
                        <p class="fw-bold fs-2" style="color: #986923;">Discover Amazing System
                            <br />with great build tools
                        </p>
                        <!--end::Description-->
                    </div>
                    <!--end::Content-->
                    <!--begin::Illustration-->
                    <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px"
                        style="background-image: url({{ asset('assets/media/illustrations/sketchy-1/13.png') }})"></div>
                    <!--end::Illustration-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Aside-->
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid py-10">
                <!--begin::Content-->
                <div class="d-flex flex-center flex-column flex-column-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                        <!--begin::Form-->
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="#">
                            @csrf
                            <!--begin::Heading-->
                            <div class="text-center mb-10">
                                <!--begin::Title-->
                                <h1 class="text-dark mb-3">Login Siakad</h1>
                                <!--end::Title-->
                                <!--begin::Link-->
                                {{-- <div class="text-gray-400 fw-bold fs-4">New Here?
                                    <a href="" class="link-primary fw-bolder">Create an Account</a>
                                </div> --}}
                                <!--end::Link-->
                            </div>
                            <!--begin::Heading-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--begin::Label-->
                                <label class="form-label fs-6 fw-bolder text-dark">Username</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-lg form-control-solid" type="text"
                                    name="username" autocomplete="off" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack mb-2">
                                    <!--begin::Label-->
                                    <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                                    <!--end::Label-->
                                    <!--begin::Link-->
                                    <a href="javascript:void(0)" class="link-primary fs-6 fw-bolder">Forgot Password
                                        ?</a>
                                    <!--end::Link-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Input-->
                                <input class="form-control form-control-lg form-control-solid" type="password"
                                    name="password" autocomplete="off" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Actions-->
                            <div class="text-center">
                                <!--begin::Submit button-->
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                                    <span class="indicator-label">Continue</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Submit button-->
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
                <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
                    <!--begin::Links-->
                    {{-- <div class="d-flex flex-center fw-bold fs-6">
                        <a href="#" class="text-muted text-hover-primary px-2" target="_blank">About</a>
                        <a href="#" class="text-muted text-hover-primary px-2" target="_blank">Support</a>
                        <a href="#" class="text-muted text-hover-primary px-2" target="_blank">Purchase</a>
                    </div> --}}
                    <!--end::Links-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Main-->
    <script>
        var hostUrl = "assets/";
        var url_login = "{{ route('login.post') }}";
    </script>
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
