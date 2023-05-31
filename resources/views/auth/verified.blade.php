<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="">
    <title>Sistem Akademik - Verifikasi Email </title>
    <meta name="description"
        content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords"
        content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
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
        <!--begin::Authentication - Signup Verify Email -->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-column-fluid text-center p-10 py-lg-15">
                <!--begin::Logo-->
                <a href="#" class="mb-10 pt-lg-10">
                    <img alt="Logo" src="{{ asset('assets/media/logos/logo-1.svg') }}" class="h-40px mb-5" />
                </a>
                <!--end::Logo-->
                <!--begin::Wrapper-->
                <div class="pt-lg-10 mb-10">
                    <!--begin::Logo-->
                    <h1 class="fw-bolder fs-2qx text-gray-800 mb-7">Verify Your Email</h1>
                    <div class="fs-3 fw-bold text-muted mb-10">We have sent an email to
                        <a href="#" class="link-primary fw-bolder">{{ Auth::user()->email }}</a>
                        <br />pelase follow a link to verify your email.
                    </div>
                </div>
                <!--end::Wrapper-->
                <!--begin::Illustration-->
                <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px"
                    style="background-image: url({{ asset('assets/media/illustrations/sketchy-1/17.png') }}"></div>
                <!--end::Illustration-->
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
            <div class="d-flex flex-center flex-column-auto p-10">
                <!--begin::Links-->
                <div class="d-flex align-items-center fw-bold fs-6">
                    <a href="https://keenthemes.com" class="text-muted text-hover-primary px-2">About</a>
                    <a href="mailto:support@keenthemes.com" class="text-muted text-hover-primary px-2">Contact</a>
                    <a href="https://1.envato.market/EA4JP" class="text-muted text-hover-primary px-2">Contact Us</a>
                </div>
                <!--end::Links-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Authentication - Signup Verify Email-->
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
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
