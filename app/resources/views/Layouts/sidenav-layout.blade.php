<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>Pos - Management</title>

    <link rel="icon" type="image/x-icon" href="{{asset('backend/favicon.ico')}}" />
    <link href="{{asset('backend/css/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('backend/css/animate.min.css')}}" rel="stylesheet" />
    <link href="{{asset('backend/css/fontawesome.css')}}" rel="stylesheet" />
    <link href="{{asset('backend/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('backend/css/toastify.min.css')}}" rel="stylesheet" />

    <link href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css')}}" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('backend/css/dataTables.min.css')}}">
            <!-- Toastr Css -->
            <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <script src="{{asset('backend/js/jquery.min.js')}}"></script>
    <script src="{{asset('backend/js/dataTables.min.js')}}"></script>

    <script src="{{asset('backend/js/toastify-js.js')}}"></script>
    <script src="{{asset('backend/js/axios.min.js')}}"></script>
    <script src="{{asset('backend/js/config.js')}}"></script>
    <script src="{{asset('backend/js/bootstrap.bundle.min.js')}}"></script>


</head>

<body>

<div id="loader" class="LoadingOverlay d-none">
    <div class="Line-Progress">
        <div class="indeterminate"></div>
    </div>
</div>

<nav class="navbar fixed-top px-0 shadow-sm bg-white">
    <div class="container-fluid">

        <a class="navbar-brand" href="#">
            <span class="icon-nav m-0 h5" onclick="MenuBarClickHandler()">
                <img class="nav-logo-sm mx-2"  src="{{asset('backend/images/menu.svg')}}" alt="logo"/>
            </span>
            <img class="nav-logo  mx-2"  src="{{asset('backend/images/logo.png')}}" alt="logo"/>
        </a>

        <div class="float-right h-auto d-flex">
            <div class="user-dropdown">
                <img class="icon-nav-img" src="{{asset('backend/images/user.webp')}}" alt=""/>
                <div class="user-dropdown-content ">
                    <div class="mt-4 text-center">
                        <img class="icon-nav-img" src="{{asset('backend/images/user.webp')}}" alt=""/>
                        <h6>User Name</h6>
                        <hr class="user-dropdown-divider  p-0"/>
                    </div>
                    <a href="{{url('/userProfile')}}" class="side-bar-item">
                        <span class="side-bar-item-caption">Profile</span>
                    </a>
                    <a href="{{url("/logout")}}" class="side-bar-item">
                        <span class="side-bar-item-caption">Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>


<div id="sideNavRef" class="side-nav-open">
    <a href="{{url("/dashboard")}}" class="side-bar-item h5">
        <i class="bi bi-graph-up"></i>
        <span class="side-bar-item-caption">Dashboard</span>
    </a>
    <a href="{{route("SliderPage")}}" class="side-bar-item h5">
        <i class="bi bi-people"></i>
        <span class="side-bar-item-caption">Sliders</span>
    </a>
    <a href="{{route("brandPage")}}" class="side-bar-item h5">
        <i class="bi bi-people"></i>
        <span class="side-bar-item-caption">Brands</span>
    </a>
    <a href="{{route("CategoryPage")}}" class="side-bar-item h5">
        <i class="bi bi-list-nested"></i>
        <span class="side-bar-item-caption">Category</span>
    </a>

    <a href="{{route("ProductPage")}}" class="side-bar-item h5">
        <i class="bi bi-bag"></i>
        <span class="side-bar-item-caption">Product</span>
    </a>
    <a href="{{url("/SalePage")}}" class="side-bar-item h5">
        <i class="bi bi-currency-dollar"></i>
        <span class="side-bar-item-caption">On-Sales</span>
    </a>
    <a href="{{url("/invoicePage")}}" class="side-bar-item h5">
        <i class="bi bi-receipt"></i>
        <span class="side-bar-item-caption">Invoice</span>
    </a>
    <a href="{{url("/report-generator")}}" class="side-bar-item h5">
        <i class="bi bi-file-earmark-bar-graph"></i>
        <span class="side-bar-item-caption">Report</span>
    </a>
</div>


<div id="contentRef" class="content">
    @yield('content')
</div>


<script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

<script>
    function MenuBarClickHandler() {
        let sideNav = document.getElementById('sideNavRef');
        let content = document.getElementById('contentRef');
        if (sideNav.classList.contains("side-nav-open")) {
            sideNav.classList.add("side-nav-close");
            sideNav.classList.remove("side-nav-open");
            content.classList.add("content-expand");
            content.classList.remove("content");
        } else {
            sideNav.classList.remove("side-nav-close");
            sideNav.classList.add("side-nav-open");
            content.classList.remove("content-expand");
            content.classList.add("content");
        }
    }
</script>

</body>
</html>