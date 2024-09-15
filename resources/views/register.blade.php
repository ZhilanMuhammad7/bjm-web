<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../../../" />
    <title>BJM - Register</title>
    <meta charset="utf-8" />
    <meta name="description" content="The most advanced Tailwind CSS & Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords" content="tailwind, tailwindcss, metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Metronic - The World's #1 Selling Tailwind CSS & Bootstrap Admin Template by KeenThemes" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Metronic by Keenthemes" />
    <link rel="canonical" href="http://preview.keenthemes.comauthentication/layouts/overlay/sign-up.html" />
    <link rel="shortcut icon" href="{{asset('metronic/assets/media/logos/favicon.ico')}}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{asset('metronic/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('metronic/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Page bg image-->
        <style>
            body {
                background-image: url('{{asset('metronic/assets/media/auth/bg10.jpeg')}}');
            }

            [data-bs-theme="dark"] body {
                background-image: url('{{asset('metronic/assets/media/auth/bg10-dark.jpeg')}}');
            }
        </style>
        <!--end::Page bg image-->
        <!--begin::Authentication - Sign-up -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <!--begin::Image-->
                    <img class="theme-light-show mx-auto mw-100 w-300px w-lg-500px mb-10 mb-lg-20" src="{{asset('metronic/assets/images/logo-bjm1.png')}}" alt="" />
                    <img class="theme-dark-show mx-auto mw-100 w-300px w-lg-500px mb-10 mb-lg-20" src="{{asset('metronic/assets/images/logo-bjm1.png')}}" alt="" />
                </div>
            </div>
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                            <form class="m-login__form m-form" action="{{route('auth.postRegister')}}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{Auth::user() ? Auth::user()->id : ''}}">
                                <div class="text-center mb-11">
                                    <h1 class="text-gray-900 fw-bolder mb-3">Daftar Sekarang</h1>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" placeholder="Nama Lengkap" name="name" autocomplete="off" class="form-control bg-transparent" required/>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" placeholder="Username" name="username" autocomplete="off" class="form-control bg-transparent" required/>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" placeholder="No.Handphone" name="no_hp" autocomplete="off" class="form-control bg-transparent" required/>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="email" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" required/>
                                </div>
                                <div class="fv-row mb-8" data-kt-password-meter="true">
                                    <div class="mb-1">
                                        <div class="position-relative mb-3">
                                            <input class="form-control bg-transparent" type="password" placeholder="Password" name="password" autocomplete="off" required/>
                                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                                <i class="ki-outline ki-eye-slash fs-2"></i>
                                                <i class="ki-outline ki-eye fs-2 d-none"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                        </div>
                                    </div>
                                    <div class="text-muted">Gunakan 8 atau lebih karakter dengan campuran huruf, angka, dan simbol.</div>
                                </div>
                                <div class="d-grid mb-10">
                                    <button type="submit" id="kt_sign_up_submit" class="btn" style="background-color: #FFD700; color: black;">
                                        <span class="indicator-label">Daftar</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <div class="text-gray-500 text-center fw-semibold fs-6">Sudah punya akun?
                                    <a href="{{route('auth.login')}}" class="link-primary fw-semibold">Masuk</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var hostUrl = "assets/";
    </script>
    <script src="{{asset('metronic/assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{asset('metronic/assets/js/scripts.bundle.js')}}"></script>
    <script src="{{asset('metronic/assets/js/custom/authentication/sign-up/general.js')}}"></script>
</body>

</html>